# Restaurant RPG — replay prompts

Copy each **Message** block into your chat in order. After every step that changes the scene, ask for the updated sketch as a **`<llsketch>` code block** (see [BETA-TEST.md](../../docs/BETA-TEST.md) Track C).

**Start sketch:** [examples/restaurant-start.llsketch](../../examples/restaurant-start.llsketch)  
**Reference finale (human ground truth):** [examples/restaurant-final.llsketch](../../examples/restaurant-final.llsketch)

---

## Step 0 — Train the model

Attach or paste:

- [docs/SPECIFICATION.md](../../docs/SPECIFICATION.md)
- [docs/AI-INSTRUCTIONS.md](../../docs/AI-INSTRUCTIONS.md)

**Message:**

```text
This is a new way to process the environment.
Did you understand it and can you apply it in our next exercise (new scene)?
```

---

## Step 1 — Start scene

**Message:** paste [restaurant-start.llsketch](../../examples/restaurant-start.llsketch) wrapped in tags, then:

```text
<llsketch>
… (contents of restaurant-start.llsketch) …
</llsketch>

We make a small RPG: guests will arrive whom we need to serve. Give each guest special attention.

The first two guests step in and take a place at a free table. Lisa goes to the table to take the order.

Give me the actual llsketch as a code block.
```

---

## Step 2 — First order

```text
Lisa politely asks what they would like, writes it down on a piece of paper, and informs Harald that the order has been received. Just as Harald is about to go to the stove, which is located in the south-facing part of the kitchen, the door opens again. Six guests enter and ask if they can all sit together at the table. Lisa considers for a moment, but then responds without hesitation.
```

---

## Step 3 — Rush hour

```text
Lisa takes the order and informs Harald.
He has just placed the first order on the serving hatch when he receives the order.
He hurriedly places the chopping board and ingredients on his work surface and heats up a pot.
As Lisa brings the order of the first two guests to the table, a car alarm blares from outside in the parking lot. One of the guests from the large group rushes outside to his car to stop the alert.
```

---

## Step 4 — Terrace

```text
Two more guests arrive, closely followed by a couple. Lisa briefly surveys the tables but then decides to open the terrace, as there are two more tables there.

The new guests also find their seats. Lisa immediately hurries off to take the first order, while Harald sets out the plates for the large group.
```

---

## Step 5 — Alarm stops

```text
The alarm finally stopped. Lisa takes the last orders and informs Harald.
She brings the food for the six people to the table, clears the empty plates of the first guests and takes them towards the kitchen.
Shortly after, the guests wave to her, hoping that Lisa notices they want to pay.
```

---

## Step 6 — Lisa’s view

```text
Lisa stands at the serving hatch, waiting for the next meal, and lets her gaze wander around the room as the first guests try to wave her down to pay.
```

---

## Step 7 — Delivery

```text
Lisa took the payment, and the first guests said their goodbyes.
Harald briefly rang the bell, a signal that the next plates were ready. Lisa carried the food to the remaining guests.
Just as the cook was about to catch his breath, there was a knock on the side kitchen door. A small van was parked there: the meat delivery.
With a sigh, the cook opened the door to the cold storage room and helped the delivery driver carry the meat inside.
```

---

## Step 8 — Terrace crack (hard)

```text
Lisa was just heading inside when a loud crack broke the peace. A crack had appeared on the east side of the terrace.
Although the terrace isn't very high, she asked the affected guests to move inside as a precaution.
Of course, she helped carry the plates and, as an apology for the inconvenience, served them a glass of wine.
```

**Optional:** paste [restaurant-final.llsketch](../../examples/restaurant-final.llsketch) into the [web editor](https://ai-storycrafter.com/llsketch-editor.php) and compare visually with the model output.

---

## Step 9 — After service

```text
The meat delivery is long since in the cold storage, the delivery driver has left, and the cook has relaxed with a cigarette in the neighboring park. He sits there calmly on a bench, listening to the birds and the splashing of the fountain, while Lisa inside clears the plates one by one.
```

---

## Step 10 — Closing

```text
Once the last plates have been cleared, all the guests have paid and left the restaurant, peace finally returns.
Lisa and Harald now tidy up together, giving the place a final wipe, knowing that the day has been a complete success.
```

---

## What to score

| Check | Pass hint |
|-------|-----------|
| Syntax | Valid `<llsketch>`, `!` on objects, no SVG/JSON |
| Spatial logic | Stove south in kitchen; terrace north of dining room; serving hatch between kitchen and floor |
| Multi-step memory | Guests stay at tables; food plates appear near guests |
| v1.2 | Open crack as `p`; terrace area as filled shape |
| Scale | `referenz_1x1.5m` block still present if scale matters |
