#!/usr/bin/env python3
"""Convert Gemini share HTML to plain User/LLM Markdown transcript."""
import html
import re
import sys
from pathlib import Path


def clean_text(s: str) -> str:
    s = html.unescape(s)
    s = re.sub(r"<br\s*/?>", "\n", s, flags=re.I)
    s = re.sub(r"<[^>]+>", "", s)
    s = s.replace("\xa0", " ")
    return s.strip()


def extract_user(block: str) -> str:
    lines = re.findall(r'class="query-text-line[^"]*"[^>]*>([\s\S]*?)</p>', block)
    parts = [clean_text(ln) for ln in lines if clean_text(ln)]
    parts = [p for p in parts if p != "Du hast gesagt"]
    return "\n".join(parts).strip()


def extract_model(block: str) -> str:
    mc = re.search(r"<message-content[^>]*>([\s\S]*?)</message-content>", block)
    if not mc:
        return ""
    inner = mc.group(1)
    chunks: list[str] = []
    for piece in re.findall(
        r"<p[^>]*data-path-to-node=\"[^\"]*\"[^>]*>([\s\S]*?)</p>"
        r"|<pre[^>]*><code[^>]*>([\s\S]*?)</code></pre>"
        r"|<li[^>]*>([\s\S]*?)</li>",
        inner,
    ):
        p, code, li = piece
        raw = p or code or li
        if code:
            text = html.unescape(code).strip()
            chunks.append(text)
        else:
            text = clean_text(raw)
            if text and len(text) > 1:
                chunks.append(text)
    return "\n\n".join(chunks).strip()


def main() -> None:
    src = Path(sys.argv[1])
    dst = Path(sys.argv[2])
    text = src.read_text(encoding="utf-8", errors="replace")

    users = re.findall(r"<user-query[\s\S]*?</user-query>", text)
    models = re.findall(r"<response-container[\s\S]*?</response-container>", text)

    lines = [
        "# Restaurant RPG — chat transcript",
        "",
        "Converted from Gemini share export. User and LLM turns in order.",
        "",
        "---",
        "",
    ]

    n = max(len(users), len(models))
    for i in range(n):
        if i < len(users):
            u = extract_user(users[i])
            if u:
                lines.append("## User")
                lines.append("")
                lines.append(u)
                lines.append("")
        if i < len(models):
            m = extract_model(models[i])
            if m:
                lines.append("## LLM")
                lines.append("")
                lines.append(m)
                lines.append("")
        lines.append("---")
        lines.append("")

    dst.write_text("\n".join(lines), encoding="utf-8")
    print(f"users={len(users)} models={len(models)} -> {dst}")


if __name__ == "__main__":
    main()
