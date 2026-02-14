<?php
/**
 * Gallery Section Component
 */
$gallery = getGallery();
?>

<?php if (!empty($gallery)): ?>
<!-- Gallery Section -->
<section id="gallery" class="gallery section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Gallery</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>Moments and memories regarding my career</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">
        <?php foreach ($gallery as $item): ?>
          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" style="position: relative; overflow: hidden; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
              <img src="<?= sanitize($item['image']) ?>" class="img-fluid" alt="<?= sanitize($item['title']) ?>" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
              
              <div class="gallery-info" style="padding: 15px; background: white;">
                <h4 style="margin: 0 0 5px 0; font-size: 1.1rem;"><?= sanitize($item['title']) ?></h4>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;"><?= sanitize($item['description']) ?></p>
                <?php if (!empty($item['date'])): ?>
                  <small style="color: #999;"><i class="bi bi-calendar3"></i> <?= date('F d, Y', strtotime($item['date'])) ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

  </div>

</section><!-- /Gallery Section -->
<?php endif; ?>
