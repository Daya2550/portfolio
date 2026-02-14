<?php
/**
 * Blog Section Component
 */
$blogs = getBlogs();
?>

<?php if (!empty($blogs)): ?>
<!-- Blog Section -->
<section id="blogs" class="blog section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Recent Articles</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>Sharing knowledge and insights on technology</p>
  </div><!-- End Section Title -->

  <div class="container">

      <div class="row gy-4">
        <?php foreach ($blogs as $blog): ?>
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <article style="box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1); background-color: #fff; border-radius: 10px; overflow: hidden; height: 100%; display: flex; flex-direction: column;">

              <?php if (!empty($blog['image'])): ?>
                <div class="post-img" style="overflow: hidden; max-height: 240px;">
                  <img src="<?= sanitize($blog['image']) ?>" alt="<?= sanitize($blog['title']) ?>" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; transition: 0.3s;">
                </div>
              <?php endif; ?>

              <div style="padding: 30px;">
                <p class="post-date" style="color: #6c757d; font-size: 14px; display: block; margin-bottom: 10px;">
                  <?php if (!empty($blog['date'])): ?>
                    <time datetime="<?= sanitize($blog['date']) ?>"><?= date('F d, Y', strtotime($blog['date'])) ?></time>
                  <?php endif; ?>
                </p>

                <h2 class="title" style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">
                  <a href="<?= sanitize($blog['link']) ?>" target="_blank" style="color: #37517e; text-decoration: none; transition: 0.3s;"><?= sanitize($blog['title']) ?></a>
                </h2>

                <p style="margin-bottom: 20px;">
                  <?= sanitize(substr($blog['summary'], 0, 150)) ?>...
                </p>
                
                <a href="<?= sanitize($blog['link']) ?>" target="_blank" style="color: var(--accent-color); font-weight: 500; font-size: 14px; display: flex; align-items: center;">
                  Read More <i class="bi bi-arrow-right" style="margin-left: 5px;"></i>
                </a>
              </div>

            </article>
          </div>
        <?php endforeach; ?>
      </div>

  </div>

</section><!-- /Blog Section -->
<?php endif; ?>
