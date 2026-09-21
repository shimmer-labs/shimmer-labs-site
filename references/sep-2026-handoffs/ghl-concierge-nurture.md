# GHL nurture for the `concierge-intake` tag (Sep 10, 2026)

Build in the GHL UI (the PIT token has no workflows scope). Trigger: Contact Tag added = `concierge-intake`. Exit goals: opportunity stage changes off "Lead" OR appointment booked on the Consultation calendar (tCHB0sj6MoYpJYWJyVqd). Do NOT add the `nurture` tag (that enrolls the old workflow). Subjects go in the Send Email action, not the template. All links hardcoded, no merge fields without defaults.

Day 0 is already covered: the site's Resend auto-reply promises Logan will text or email within one business day. Logan does that by hand. The drip below is the safety net if the first contact doesn't land.

## Day 2, email: "While you wait, run this"
Subject: The three tasks for a shop like yours
Body:
Hey {{contact.first_name | default: "there"}},

Logan reads every intake himself, so if you haven't heard from him yet, you will. In the meantime, here's something you can do today.

We keep one page per trade with the three tasks most worth getting off your plate, each with a prompt you can paste into ChatGPT or Claude right now:
https://shimmerlabs.co/automate-first

Pick your trade, find the task that made you groan, run the prompt. That's roughly what the first session feels like, minus the part where we make it run the same way every time.

Logan

## Day 5, email: "What this looked like for Anna"
Subject: The yoga studio that got its dinners back
Body:
Anna runs a yoga studio in Stillwater. Twice a year the students move out and she'd get buried in freeze and cancel paperwork, phone in hand at the dinner table.

We automated that part. Not the teaching, not knowing her members by name. The paperwork. She got her family dinners back.

The whole story, with her words: https://shimmerlabs.co/case-studies/sweat-yoga-fitness

If you'd rather see it than read it, free AI office hours are Tuesdays and Thursdays, 2 to 3 PM at WorkIT in Stillwater. Bring the thing you dread. https://shimmerlabs.co/office-hours

Logan

## Day 9, email: "How the concierge is priced, and what session one is"
Subject: What session one actually looks like
Body:
Session one is setup: your AI workspace, your files, your policies, so every session after starts working on minute one. Then two 45-minute working sessions a month, on your screen, plus a text line to Logan in between.

Pricing follows how many people you have, because a 20-person shop gets 20 people's hours back from the same two sessions:
Solo $750/mo. Crew (2 to 10) $1,000. Shop (11 to 25) $1,500. Company (26 to 50) $2,250. The first 5 clients get one tier down, locked in.
https://shimmerlabs.co/services/concierge

No contracts. If a month didn't earn its keep, stop.

Logan

## Day 14, email: "Still want to?"
Subject: Still want to take that off your plate?
Body:
Quick one. You filled out the intake a couple of weeks ago about the tasks eating your week. If the timing was off, no worries at all, this is the last email.

If it wasn't, reply to this with one sentence about the task you'd pay the most to never do again, and Logan will text you a time.

Logan

## SMS (optional, Day 3, only if Logan has not already texted)
Hey {{contact.first_name | default: "there"}}, Logan at Shimmer Labs. Saw your intake come through. Want to grab 15 minutes this week, or should I just send a couple of times? No pressure either way.
