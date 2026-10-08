**AppFolio x Claude research (Oct 8, 2026)**

**1. Claude connectors and AppFolio's own AI**
- There IS an official connector. "AppFolio Realm-X" is listed in Anthropic's directory (publisher AppFolio, Inc., added June 2026, sign-in required, exposes one tool called "chat", docs point to a login-gated AppFolio knowledge base article): https://claude.com/connectors/appfolio-realm-x
- AppFolio's blog: "Core Customers have access with Read capabilities and Plus and Max customers have access with Read & Write capabilities" and "The Realm-X Connector is available now": https://www.appfolio.com/blog/appfolio-connects-realm-x-to-anthropic-claude
- Press release (June 9, 2026) frames it as agent-to-agent: Claude asks Realm-X to run jobs inside AppFolio under existing permissions: https://www.appfolio.com/newsroom/appfolio-connects-realm-x-to-anthropics-claude-2026
- Third-party reporting (unverified, KB article is 401 for me): endpoint is mcp.appfolio.com, data-changing actions show a confirmation card before submit, admins may need to allow third-party connectors, and one source says it's early-access/beta rather than self-serve: https://pacificsoftwareventures.com/newsroom/appfolio-claude-connector-commercial-real-estate and https://www.usecarly.com/blog/claude-appfolio-integration/
- Realm-X tiers per the pricing page: Assistant & Messages on Core; Flows on Plus; Leasing CRM/Signals on Max. The Sept 29, 2026 "new Realm-X" (Memory, Knowledge Base, Skills, Prompt-to-Flow) is "available with all AppFolio plans": https://www.appfolio.com/pricing and https://www.financialcontent.com/article/gnwcq-2026-9-29-appfolio-introduces-the-new-realm-x-built-in-the-platform-that-already-knows-your-business
- No separate AppFolio-shipped MCP server beyond that connector was found.

**2. Property Manager API**
- Pricing page lists "AppFolio API (read only)" on Plus and "AppFolio API (read/write)" on Max. Core has no API line item. 50-unit minimum, no public prices: https://www.appfolio.com/pricing
- Credentials are customer-generated, not partner-gated: System Administrator on Plus/Max goes to General Settings > Manage API Settings > Generate New Credentials (client ID + secret, Basic Auth). Source is a third-party help doc, so flag as secondary: https://aptly.helpkit.so/integrations/vVQpukZPcgx25GULuxrwjv/integrating-aptly-with-appfolio-api-plus-and-max-users/7eBtxbAky1ZW98PUBWt4Kx
- Objects documented on AppFolio's public API page: Properties, Units, Listings, Work Orders, Tenants, Tenant Ledgers, Leads, Showings, Rental Applications, Charges, Recurring Charges, Delinquent Charges, Bills, Journal Entries, Attachments, Vendors, Users: https://www.appfolio.com/stack/partners/api
- Independent report card (secondary): 162 operations; work orders POST+PATCH, applicants approve/deny, bills and charges partial; leases PATCH only; no payment posting; rate limit 8 req/s; no OpenAPI, no SDK, no MCP; reference docs are login-gated. It also says endpoint permissions are negotiated case by case: https://www.peterlohmann.com/api-grader/appfolio
- Guest card (Leads) CREATE via API is unverified. Leads and Showings appear in the endpoint list but I could not confirm write support from a primary source.
- Bottom line for Core: a Core customer cannot connect outside tools via API at all.

**3. AppFolio Stack and AI phone tools**
- Official marketplace lists Respage (AI leasing assistant), Tour24 (Tori conversational AI), Knock, AppWork, SmartRent, Property Meld, Lula, Rently, ShowMojo, Tenant Turner. Frontdesk and Haven do NOT appear, and appfolio.com/partners/frontdesk and /partners/haven both 404: https://www.appfolio.com/stack/marketplace
- Frontdesk (myaifrontdesk) claims it writes "guest cards, tour appointments, work orders, and call notes" via AppFolio's API, 2 to 3 week setup, no Stack claim: https://www.myaifrontdesk.com/multifamily/appfolio-ai-answering-service
- Haven claims it writes structured work orders via the API and says API needs Plus or above: https://www.usehaven.ai/post/ai-work-order-creation-in-appfolio-guide
- Partner program: application, security questionnaire, ToS, then listing: https://www.appfolio.com/stack/partners. Propexo (secondary) says Stack listing costs $25k to $50k/yr plus possible rev share, while Database API integrations need no partnership and the client provisions credentials: https://docs.propexo.com/pms-guidance/appfolio/integration-and-partnership

**4. Practical paths, ranked**
1. Realm-X Claude connector (official, Core gets read, Plus/Max write). Setup details login-gated; confirm with client's admin.
2. Database API (needs Plus for read, Max for write; customer-generated creds, no partner fee).
3. Scheduled Reports: Reporting > Scheduled Reports, CSV/XLSX on a schedule to any email; no tier noted: https://propertyhelp.apartments.com/article/1225-how-do-i-automate-occupancy-reporting-using-appfolio. Reliable for read-only.
4. Inbound email parsing: no AppFolio email-to-work-order feature found. Intake is portal, text, phone, or Smart Maintenance Contact Center: https://www.appfolio.com/blog/smart-maintenance. You'd parse the client's notification emails, not push in.
5. Browser automation: AppFolio's Websites ToS section 2(ix) bans "any robot, spider, or other automated device, process or means to access, retrieve, scrape or index any portion of the Services": https://www.appfolio.com/terms/listings. Core/Max product ToS pages didn't render for me (unverified) but assume the same.

**5-line bottom line for the meeting**
1. AppFolio already ships an official Claude connector; Core plan gets read-only, Plus/Max get read/write.
2. Real API access starts at Plus (read) and needs Max to write work orders.
3. On Core, the honest options are the Claude connector for reads plus scheduled CSV reports; writes stay manual.
4. Frontdesk and Haven do write-backs, but they're API-based and not official Stack partners.
5. Scraping or browser bots violate AppFolio's terms; I won't build on that.