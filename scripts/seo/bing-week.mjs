// Bing Webmaster Tools weekly pull. Needs an API key from Bing Webmaster Tools
// (gear icon > API access) saved as a single line in ~/.config/shimmer-seo/bing-api-key.
// Usage: node scripts/seo/bing-week.mjs            (last 7 days vs prior 7, top queries, crawl, quota)
//        node scripts/seo/bing-week.mjs /path ...  (also GetUrlInfo for each path)
import { readFileSync, existsSync } from 'fs'; import { homedir } from 'os';
const SITE = process.env.BING_SITE || 'https://shimmerlabs.co';
const keyPath = `${homedir()}/.config/shimmer-seo/bing-api-key`;
if (!existsSync(keyPath)) { console.error('no key at', keyPath, '(Bing Webmaster Tools > gear > API access, paste the key into that file)'); process.exit(1); }
const KEY = readFileSync(keyPath, 'utf8').trim();
const api = async (m, q = {}) => {
  const u = new URL(`https://ssl.bing.com/webmaster/api.svc/json/${m}`);
  u.searchParams.set('siteUrl', SITE); u.searchParams.set('apikey', KEY);
  for (const [k, v] of Object.entries(q)) u.searchParams.set(k, v);
  const r = await fetch(u); const t = await r.text();
  try { return JSON.parse(t).d; } catch { return { error: `${r.status} ${t.slice(0, 200)}` }; }
};
const msDate = s => { const m = /\/Date\((\d+)/.exec(s || ''); return m ? new Date(+m[1]) : null; };
const day = d => d.toISOString().slice(0, 10);
const sum = (rows, f) => rows.reduce((a, r) => a + (r[f] || 0), 0);

const traffic = await api('GetRankAndTrafficStats');
if (traffic?.error) { console.error('API error:', traffic.error); process.exit(1); }
const rows = (traffic || []).map(r => ({ d: msDate(r.Date), imp: r.Impressions, clk: r.Clicks })).filter(r => r.d).sort((a, b) => a.d - b.d);
const now = Date.now(), wk = 7 * 864e5;
const A = rows.filter(r => now - r.d <= wk), B = rows.filter(r => now - r.d > wk && now - r.d <= 2 * wk);
console.log(`Bing ${SITE}  last 7d: ${sum(A,'imp')} impr / ${sum(A,'clk')} clicks   prior 7d: ${sum(B,'imp')} impr / ${sum(B,'clk')} clicks   (data through ${rows.length ? day(rows.at(-1).d) : 'n/a'})`);

const queries = await api('GetQueryStats');
const q = (queries || []).filter(x => now - (msDate(x.Date) || 0) <= wk);
const byQ = {}; for (const x of q) { const k = x.Query; byQ[k] ??= { imp: 0, clk: 0, pos: [] }; byQ[k].imp += x.Impressions; byQ[k].clk += x.Clicks; byQ[k].pos.push(x.AvgImpressionPosition); }
const top = Object.entries(byQ).sort((a, b) => b[1].imp - a[1].imp).slice(0, 20);
console.log('\nTop queries, last 7d (query | impr | clicks | avg pos)');
for (const [k, v] of top) console.log(`  ${k.padEnd(50)} ${String(v.imp).padStart(5)} ${String(v.clk).padStart(4)}   ${(v.pos.reduce((a, b) => a + b, 0) / v.pos.length).toFixed(1)}`);
if (!top.length) console.log('  (none yet; Bing backfills a few days after verification)');

const crawl = await api('GetCrawlStats');
const c = (crawl || []).map(r => ({ d: msDate(r.Date), ...r })).filter(r => r.d && now - r.d <= wk);
if (c.length) console.log(`\nCrawl, last 7d: ${sum(c,'CrawledPages')} pages crawled, ${sum(c,'InIndex')} in index (latest day), ${sum(c,'CrawlErrors')} errors, ${sum(c,'BlockedByRobotsTxt')} blocked by robots`);

const quota = await api('GetUrlSubmissionQuota');
if (quota && !quota.error) console.log(`\nURL submission quota: ${quota.DailyQuota} today, ${quota.MonthlyQuota} this month`);

for (const p of process.argv.slice(2)) {
  const info = await api('GetUrlInfo', { url: SITE + p });
  console.log(`\n${p}: ${info?.error ? info.error : JSON.stringify(info)}`);
}
