# SVG vs. LLSketch – Comparison

Same scene: troop, orc army, mountains, rockfall, stream.

## SVG (excerpt, ~670 characters)

```xml
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 1000">
  <rect id="Orc-Fortress" x="1282.5" y="18.5" width="150" height="100" fill="#ffc107"/>
  <circle id="Mountains" cx="858.5" cy="189.5" r="154.3" fill="#6c757d"/>
  ...
</svg>
```

## LLSketch (~383 characters, −~43 %)

```text
<llsketch>
r,Orc-Fortress,1282.5,18.5,150:100,ffc107!
c,Mountains,858.5,189.5,154.3,6c757d!
c,Mountains,550.5,223.5,221.2,6c757d!
r,My-Troop,181.5,484.5,155:120,198754!
r,Orc-Army,1090.5,182.5,150:100,dc3545!
c,Final-Combat-Zone,964.5,453.5,90.5,0d6efd!
c,Rockfall,1213.5,293.5,91.7,0d6efd!
p,Stream,10,10,25:40_60:85_120:90_200:150,0dcaf0!
t,Battlefield,500,50,24,ffffff!
</llsketch>
```

(Source: [battlefield.llsketch](battlefield.llsketch))

## Inline (URL-friendly, ~303 characters)

```text
r,Orc-Fortress,1282.5,18.5,150:100,ffc107!c,Mountains,858.5,189.5,154.3,6c757d!...
```

## RLLSketch (LZ, engine-only)

After `LZString.compressToEncodedURIComponent(inline)` e.g.:

```text
eJxNj01rwzAMhv9KeteC5Fixndt6CINRCmX3Ehy5K03T4C6X_vraho6C0EWP3o8I-8Plo5f73zqfgJRVNQPZvBg7QoQQPKHZeNhKPAlYLkfrCqLrBlpv2Iz_ADOmk1JN2VSrFxBhJ-dZqp-4LoskCUqEtroIcUcKgZw1rBO5j5fqSyQCocPip94ijb5hzcmxP8_DJNX353UJj9ss4Nospzmbl0ccWwk5XC_TPZWMj1SSSjZXIKrNC1pgO_jfaVhDss2juNN4bLGzWcgPAZ_y-U49
```

→ Short for URLs, **unreadable for LLMs** — only `<llsketch>` in chat.
