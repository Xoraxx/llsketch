#!/usr/bin/env python3
"""Extract llsketch blocks and short prose from saved Gemini share HTML."""
import html
import re
import sys
from pathlib import Path


def main() -> None:
    path = Path(sys.argv[1])
    text = path.read_text(encoding="utf-8", errors="replace")

    blocks = re.findall(r"&lt;llsketch&gt;(.*?)&lt;/llsketch&gt;", text, re.S)
    print(f"llsketch_blocks: {len(blocks)}")

    # User turns: text in share-turn before model response (heuristic)
    turns = re.split(r"share-turn-viewer", text)
    print(f"turn_chunks: {len(turns)}")

    for i, block in enumerate(blocks[:20], 1):
        lines = [ln.strip() for ln in html.unescape(block).strip().splitlines() if ln.strip()]
        print(f"\n--- block {i} ({len(lines)} objects) ---")
        for ln in lines[:3]:
            print(ln)
        if len(lines) > 3:
            print("...")
            for ln in lines[-2:]:
                print(ln)


if __name__ == "__main__":
    main()
