<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= sanitize($basic['name'] ?? 'My Portfolio') ?> - Portfolio</title>
  <meta content="<?= getMetaDescription($others) ?>" name="description">
  <meta content="<?= getMetaKeywords($others) ?>" name="keywords">

  <!-- Favicons -->
  <link href="https://i.postimg.cc/4x4vTwXN/images.jpg" rel="icon">
  <link href="https://i.postimg.cc/4x4vTwXN/images.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Questrial&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= ASSETS_PATH ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= ASSETS_PATH ?>css/main.css" rel="stylesheet">

  <!-- Mohasin Portfolio CSS -->
  <link href="<?= ASSETS_PATH ?>css/mohasin-complete.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>css/custom.css" rel="stylesheet">
  <link href="<?= ASSETS_PATH ?>css/modern-enhancements.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename"><?= sanitize($basic['name'] ?? 'Portfolio') ?></h1>
      </a>

      <nav id="navmenu" class="navmenu nav">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          
          <?php if (!empty(getServices())): ?>
          <li><a href="#services">Services</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getSkills())): ?>
          <li><a href="#skills">Skills</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getProjects())): ?>
          <li><a href="#project">Projects</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getEducation())): ?>
          <li><a href="#education">Education</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getInternshipExperience())): ?>
          <li><a href="#internship">Internships</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getCertifications())): ?>
          <li><a href="#certificates">Certification</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getAwards())): ?>
          <li><a href="#awards">Awards</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getGallery())): ?>
          <li><a href="#gallery">Gallery</a></li>
          <?php endif; ?>
          
          <?php if (!empty(getBlogs())): ?>
          <li><a href="#blogs">Blog</a></li>
          <?php endif; ?>
          
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="<?= LINKEDIN_URL ?>" class="linkedin" target="_blank">
          <i class="bi bi-linkedin"></i>
        </a>
        <a href="<?= GITHUB_URL ?>" class="github" target="_blank">
          <i class="bi bi-github"></i>
        </a>
        <a href="<?= INSTAGRAM_URL ?>" class="instagram" target="_blank">
          <i class="bi bi-instagram"></i>
        </a>
      </div>

    </div>
  </header>

  <main class="main">
