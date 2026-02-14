<?php
/**
 * Functions file for Portfolio Website
 * Contains all database queries and data processing functions
 */

/**
 * Safe fetch function to prevent errors when no data is found
 */
function safeFetch($query) {
    global $pdo;
    try {
        $stmt = $pdo->query($query);
        $res = $stmt->fetch();
        return $res ?: [];
    } catch (Exception $e) {
        // Return empty array if table doesn't exist
        return [];
    }
}

/**
 * Get basic details from database
 */
function getBasicDetails() {
    return safeFetch("SELECT * FROM basic_details LIMIT 1");
}

/**
 * Get contact information from database
 */
function getContactInfo() {
    return safeFetch("SELECT * FROM contacts LIMIT 1");
}

/**
 * Get education records from database
 */
function getEducation() {
    global $pdo;
    return $pdo->query("SELECT * FROM education ORDER BY start_date DESC")->fetchAll();
}

/**
 * Get professional experience from database
 */
function getProfessionalExperience() {
    global $pdo;
    return $pdo->query("SELECT * FROM experience WHERE type='professional' ORDER BY start_date DESC")->fetchAll();
}

/**
 * Get internship experience from database
 */
function getInternshipExperience() {
    global $pdo;
    return $pdo->query("SELECT * FROM experience WHERE type='internship' ORDER BY start_date DESC")->fetchAll();
}

/**
 * Get all experience (professional + internship)
 */
function getAllExperience() {
    return array_merge(getProfessionalExperience(), getInternshipExperience());
}

/**
 * Get projects from database
 */
function getProjects() {
    global $pdo;
    return $pdo->query("SELECT * FROM projects ORDER BY start_date DESC")->fetchAll();
}

/**
 * Get certifications from database
 */
function getCertifications() {
    global $pdo;
    return $pdo->query("SELECT * FROM certifications ORDER BY id DESC")->fetchAll();
}

// Note: createAboutTable() function is defined in admin.php to avoid conflicts

/**
 * Get about details from database
 */
function getAboutDetails() {
    return safeFetch("SELECT * FROM about LIMIT 1");
}

/**
 * Get other details from database
 */
function getOtherDetails() {
    return safeFetch("SELECT * FROM others LIMIT 1");
}

/**
 * Get skills data from database
 */
function getSkills() {
    global $pdo;
    try {
        return $pdo->query("SELECT * FROM skills ORDER BY category, name")->fetchAll();
    } catch (Exception $e) {
        // Fallback to default skills if table doesn't exist
        return [
            ['name' => 'HTML', 'category' => 'frontend', 'proficiency' => 95, 'image' => 'assets/img/skills/HTML.png'],
            ['name' => 'CSS', 'category' => 'frontend', 'proficiency' => 90, 'image' => 'assets/img/skills/CSS.svg'],
            ['name' => 'JavaScript', 'category' => 'frontend', 'proficiency' => 85, 'image' => 'assets/img/skills/js.webp'],
            ['name' => 'PHP', 'category' => 'backend', 'proficiency' => 80, 'image' => 'assets/img/skills/php.png'],
            ['name' => 'MySQL', 'category' => 'databases', 'proficiency' => 85, 'image' => 'assets/img/skills/sql.jpg'],
            ['name' => 'Python', 'category' => 'languages', 'proficiency' => 70, 'image' => 'assets/img/skills/python.jpg']
        ];
    }
}

/**
 * Get skills by category
 */
function getSkillsByCategory($category) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM skills WHERE category = ? ORDER BY name");
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Sanitize output for HTML display
 */
function sanitize($data) {
    return htmlentities($data ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Get profile image path with fallback
 */
function getProfileImage($basic_details) {
    if (!empty($basic_details['profile_photo'])) {
        return sanitize($basic_details['profile_photo']);
    }
    return DEFAULT_PROFILE_IMAGE;
}

/**
 * Get project image path with fallback
 */
function getProjectImage($project) {
    if (!empty($project['image'])) {
        return sanitize($project['image']);
    }
    return ASSETS_PATH . 'img/portfolio/default-project.jpg';
}

/**
 * Get certificate image path with fallback
 */
function getCertificateImage($certificate) {
    if (!empty($certificate['certificate'])) {
        return sanitize($certificate['certificate']);
    }
    return ASSETS_PATH . 'img/certificates/default-certificate.jpg';
}

/**
 * Format date range for display
 */
function formatDateRange($start_date, $end_date) {
    return sanitize($start_date) . ' - ' . sanitize($end_date);
}

/**
 * Generate meta description
 */
function getMetaDescription($others) {
    return sanitize($others['summary'] ?? 'Passionate developer with expertise in modern web technologies.');
}

/**
 * Generate meta keywords
 */
function getMetaKeywords($others) {
    return sanitize($others['key_expertise'] ?? 'developer,designer,freelancer,portfolio');
}

/**
 * Get awards from database
 */
function getAwards() {
    global $pdo;
    try {
        return $pdo->query("SELECT * FROM awards ORDER BY date DESC")->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Get gallery items from database
 */
function getGallery() {
    global $pdo;
    try {
        return $pdo->query("SELECT * FROM gallery ORDER BY date DESC")->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Get services from database
 */
function getServices() {
    global $pdo;
    try {
        return $pdo->query("SELECT * FROM services")->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Get blogs from database
 */
function getBlogs() {
    global $pdo;
    try {
        return $pdo->query("SELECT * FROM blogs ORDER BY date DESC")->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

?>
