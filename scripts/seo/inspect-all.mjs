// Inspect every sitemap URL: verdict, coverage, canonical mismatch, crawledAs, rich results issues, mobile usability.
import {headers, inspect} from './lib.mjs';
const H=await headers();
const sm=await (await fetch('https://shimmerlabs.co/sitemap.xml')).text();
const urls=[...sm.matchAll(/<loc>(.*?)<\/loc>/g)].map(m=>m[1]);
const rows=[];
for (const u of urls){
  const r=await inspect(H,u); const ix=r.indexStatusResult||{}; const rr=r.richResultsResult||{}; const mu=r.mobileUsabilityResult||{};
  const issues=(rr.detectedItems||[]).flatMap(d=>(d.items||[]).flatMap(i=>(i.issues||[]).map(x=>`${d.richResultType}:${x.severity}:${x.issueMessage}`)));
  const canon = ix.userCanonical && ix.googleCanonical && ix.userCanonical!==ix.googleCanonical ? `CANON user=${ix.userCanonical} google=${ix.googleCanonical}` : '';
  rows.push({u:u.replace('https://shimmerlabs.co',''), verdict:ix.verdict, cov:ix.coverageState, crawledAs:ix.crawledAs, robots:ix.robotsTxtState, idx:ix.indexingState, fetch:ix.pageFetchState, last:(ix.lastCrawlTime||'').slice(0,10), rich:rr.verdict, richIssues:issues, mobile:mu.verdict, canon});
}
const bad=rows.filter(r=>r.verdict!=='PASS'||r.canon||r.richIssues.length||(r.rich&&r.rich!=='PASS')||(r.mobile&&r.mobile!=='PASS')||r.robots!=='ALLOWED'||r.fetch!=='SUCCESSFUL');
console.log('total',rows.length,'| flagged',bad.length);
for(const r of bad) console.log(`${r.u.padEnd(50)} ${r.verdict}/${r.cov} crawl=${r.last} as=${r.crawledAs} idx=${r.idx} fetch=${r.fetch} robots=${r.robots} rich=${r.rich} mobile=${r.mobile} ${r.canon} ${r.richIssues.join(' ; ')}`);
console.log('\nrich result types detected across site:');
const types={}; for(const r of rows){ } 
const byCrawl={}; for(const r of rows){ byCrawl[r.crawledAs]=(byCrawl[r.crawledAs]||0)+1 } console.log('crawledAs', byCrawl);
const stale=rows.filter(r=>r.last && r.last<'2026-09-15').map(r=>`${r.u} ${r.last}`); console.log('\ncrawled before Sep 15:', stale.length); console.log(stale.join('\n'));
