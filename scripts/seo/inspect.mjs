import {headers, inspect} from './lib.mjs';
const H=await headers();
for (const p of process.argv.slice(2)){const r=await inspect(H,'https://shimmerlabs.co'+p); const ix=r.indexStatusResult||{}; console.log(p.padEnd(52),'|',(ix.coverageState||r.error||'?').padEnd(36),'| crawl',ix.lastCrawlTime?ix.lastCrawlTime.slice(0,10):'-','|',r.inspectionResultLink||'');}
