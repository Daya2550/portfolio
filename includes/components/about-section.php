<?php
/**
 * About Section Component - Mohasin Portfolio Style
 */
?>

<!-- About Section -->
<section id="about" class="about section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <div class="about-text" style="background: var(--glass-bg); border: var(--glass-border); box-shadow: var(--glass-shadow); padding: 30px; border-radius: 20px;">
      <p style="font-size: 1.1rem; line-height: 1.8; color: var(--default-color);"><?= nl2br(sanitize($about['about_text'] ?? 'Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions.')) ?></p>
    </div>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row align-items-center justify-content-center">

      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
        <div class="about-content">
          <span class="subtitle">About Me</span>

          <h2><?= sanitize($basic['course'] ?? 'Full Stack Developer') ?></h2>

          <div class="personal-info">
            <div class="row g-4">
              <div class="col-6">
                <div class="info-item">
                  <span class="label">Name</span>
                  <span class="value"><?= sanitize($basic['name'] ?? 'Your Name') ?></span>
                </div>
              </div>

              <div class="col-6">
                <div class="info-item">
                  <span class="label">Phone</span>
                  <span class="value"><?= sanitize($contact['phone'] ?? 'N/A') ?></span>
                </div>
              </div>

              <div class="col-6">
                <div class="info-item">
                  <span class="label">Age</span>
                  <span class="value"><?= sanitize($basic['age'] ?? 'N/A') ?></span>
                </div>
              </div>

              <div class="col-6">
                <div class="info-item">
                  <span class="label">Occupation</span>
                  <span class="value"><?= sanitize($basic['occupation'] ?? 'Developer') ?></span>
                </div>
              </div>

              <div class="col-10">
                <div class="info-item">
                  <span class="label">Email</span>
                  <span class="value"><?= sanitize($contact['email'] ?? 'N/A') ?></span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section><!-- /About Section -->
