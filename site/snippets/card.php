<div class="card">
  <h3><a href="<?= $item->url() ?>"><?= $item->title() ?></a></h3>
  <p><?= $item->summary()->excerpt(100) ?></p>
  <p><a href="<?= $item->url() ?>">View Project →</a></p>
</div>