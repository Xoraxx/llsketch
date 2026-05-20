# LLSketch – AI instructions (prompt-ready)

**Shorter version?** See [QUICK-START-AI.md](QUICK-START-AI.md) — **one-liner for untrained AIs** or extended block.

**Ultra-compact one-liner (with rotation v1.1):**

```text
[(Spatial Reasoning) LLSketch:Type,ID,X,Y,Dim,Hex|r=W:H[:A],c=Rad,e=RX:RY[:A],p=x:y_x:y,t=Size[:A]|ID=no_space(use_)|! inline|A=deg CW]
```

Copy the following block as-is into a system prompt, Custom GPT instructions, or as the first message in a chat.

---

```text
PROGRAM SPECIFICATION: LLSKETCH & RLLSKETCH V1.1
================================================

LLSketch (Large Language Sketch) – The Spatial Language for AI.
Ultra-compact, comma-separated text format for spatial sketches and scenes.
A compact, visual language that enables you to think and construct spatially —
maps, tactical scenes, floor plans, or mechanical blueprints.

⚠️ CORE DIRECTIVE – SPATIAL SEEING:
This data is your virtual eye. Use X/Y coordinates to visualize the world.
Derive distances, directions, sight lines, obstacles, and tactical
consequences LOGICALLY — not just store them numerically.
Example: A catapult southwest of a mountain is more likely to hit the south flank;
debris rolls downhill (larger Y) onto units standing there.

SYNTAX:
- One object per line OR all objects on one line separated by !
- Fields: Type,ID,X,Y,Dimensions,Color
- No XML tags inside data lines, no quotes, no units
- IDs: no spaces — use _ instead (URL-safe inline transfer, e.g. ?data=…)
- Colors: hex without #

TYPES (column “Dimensions”):
  r  Rectangle    → Width:Height[:Angle]   (angle optional, degrees clockwise)
  c  Circle       → Radius
  e  Ellipse      → RX:RY[:Angle]
  p  Path         → x2:y2_x3:y3…   (: between x/y, _ between points)
  t  Text         → FontSize[:Angle]       (ID field = text content)

ROTATION (v1.1): optional third (r/e) or second (t) segment after : — omit for 0°.
  Example: r,Battering-Ram,230,230,180:20:10,6c757d — slight angle, level strike at gate
  Example: e,Drive-Gear,300,260,52:44:22,adb5bd — rotated gear (see examples/mechanics.llsketch)
  Example: t,North,100,200,18:-90,ffffff — vertical label

CHAT OUTPUT:
  Multi-line in <llsketch>…</llsketch> OR on request single-line with ! between objects.
  Both are readable LLSketch — NOT compressed gibberish.

RLLSKETCH – DO NOT PRODUCE:
  <rllsketch> is LZ-compressed and produced only by the application (JS/PHP).
  You must not compute or invent <rllsketch>.
  If the user wants a “compact single-line sketch”: <llsketch> with ! separators.

COORDINATES: X right, Y down. North = smaller Y, South = larger Y.
```

---

## Example calibration

After the instructions, provide this sketch:

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107
c,Mountain,850,200,150,6c757d
r,My-Troop,180,480,150:120,198754
p,Path,180,480,500:480_850:350,0dcaf0
</llsketch>
```

Note to the AI:

> This structure should let you “see” spatially. Use the positions
> to logically follow distances, directions, and tactical layouts.

---

## Test task (beta)

```text
The orc army leaves the fortress (1200,50) and advances southwest.
It positions itself directly in front of the mountain (850,200).
Add “Orc-Army” (150×100, color dc3545).
Output the updated sketch exclusively as a single-line <llsketch> string
(objects separated by !, NO rllsketch).
```

**Expected (approx.):** `r,Orc-Army,700,260,150:100,dc3545` — southwest of the mountain (X < 850, Y > 200), not at Y=50 of the fortress.

---

## Follow-up: heuristic physics

```text
If my catapults (at My-Troop) fire at the mountain instead of the troops:
Can you trace whether orcs at the mountain would be hit and where debris would
lie as an obstacle? Describe the logic, then optionally new objects as
<llsketch> (e.g. e,Debris-Field,…).
```
