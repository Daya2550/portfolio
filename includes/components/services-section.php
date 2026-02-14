<?php
/**
 * Services Section Component
 */
$services = getServices();
?>

<?php if (!empty($services)): ?>
<!-- Services Section -->
<section id="services" class="services section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>My Services</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>Professional solutions tailored to your needs</p>
  </div><!-- End Section Title -->

  <div class="container">

      <div class="row gy-4">
        <?php foreach ($services as $service): ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative" style="background: #fff; padding: 40px 30px; box-shadow: 0px 10px 29px 0px rgba(68, 88, 144, 0.1); height: 100%; border-radius: 10px; transition: all 0.3s ease-in-out;">
              <div class="icon" style="margin-bottom: 20px; width: 64px; height: 64px; background: #e1f0fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s;">
                <?php if (strpos($service['icon'], 'bi-') === 0): ?>
                  <i class="<?= sanitize($service['icon']) ?>" style="font-size: 32px; color: var(--accent-color);"></i>
                <?php else: ?>
                  <img src="<?= sanitize($service['icon']) ?>" alt="<?= sanitize($service['title']) ?>" style="width: 32px; height: 32px;">
                <?php endif; ?>
              </div>
              <h3 style="font-weight: 700; margin-bottom: 15px; font-size: 22px;"><?= sanitize($service['title']) ?></h3>
              <p style="line-height: 24px; font-size: 14px; margin-bottom: 0;"><?= nl2br(sanitize($service['description'])) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

  </div>

</section><!-- /Services Section -->
<?php endif; ?>
