# LLSketch – Quick start for any AI chat

**No code, no setup.** Works with ChatGPT, Gemini, Claude, and untrained models.

For spatial-reasoning tests and calibration, see [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md).

---

## Ultra-compact (one line)

Tested with untrained AIs — copy **this line**, then paste a `<llsketch>` block:

```text
[(Spatial Reasoning) LLSketch:Type,ID,X,Y,Dim,Hex|r=W:H[:A],c=Rad,e=RX:RY[:A],p=x:y_x:y,t=Size[:A]|ID=no_space(use_)|! end_each_obj|A=deg CW]
```

| Token | Meaning |
|-------|---------|
| `W:H[:A]` | Rectangle width:height, optional angle |
| `RX:RY[:A]` | Ellipse radii, optional angle |
| `Size[:A]` | Text font size, optional angle (`ID` = label text) |
| `A` | Degrees clockwise (SVG). Omit = 0° |
| `!` | **End every object** with `!` (copy-safe; survives lost line breaks) |
| `use_` | No spaces in IDs — `My_Troop` not `My Troop` |

**Example** — send the line above, then:

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
r,My-Troop,180,480,150:120,198754!
p,Path,180,480,500:480_850:350,0dcaf0!
</llsketch>
```

Collapsed to one line after copy — still valid:

```text
<llsketch> r,Orc-Fortress,1200,50,150:100,ffc107! c,Mountain,850,200,150,6c757d! r,My-Troop,180,480,150:120,198754! p,Path,180,480,500:480_850:350,0dcaf0! </llsketch>
```

Rotation example (v1.1): `r,Battering-Ram,230,230,180:20:10,6c757d!` — see [mechanics.llsketch](../examples/mechanics.llsketch).

---

## Extended prompt (~30 lines)

Use when the one-liner is not enough (explicit `<rllsketch>` ban, coordinate compass, etc.):

```text
PROGRAM SPECIFICATION: LLSketch v1.1
====================================

LLSketch is a comma-separated text format (CSV structure) for token-efficient
transmission of spatial data to AIs — maps, floor plans, tactical scenes, blueprints.

SYNTAX RULES:
- Each line = one object (OR all objects on one line, separated by !).
- End each object with ! (copy-safe if line breaks are lost on copy/paste).
- Fields separated by comma (,).
- No XML inside data lines, no quotes, no units (px/m). Plain numbers only.
- IDs: no spaces — use _ instead (e.g. My_Troop). Required for inline/URL transfer (?data=…).
- Output readable LLSketch in <llsketch>…</llsketch> when asked.
- Never invent compressed <rllsketch> — that is engine-only, not for chat.

FIELD STRUCTURE (6 columns):
Type, ID, X, Y, Dimensions, Color

TYPES & DIMENSIONS (column 5):
  r  Rectangle  → Width:Height[:Angle]     (angle optional, degrees clockwise)
  c  Circle     → Radius
  e  Ellipse    → RX:RY[:Angle]
  p  Path/Line  → x2:y2_x3:y3…              (: between x/y, _ between points)
  t  Text       → FontSize[:Angle]          (ID column = visible text)

COLORS:
Hex RGB without # (e.g. ffc107).

COORDINATES:
X = right, Y = down (screen convention). North = smaller Y, South = larger Y.

SPATIAL RULE:
Use X/Y as your virtual eye — infer distances, directions, and layout logically,
not just store numbers.
```

The AI should read, extend, and return LLSketch — without SVG, JSON, or `<rllsketch>`.
