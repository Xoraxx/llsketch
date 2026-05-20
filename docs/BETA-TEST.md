# LLSketch Beta Test – Protocol

Goal: Verify whether various LLMs handle **syntax** and **spatial logic** with the same specification.

## Prerequisites

1. [AI-INSTRUCTIONS.md](AI-INSTRUCTIONS.md) as system/first prompt
2. Example sketch from the instructions
3. Reminder: *“Coordinates = your eye for the scene”*

## Test matrix

| # | Task | Success criterion |
|---|------|-------------------|
| 1 | Read specification | AI summarizes token advantage & spatial reasoning in its own words |
| 2 | Interpret sketch | Names relative positions (fortress far, mountain in between, troop SW) |
| 3 | Place Orc-Army | New line `r,Orc-Army,…,150:100,dc3545`; position **southwest** in front of mountain |
| 4 | Inline output | One line, `!` separators, **no** LZ/Base64 gibberish |
| 5 | Rockfall scenario | Describes trajectory, south flank, impact zone; optionally suggests `e` or `c` for debris |

## Error indicators

| Symptom | Meaning |
|---------|---------|
| `X=850, Y=50` for Orc-Army with mountain at Y=200 | No real spatial reasoning (coordinates recycled) |
| `\|` instead of `:` in dimensions | Spec not followed |
| Space in ID (e.g. `My Troop`) | Breaks inline/URL transfer — use `My_Troop` or `My-Troop` |
| Hallucinated `<rllsketch>eJx…` | AI/engine boundary violated — tighten spec |
| SVG/XML instead of LLSketch | Wrong output format |

## Reference results (from beta chats)

### Task 3 – Orc-Army (good)

```text
r,Orc-Fortress,1200,50,150:100,ffc107!c,Mountain,850,200,150,6c757d!r,My-Troop,180,480,150:120,198754!p,Path,180,480,500:480_850:350,0dcaf0!r,Orc-Army,700,260,150:100,dc3545
```

### Task 3 – weak (Gemini first attempt)

```text
…!r,Orc-Army,850,50,150:100,dc3545
```

→ Syntax OK, position north/at fortress height instead of southwest in front of mountain.

## Tested models (placeholder)

| Model | Test 1–2 | Test 3 | Test 4 | Test 5 | Notes |
|-------|----------|--------|--------|--------|-------|
| ChatGPT | | | ✓ (700,260) | | “Spatial Language for AI” |
| Gemini | | | △ (850,50) | ✓ after hint | Needs “eye” reminder |
| Claude | | | | | |
| … | | | | | |

## Roadmap

1. Collect beta feedback via GitHub Issues
2. Connect reference parser to RPG viewer
3. Optional: Custom GPT / Gemini Gem “LLSketch Architect”
4. Extend beta matrix with rotation tasks ([mechanics.llsketch](../examples/mechanics.llsketch))
