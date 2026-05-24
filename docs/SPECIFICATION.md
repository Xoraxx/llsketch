# LLSketch v1.1 – Specification

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
| Type | One letter: `r`, `c`, `e`, `p`, `t` |
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

### `p` – Path / polygon / freehand

Start point = `(X, Y)`. Additional points in column 5:

- **Pair separator:** colon `:` → `x:y`
- **Point chain:** underscore `_` → next point is connected

```text
p,ID,startX,startY,x2:y2_x3:y3_x4:y4,Color
```

Example: `p,Stream,10,10,25:40_60:85_120:90,0dcaf0!`

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

Inline LLSketch (one line, `!`-separated) is used for data transfer — e.g. `map.php?data=r,Orc-Fortress,…` or `<llsketch>…</llsketch>` in APIs. Every character must survive URL encoding without ambiguity.

| Purpose | Character | Do not use |
|---------|-----------|------------|
| Field separator | `,` | – |
| Width/height, radii, rotation angle | `:` | `\|` (URL issues) |
| Connect path points | `_` | `;` (URL-reserved) |
| Objects on one line | `!` | Line break in URLs |
| **End of each object** | **`!`** (recommended) | Relying on newline alone (breaks when copy drops line breaks) |
| **Word separator in IDs** | **`_`** | **Space** (breaks URLs and CSV parsing) |

**ID rule:** Never use spaces in the ID field (including text labels for type `t`). Replace spaces with underscore: `Orc_Army`, `Final_Combat_Zone`, `My_Troop`. Hyphens (`My-Troop`) are also valid.

**Copy-safe rule (recommended):** Terminate **every** object with `!` — also in multi-line `<llsketch>` blocks. The parser treats `!` and newline as equivalent separators; a trailing `!` on the last object is optional. If copy/paste collapses lines into one row, the sketch still parses. Extra cost: one character per object (negligible).

---

## 5. Transfer formats

### 5.1 `<llsketch>` – plain text (AI interface)

**Standard in chat:** multi-line, one object per line, optionally in tags. **Recommended:** end each line with `!` (copy-safe):

```xml
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
</llsketch>
```

If line breaks are lost on copy, this still works as one row:

```xml
<llsketch> r,Orc-Fortress,1200,50,150:100,ffc107! c,Mountain,850,200,150,6c757d! </llsketch>
```

**Inline (single line):** all objects chained with `!`, **still readable plain text** — suitable for `?data=…` URL parameters:

```xml
<llsketch>r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!</llsketch>
```

Example URL: `https://example.com/map?data=r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!`

The AI **may and should** output inline LLSketch when asked. This is **not** `<rllsketch>`.

### 5.2 `<rllsketch>` – LZ-compressed (engine only)

- Creation: `LZString.compressToEncodedURIComponent(llsketchInline)`
- Decompression: `LZString.decompressFromEncodedURIComponent(rllsketchPayload)`
- Use: `map.php?data=…`, APIs, database
- Content after decompression: identical to inline LLSketch (`!`-separated)

```xml
<rllsketch>eJxNj01rwzAMhv9KeteC5F...</rllsketch>
```

**AI rule:** Never compute, guess, or invent `<rllsketch>`. When receiving `<rllsketch>`: pass to tool/engine for decompression, then read as `<llsketch>`.

### 5.3 Parser detection (auto mode)

1. String starts with `r,`, `c,`, `e,`, `p,` or `t,` → parse LLSketch directly  
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

- Current version: **1.1** (rotation in column 5; fully backward compatible with 1.0)
- Reserved for future extensions: optional 7th column `Layer`, 3D (`Z`), status tags
- New types only with a new letter + documentation; existing lines remain valid

---

## 8. Goals

LLSketch serves:

- compact transmission of spatial information
- easy processing by LLMs
- minimal token usage
- human-readable structuring of geometric sketches
- fast reconstruction of maps, scenes, and blueprints
- **logically coherent** positions — not just storage
