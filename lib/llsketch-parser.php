<?php
/**
 * LLSketch v1.2 → SVG reference parser
 *
 * Accepts: raw inline, <llsketch>…</llsketch>, or LZ <rllsketch> (decompress first)
 */

function llsketch_extract_payload(string $input): string
{
    $input = trim($input);
    if (preg_match('/<llsketch>(.*?)<\/llsketch>/is', $input, $m)) {
        return trim($m[1]);
    }
    if (preg_match('/<rllsketch>(.*?)<\/rllsketch>/is', $input, $m)) {
        throw new RuntimeException('rllsketch must be decompressed before parsing (use JS LZString or llsketch_decompress_rllsketch).');
    }
    return $input;
}

/** Split objects by newline or ! */
function llsketch_split_objects(string $payload): array
{
    $payload = str_replace(["\r\n", "\r"], "\n", $payload);
    $lines = [];
    foreach (explode("\n", $payload) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        foreach (explode('!', $line) as $chunk) {
            $chunk = trim($chunk);
            if ($chunk !== '') {
                $lines[] = $chunk;
            }
        }
    }
    return $lines;
}

function llsketch_color(string $hex): string
{
    $hex = ltrim(trim($hex), '#');
    if ($hex === '') {
        return '#000000';
    }
    return '#' . $hex;
}

function llsketch_parse_path_points(string $dims, float $x0, float $y0, bool $close = false): string
{
    $pairs = explode('_', $dims);
    $d = sprintf('M %.4F %.4F', $x0, $y0);
    foreach ($pairs as $pair) {
        $pair = trim($pair);
        if ($pair === '') {
            continue;
        }
        $parts = explode(':', $pair, 2);
        if (count($parts) !== 2) {
            continue;
        }
        $d .= sprintf(' L %.4F %.4F', (float) $parts[0], (float) $parts[1]);
    }
    if ($close) {
        $d .= ' Z';
    }
    return $d;
}

/**
 * @return array<int, array{type:string, id:string, x:float, y:float, dims:string, fill:string}>
 */
function llsketch_parse_objects(string $input): array
{
    $payload = llsketch_extract_payload($input);
    $objects = [];
    foreach (llsketch_split_objects($payload) as $line) {
        $data = str_getcsv($line);
        if (count($data) < 6) {
            continue;
        }
        $type = strtolower(trim($data[0]));
        $id = trim($data[1]);
        $x = (float) trim($data[2]);
        $y = (float) trim($data[3]);
        $dims = trim($data[4]);
        $fill = llsketch_color($data[5]);

        $objects[] = [
            'type' => $type,
            'id' => $id,
            'x' => $x,
            'y' => $y,
            'dims' => $dims,
            'fill' => $fill,
        ];
    }
    return $objects;
}

function llsketch_svg_rotate(?float $angle, float $cx, float $cy): string
{
    if ($angle === null || $angle == 0.0) {
        return '';
    }
    return sprintf(' transform="rotate(%s, %s, %s)"', $angle, $cx, $cy);
}

function llsketch_object_to_svg(array $obj): string
{
    $id = htmlspecialchars($obj['id'], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $fill = htmlspecialchars($obj['fill'], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $type = $obj['type'];
    $x = $obj['x'];
    $y = $obj['y'];
    $dims = $obj['dims'];

    switch ($type) {
        case 'r':
            $parts = explode(':', $dims);
            $w = (float) ($parts[0] ?? 0);
            $h = (float) ($parts[1] ?? 0);
            $angle = isset($parts[2]) ? (float) $parts[2] : null;
            $rot = llsketch_svg_rotate($angle, $x + $w / 2, $y + $h / 2);
            return sprintf(
                "<rect id=\"%s\" x=\"%s\" y=\"%s\" width=\"%s\" height=\"%s\" fill=\"%s\"%s />\n",
                $id, $x, $y, $w, $h, $fill, $rot
            );
        case 'c':
            return sprintf(
                "<circle id=\"%s\" cx=\"%s\" cy=\"%s\" r=\"%s\" fill=\"%s\" />\n",
                $id, $x, $y, (float) $dims, $fill
            );
        case 'e':
            $parts = explode(':', $dims);
            $rx = (float) ($parts[0] ?? 0);
            $ry = (float) ($parts[1] ?? 0);
            $angle = isset($parts[2]) ? (float) $parts[2] : null;
            $rot = llsketch_svg_rotate($angle, $x, $y);
            return sprintf(
                "<ellipse id=\"%s\" cx=\"%s\" cy=\"%s\" rx=\"%s\" ry=\"%s\" fill=\"%s\"%s />\n",
                $id, $x, $y, $rx, $ry, $fill, $rot
            );
        case 'f':
            $d = llsketch_parse_path_points($dims, $x, $y, true);
            return sprintf(
                "<path id=\"%s\" d=\"%s\" fill=\"%s\" />\n",
                $id, htmlspecialchars($d, ENT_QUOTES | ENT_XML1, 'UTF-8'), $fill
            );
        case 'p':
            $d = llsketch_parse_path_points($dims, $x, $y, false);
            return sprintf(
                "<path id=\"%s\" d=\"%s\" fill=\"none\" stroke=\"%s\" stroke-width=\"2\" />\n",
                $id, htmlspecialchars($d, ENT_QUOTES | ENT_XML1, 'UTF-8'), $fill
            );
        case 't':
            $parts = explode(':', $dims);
            $size = (float) ($parts[0] ?? 0);
            $angle = isset($parts[1]) ? (float) $parts[1] : null;
            $rot = llsketch_svg_rotate($angle, $x, $y);
            $text = $id;
            return sprintf(
                "<text x=\"%s\" y=\"%s\" fill=\"%s\" font-size=\"%s\"%s>%s</text>\n",
                $x, $y, $fill, $size, $rot, htmlspecialchars($text, ENT_QUOTES | ENT_XML1, 'UTF-8')
            );
        default:
            return '';
    }
}

function llsketch_to_svg(string $input, string $viewBox = '0 0 1600 1000'): string
{
    $elements = '';
    foreach (llsketch_parse_objects($input) as $obj) {
        $elements .= llsketch_object_to_svg($obj);
    }
    return "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"{$viewBox}\">\n{$elements}</svg>";
}
