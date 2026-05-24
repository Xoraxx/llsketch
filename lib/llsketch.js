/**
 * LLSketch v1.2 – browser reference (parse, inline, optional LZ via LZString)
 * Load lz-string before compress/decompress: https://github.com/pieroxy/lz-string
 */

const LLSKETCH_TYPES = new Set(['r', 'c', 'e', 'f', 'p', 't']);

function llsketchExtractPayload(input) {
  const s = String(input).trim();
  const ll = s.match(/<llsketch>([\s\S]*?)<\/llsketch>/i);
  if (ll) return ll[1].trim();
  const rl = s.match(/<rllsketch>([\s\S]*?)<\/rllsketch>/i);
  if (rl) return rl[1].trim(); // still compressed – caller must decompress
  return s;
}

function llsketchSplitObjects(payload) {
  const lines = [];
  for (const rawLine of payload.replace(/\r\n?/g, '\n').split('\n')) {
    const line = rawLine.trim();
    if (!line || line.startsWith('#')) continue;
    for (const chunk of line.split('!')) {
      const c = chunk.trim();
      if (c) lines.push(c);
    }
  }
  return lines;
}

function llsketchParseLine(line) {
  const parts = [];
  let cur = '';
  let inQuotes = false;
  for (let i = 0; i < line.length; i++) {
    const ch = line[i];
    if (ch === '"') {
      inQuotes = !inQuotes;
      continue;
    }
    if (ch === ',' && !inQuotes) {
      parts.push(cur.trim());
      cur = '';
    } else {
      cur += ch;
    }
  }
  parts.push(cur.trim());
  if (parts.length < 6) return null;
  const [type, id, x, y, dims, fill] = parts;
  if (!LLSKETCH_TYPES.has(type.toLowerCase())) return null;
  return {
    type: type.toLowerCase(),
    id,
    x: parseFloat(x),
    y: parseFloat(y),
    dims,
    fill: fill.replace(/^#/, ''),
  };
}

/** @returns {Array<{type,id,x,y,dims,fill}>} */
export function llsketchParse(input) {
  const payload = llsketchExtractPayload(input);
  return llsketchSplitObjects(payload)
    .map(llsketchParseLine)
    .filter(Boolean);
}

/** Multiline <llsketch> block → single line with ! */
export function llsketchToInline(objectsOrText) {
  const objs = Array.isArray(objectsOrText)
    ? objectsOrText
    : llsketchSplitObjects(llsketchExtractPayload(objectsOrText));
  return objs.join('!');
}

/** Multiline human-readable block */
export function llsketchToBlock(inlineOrObjects) {
  const inline = Array.isArray(inlineOrObjects)
    ? inlineOrObjects.join('!')
    : llsketchToInline(inlineOrObjects);
  return `<llsketch>\n${inline.split('!').join('\n')}\n</llsketch>`;
}

function llsketchSvgRotate(angle, cx, cy) {
  const deg = parseFloat(angle);
  if (!deg) return '';
  return ` transform="rotate(${deg}, ${cx}, ${cy})"`;
}

export function llsketchToSvg(input, viewBox = '0 0 1600 1000') {
  const objs = llsketchParse(input);
  let elements = '';
  for (const o of objs) {
    const fill = '#' + o.fill.replace(/^#/, '');
    const esc = (s) =>
      String(s)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/"/g, '&quot;');
    switch (o.type) {
      case 'r': {
        const [w, h, angle] = o.dims.split(':');
        const wf = parseFloat(w);
        const hf = parseFloat(h);
        const rot = llsketchSvgRotate(angle, o.x + wf / 2, o.y + hf / 2);
        elements += `<rect id="${esc(o.id)}" x="${o.x}" y="${o.y}" width="${w}" height="${h}" fill="${fill}"${rot} />\n`;
        break;
      }
      case 'c':
        elements += `<circle id="${esc(o.id)}" cx="${o.x}" cy="${o.y}" r="${o.dims}" fill="${fill}" />\n`;
        break;
      case 'e': {
        const [rx, ry, angle] = o.dims.split(':');
        const rot = llsketchSvgRotate(angle, o.x, o.y);
        elements += `<ellipse id="${esc(o.id)}" cx="${o.x}" cy="${o.y}" rx="${rx}" ry="${ry}" fill="${fill}"${rot} />\n`;
        break;
      }
      case 'f':
      case 'p': {
        let d = `M ${o.x} ${o.y}`;
        for (const pair of o.dims.split('_')) {
          const [px, py] = pair.split(':');
          if (px && py) d += ` L ${px} ${py}`;
        }
        if (o.type === 'f') {
          d += ' Z';
          elements += `<path id="${esc(o.id)}" d="${d}" fill="${fill}" />\n`;
        } else {
          elements += `<path id="${esc(o.id)}" d="${d}" fill="none" stroke="${fill}" stroke-width="2" />\n`;
        }
        break;
      }
      case 't': {
        const [size, angle] = o.dims.split(':');
        const rot = llsketchSvgRotate(angle, o.x, o.y);
        elements += `<text x="${o.x}" y="${o.y}" fill="${fill}" font-size="${size}"${rot}>${esc(o.id)}</text>\n`;
        break;
      }
    }
  }
  return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="${viewBox}">\n${elements}</svg>`;
}

/** Requires global LZString (lz-string library) */
export function llsketchCompressToRllsketch(inlineLlsketch) {
  if (typeof LZString === 'undefined') {
    throw new Error('LZString not loaded. Include lz-string before compress.');
  }
  const inline = llsketchToInline(inlineLlsketch);
  return LZString.compressToEncodedURIComponent(inline);
}

export function llsketchDecompressRllsketch(compressed) {
  if (typeof LZString === 'undefined') {
    throw new Error('LZString not loaded.');
  }
  const plain = LZString.decompressFromEncodedURIComponent(compressed.trim());
  if (!plain) throw new Error('Invalid rllsketch payload');
  return plain;
}

/** Auto: llsketch inline/tags or rllsketch LZ blob */
export function llsketchResolve(input) {
  const raw = String(input).trim();
  const rll = raw.match(/<rllsketch>([\s\S]*?)<\/rllsketch>/i);
  const payload = rll ? rll[1].trim() : raw;
  if (/^[rceptf],/i.test(payload)) {
    return llsketchExtractPayload(raw);
  }
  return llsketchDecompressRllsketch(payload);
}
