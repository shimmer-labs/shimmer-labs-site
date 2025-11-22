<?php if ($testimonials && $testimonials->isNotEmpty()): ?>
<section class="testimonials">
  <div class="container">
    <h2 class="testimonials__title">What Clients Say</h2>

    <div class="testimonials__grid">
      <?php foreach ($testimonials->toStructure() as $testimonial): ?>
        <div class="testimonial">
          <div class="testimonial__quote">
            <p>"<?= $testimonial->quote() ?>"</p>
          </div>
          <div class="testimonial__author">
            <strong><?= $testimonial->author() ?></strong>
            <span class="testimonial__role"><?= $testimonial->role() ?></span>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>
