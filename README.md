# LLSketch – Large Language Sketch

**The Spatial Language for AI** — a compact, visual language that enables AIs to think and construct spatially.

LLSketch is an ultra-compact, comma-separated text format for token-efficient transmission of spatial sketches and scene data to AI systems — and back to renderers (SVG, WebGL, Canvas). Use it for tactical maps, floor plans, or mechanical blueprints.

## Use in ChatGPT, Gemini, Claude …

**No code required.** Copy the prompt from **[Quick start for AI chat](docs/QUICK-START-AI.md)** into any chat — that is all most users need.

| Prompt | When to use |
|--------|-------------|
| **[QUICK-START-AI.md](docs/QUICK-START-AI.md)** | Minimal block (~30 lines) — paste and go |
| **[AI-INSTRUCTIONS.md](docs/AI-INSTRUCTIONS.md)** | Full version with spatial-reasoning directive & test tasks |

## Why LLSketch?

| Problem with SVG/JSON/XML | LLSketch solution |
|---------------------------|-------------------|
| High token usage from tags and quotes | Fixed CSV columns, one letter per type |
| AI “sees” space poorly in prose | Coordinates = virtual eye for spatial reasoning |
| URLs break on `;`, `\|`, line breaks, **spaces in IDs** | URL-safe delimiters (`:`, `_`, `!`); IDs use `_` not spaces |
| Base64 inflates text (~33 %) | Plain text in chat; LZ only for engine transfer |

## Two formats — clear responsibilities

| Format | Who produces it? | Purpose |
|--------|------------------|---------|
| **`<llsketch>`** | **AI & human** | Readable in chat, editable, spatially interpretable |
| **`<rllsketch>`** | **Engine only** (JS/PHP) | LZ-compressed string for URLs (`?data=…`), APIs, DB |

⚠️ **AI must never compute or hallucinate `<rllsketch>` itself.**  
If an AI should deliver compact output: single-line plain text with `!` as object separator — still readable LLSketch, not LZ gibberish.

## Quick start (example sketch)

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107
c,Mountain,850,200,150,6c757d
r,My-Troop,180,480,150:120,198754
p,Path,180,480,500:480_850:350,0dcaf0
</llsketch>
```

Single-line (inline, e.g. for copy/paste or engine input):

```text
r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!r,My-Troop,180,480,150:120,198754
```

## Documentation

- **[Quick start for AI chat](docs/QUICK-START-AI.md)** — minimal paste block for any chat
- [AI instructions](docs/AI-INSTRUCTIONS.md) — full prompt + calibration & test tasks
- [Specification v1.1](docs/SPECIFICATION.md) — syntax, types, delimiters, rotation
- [Beta test](docs/BETA-TEST.md) — test course for ChatGPT, Claude, Gemini & co.
- [SVG comparison](examples/comparison.md) — token savings example

## Examples

| File | Purpose |
|------|---------|
| [examples/training.llsketch](examples/training.llsketch) | Minimal starter scene (4 objects, no rotation) |
| [examples/battlefield.llsketch](examples/battlefield.llsketch) | Full tactical map with labels |
| [examples/mechanics.llsketch](examples/mechanics.llsketch) | Blueprint / gear demo (v1.1 rotation) |

## Live demo

Open [demo/index.html](demo/index.html) via a **local web server** (ES module import):

```bash
npx --yes serve .
# then visit http://localhost:3000/demo/
```

Paste any `.llsketch` file or edit inline — preview SVG, inline (`!`), or `<rllsketch>` (LZ).

## Reference implementation

- `lib/llsketch-parser.php` — LLSketch → SVG
- `lib/llsketch.js` — parse, inline (`!`), LZ ↔ `<rllsketch>` (requires [lz-string](https://github.com/pieroxy/lz-string))

## Supported geometry (v1.1)

| Type | Meaning | Dimensions (column 5) |
|------|---------|------------------------|
| `r` | Rectangle | `width:height[:angle]` |
| `c` | Circle | `radius` |
| `e` | Ellipse | `rx:ry[:angle]` |
| `p` | Path / polygon / freehand | `x2:y2_x3:y3_…` |
| `t` | Text | `fontSize[:angle]` (ID = text content) |

Optional **angle** in degrees (clockwise, SVG convention). Example: `r,Battering-Ram,230,230,180:20:10,6c757d` (see [mechanics.llsketch](examples/mechanics.llsketch))

## Beta status

This repository is in **public beta**. Goal: test various LLMs with the same specification to see whether syntax **and** spatial logic work consistently.

## License

MIT — see [LICENSE](LICENSE).
