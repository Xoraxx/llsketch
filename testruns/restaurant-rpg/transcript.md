# Restaurant RPG — test transcript (Gemini)

Long-form spatial-RPG test: a full restaurant shift driven only by prose prompts. The model must **update the same sketch** across many turns — placement, kitchen workflow, terrace, delivery, accident.

**Live share (full chat):** [gemini.google.com/share/5f8744929f30](https://gemini.google.com/share/5f8744929f30)

**Replay locally:** [prompts.md](prompts.md)  
**Sketches:** [restaurant-start.llsketch](../../examples/restaurant-start.llsketch) → [restaurant-final.llsketch](../../examples/restaurant-final.llsketch) (human reference at step 8)

---

## Setup

| Item | Value |
|------|--------|
| Model | Google Gemini (shared chat) |
| Training | `SPECIFICATION.md` + `AI-INSTRUCTIONS.md` uploaded |
| Start objects | 16 (floor plan, staff, street) |
| End objects (reference) | 50 (step 8 ground truth) |
| Scene type | Indoor floor plan + terrace + kitchen — RPG service simulation |

---

## Milestones (model output)

Approximate object counts in each **model** `<llsketch>` response (extracted from chat export):

| Step | ~Objects | Notable additions |
|------|----------|-------------------|
| 1 | 19 | `Guest_1_Merchant`, `Guest_2_Scholar`; Lisa moves |
| 2 | 26 | Party of 6 (`Guest_3_Local` … `Guest_8_Local`) seated together |
| 3 | 26 | Guest positions at large table; Lisa serving |
| 4 | 26 | Layout stable; alarm interrupt (one guest may leave) |
| 5 | 30 | More guest/food markers |
| 6 | 38 | **Terrace** (`r,terrace,…`), `Table_5`, `Table_6`; more guests |
| 7 | 35–40 | Terrace guests; kitchen activity |
| 8 | 47 | Food markers; payment wave scene |
| 9 | 50 | **`p,terrace_crack,…`**, `cold_storage`, `stove`, `work_surface`, delivery van |
| 10 | 45–50 | Wine glasses; guests moved from terrace |
| 11 | 29 | Closing: fewer guests; staff repositioned (park scene implied in prose) |

Exact coordinates differ run-to-run; compare structure and spatial reasoning, not pixel-perfect match.

---

## Reference finale (step 8 — human)

After the terrace crack, the author compared model output against a hand-tuned sketch in the [web editor](https://ai-storycrafter.com/llsketch-editor.php). That reference is [restaurant-final.llsketch](../../examples/restaurant-final.llsketch).

Highlights in the reference:

- Terrace north of dining room (`r,terrace,…`)
- Crack as open polyline: `p,terrace_crack,850,200.5,870:250_860:290_880:342,333333!`
- Kitchen south-east: `stove`, `work_surface`, `cold_storage`, `kitchen_ext_door`
- Delivery episode: `delivery_van`, `delivery_driver`, `meat_crates`
- Service detail: `food_*`, `wine_g11`, `wine_g12` near guests

---

## Observations (informal)

- **Strengths:** Model kept returning valid LLSketch; added guests and furniture incrementally; understood terrace vs interior; used `p` for crack when scene complexity increased.
- **Watch for:** ID drift (`Guest_*` renumbering), staff teleporting, duplicate tables, missing `!`, SVG instead of LLSketch on weak models.
- **Tip:** Paste output into the [viewer](https://ai-storycrafter.com/llsketch-viewer.php) or editor after steps 6, 8, and 10.

---

## Raw export (local only)

The folder `testrun-example/` at repo root may contain a saved Gemini HTML page and assets (~1 MB). It is **gitignored** — use [prompts.md](prompts.md) to replay. To re-extract sketches from HTML: `python tools/extract-gemini-html.py testrun-example/hard-test-restaurant.html`
