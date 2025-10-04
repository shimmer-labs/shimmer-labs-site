<?php snippet('header') ?>

<main>
  <h1><?= $page->title() ?></h1>
  <p><?= $page->intro() ?></p>

  <form method="post" action="#">
    <label for="name">Name</label><br>
    <input type="text" name="name" id="name" required><br><br>

    <label for="email">Email</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="message"><?= $page->intake_question() ?></label><br>
    <textarea name="message" rows="5" required></textarea><br><br>

    <button type="submit">Send Message</button>
  </form>
</main>

<?php snippet('footer') ?>