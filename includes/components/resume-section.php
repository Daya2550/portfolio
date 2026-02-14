<?php
/**
 * Education Section Component - Mohasin Portfolio Style
 */
?>

<!-- Education Section - Academic Background Only -->
<section id="education" class="education section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Education</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>My educational background and academic achievements that have shaped my professional journey.</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row justify-content-center">
      <!-- Academic Education -->
      <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
        <div class="education-timeline">
          <?php if (empty($education)): ?>
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <div class="education-card">
                  <div class="education-icon">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                  <div class="education-details">
                    <h4>No Education Details Available</h4>
                    <p class="text-muted">Please add your education details in the admin panel.</p>
                    <a href="admin.php?section=education" class="btn btn-outline-primary btn-sm">Add Education</a>
                  </div>
                </div>
              </div>
            </div>
          <?php else: ?>
            <?php foreach ($education as $index => $edu): ?>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="<?= 100 + ($index * 100) ?>">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <div class="education-card">
                  <div class="education-icon">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                  <div class="education-details">
                    <h4><?= sanitize($edu['degree']) ?> in <?= sanitize($edu['stream']) ?></h4>
                    <h5 class="institution"><?= sanitize($edu['college']) ?></h5>
                    <div class="education-meta">
                      <span class="duration">
                        <i class="bi bi-calendar3"></i>
                        <?= formatDateRange($edu['start_date'], $edu['end_date']) ?>
                      </span>
                      <span class="grade">
                        <i class="bi bi-award"></i>
                        CGPA: <?= sanitize($edu['cgpa']) ?>
                      </span>
                      <span class="type">
                        <i class="bi bi-bookmark"></i>
                        <?= sanitize($edu['graduation_type']) ?>
                      </span>
                    </div>
                    <?php if (!empty($edu['description'])): ?>
                      <p class="education-description"><?= nl2br(sanitize($edu['description'])) ?></p>
                    <?php endif; ?>
                    <?php if ($edu['marksheet'] || $edu['certificate']): ?>
                      <div class="education-documents">
                        <?php if ($edu['marksheet']): ?>
                          <a href="<?= sanitize($edu['marksheet']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-file-earmark-text"></i> Marksheet
                          </a>
                        <?php endif; ?>
                        <?php if ($edu['certificate']): ?>
                          <a href="<?= sanitize($edu['certificate']) ?>" target="_blank" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-award"></i> Certificate
                          </a>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>


    </div>
  </div>
</section>
