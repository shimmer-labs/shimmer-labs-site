<?php if ($testimonials && $testimonials->isNotEmpty()): ?>
<section class="testimonials">
  <div class="container">
    <h2 class="testimonials__title">What Clients Say</h2>

    <div class="testimonials__grid">
      <?php $index = 0; foreach ($testimonials->toStructure() as $testimonial): ?>
        <div class="testimonial <?= $index % 2 === 1 ? 'testimonial--reversed' : '' ?>">
          <div class="testimonial__quote">
            <p>"<?= $testimonial->quote() ?>"</p>
          </div>
          <div class="testimonial__author">
            <?php if ($testimonial->avatar()->isNotEmpty()): ?>
              <img
                src="<?= url('assets/images/testimonials/' . $testimonial->avatar()) ?>"
                alt="<?= $testimonial->author() ?>"
                class="testimonial__avatar"
              >
            <?php endif ?>
            <div class="testimonial__author-info">
              <strong><?= $testimonial->author() ?></strong>
              <span class="testimonial__role"><?= $testimonial->role() ?></span>
            </div>
          </div>
        </div>
      <?php $index++; endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>
