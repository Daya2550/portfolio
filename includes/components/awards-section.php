<?php
/**
 * Honors & Awards Section Component
 */
$awards = getAwards();
?>

<?php if (!empty($awards)): ?>
<!-- Honors & Awards Section -->
<section id="awards" class="awards section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Honors & Awards</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>Recognition and achievements throughout my professional journey</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="awards-list">
        <?php foreach ($awards as $award): ?>
          <div class="award-item" style="background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-left: 5px solid var(--accent-color);">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <h3 style="margin: 0; color: var(--heading-color);"><?= sanitize($award['title']) ?></h3>
              <span class="award-date" style="color: #6c757d; font-size: 0.9rem;">
                <?php if (!empty($award['date'])): ?>
                  <i class="bi bi-calendar3"></i> <?= date('F Y', strtotime($award['date'])) ?>
                <?php endif; ?>
              </span>
            </div>
            
            <?php if (!empty($award['provider'])): ?>
              <h4 style="font-size: 1.1rem; color: var(--accent-color); margin-top: 5px;"><?= sanitize($award['provider']) ?></h4>
            <?php endif; ?>
            
            <?php if (!empty($award['description'])): ?>
              <p style="margin-top: 10px; margin-bottom: 0; color: #444;"><?= nl2br(sanitize($award['description'])) ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

  </div>

</section><!-- /Honors & Awards Section -->
<?php endif; ?>
