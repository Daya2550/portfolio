<?php
/**
 * Skills Section Component - Mohasin Portfolio Style
 */
?>

<!-- Skills Section -->
<section id="skills" class="skills section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
    <div class="title-shape">
      <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
          stroke-width="2"></path>
      </svg>
    </div>
  </div><!-- End Section Title -->

  <h2 style="font-weight: bold;">Technical Skills</h2>
  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <!-- Skill Buttons -->
    <div class="skills-buttons">
      <button class="skill-btn active" onclick="showSkillSection(event, 'frontend')">Front-End</button>
      <button class="skill-btn" onclick="showSkillSection(event, 'backend')">Back-End</button>
      <button class="skill-btn" onclick="showSkillSection(event, 'databases')">Databases</button>
      <button class="skill-btn" onclick="showSkillSection(event, 'languages')">Languages</button>
      <button class="skill-btn" onclick="showSkillSection(event, 'tools')">Tools & Technologies</button>
    </div>

    <!-- Front-End -->
    <div class="skill-section" id="frontend" style="display: flex;">
      <?php
      $frontendSkills = getSkillsByCategory('frontend');
      if (empty($frontendSkills)) {
        // Fallback skills if database is empty
        $frontendSkills = [
        
        ];
      }
      foreach ($frontendSkills as $skill): ?>
        <div class="card">
          <img src="<?= sanitize($skill['image'] ?? ASSETS_PATH . 'img/skills/default.png') ?>" alt="<?= sanitize($skill['name']) ?>" loading="lazy">
          <h4 class="headings"><b><?= sanitize($skill['name']) ?></b></h4>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Back-End -->
    <div class="skill-section" id="backend" style="display: none;">
      <?php
      $backendSkills = getSkillsByCategory('backend');
      if (empty($backendSkills)) {
        // Fallback skills if database is empty
        $backendSkills = [
        
        ];
      }
      foreach ($backendSkills as $skill): ?>
        <div class="card">
          <img src="<?= sanitize($skill['image'] ?? ASSETS_PATH . 'img/skills/default.png') ?>" alt="<?= sanitize($skill['name']) ?>" loading="lazy">
          <h4 class="headings"><b><?= sanitize($skill['name']) ?></b></h4>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Databases -->
    <div class="skill-section" id="databases" style="display: none;">
      <?php
      $databaseSkills = getSkillsByCategory('databases');
      if (empty($databaseSkills)) {
        // Fallback skills if database is empty
        $databaseSkills = [
         
        ];
      }
      foreach ($databaseSkills as $skill): ?>
        <div class="card">
          <img src="<?= sanitize($skill['image'] ?? ASSETS_PATH . 'img/skills/default.png') ?>" alt="<?= sanitize($skill['name']) ?>" loading="lazy">
          <h4 class="headings"><b><?= sanitize($skill['name']) ?></b></h4>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Languages -->
    <div class="skill-section" id="languages" style="display: none;">
      <?php
      $languageSkills = getSkillsByCategory('languages');
      if (empty($languageSkills)) {
        // Fallback skills if database is empty
        $languageSkills = [
         
        ];
      }
      foreach ($languageSkills as $skill): ?>
        <div class="card">
          <img src="<?= sanitize($skill['image'] ?? ASSETS_PATH . 'img/skills/default.png') ?>" alt="<?= sanitize($skill['name']) ?>" loading="lazy">
          <h4 class="headings"><b><?= sanitize($skill['name']) ?></b></h4>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Tools -->
    <div class="skill-section" id="tools" style="display: none;">
      <?php
      $toolSkills = getSkillsByCategory('tools');
      if (empty($toolSkills)) {
        // Fallback skills if database is empty
        $toolSkills = [
         
        ];
      }
      foreach ($toolSkills as $skill): ?>
        <div class="card">
          <img src="<?= sanitize($skill['image'] ?? ASSETS_PATH . 'img/skills/default.png') ?>" alt="<?= sanitize($skill['name']) ?>" loading="lazy">
          <h4 class="headings"><b><?= sanitize($skill['name']) ?></b></h4>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <h2 class="section-title">Soft Skills</h2>
  <ul class="soft-skills" style="gap: 15px;">
    <?php
    $softSkills = getSkillsByCategory('soft');
    if (!empty($softSkills)):
        foreach ($softSkills as $skill):
    ?>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">
        <?= sanitize($skill['name']) ?>
    </li>
    <?php
        endforeach;
    else:
        // Fallback or empty state if no skills found
    ?>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">🗣️ Communication</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">🧠 Critical Thinking</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">🧭 Leadership</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">📊 Logical Thinking</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">🤝 Team Collaboration</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">🔄 Adaptability</li>
    <li style="background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">⏱️ Time Management</li>
    <?php endif; ?>
  </ul>

</section><!-- /Skills Section -->
