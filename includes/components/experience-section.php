<?php
/**
 * Internship Section Component - Mohasin Portfolio Style
 */
?>

<!-- Internship Section -->
<section id="internship" class="internship section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Internships</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
    <p>My internship experiences and professional development journey.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="internship-wrapper">
      <div class="timeline">
        <?php
        $internships = getInternshipExperience();
        if (empty($internships)):
        ?>
          <div class="text-center">
            <p>No internship experience available. Please add details in the database.</p>
          </div>
        <?php
        else:
          foreach ($internships as $intern):
        ?>
        <div class="timeline-item timeline-modern-item" data-aos="fade-up" data-aos-delay="200">
          <div class="timeline-dot"></div>
          <div class="timeline-left">
            <div class="company" style="font-weight: 700; color: #2d3436; font-size: 1.1rem;"><?= sanitize($intern['organization']) ?></div>
            <div class="period" style="color: #667eea; font-weight: 500; font-size: 0.9rem;"><?= formatDateRange($intern['start_date'], $intern['end_date']) ?></div>
          </div>
          <div class="timeline-right">
            <div class="position" style="font-size: 1.2rem; font-weight: 700; color: #667eea; margin-bottom: 10px;"><?= sanitize($intern['designation']) ?></div>
            <div class="skills" style="margin-bottom: 10px;">
                <strong>Skills:</strong> 
                <?php 
                $skillsStr = $intern['skills'] ?? '';
                $skills = !empty($skillsStr) ? explode(',', $skillsStr) : [];
                foreach($skills as $skill): 
                ?>
                <span class="badge bg-light text-dark" style="font-weight: 500; border: 1px solid #ddd; margin-right: 5px;"><?= trim(sanitize($skill)) ?></span>
                <?php endforeach; ?>
            </div>
            <div class="description" style="color: #636e72; line-height: 1.6;"><?= nl2br(sanitize($intern['description'])) ?></div>
          </div>
        </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </div>
</section><!-- /Internship Section -->
