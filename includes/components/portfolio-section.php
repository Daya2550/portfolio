<?php
/**
 * Portfolio Section Component - Enhanced with Mohasin Portfolio Design
 */
?>

<section id="project" class="project section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Projects</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
      </svg>
    </div>
    <p>A curated collection of my development projects, showcasing my practical skills, innovative solutions, and contributions to various teams.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-4" data-aos="fade-up" data-aos-delay="300">
      <?php if (empty($projects)): ?>
        <div class="col-12">
          <p class="text-center">No projects available. Please add your project details in the database.</p>
        </div>
      <?php else: ?>
        <?php $delay = 100; ?>
        <?php foreach ($projects as $proj): ?>
          <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="my-project-card glow-effect enhanced-hover">
              <div class="my-project-image">
                <?php if (!empty($proj['image']) && file_exists($proj['image'])): ?>
                  <img src="<?= sanitize($proj['image']) ?>" alt="<?= sanitize($proj['name']) ?> Project" class="img-fluid" loading="lazy">
                <?php elseif (!empty($proj['image'])): ?>
                  <!-- Image path exists but file not found - show placeholder with error -->
                  <div style="height: 220px; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; text-align: center; padding: 20px;">
                    <div>
                      <i class="bi bi-exclamation-triangle" style="font-size: 2rem; margin-bottom: 10px;"></i><br>
                      Image not found
                    </div>
                  </div>
                <?php else: ?>
                  <!-- No image set - show default placeholder -->
                  <div style="height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                    <div style="text-align: center;">
                      <i class="bi bi-code-square" style="font-size: 3rem; margin-bottom: 10px;"></i><br>
                      <span style="font-size: 1rem;">Project Image</span>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="my-project-content">
                <h4><?= sanitize($proj['name']) ?></h4>
                <?php if (!empty($proj['skills'])): ?>
                  <div class="my-project-tech">
                    <?php 
                    $skillsStr = $proj['skills'] ?? '';
                    $skills = !empty($skillsStr) ? explode(',', $skillsStr) : [];
                    foreach ($skills as $skill): 
                        $skill = trim($skill);
                        if (!empty($skill)):
                    ?>
                        <span class="tech-tag"><?= sanitize($skill) ?></span>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                  </div>
                <?php endif; ?>
                <p class="my-project-description"><?= sanitize($proj['description']) ?></p>

                <?php if (!empty($proj['mentor']) || !empty($proj['team_size'])): ?>
                  <div class="my-project-meta">
                    <?php if (!empty($proj['mentor'])): ?>
                      <small><strong>Mentor:</strong> <?= sanitize($proj['mentor']) ?></small><br>
                    <?php endif; ?>
                    <?php if (!empty($proj['team_size'])): ?>
                      <small><strong>Team Size:</strong> <?= sanitize($proj['team_size']) ?></small><br>
                    <?php endif; ?>
                    <small><strong>Duration:</strong> <?= formatDateRange($proj['start_date'], $proj['end_date']) ?></small>
                  </div>
                <?php endif; ?>

                <div class="my-project-links">
                  <?php if (!empty($proj['github_link'])): ?>
                    <a href="<?= sanitize($proj['github_link']) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm me-2">
                      <i class="bi bi-github"></i> GitHub
                    </a>
                  <?php endif; ?>
                  <?php if (!empty($proj['live_link'])): ?>
                    <a href="<?= sanitize($proj['live_link']) ?>" target="_blank" rel="noopener" class="btn btn-success btn-sm">
                      <i class="bi bi-globe"></i> Live Demo
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php $delay += 100; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section><!-- /Project Section -->
