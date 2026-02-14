<?php
/**
 * Certificates Section Component - Enhanced with Mohasin Portfolio Design
 */
?>

<section id="certificates" class="certificates section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Certification</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
      </svg>
    </div>
    <p>Professional certifications and achievements that demonstrate my expertise and commitment to continuous learning.</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row justify-content-center">
      <?php if (empty($certifications)): ?>
        <div class="col-lg-8">
          <div class="text-center py-5">
            <div class="empty-state">
              <i class="bi bi-award" style="font-size: 4rem; color: #ddd; margin-bottom: 20px;"></i>
              <h4>No Certifications Available</h4>
              <p class="text-muted">Add your professional certifications to showcase your skills and achievements.</p>
              <a href="admin.php?section=certifications" class="btn btn-primary">Add Certifications</a>
            </div>
          </div>
        </div>
      <?php else: ?>
        <?php $delay = 100; ?>
        <?php foreach ($certifications as $cert): ?>
          <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="certification-card modern-card h-100">
              <div class="cert-header">
                <div class="cert-icon">
                  <i class="bi bi-award-fill"></i>
                </div>
                <div class="cert-title">
                  <h4><?= sanitize($cert['name']) ?></h4>
                  <p class="cert-provider"><?= sanitize($cert['provider']) ?></p>
                </div>
              </div>

              <div class="cert-body">
                <div class="cert-meta">
                  <?php if (!empty($cert['enrollment_no'])): ?>
                    <div class="meta-item">
                      <span class="meta-label">ID:</span>
                      <span class="meta-value"><?= sanitize($cert['enrollment_no']) ?></span>
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($cert['marks'])): ?>
                    <div class="meta-item">
                      <span class="meta-label">Score:</span>
                      <span class="meta-value"><?= sanitize($cert['marks']) ?></span>
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($cert['issue_date'])): ?>
                    <div class="meta-item">
                      <span class="meta-label">Issued:</span>
                      <span class="meta-value"><?= date('M Y', strtotime($cert['issue_date'])) ?></span>
                    </div>
                  <?php endif; ?>
                </div>

                <?php if (!empty($cert['skills'])): ?>
                  <div class="cert-skills">
                    <h6>Skills Covered:</h6>
                    <div class="skills-tags">
                      <?php
                      $skillsStr = $cert['skills'] ?? '';
                      $skills = !empty($skillsStr) ? explode(',', $skillsStr) : [];
                      foreach ($skills as $skill):
                        $skill = trim($skill);
                        if (!empty($skill)):
                      ?>
                        <span class="skill-tag"><?= sanitize($skill) ?></span>
                      <?php
                        endif;
                      endforeach;
                      ?>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if (!empty($cert['description'])): ?>
                  <div class="cert-description">
                    <p><?= nl2br(sanitize($cert['description'])) ?></p>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Certificate Image Display -->
              <?php if (!empty($cert['certificate'])): ?>
              <div class="cert-image-section">
                <h6>Certificate Image:</h6>
                <div class="certificate-image">
                  <img src="<?= sanitize($cert['certificate']) ?>" alt="<?= sanitize($cert['name']) ?> Certificate" class="img-fluid">
                  <div class="image-overlay">
                    <a href="<?= sanitize($cert['certificate']) ?>" target="_blank" class="btn btn-light btn-sm">
                      <i class="bi bi-zoom-in"></i> View Full Size
                    </a>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <div class="cert-footer">
                <?php if (!empty($cert['certificate'])): ?>
                  <a href="<?= sanitize($cert['certificate']) ?>" target="_blank" class="btn btn-primary btn-sm">
                    <i class="bi bi-download"></i> Download Certificate
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php $delay += 100; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section><!-- /Certificates Section -->
