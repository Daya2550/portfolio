
  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= sanitize($basic['name'] ?? 'Portfolio') ?></strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="credits">
        Designed by <a href="#"><?= sanitize($basic['name'] ?? 'Your Name') ?></a>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= ASSETS_PATH ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/aos/aos.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/typed.js/typed.umd.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= ASSETS_PATH ?>vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= ASSETS_PATH ?>js/main.js"></script>
  
  <!-- Custom JS -->
  <script src="<?= ASSETS_PATH ?>js/custom.js"></script>

</body>
</html>
