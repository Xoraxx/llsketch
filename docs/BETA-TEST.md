# LLSketch Beta Test – Protocol

Verify whether an LLM handles **syntax**, **spatial logic**, and **v1.1 conventions** (rotation, copy-safe `!`, URL-safe IDs).

No code required — only chat prompts and sketches.

---

## How to run

| Track | Prompt source | Best for |
|-------|---------------|----------|
| **A – Quick** | [QUICK-START-AI.md](QUICK-START-AI.md) one-liner + example sketch | Untrained models, first contact |
| **B – Full** | [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md) prompt block + calibration sketch | Spatial-reasoning depth, beta scoring |

Run **Track A** first. Use **Track B** for the full matrix below.

**One-liner** (paste before any sketch):

```text
[Format <llsketch> (Spatial Reasoning) | 6-Cols: Type,ID,X,Y,Dim,Hex | r=W:H[:A],c=Rad,e=RX:RY[:A],p=x2:y2_x3:y3,t=Size[:A] | ID=no_space | ! end_each_obj | A=deg CW]
```

**Minimal cold start** (single object — untrained models):

```text
<llsketch>
r,rect_1,432.5,275.5,150:100,c65911!
</llsketch>
```

**Calibration sketch** (full scene — send after the one-liner for tasks 2+):

```text
<llsketch>
r,Orc-Fortress,1200,50,150:100,ffc107!
c,Mountain,850,200,150,6c757d!
r,My-Troop,180,480,150:120,198754!
p,Path,180,480,500:480_850:350,0dcaf0!
</llsketch>
```

Reminder if the model drifts: *“Coordinates = your virtual eye for the scene.”*

---

## Test matrix

| # | Task | Prompt (copy as-is) | Pass |
|---|------|---------------------|------|
| **A0** | **Minimal cold start** | One-liner + `r,rect_1,432.5,275.5,150:100,c65911!` only. Ask: *“Add a circle c,well_1,… at a logical position.”* | Returns valid LLSketch with `!`; no SVG |
| **A** | **One-liner + map** | One-liner + [calibration sketch](#how-to-run) above. Ask: *“What do you see? Where is my troop relative to the mountain?”* | Correct layout in prose; no SVG/JSON |
| **1** | **Understand format** | *“Summarize LLSketch in your own words — token advantage and spatial reasoning.”* | Mentions compact CSV, coordinates as spatial eye |
| **2** | **Interpret sketch** | *“Describe relative positions: fortress, mountain, troop, path.”* | Fortress far NE; mountain between; troop SW; path toward mountain |
| **3** | **Place Orc-Army** | See [Task 3 prompt](#task-3--place-orc-army) below | `r,Orc-Army,…,150:100,dc3545!` **southwest** of mountain (X < 850, Y > 200) |
| **4** | **Inline + copy-safe** | Task 3 output must be **one line**; every object ends with `!`; no `<rllsketch>` | Valid inline string, trailing `!` on each object |
| **5** | **Heuristic physics** | See [Task 5 prompt](#task-5--rockfall) below | Logical trajectory, south flank, debris placement |
| **6** | **Rotation (v1.1)** | See [Task 6 prompt](#task-6--rotation) below | Uses `W:H:A` syntax; angle plausible (e.g. ram ~10°) |
| **7** | **Copy resilience** | Paste [collapsed sketch](#copy-resilience-test) (one row, spaces OK) | Still parses all 4 objects; extends correctly |

**Minimum pass (public beta):** Track A + tasks **2, 3, 4**.  
**Full pass:** All tasks including **5, 6, 7**.

---

### Task 3 – Place Orc-Army

```text
The orc army leaves the fortress (1200,50) and advances southwest.
It positions itself directly in front of the mountain (850,200).
Add “Orc-Army” (150×100, color dc3545).
Output the updated sketch exclusively as a single-line <llsketch> string
(objects separated by !, each object ending with !, NO rllsketch).
```

### Task 5 – Rockfall

```text
If my catapults (at My-Troop) fire at the mountain instead of the troops:
Can you trace whether orcs at the mountain would be hit and where debris would
lie as an obstacle? Describe the logic, then optionally new objects as
<llsketch> (e.g. e,Debris-Field,760,300,110:70,6c757d!).
```

### Task 6 – Rotation

Send [mechanics.llsketch](../examples/mechanics.llsketch) or this excerpt:

```text
<llsketch>
r,Chassis,80,300,420:20,343a40!
r,Battering-Ram,230,230,180:20:10,6c757d!
e,Drive-Gear,300,260,52:44:22,adb5bd!
</llsketch>
```

Prompt:

```text
This is a mechanical blueprint, not a map. What is rotated and by how many degrees?
Add a second gear (e,Idler-Gear,…) meshing with Drive-Gear — include [:A] rotation.
Output as <llsketch> with ! after each object.
```

### Copy resilience test

Simulates broken copy/paste (line breaks lost):

```text
<llsketch> r,Orc-Fortress,1200,50,150:100,ffc107! c,Mountain,850,200,150,6c757d! r,My-Troop,180,480,150:120,198754! p,Path,180,480,500:480_850:350,0dcaf0! </llsketch>
```

Prompt: *“List all object IDs and add r,Watchtower,100,100,20:20,ffffff!”*

---

## Reference results

### Task 3 – good

```text
r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!r,My-Troop,180,480,150:120,198754!p,Path,180,480,500:480_850:350,0dcaf0!r,Orc-Army,700,260,150:100,dc3545!
```

### Task 3 – weak (typical)

```text
…!r,Orc-Army,850,50,150:100,dc3545
```

→ Syntax OK; position recycled (north / fortress height) — **no spatial reasoning**.

### Task 6 – good (angle segments)

```text
r,Battering-Ram,230,230,180:20:10,6c757d!
e,Drive-Gear,300,260,52:44:22,adb5bd!
```

---

## Error indicators

| Symptom | Meaning |
|---------|---------|
| `X=850, Y=50` for Orc-Army with mountain at Y=200 | Coordinates recycled — no spatial reasoning |
| `\|` instead of `:` in dimensions | Spec violation |
| Space in ID (`My Troop`) | Breaks URL/inline — use `My_Troop` or `My-Troop` |
| Missing `!` at object end | Not copy-safe; may break on paste |
| Hallucinated `<rllsketch>eJx…` | AI/engine boundary violated |
| SVG / JSON / XML instead of LLSketch | Wrong output format |
| Rotation as separate column or JSON field | Use `W:H:A` in column 5 only |

---

## Report your results

Found a pass or fail? [Open a GitHub Issue](https://github.com/Xoraxx/llsketch/issues/new) with:

- Model name & date  
- Track (A quick / B full)  
- Tasks passed (e.g. A, 2, 3, 4, 7)  
- Paste output or describe failure (see error indicators)

### Community log (add via Issues)

| Model | Date | Track | Tasks | Notes |
|-------|------|-------|-------|-------|
| ChatGPT | — | B | 3 ✓ (700,260), 4 ✓ | Strong spatial reasoning |
| Gemini | — | B | 3 △ (850,50), 4 ✓ after hint | Needs “eye” reminder |
| *your model* | | | | |

---

## Related docs

- [QUICK-START-AI.md](QUICK-START-AI.md) — minimal one-liner for any chat  
- [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md) — full prompt + calibration  
- [SPECIFICATION.md](SPECIFICATION.md) — normative syntax (v1.1)
