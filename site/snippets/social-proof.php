<?php if ($clients && $clients->isNotEmpty()): ?>
<section class="social-proof">
  <div class="container">
    <div class="client-logos">
      <?php foreach ($clients->toStructure() as $client): ?>
        <div class="client-item">
          <?php if ($client->logo()->isNotEmpty()): ?>
            <?php if ($client->url()->isNotEmpty()): ?>
              <a href="<?= $client->url() ?>" target="_blank" rel="noopener">
                <img src="<?= $client->logo()->toFile()->url() ?>" alt="<?= $client->name() ?>">
              </a>
            <?php else: ?>
              <img src="<?= $client->logo()->toFile()->url() ?>" alt="<?= $client->name() ?>">
            <?php endif ?>
          <?php else: ?>
            <span class="client-name"><?= $client->name() ?></span>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>