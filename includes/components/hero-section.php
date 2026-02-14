<?php
/**
 * Hero Section Component - Mohasin Portfolio Style
 */
?>

<!-- Hero Section -->
<section id="hero" class="hero section pad">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center content">

      <!-- Text Column -->
      <div class="col-lg-6 bold" data-aos="fade-up" data-aos-delay="200">
        <h3 class="headings role" style="color: var(--heading-color); font-weight: 700; letter-spacing: -0.5px;">Hello, I am</h3>
        <h1 class="name" style="font-weight: 800; font-family: 'Rowdies', sans-serif; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 3.5rem; line-height: 1.2; margin-bottom: 10px;"><?= sanitize($basic['name'] ?? 'Your Name') ?></h1>
        <h3 class="headings role" style="font-size: 2rem; font-weight: 700; color: var(--default-color);">
          I am a
          <span class="headings typewrite" data-period="2000"
            data-type='<?= json_encode(explode(',', $basic['course'] ?? 'Developer,Designer,Freelancer')) ?>'
            style="font-family: 'Rowdies', sans-serif; font-size: 2rem;">
            <span class="wrap typewrite"></span>
          </span>
        </h3>
        <br>
        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
          <?php if (!empty($about['cv_file']) && file_exists($about['cv_file'])): ?>
            <a href="<?= sanitize($about['cv_file']) ?>" download="<?= sanitize($basic['name'] ?? 'Resume') ?>_CV.pdf" target="_blank" class="btn btn-primary">
              Download CV <i class="bi bi-download ms-2 fs-5"></i>
            </a>
          <?php elseif (!empty($basic['resume'])): ?>
            <a href="<?= sanitize($basic['resume']) ?>" download="<?= sanitize($basic['name']) ?>_Resume.pdf" target="_blank" class="btn btn-primary">
              Download CV <i class="bi bi-download ms-2 fs-5"></i>
            </a>
          <?php else: ?>
            <a href="#contact" class="btn btn-primary disabled" title="CV not available">
              CV Not Available <i class="bi bi-exclamation-circle ms-2 fs-5"></i>
            </a>
          <?php endif; ?>
          <a href="#contact" class="btn btn-outline">
            Hire me <i class="bi bi-telephone-fill ms-2 fs-5"></i>
          </a>
        </div>

      </div>

      <!-- Image Column -->
      <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="300">
        <div class="hero-image">
          <img src="<?= getProfileImage($basic) ?>" alt="Portfolio Hero Image" class="img-fluid">
          <div class="shape-1"></div>
          <div class="shape-2"></div>
        </div>
      </div>

    </div>
  </div>
</section>
