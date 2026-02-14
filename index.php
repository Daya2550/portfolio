<?php
/**
 * Portfolio Website - Main Index Page
 * Clean, modular structure with organized components
 */

// Include configuration and functions
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Fetch all data using functions
$basic = getBasicDetails();
$contact = getContactInfo();
$about = getAboutDetails();
$education = getEducation();
$professional = getProfessionalExperience();
$internship = getInternshipExperience();
$projects = getProjects();
$certifications = getCertifications();
$others = getOtherDetails();
$skills = getSkills();

// Include header
include 'includes/header.php';
?>


<!-- Hero Section -->
<?php include 'includes/components/hero-section.php'; ?>

<!-- About Section -->
<?php include 'includes/components/about-section.php'; ?>

<!-- Services Section -->
<?php include 'includes/components/services-section.php'; ?>

<!-- Skills Section -->
<?php include 'includes/components/skills-section.php'; ?>

<!-- Resume Section -->
<?php include 'includes/components/resume-section.php'; ?>

<!-- Certificates Section -->
<?php include 'includes/components/certificates-section.php'; ?>

<!-- Honors & Awards Section -->
<?php include 'includes/components/awards-section.php'; ?>

<!-- Gallery Section -->
<?php include 'includes/components/gallery-section.php'; ?>

<!-- Blog Section -->
<?php include 'includes/components/blog-section.php'; ?>

<!-- Project Section -->
<?php include 'includes/components/portfolio-section.php'; ?>

<!-- Internship Section -->
<?php include 'includes/components/experience-section.php'; ?>

<!-- Contact Section -->
<?php include 'includes/components/contact-section.php'; ?>

<?php
// Include footer
include 'includes/footer.php';
?>
```