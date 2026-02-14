<?php
/**
 * Database Setup Script for Skills Table
 */

require_once 'includes/config.php';

echo "<h2>Setting up Skills Table</h2>\n";

try {
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
    echo "<p style='color: green;'>✅ Skills table created successfully!</p>\n";
    
    // Check if table is empty and add sample data
    $stmt = $pdo->query("SELECT COUNT(*) FROM skills");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        echo "<p>Adding sample skills data...</p>\n";
        
        $sample_skills = [
            ['HTML', 'frontend', 'assets/img/skills/HTML.png', 95, 'HyperText Markup Language'],
            ['CSS', 'frontend', 'assets/img/skills/CSS.svg', 90, 'Cascading Style Sheets'],
            ['JavaScript', 'frontend', 'assets/img/skills/js.webp', 85, 'JavaScript Programming Language'],
            ['Bootstrap', 'frontend', 'assets/img/skills/bootstrap.png', 80, 'CSS Framework'],
            ['React', 'frontend', 'assets/img/skills/react.png', 75, 'JavaScript Library'],
            ['Node.js', 'backend', 'assets/img/skills/node.png', 80, 'JavaScript Runtime'],
            ['PHP', 'backend', 'assets/img/skills/php.png', 85, 'Server-side Scripting Language'],
            ['Python', 'backend', 'assets/img/skills/python.jpg', 75, 'Programming Language'],
            ['MySQL', 'databases', 'assets/img/skills/sql.jpg', 85, 'Relational Database'],
            ['MongoDB', 'databases', 'assets/img/skills/mongodb.webp', 70, 'NoSQL Database'],
            ['Java', 'languages', 'assets/img/skills/java.jpeg', 80, 'Programming Language'],
            ['C', 'languages', 'assets/img/skills/c.png', 75, 'Programming Language'],
            ['Git', 'tools', 'assets/img/skills/git.png', 85, 'Version Control System'],
            ['GitHub', 'tools', 'assets/img/skills/github.png', 85, 'Code Repository Platform'],
            ['VS Code', 'tools', 'assets/img/skills/vscode.jpeg', 90, 'Code Editor'],
            ['Eclipse', 'tools', 'assets/img/skills/eclipse.jpg', 75, 'Integrated Development Environment']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO skills (name, category, image, proficiency, description) VALUES (?, ?, ?, ?, ?)");
        
        foreach ($sample_skills as $skill) {
            $stmt->execute($skill);
        }
        
        echo "<p style='color: green;'>✅ Sample skills data added successfully!</p>\n";
    } else {
        echo "<p style='color: blue;'>ℹ️ Skills table already contains data ($count records)</p>\n";
    }
    
    // Add image column to projects table if it doesn't exist
    $stmt = $pdo->query("SHOW COLUMNS FROM projects LIKE 'image'");
    if ($stmt->rowCount() == 0) {
        $pdo->exec("ALTER TABLE projects ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER name");
        echo "<p style='color: green;'>✅ Added image column to projects table!</p>\n";
    } else {
        echo "<p style='color: blue;'>ℹ️ Projects table already has image column</p>\n";
    }
    
    echo "<h3 style='color: green;'>Database setup completed successfully!</h3>\n";
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>\n";
}

echo "<p><a href='admin.php'>Go to Admin Panel</a></p>\n";
echo "<p><a href='index.php'>Go to Portfolio</a></p>\n";
?>
