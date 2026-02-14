<?php
/**
 * Configuration file for Portfolio Website
 * Contains database connection and common settings
 */

// Error reporting configuration
// Set to 0 for production, 1 for development
$is_development = true; // Set to true for local development (XAMPP)

if ($is_development) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
    ini_set('log_errors', 1);
    ini_set('error_log', 'error.log');
}

// Database configuration
// Local Connection (XAMPP)
if ($is_development) {
    $host = 'localhost';
    $db   = 'protfolio'; // Using the name from the SQL file/existing config
    $user = 'root';
    $pass = '2550';
} else {
    // Production Connection (InfinityFree)
    $host = 'sql100.infinityfree.com';
    $db   = 'if0_39432401_protfolio';
    $user = 'if0_39432401';
    $pass = 'gGgd1nzsa9';
}

$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Test the connection
    $pdo->query("SELECT 1");

} catch (\PDOException $e) {
    // Log the error for debugging
    $error_msg = 'Database connection failed: ' . $e->getMessage();
    error_log($error_msg);
    
    if ($is_development) {
        exit('DB Connection failed: ' . $e->getMessage() . '<br>Please ensure XAMPP MySQL is running and database "' . $db . '" exists.');
    } else {
        exit('Database connection error. Please check your configuration.');
    }
}

// Site configuration
if (!defined('SITE_NAME')) define('SITE_NAME', 'Portfolio Website');

// Auto-detect site URL
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host_url = $_SERVER['HTTP_HOST'] ?? 'localhost';
$site_url = $protocol . '://' . $host_url;
if (!defined('SITE_URL')) define('SITE_URL', $site_url);

if (!defined('ASSETS_PATH')) define('ASSETS_PATH', 'assets/');

// Default profile image
if (!defined('DEFAULT_PROFILE_IMAGE')) define('DEFAULT_PROFILE_IMAGE', 'assets/img/my-profile-img.jpg');

// Social media links
if (!defined('LINKEDIN_URL')) define('LINKEDIN_URL', 'https://www.linkedin.com/in/jagdale2050/');
if (!defined('GITHUB_URL')) define('GITHUB_URL', 'https://github.com/Daya2550');
if (!defined('INSTAGRAM_URL')) define('INSTAGRAM_URL', 'https://instagram.com/yourprofile');

?>
