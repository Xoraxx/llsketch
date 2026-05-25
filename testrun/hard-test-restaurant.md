# Restaurant RPG — Gemini session (transcript)

Model responses as `<llsketch>` blocks — extracted from the Gemini test run.
Replay the test with [hard-test-restaurant_prompts.md](hard-test-restaurant_prompts.md).

**Live share:** https://gemini.google.com/share/5f8744929f30

---

## Step 0 — Train the model

### User

```text
This is a new way to process the environment.
Did you understand it and can you apply it in our next exercise (new scene)?
```

### Model

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
c,serv_Lisa,696.5,465,8,00b050!
c,cook_Harald,980.5,453.5,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
</llsketch>
```

---

## Step 1 — Start scene

### User

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

### Model

```text
<llsketch>
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_2,697.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,635,411.5,8,00b050!
c,cook_Harald,980.5,500,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,667.5,338.5,8,f0ad4e!
c,Guest_4_Local,697.5,338.5,8,f0ad4e!
c,Guest_5_Local,727.5,338.5,8,f0ad4e!
c,Guest_6_Local,667.5,426.5,8,f0ad4e!
c,Guest_7_Local,697.5,426.5,8,f0ad4e!
c,Guest_8_Local,727.5,426.5,8,f0ad4e!
</llsketch>
```

---

## Step 2 — First order

### User

```text
Lisa politely asks what they would like, writes it down on a piece of paper, and informs Harald that the order has been received. Just as Harald is about to go to the stove, which is located in the south-facing part of the kitchen, the door opens again. Six guests enter and ask if they can all sit together at the table. Lisa considers for a moment, but then responds without hesitation.
```

### Model

```text
<llsketch>
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,758.5,480.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,798.5,450,8,00b050!
c,cook_Harald,980.5,500,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,770,466.5,8,f0ad4e!
c,Guest_4_Local,798.5,466.5,8,f0ad4e!
c,Guest_5_Local,827,466.5,8,f0ad4e!
c,Guest_6_Local,770,554.5,8,f0ad4e!
c,Guest_7_Local,798.5,554.5,8,f0ad4e!
c,Guest_8_Local,827,554.5,8,f0ad4e!
</llsketch>
```

---

## Step 3 — Rush hour

### User

```text
Lisa takes the order and informs Harald.
He has just placed the first order on the serving hatch when he receives the order.
He hurriedly places the chopping board and ingredients on his work surface and heats up a pot.
As Lisa brings the order of the first two guests to the table, a car alarm blares from outside in the parking lot. One of the guests from the large group rushes outside to his car to stop the alert.
```

### Model

```text
<llsketch>
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,818.5,406.5,8,00b050!
c,cook_Harald,980.5,500,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
</llsketch>
```

---

## Step 4 — Terrace

### User

```text
Two more guests arrive, closely followed by a couple. Lisa briefly surveys the tables but then decides to open the terrace, as there are two more tables there.

The new guests also find their seats. Lisa immediately hurries off to take the first order, while Harald sets out the plates for the large group.
```

### Model

```text
<llsketch>
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,690,460,8,00b050!
c,cook_Harald,965,490,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,car_alarming,460,400,30:60,dc3545!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,food_stew,685,490,5,d9534f!
c,food_broth,710,490,5,0dcaf0!
c,Guest_3_Local,500,430,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
</llsketch>
```

---

## Step 5 — Alarm stops

### User

```text
The alarm finally stopped. Lisa takes the last orders and informs Harald.
She brings the food for the six people to the table, clears the empty plates of the first guests and takes them towards the kitchen.
Shortly after, the guests wave to her, hoping that Lisa notices they want to pay.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,720,290.5,8,00b050!
c,cook_Harald,945,390,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,car_alarming,460,400,30:60,dc3545!
r,plates_large_group,910,360,15:60,e2e2e2!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,food_stew,685,490,5,d9534f!
c,food_broth,710,490,5,0dcaf0!
c,Guest_3_Local,500,430,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,Guest_11_Couple,745,290.5,8,e83e8c!
c,Guest_12_Couple,810,290.5,8,e83e8c!
</llsketch>
```

---

## Step 6 — Lisa's view

### User

```text
Lisa stands at the serving hatch, waiting for the next meal, and lets her gaze wander around the room as the first guests try to wave her down to pay.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,850,430,8,00b050!
c,cook_Harald,965,490,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,plates_large_group,910,360,15:60,e2e2e2!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,Guest_11_Couple,745,290.5,8,e83e8c!
c,Guest_12_Couple,810,290.5,8,e83e8c!
</llsketch>
```

---

## Step 7 — Delivery

### User

```text
Lisa took the payment, and the first guests said their goodbyes.
Harald briefly rang the bell, a signal that the next plates were ready. Lisa carried the food to the remaining guests.
Just as the cook was about to catch his breath, there was a knock on the side kitchen door. A small van was parked there: the meat delivery.
With a sigh, the cook opened the door to the cold storage room and helped the delivery driver carry the meat inside.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,890,390,8,00b050!
c,cook_Harald,965,490,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,plates_large_group,910,360,15:60,e2e2e2!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,Guest_11_Couple,745,290.5,8,e83e8c!
c,Guest_12_Couple,810,290.5,8,e83e8c!
</llsketch>
```

---

## Step 8 — Terrace crack

### User

```text
Lisa was just heading inside when a loud crack broke the peace. A crack had appeared on the east side of the terrace.
Although the terrace isn't very high, she asked the affected guests to move inside as a precaution.
Of course, she helped carry the plates and, as an apology for the inconvenience, served them a glass of wine.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,695,495,8,00b050!
c,cook_Harald,965,490,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
c,Guest_1_Merchant,665,506.5,8,d9534f!
c,Guest_2_Scholar,728,506.5,8,0dcaf0!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,food_g3,805,440.5,5,e2e2e2!
c,food_g4,805,480.5,5,e2e2e2!
c,food_g5,805,520.5,5,e2e2e2!
c,food_g6,830,440.5,5,e2e2e2!
c,food_g7,830,480.5,5,e2e2e2!
c,food_g8,830,520.5,5,e2e2e2!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,Guest_11_Couple,745,290.5,8,e83e8c!
c,Guest_12_Couple,810,290.5,8,e83e8c!
</llsketch>
```

---

## Step 9 — After service

### User

```text
The meat delivery is long since in the cold storage, the delivery driver has left, and the cook has relaxed with a cigarette in the neighboring park. He sits there calmly on a bench, listening to the birds and the splashing of the fountain, while Lisa inside clears the plates one by one.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,cold_storage,990,350,65:55,b0e0e6!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_ext_door,1058.5,410,8:40,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,708.5,275,8,00b050!
c,cook_Harald,1035,430,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,delivery_van,1080,390,45:80,495057!
c,delivery_driver,1065,430,8,f8f9fa!
c,meat_crates,1050,430,6,d9534f!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,food_g3,805,440.5,5,e2e2e2!
c,food_g4,805,480.5,5,e2e2e2!
c,food_g5,805,520.5,5,e2e2e2!
c,food_g6,830,440.5,5,e2e2e2!
c,food_g7,830,480.5,5,e2e2e2!
c,food_g8,830,520.5,5,e2e2e2!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,Guest_11_Couple,745,290.5,8,e83e8c!
c,Guest_12_Couple,810,290.5,8,e83e8c!
c,food_g9,665,270,5,e2e2e2!
c,food_g10,685,270,5,e2e2e2!
c,food_g11,765,270,5,e2e2e2!
c,food_g12,785,270,5,e2e2e2!
</llsketch>
```

---

## Step 10 — Closing

### User

```text
Once the last plates have been cleared, all the guests have paid and left the restaurant, peace finally returns.
Lisa and Harald now tidy up together, giving the place a final wipe, knowing that the day has been a complete success.
```

### Model

```text
<llsketch>
r,terrace,615.5,200.5,280:142,e9ecef!
p,terrace_crack,850,200.5,870:250_860:290_880:342,333333!
r,rect_1,615.5,346.5,300:200,2f75b5!
r,referenz_1x1.5m,1070.5,567.5,40:60,000000!
r,Table_5,657.5,260.5,40:60,c65911!
r,Table_6,758.5,260.5,40:60,c65911!
r,Table_1,657.5,352.5,40:60,c65911!
r,Table_3,676.5,476.5,40:60,c65911!
r,Table_4,798.5,480.5,40:60,c65911!
r,Table_2,798.5,420.5,40:60,c65911!
r,rect_5,921.5,348.5,137:198,c65911!
r,cold_storage,990,350,65:55,b0e0e6!
r,door,734.5,342.5,66:8,ffff00!
r,kitchen_door,911.5,442.5,13:46,ffff00!
r,kitchen_ext_door,1058.5,410,8:40,ffff00!
r,kitchen_serving_hatch,908.5,350.5,21:80,c65911!
r,work_surface,980,460,40:30,adb5bd!
r,stove,935,510,90:30,595959!
r,main_entrance,610.5,411.5,12:71,ffff00!
c,serv_Lisa,696.5,455,8,00b050!
c,cook_Harald,1035,430,8,00b050!
r,air-fan,622.5,519.5,26:22,595959!
r,overtuned_musicbox,890.1,521.1,20.4:24.8,c65911!
c,tree_with_birds,1117.9,261.5,50,00b050!
r,main_street,340.5,103.5,187.6:588.8,595959!
r,delivery_van,1080,390,45:80,495057!
c,delivery_driver,1065,430,8,f8f9fa!
c,meat_crates,1050,430,6,d9534f!
c,Guest_3_Local,784.5,440.5,8,f0ad4e!
c,Guest_4_Local,784.5,480.5,8,f0ad4e!
c,Guest_5_Local,784.5,520.5,8,f0ad4e!
c,Guest_6_Local,852.5,440.5,8,f0ad4e!
c,Guest_7_Local,852.5,480.5,8,f0ad4e!
c,Guest_8_Local,852.5,520.5,8,f0ad4e!
c,food_g3,805,440.5,5,e2e2e2!
c,food_g4,805,480.5,5,e2e2e2!
c,food_g5,805,520.5,5,e2e2e2!
c,food_g6,830,440.5,5,e2e2e2!
c,food_g7,830,480.5,5,e2e2e2!
c,food_g8,830,520.5,5,e2e2e2!
c,Guest_9,645,290.5,8,9932cc!
c,Guest_10,710,290.5,8,9932cc!
c,food_g9,665,270,5,e2e2e2!
c,food_g10,685,270,5,e2e2e2!
c,Guest_11_Couple,665,506.5,8,e83e8c!
c,Guest_12_Couple,728,506.5,8,e83e8c!
c,food_g11,685,490,5,e2e2e2!
c,food_g12,710,490,5,e2e2e2!
c,wine_g11,685,475,3,722f37!
c,wine_g12,710,475,3,722f37!
</llsketch>
```

---

<!-- 2 extra model sketch(s) at end of export -->
