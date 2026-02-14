<?php
/**
 * Simple Portfolio Setup Script
 * Creates all required tables and fixes common issues
 */

require_once 'includes/config.php';

echo "<h1>🚀 Portfolio Setup</h1>\n";

try {
    // Create about table (fixes the function conflict error)
    echo "<h2>Creating About Table...</h2>\n";
    $sql = "CREATE TABLE IF NOT EXISTS about (
        id INT AUTO_INCREMENT PRIMARY KEY,
        about_text TEXT NOT NULL,
        cv_file VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p style='color: green;'>✅ About table created</p>\n";
    
    // Add default about content if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM about");
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $stmt = $pdo->prepare("INSERT INTO about (about_text) VALUES (?)");
        $stmt->execute(['Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions.']);
        echo "<p style='color: green;'>✅ Default about content added</p>\n";
    }
    
    // Create skills table
    echo "<h2>Creating Skills Table...</h2>\n";
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
    echo "<p style='color: green;'>✅ Skills table created</p>\n";
    
    // Add sample skills if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM skills");
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $skills = [
            ['HTML', 'frontend', 'assets/img/skills/HTML.png', 95, 'HyperText Markup Language'],
            ['CSS', 'frontend', 'assets/img/skills/CSS.svg', 90, 'Cascading Style Sheets'],
            ['JavaScript', 'frontend', 'assets/img/skills/js.webp', 85, 'JavaScript Programming Language'],
            ['PHP', 'backend', 'assets/img/skills/php.png', 85, 'Server-side Scripting Language'],
            ['MySQL', 'databases', 'assets/img/skills/sql.jpg', 85, 'Relational Database'],
            ['Git', 'tools', 'assets/img/skills/git.png', 85, 'Version Control System']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO skills (name, category, image, proficiency, description) VALUES (?, ?, ?, ?, ?)");
        foreach ($skills as $skill) {
            $stmt->execute($skill);
        }
        echo "<p style='color: green;'>✅ Sample skills added</p>\n";
    }
    
    // Add image column to projects table if missing
    echo "<h2>Updating Projects Table...</h2>\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM projects LIKE 'image'");
    if ($stmt->rowCount() == 0) {
        $pdo->exec("ALTER TABLE projects ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER name");
        echo "<p style='color: green;'>✅ Image column added to projects table</p>\n";
    } else {
        echo "<p style='color: blue;'>ℹ️ Projects table already has image column</p>\n";
    }
    
    // Create upload directories
    echo "<h2>Creating Upload Directories...</h2>\n";
    $dirs = ['uploads/', 'uploads/cv/', 'uploads/projects/', 'uploads/skills/'];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            echo "<p style='color: green;'>✅ Created: $dir</p>\n";
        } else {
            echo "<p style='color: blue;'>ℹ️ Exists: $dir</p>\n";
        }
    }
    
    echo "<h2 style='color: green;'>🎉 Setup Complete!</h2>\n";
    echo "<div style='background: #d4edda; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
    echo "<h3>✅ What's Ready:</h3>";
    echo "<ul>";
    echo "<li>About table created with default content</li>";
    echo "<li>Skills table created with sample data</li>";
    echo "<li>Projects table updated with image support</li>";
    echo "<li>Upload directories created</li>";
    echo "</ul>";
    echo "</div>";
    
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
    echo "<h3>🚀 Next Steps:</h3>";
    echo "<ul>";
    echo "<li><a href='admin.php?section=about'>Manage About Section</a></li>";
    echo "<li><a href='admin.php?section=skills'>Manage Skills</a></li>";
    echo "<li><a href='project-images.php'>Manage Project Images</a></li>";
    echo "<li><a href='index.php'>View Your Portfolio</a></li>";
    echo "</ul>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>❌ Error: " . $e->getMessage() . "</h2>\n";
}
?>
