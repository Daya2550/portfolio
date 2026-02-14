<?php
/**
 * Database Setup Script for Soft Skills
 * Populates the skills table with default soft skills
 */

require_once 'includes/config.php';

echo "<h2>Setting up Soft Skills</h2>\n";

try {
    // Check if soft skills already exist
    $stmt = $pdo->query("SELECT COUNT(*) FROM skills WHERE category = 'soft'");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        echo "<p>Adding default soft skills...</p>\n";
        
        $soft_skills = [
            ['Communication', 'soft', null, 90, 'Effective verbal and written communication'],
            ['Critical Thinking', 'soft', null, 85, 'Ability to analyze and evaluate issues'],
            ['Leadership', 'soft', null, 80, 'Guiding and motivating teams'],
            ['Logical Thinking', 'soft', null, 85, 'Reasoning and problem-solving'],
            ['Team Collaboration', 'soft', null, 90, 'Working effectively with others'],
            ['Adaptability', 'soft', null, 85, 'Adjusting to new conditions'],
            ['Time Management', 'soft', null, 80, 'Prioritizing and managing time efficiently']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO skills (name, category, image, proficiency, description) VALUES (?, ?, ?, ?, ?)");
        
        $inserted = 0;
        foreach ($soft_skills as $skill) {
            $stmt->execute($skill);
            $inserted++;
            echo "<li>Inserted: " . $skill[0] . "</li>\n";
        }
        
        echo "<p style='color: green;'>✅ Successfully added $inserted soft skills!</p>\n";
    } else {
        echo "<p style='color: blue;'>ℹ️ Soft skills already exist in the database ($count records). No changes made.</p>\n";
    }
    
    echo "<h3>Verification</h3>\n";
    $stmt = $pdo->query("SELECT name, proficiency FROM skills WHERE category = 'soft'");
    $skills = $stmt->fetchAll();
    
    echo "<ul>";
    foreach ($skills as $skill) {
        echo "<li>" . htmlspecialchars($skill['name']) . " (" . $skill['proficiency'] . "%)</li>";
    }
    echo "</ul>";
    
    echo "<p><a href='admin.php?section=skills'>Go to Admin Panel (Skills)</a></p>\n";
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>\n";
}
?>
