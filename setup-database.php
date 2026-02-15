<?php
/**
 * Database Setup Script
 * Run this script to create all required tables for the portfolio
 */

require_once 'includes/config.php';

echo "<!DOCTYPE html><html><head><title>Database Setup</title></head><body>";
echo "<h1>Portfolio Database Setup</h1>";

try {
    // Test database connection
    $pdo->query("SELECT 1");
    echo "<p>✓ Database connection successful</p>";
    
    // Create basic_details table
    $sql = "CREATE TABLE IF NOT EXISTS basic_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        course VARCHAR(100) DEFAULT NULL,
        gender VARCHAR(20) DEFAULT NULL,
        birth_date DATE DEFAULT NULL,
        languages VARCHAR(255) DEFAULT NULL,
        profile_photo VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ basic_details table created/verified</p>";

    // Check and add missing columns to basic_details table
    $columns_to_check = [
        'course' => 'VARCHAR(100) DEFAULT NULL',
        'gender' => 'VARCHAR(20) DEFAULT NULL',
        'birth_date' => 'DATE DEFAULT NULL',
        'languages' => 'VARCHAR(255) DEFAULT NULL',
        'profile_photo' => 'VARCHAR(255) DEFAULT NULL'
    ];

    foreach ($columns_to_check as $column => $definition) {
        try {
            $stmt = $pdo->query("SHOW COLUMNS FROM basic_details LIKE '$column'");
            if ($stmt->rowCount() == 0) {
                $pdo->exec("ALTER TABLE basic_details ADD COLUMN $column $definition");
                echo "<p>✓ Added missing column '$column' to basic_details table</p>";
            }
        } catch (Exception $e) {
            echo "<p>⚠ Could not add column '$column': " . $e->getMessage() . "</p>";
        }
    }
    
    // Create contacts table
    $sql = "CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        phone VARCHAR(20) DEFAULT NULL,
        email VARCHAR(100) DEFAULT NULL,
        address TEXT DEFAULT NULL,
        social_links TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ contacts table created/verified</p>";
    
    // Create about table
    $sql = "CREATE TABLE IF NOT EXISTS about (
        id INT AUTO_INCREMENT PRIMARY KEY,
        about_text TEXT NOT NULL,
        cv_file VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ about table created/verified</p>";
    
    // Create others table
    $sql = "CREATE TABLE IF NOT EXISTS others (
        id INT AUTO_INCREMENT PRIMARY KEY,
        summary TEXT DEFAULT NULL,
        key_expertise TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ others table created/verified</p>";
    
    // Create education table
    $sql = "CREATE TABLE IF NOT EXISTS education (
        id INT AUTO_INCREMENT PRIMARY KEY,
        institution VARCHAR(255) NOT NULL,
        degree VARCHAR(255) NOT NULL,
        field VARCHAR(255) DEFAULT NULL,
        start_date DATE DEFAULT NULL,
        end_date DATE DEFAULT NULL,
        grade VARCHAR(50) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ education table created/verified</p>";
    
    // Create experience table
    $sql = "CREATE TABLE IF NOT EXISTS experience (
        id INT AUTO_INCREMENT PRIMARY KEY,
        type ENUM('professional', 'internship') NOT NULL,
        company VARCHAR(255) NOT NULL,
        position VARCHAR(255) NOT NULL,
        location VARCHAR(255) DEFAULT NULL,
        start_date DATE DEFAULT NULL,
        end_date DATE DEFAULT NULL,
        description TEXT DEFAULT NULL,
        skills VARCHAR(500) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ experience table created/verified</p>";
    
    // Create projects table
    $sql = "CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        skills VARCHAR(500) DEFAULT NULL,
        start_date DATE DEFAULT NULL,
        end_date DATE DEFAULT NULL,
        github_link VARCHAR(500) DEFAULT NULL,
        live_link VARCHAR(500) DEFAULT NULL,
        team_size INT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ projects table created/verified</p>";
    
    // Create certifications table
    $sql = "CREATE TABLE IF NOT EXISTS certifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        issuer VARCHAR(255) NOT NULL,
        issue_date DATE DEFAULT NULL,
        expiry_date DATE DEFAULT NULL,
        certificate VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ certifications table created/verified</p>";
    
    // Create messages table
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ messages table created/verified</p>";
    
    // Create skills table
    $sql = "CREATE TABLE IF NOT EXISTS skills (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        category VARCHAR(50) NOT NULL DEFAULT 'frontend',
        image VARCHAR(255) DEFAULT NULL,
        proficiency INT DEFAULT 80,
        description TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✓ skills table created/verified</p>";
    
    echo "<h2>Database Setup Complete!</h2>";
    echo "<p>All tables have been created successfully.</p>";
    echo "<p><a href='admin.php'>Go to Admin Panel</a></p>";
    echo "<p><a href='admin-debug.php'>Run Debug Test</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database setup failed: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration in includes/config.php</p>";
}

echo "</body></html>";
?>
