# LLSketch v1.2 – Specification

**LLSketch** = *Large Language Sketch*  
**The Spatial Language for AI** — a compact, visual language for spatial thinking and construction by AIs.

## 1. Core directive: spatial seeing & logical application

> ⚠️ **IMPORTANT INSTRUCTION FOR THE AI**

This data is **not** for pure mathematical storage. **LLSketch is your virtual eye.**

You should use the coordinates to **visualize the scene spatially** — maps, tactical layouts, blueprints, or mechanical assemblies. From that, derive implicit logical, semantic, and tactical consequences — e.g.:

- Estimate distances and directions
- Check sight lines and obstacles
- Interpret paths and tactical positions
- **Heuristically** infer causality for environmental damage (rockfall, fire, flood)

Every sketch change and every narrative statement must follow this spatial logic. Copying coordinates without spatial meaning is not allowed.

### 1.1 Inference patterns (heuristic)

LLSketch does not embed a physics engine. With the core directive above, capable LLMs **consistently infer** plausible consequences from `(X,Y)` geometry — especially when the sketch is compact enough to treat as a whole scene.

| Pattern | Idea | Example prompt outcome |
|---------|------|------------------------|
| **Scale reference** | A named reference object encodes real-world size | `Reference_20m` as a 20-unit bar → travel times and distances stay coherent |
| **Line of sight** | Rectangles/circles/**closed forms `f`** block vectors between points | *“You cannot see them — the machinery is in the way.”* |
| **Proximity** | Distance between centers/edges | *“The drive-belt at X=100 is loud; a character 15 m away would not hear a whisper.”* |
| **Causal relations** | Overlapping or adjacent shapes imply mechanics | Fulcrum + plank + weight → plausible lever / chain reaction narration |

These are **heuristic**, not guaranteed. Reinforce with the spatial prompt ([QUICK-START-AI.md](QUICK-START-AI.md) or [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md)). Validate critical layouts via [BETA-TEST.md](BETA-TEST.md).

### 1.2 Scale by convention (optional)

No extra schema column is required. Encode scale in the **ID** and dimensions of a reference object:

```text
r,Reference_20m,0,400,200:10,b0b0b0!
```

Interpretation: the bar spans **200 coordinate units** and represents **20 meters** → 10 units = 1 m. Place it once per sketch (or per region). All other objects inherit proportional reasoning.

Example file: [scale-reference.llsketch](../examples/scale-reference.llsketch).

---

## 2. Basic principle

- Each **line** (or each `!` segment) = **one object**
- **End each object with `!`** (copy-safe; survives lost line breaks on copy/paste)
- Fields separated by **comma** `,`
- No XML tags, no quotes, no units (`px`, `m`)
- Colors: hex **without** `#`
- **IDs: no spaces** — use `_` (e.g. `My_Troop`, not `My Troop`). Inline LLSketch is passed in URLs as `?data=…`; spaces break encoding and transfer.
- Coordinate system: **X** to the right, **Y** downward (screen/SVG convention)

### Field structure (6 columns)

```text
Type, ID, X, Y, Dimensions, Color
```

| Field | Description |
|-------|-------------|
| Type | One letter: `r`, `c`, `e`, `f`, `p`, `t` |
| ID | Unique name or (for `t`) the text content — **no spaces**; use `_` instead (URL-safe) |
| X | X position (center for `c`/`e`, corner for `r`, start for `p`) |
| Y | Y position |
| Dimensions | Type-dependent — see below |
| Color | Hex RGB, e.g. `ffc107` |

---

## 3. Object types & dimensions

### `r` – Rectangle

```text
r,ID,X,Y,Width:Height[:Angle],Color
```

- **Angle** (optional): rotation in degrees, clockwise (SVG convention). Pivot = rectangle center.
- Omit angle or use two segments only → 0° (backward compatible).

Examples:

- `r,Workbench,100,50,45:90,ffc107!`
- `r,Battering-Ram,230,230,180:20:10,6c757d!` — slight angle for a level strike at the gate (see [mechanics.llsketch](../examples/mechanics.llsketch))

### `c` – Circle

```text
c,ID,X,Y,Radius,Color
```

Example: `c,Campfire,500,500,30,0d6efd!`

### `e` – Ellipse

```text
e,ID,X,Y,RX:RY[:Angle],Color
```

- **Angle** (optional): rotation in degrees, clockwise. Pivot = ellipse center `(X,Y)`.

Examples:

- `e,Debris-Field,760,300,110:70,6c757d!`
- `e,Crater,400,300,80:40:30,6c757d!` — tilted ellipse

### `f` – Form / Fill (closed polygon)

Same point syntax as `p`, but **semantically closed**: the path returns from the last point to `(X,Y)`. Solid **interior area** — rooms, zones, obstacles with volume on the map.

Start point = `(X, Y)`. Additional points in column 5 (`x2:y2_x3:y3…`).

```text
f,ID,startX,startY,x2:y2_x3:y3_x4:y4,Color
```

**AI rule:** `f` = enclosed surface (collision, containment, “inside/outside”). Do not use `p` for filled rooms.

**LLM preference:** `f` works for any closed polygon, but **free-form `f` is harder for models to reason about** than `r` or `c`. Checking whether a point is inside a rectangle or circle is trivial; point-in-polygon for irregular `f` is more error-prone. **Prefer `r` for rectangular rooms and `c` for circular zones**; use `f` only when the footprint is not a box or disk (e.g. L-shaped hall, irregular yard).

Examples:

- `f,Room_A,10,10,110:10_110:80_10:80,e9ecef!` — rectangular room (4 corners + auto-close)
- `f,Yard,200,200,280:200_260:280_180:260,adb5bd!` — irregular enclosed area

### `p` – Path (open polyline)

**Open** 1D chain in space — no automatic close, **no filled interior**. Color = **stroke** only.

- **Wall segment / tripwire:** `p,Wall,10,10,20:10,333333!` (start → one end point)
- **Route / stream:** `p,Path,180,480,500:480_850:350,0dcaf0!`
- **Zigzag barrier:** `p,Barrier,10,10,20:10_20:20_30:20,000000!`

```text
p,ID,startX,startY,x2:y2_x3:y3…,Color
```

Example: `p,Stream,10,10,25:40_60:85_120:90,0dcaf0!`

**AI rule:** `p` stops at the last coordinate pair. It may block crossing a **line**, but does not define an ** enclosed area**. Use `f` for that.

See [enclosure.llsketch](../examples/enclosure.llsketch) for `f` vs `p` together.

### `t` – Text

For `t`, the **ID** field contains the visible text.

```text
t,TextContent,X,Y,FontSize[:Angle],Color
```

- **Angle** (optional): rotation in degrees, clockwise. Pivot = anchor point `(X,Y)`.

Examples:

- `t,Battlefield,500,50,24,ffffff!`
- `t,North,100,200,18:-90,ffffff!` — vertical label

---

## 4. URL-safe delimiters & IDs

Inline LLSketch (`!`-separated objects on a single line, no tags) is used for URL transfer — e.g. `map.php?data=r,Orc-Fortress,…`. Every character must survive URL encoding without ambiguity.

| Purpose | Character | Do not use |
|---------|-----------|------------|
| Field separator | `,` | – |
| Width/height, radii, rotation angle | `:` | `\|` (URL issues) |
| Connect path points | `_` | `;` (URL-reserved) |
| Inline object separator | `!` | Line break in URLs |
| **End of each object** | **`!`** (recommended) | Relying on newline alone (breaks when copy drops line breaks) |
| **Word separator in IDs** | **`_`** | **Space** (breaks URLs and CSV parsing) |

**ID rule:** Never use spaces in the ID field (including text labels for type `t`). Replace spaces with underscore: `Orc_Army`, `Final_Combat_Zone`, `My_Troop`. Hyphens (`My-Troop`) are also valid.

**Copy-safe rule (recommended):** Terminate **every** object with `!` — also in multi-line `<llsketch>` blocks. The parser treats `!` and newline as equivalent separators; a trailing `!` on the last object is optional. If copy/paste collapses lines into one row, the sketch still parses. Extra cost: one character per object (negligible).

---

## 5. Transfer formats

Plain LLSketch appears in two readable shapes — **chat** and **inline**. A third form, **RLLSketch**, is the same inline string after LZ compression (engine only).

| | Chat | Inline | RLLSketch |
|---|------|--------|-----------|
| **Typical use** | LLM input/output, human editing | Export to scripts (`?data=…`), APIs | **Short shareable map URLs**, editor ↔ viewer, DB |
| **Wrapper** | `<llsketch>…</llsketch>` (usual) | **None** — raw data only | **None** — raw LZ blob only |
| **Format legend** | Optional (see below) | **Never** | **Never** |
| **Layout** | Multi-line (one object per line) or one row inside tags | Single line, objects chained with `!` | Opaque compressed string |
| **Readable?** | Yes | Yes | No (decompress first) |

**Untrained LLMs:** paste the [format legend](QUICK-START-AI.md#format-legend-for-untrained-llms) **above** the `<llsketch>` block — legend teaches grammar; it is **not** part of inline or RLLSketch payloads.

**Typical workflow (viewer / editor / chat):** Share a map as `viewer.php?data=…` (inline or RLLSketch) — recipient sees it instantly. Viewer → editor handoff uses RLLSketch in the URL. **Viewer and editor** export **`<llsketch>`** to LLM chat; paste chat output back into the **editor** to view, fix, and re-send. See [README § Share & LLM workflow](../README.md#share--llm-workflow).

### 5.1 `<llsketch>` – chat (AI interface)

**Standard in chat:** multi-line, one object per line, in tags. **Recommended:** end each line with `!` (copy-safe):

```xml
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
r,My-Troop,180,480,150:120,198754!
p,Path,180,480,500:480_850:350,0dcaf0!
</llsketch>
```

**With format legend** (for untrained models — legend + sketch):

```text
[Format <llsketch> (Spatial Reasoning) | 6-Cols: Type,ID,X,Y,Dim,Hex | r=W:H[:A],c=Rad,e=RX:RY[:A],f=x2:y2_x3:y3,p=x2:y2_x3:y3,t=Size[:A] | ID=no_space | ! end_each_obj | A=deg CW]
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
r,My-Troop,180,480,150:120,198754!
p,Path,180,480,500:480_850:350,0dcaf0!
</llsketch>
```

If line breaks are lost on copy, the tagged block still parses as one row.

### 5.2 Inline – export payload (no wrapper)

**Inline** = all objects chained with `!` on a single line, **without** `<llsketch>` tags and **without** the format legend. Used for `?data=…`, copy/paste into engines, APIs:

```text
r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!r,My-Troop,180,480,150:120,198754!p,Path,180,480,500:480_850:350,0dcaf0!
```

Example URL: `https://example.com/map?data=r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!…`

The AI **may** output inline LLSketch when asked (still readable plain text). This is **not** `<rllsketch>`.

### 5.3 `<rllsketch>` – LZ-compressed inline (engine only)

- Creation: `LZString.compressToEncodedURIComponent(inlineString)` — compresses the **inline** payload from §5.2
- Decompression: `LZString.decompressFromEncodedURIComponent(rllsketchPayload)`
- Use: **short URLs** that open a map directly (`viewer.php?data=…`), compact handoff editor ↔ viewer, APIs, database
- Content after decompression: identical to inline LLSketch (`!`-separated, no tags)

**Why compress?** Inline works in `?data=…`, but long sketches produce long URLs. RLLSketch shrinks the payload so a link fits in chat, email, or bookmarks — one click to the map.

Example payload (raw LZ string for `?data=…`):

```text
E4Gg8sDGC0BiD2wAuwCmBndICMAmADPiAKxHakBc2hIAZrZNQOwCEkIAsvAK4B2SAQwCWvEAA5SIAmUkA2SE2JMAJi1AcAntAAqwePAAOOMUQAsJnJTxkAnGMWmWRgAoCkAC2NmLpfBXP4APoSfgDMkvjKkAK0+EA
```

Live example (opens the calibration scene in the [LLSketch Viewer](https://ai-storycrafter.com/llsketch-viewer.php?data=E4Gg8sDGC0BiD2wAuwCmBndICMAmADPiAKxHakBc2hIAZrZNQOwCEkIAsvAK4B2SAQwCWvEAA5SIAmUkA2SE2JMAJi1AcAntAAqwePAAOOMUQAsJnJTxkAnGMWmWRgAoCkAC2NmLpfBXP4APoSfgDMkvjKkAK0%2BEA)):

Optional markup wrapper for storage: `<rllsketch>…</rllsketch>` — tags are **not** part of the compressed payload.

**AI rule:** Never compute, guess, or invent `<rllsketch>`. When receiving `<rllsketch>`: pass to tool/engine for decompression, then read as inline/chat LLSketch.

### 5.4 Parser detection (auto mode)

1. String starts with `r,`, `c,`, `e,`, `f,`, `p,` or `t,` → parse LLSketch directly  
2. String in `<llsketch>…</llsketch>` → extract content, parse  
3. Otherwise → treat as `<rllsketch>`, LZ-decompress, then parse  

---

## 6. Coordinate logic (orientation)

| Direction | X | Y |
|-----------|---|---|
| North (up) | same | smaller |
| South (down) | same | larger |
| West (left) | smaller | same |
| East (right) | larger | same |

**Circle `c`:** `(X,Y)` = center, extent ± radius.  
**Rectangle `r`:** `(X,Y)` = top-left corner (SVG standard); optional angle rotates around rect center.  
**Ellipse `e`:** optional angle rotates around center.  
**Text `t`:** optional angle rotates around anchor `(X,Y)`.

---

## 7. Versioning

- Current version: **1.2** (`f` = closed polygon; `p` = open path only — v1.1 rotation unchanged)
- **1.1:** optional angle in column 5 (`r`, `e`, `t`)
- **1.0:** six column base types
- Reserved for future extensions: optional 7th column `Layer`, 3D (`Z`), status tags
- New types only with a new letter + documentation; existing lines remain valid
- **Migration:** sketches that used `p` for **closed rooms** should use `f` instead (v1.2)

---

## 8. Goals

LLSketch serves:

- compact transmission of spatial information
- easy processing by LLMs
- minimal token usage
- human-readable structuring of geometric sketches
- fast reconstruction of maps, scenes, and blueprints
- **logically coherent** positions — not just storage
