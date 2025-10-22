<?php snippet('header') ?>

<main class="main">
    <div class="content-wrapper">
        <article class="content">
            <h1><?= $page->title() ?></h1>

            <?php if ($page->text()->isNotEmpty()): ?>
                <div class="text">
                    <?= $page->text()->kt() ?>
                </div>
            <?php endif ?>
        </article>
    </div>
</main>

<?php snippet('footer') ?>
