# Web editor integration (v1.2)

Guide for drawing tools and renderers (Canvas, SVG, WebGL) — e.g. [ai-storycrafter.com/llsketch-editor.php](https://ai-storycrafter.com/llsketch-editor.php).

Reference parsers: [lib/llsketch.js](../lib/llsketch.js), [lib/llsketch-parser.php](../lib/llsketch-parser.php).

---

## Render rule: `f` vs `p`

| Type | Semantics | Canvas 2D | SVG |
|------|-----------|-----------|-----|
| **`f`** | Closed polygon, **filled** area | `moveTo` → `lineTo`… → **`closePath()`** → **`fill()`** | `<path d="M… L… Z" fill="…"/>` |
| **`p`** | Open polyline, **stroke** only | `moveTo` → `lineTo`… → **`stroke()`** (no close) | `<path d="M… L…" fill="none" stroke="…"/>` |

Both share the same point encoding in column 5: `x2:y2_x3:y3…` (start = columns X,Y).

---

## JavaScript (Canvas export)

```javascript
/**
 * Draw one LLSketch object onto CanvasRenderingContext2D.
 * obj: { type, x, y, dims, fill } — from llsketchParse()
 */
function drawLlsketchObject(ctx, obj) {
  const color = '#' + String(obj.fill).replace(/^#/, '');

  switch (obj.type) {
    case 'f':
    case 'p': {
      ctx.beginPath();
      ctx.moveTo(obj.x, obj.y);
      for (const pair of obj.dims.split('_')) {
        const [px, py] = pair.split(':');
        if (px && py) ctx.lineTo(parseFloat(px), parseFloat(py));
      }
      if (obj.type === 'f') {
        ctx.closePath();
        ctx.fillStyle = color;
        ctx.fill();
      } else {
        ctx.strokeStyle = color;
        ctx.lineWidth = 2;
        ctx.stroke();
      }
      break;
    }
    // r, c, e, t — see lib/llsketch.js → llsketchToSvg()
  }
}
```

## PHP → SVG (excerpt)

```php
// Closed form (f)
$d = llsketch_parse_path_points($dims, $x, $y, true);  // appends Z
// → <path d="…" fill="#…"/>

// Open path (p)
$d = llsketch_parse_path_points($dims, $x, $y, false);
// → <path d="…" fill="none" stroke="#…" stroke-width="2"/>
```

---

## Export to LLSketch string

When the user draws a **closed** shape (room, zone):

```text
f,Room_A,50,50,250:50_250:200_50:200,e9ecef!
```

When the user draws an **open** line (wall segment, route):

```text
p,Wall_South,50,200,250:200,333333!
```

Always end each object with `!`. IDs: no spaces (`Room_A`, not `Room A`).

---

## Tool mapping (UI)

| User action | Export as | Prefer if |
|-------------|-----------|-----------|
| Rectangle tool | **`r`** | Rooms, boxes — **best for LLM containment** |
| Circle tool | **`c`** | Zones, radius — **best for LLM containment** |
| Closed polygon (3+ corners) | **`f`** | Non-rectangular rooms only |
| Line / polyline tool | **`p`** | Walls, paths, wires |

---

## LLM note (for editor help text)

**Prefer `r` and `c` over irregular `f`.**  
`f` is supported, but point-in-polygon reasoning is harder for LLMs than “inside this rectangle or circle”. Use `f` when the shape is genuinely not a box or disk; otherwise export `r` or `c`.

See [SPECIFICATION.md — f](SPECIFICATION.md#f--form--fill-closed-polygon).
