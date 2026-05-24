# LLSketch – Large Language Sketch

**The Spatial Language for AI** — a compact, visual language that enables AIs to think and construct spatially.

LLSketch is an ultra-compact, comma-separated text format for token-efficient transmission of spatial sketches and scene data to AI systems — and back to renderers (SVG, WebGL, Canvas).

## The problem

If you have tried to make an LLM understand a physical environment — for autonomous agents, RPGs, or worldbuilding — you may have fed it a large JSON or XML map. It consumes hundreds or thousands of tokens, and a few prompts later the model still hallucinates a door where a wall should be, or forgets the scale of a room.

JSON is excellent for APIs; for an LLM context window it adds syntactic bloat. LLSketch strips that away: a fixed **6-column** layout that keeps coordinates dense and readable.

## Who is this for?

| Use case | Example |
|----------|---------|
| **RPG & worldbuilding** | Tactical maps, troop positions, terrain |
| **Autonomous agents** | Room layouts, object relations, navigation |
| **Floor plans & blueprints** | Walls, machinery, rotated components (v1.1) |
| **Any chat-based AI** | Paste a sketch — no SDK required |

See [Inference patterns](docs/SPECIFICATION.md#11-inference-patterns-heuristic) in the spec for what models can derive from coordinates (scale, line of sight, proximity, causality).

## Try it

| Resource | Link |
|----------|------|
| **Web editor (WYSIWYG)** | [ai-storycrafter.com/llsketch-editor.php](https://ai-storycrafter.com/llsketch-editor.php) — draw, export prompt-ready LLSketch ([integration guide](docs/WEB-EDITOR.md)) |
| **60-second video (PoC)** | [YouTube](https://www.youtube.com/watch?v=LsJxSLlCcOY) |
| **Local demo (this repo)** | [demo/index.html](demo/index.html) — parse, SVG preview, LZ (see below) |

## Use in ChatGPT, Gemini, Claude …

**No code required.** Copy the prompt from **[Quick start for AI chat](docs/QUICK-START-AI.md)** into any chat — that is all most users need.

| Prompt | When to use |
|--------|-------------|
| **[QUICK-START-AI.md](docs/QUICK-START-AI.md)** | **One-liner** for untrained AIs, or ~30-line block |
| **[AI-INSTRUCTIONS.md](docs/AI-INSTRUCTIONS.md)** | Full version with spatial-reasoning directive & test tasks |

**Ultra-compact (copy + sketch):**

```text
[Format <llsketch> (Spatial Reasoning) | 6-Cols: Type,ID,X,Y,Dim,Hex | r=W:H[:A],c=Rad,e=RX:RY[:A],f=x2:y2_x3:y3,p=x2:y2_x3:y3,t=Size[:A] | ID=no_space | ! end_each_obj | A=deg CW]
```

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
| **`<rllsketch>`** | **Engine only** (JS/PHP) | Raw LZ payload for URLs (`?data=…`), APIs, DB — not the format one-liner |

Three layers: **format one-liner** (prompt/script) → **inline** (raw data) → **rllsketch** (raw compressed data). See [Spec §5](docs/SPECIFICATION.md#5-transfer-formats).

⚠️ **AI must never compute or hallucinate `<rllsketch>` itself.**  
If an AI should deliver compact output: single-line plain text with `!` as object separator — still readable LLSketch, not LZ gibberish.

## Quick start (example sketch)

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
r,My-Troop,180,480,150:120,198754!
p,Path,180,480,500:480_850:350,0dcaf0!
</llsketch>
```

Single-line (inline, e.g. for copy/paste or engine input):

```text
r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!r,My-Troop,180,480,150:120,198754!
```

## Documentation

- **[Quick start for AI chat](docs/QUICK-START-AI.md)** — minimal paste block for any chat
- [AI instructions](docs/AI-INSTRUCTIONS.md) — full prompt + calibration & test tasks
- [Specification v1.2](docs/SPECIFICATION.md) — syntax, types (`f`/`p`), delimiters, rotation
- [Web editor integration](docs/WEB-EDITOR.md) — Canvas/SVG snippet for `f` vs `p`
- [Beta test](docs/BETA-TEST.md) — structured test protocol (quick + full track)
- [SVG comparison](examples/comparison.md) — token savings example

## Examples

| File | Purpose |
|------|---------|
| [examples/training.llsketch](examples/training.llsketch) | Minimal starter scene (4 objects, no rotation) |
| [examples/battlefield.llsketch](examples/battlefield.llsketch) | Full tactical map with labels |
| [examples/mechanics.llsketch](examples/mechanics.llsketch) | Blueprint / gear demo (v1.1 rotation) |
| [examples/enclosure.llsketch](examples/enclosure.llsketch) | Closed `f` vs open `p` (v1.2) |
| [examples/scale-reference.llsketch](examples/scale-reference.llsketch) | Scale convention (`Reference_20m`) |

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

## Supported geometry (v1.2)

| Type | Meaning | Dimensions (column 5) |
|------|---------|------------------------|
| `r` | Rectangle | `width:height[:angle]` |
| `c` | Circle | `radius` |
| `e` | Ellipse | `rx:ry[:angle]` |
| `f` | Form / closed polygon | `x2:y2_x3:y3_…` (solid fill; **prefer `r`/`c` for simple zones**) |
| `p` | Path / open polyline | `x2:y2_x3:y3_…` (stroke only) |
| `t` | Text | `fontSize[:angle]` (ID = text content) |

Optional **angle** in degrees (clockwise, SVG convention). Example: `r,Battering-Ram,230,230,180:20:10,6c757d!` (see [mechanics.llsketch](examples/mechanics.llsketch))

## Beta status

This repository is in **public beta**. Goal: test various LLMs with the same specification to see whether syntax **and** spatial logic work consistently.

## License

MIT — see [LICENSE](LICENSE).
