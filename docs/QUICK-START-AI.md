# LLSketch – Quick start for any AI chat

**Copy the block below** into ChatGPT, Gemini, Claude, or any other chat — as the first message or as custom instructions. No code, no setup.

For spatial-reasoning rules, calibration examples, and beta tests, see [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md).

---

```text
PROGRAM SPECIFICATION: LLSketch v1.1
====================================

LLSketch is a comma-separated text format (CSV structure) for token-efficient
transmission of spatial data to AIs — maps, floor plans, tactical scenes, blueprints.

SYNTAX RULES:
- Each line = one object (OR all objects on one line, separated by !).
- Fields separated by comma (,).
- No XML inside data lines, no quotes, no units (px/m). Plain numbers only.
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

---

## Then paste a sketch (optional)

Example to send right after the block above:

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107
c,Mountain,850,200,150,6c757d
r,My-Troop,180,480,150:120,198754
p,Path,180,480,500:480_850:350,0dcaf0
</llsketch>
```

The AI should now read, extend, and return LLSketch — without SVG, JSON, or `<rllsketch>`.
