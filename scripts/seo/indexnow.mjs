// Ping IndexNow (Bing, DuckDuckGo, Yandex, Naver share it) with changed URLs.
// Usage: node scripts/seo/indexnow.mjs [/path ...]   (no args = every sitemap URL)
// The key is public by design; it lives at https://shimmerlabs.co/<key>.txt so engines can verify ownership.
const KEY = '347258a96998b2d2d186b18074308ddc';
const HOST = 'shimmerlabs.co';
let urls = process.argv.slice(2).map(p => 'https://' + HOST + p);
if (urls.length === 0) {
  const xml = await (await fetch('https://' + HOST + '/sitemap.xml')).text();
  urls = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)].map(m => m[1]);
}
const keyCheck = await fetch(`https://${HOST}/${KEY}.txt`);
if (!keyCheck.ok || (await keyCheck.text()).trim() !== KEY) { console.error('key file not live yet at /' + KEY + '.txt, push and wait for deploy'); process.exit(1); }
const r = await fetch('https://api.indexnow.org/indexnow', {
  method: 'POST', headers: { 'Content-Type': 'application/json; charset=utf-8' },
  body: JSON.stringify({ host: HOST, key: KEY, keyLocation: `https://${HOST}/${KEY}.txt`, urlList: urls })
});
console.log('IndexNow', r.status, r.statusText, '| urls:', urls.length);
