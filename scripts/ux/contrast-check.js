// Paste into Playwright browser_evaluate (or DevTools) on any page.
// Flags text/links with contrast < 3:1 against the nearest opaque background, and horizontal overflow.
() => {
  const parse = c => { const m = c.match(/rgba?\(([^)]+)\)/); if (!m) return null; const p = m[1].split(',').map(Number); return { r: p[0], g: p[1], b: p[2], a: p.length > 3 ? p[3] : 1 }; };
  const lum = c => { const f = v => { v /= 255; return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4); }; return 0.2126 * f(c.r) + 0.7152 * f(c.g) + 0.0722 * f(c.b); };
  const bgOf = el => { let e = el; while (e && e !== document.documentElement) { const cs = getComputedStyle(e); const bg = parse(cs.backgroundColor); if (bg && bg.a > 0.5) return bg; if (cs.backgroundImage && cs.backgroundImage.includes('gradient')) { const m = cs.backgroundImage.match(/rgba?\([^)]+\)/); if (m) return parse(m[0]); } e = e.parentElement; } return { r: 255, g: 255, b: 255, a: 1 }; };
  const out = [];
  for (const a of document.querySelectorAll('main a, section a, main p, main li, main h1, main h2, main h3')) {
    if (a.closest('header, footer, nav, dialog')) continue;
    const r = a.getBoundingClientRect(); if (r.width === 0 || r.height === 0) continue;
    const cs = getComputedStyle(a); const fg = parse(cs.color); const bg = bgOf(a); if (!fg) continue;
    const L1 = lum(fg), L2 = lum(bg); const ratio = (Math.max(L1, L2) + 0.05) / (Math.min(L1, L2) + 0.05);
    if (ratio < 3) out.push({ tag: a.tagName, text: a.textContent.trim().slice(0, 40), ratio: +ratio.toFixed(2), section: ((a.closest('section') || {}).className || '').split(' ')[0] });
  }
  const seen = new Set(); const uniq = out.filter(o => { const k = o.tag + o.text; if (seen.has(k)) return false; seen.add(k); return true; });
  const overflow = [...document.querySelectorAll('main *')].filter(e => e.scrollWidth > e.clientWidth + 4 && getComputedStyle(e).overflowX === 'visible' && e.clientWidth > 0 && !e.className.toString().includes('carousel')).slice(0, 6).map(e => e.tagName + '.' + (e.className || '').toString().split(' ')[0] + ' ' + e.scrollWidth + '>' + e.clientWidth);
  return { url: location.pathname, width: innerWidth, low: uniq, overflow };
}
