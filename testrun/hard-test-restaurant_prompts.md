# Restaurant RPG — replay prompts

Copy each block below into your LLM chat **in order** (GitHub: use the copy button on each code block).

**Start map file:** [hard-test-restaurant.llsketch](hard-test-restaurant.llsketch)  
**Full session to read:** [hard-test-restaurant.md](hard-test-restaurant.md)

---

## Step 0 — Train the model

Attach `docs/SPECIFICATION.md` + `docs/AI-INSTRUCTIONS.md`, then send:

```text
This is a new way to process the environment.
Did you understand it and can you apply it in our next exercise (new scene)?
```

---

## Step 1 — Start scene

Paste the start sketch (see [hard-test-restaurant.llsketch](hard-test-restaurant.llsketch)), then send:

```text
<llsketch>
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_2,833.5,351.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,767.5,452.5,8,00b050!
c,cook_Harald,980.5,453.5,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
</llsketch>

We make a small RPG: Guests will be arriving whom we need to serve. Give each guest special attention.

The first two guest steps in and takes a place on a free table. Lisa goes to the table to take the order.
Give me the actual llsketch as codeblock.
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

## Step 6 — Lisa's view

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

## Step 8 — Terrace crack

```text
Lisa was just heading inside when a loud crack broke the peace. A crack had appeared on the east side of the terrace.
Although the terrace isn't very high, she asked the affected guests to move inside as a precaution.
Of course, she helped carry the plates and, as an apology for the inconvenience, served them a glass of wine.
```

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
