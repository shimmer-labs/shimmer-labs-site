import { readFileSync } from 'fs'; import { createSign } from 'crypto'; import { homedir } from 'os';
export const SITE='sc-domain:shimmerlabs.co'; export const GA4='509224592';
export async function headers(scope='https://www.googleapis.com/auth/webmasters'){
  const key=JSON.parse(readFileSync(`${homedir()}/.config/shimmer-seo/service-account.json`,'utf8'));
  const now=Math.floor(Date.now()/1000); const b64=o=>Buffer.from(JSON.stringify(o)).toString('base64url');
  const unsigned=`${b64({alg:'RS256',typ:'JWT'})}.${b64({iss:key.client_email,scope,aud:'https://oauth2.googleapis.com/token',iat:now,exp:now+3600})}`;
  const sig=createSign('RSA-SHA256').update(unsigned).sign(key.private_key,'base64url');
  const tok=await (await fetch('https://oauth2.googleapis.com/token',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:new URLSearchParams({grant_type:'urn:ietf:params:oauth:grant-type:jwt-bearer',assertion:`${unsigned}.${sig}`})})).json();
  return {Authorization:`Bearer ${tok.access_token}`,'Content-Type':'application/json'};
}
export async function inspect(H,url){const d=await (await fetch('https://searchconsole.googleapis.com/v1/urlInspection/index:inspect',{method:'POST',headers:H,body:JSON.stringify({inspectionUrl:url,siteUrl:SITE})})).json(); return d.inspectionResult||{error:d.error?.message};}
export async function sa(H,b){return (await (await fetch(`https://www.googleapis.com/webmasters/v3/sites/${encodeURIComponent(SITE)}/searchAnalytics/query`,{method:'POST',headers:H,body:JSON.stringify(b)})).json());}
export async function ga(H,b){return (await (await fetch(`https://analyticsdata.googleapis.com/v1beta/properties/${GA4}:runReport`,{method:'POST',headers:H,body:JSON.stringify(b)})).json());}
