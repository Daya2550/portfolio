<?php
/**
 * Database Setup Script for Awards and Gallery Sections
 */

require_once 'includes/config.php';

echo "<h2>Setting up New Sections: Awards & Gallery</h2>\n";

try {
    // 1. Create Awards Table
    $sql_awards = "CREATE TABLE IF NOT EXISTS awards (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        provider VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        date DATE DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_awards);
    echo "<p style='color: green;'>✅ Awards table created successfully!</p>\n";

    // 2. Insert Sample Awards
    $stmt = $pdo->query("SELECT COUNT(*) FROM awards");
    if ($stmt->fetchColumn() == 0) {
        $sample_awards = [
            ['Best Developer 2024', 'Tech Solutions Inc.', 'Awarded for exceptional contribution to the flagship project.', '2024-12-15'],
            ['Hackathon Winner', 'Global Tech Summit', 'First place in the AI Innovation category.', '2023-08-20']
        ];
        $stmt = $pdo->prepare("INSERT INTO awards (title, provider, description, date) VALUES (?, ?, ?, ?)");
        foreach ($sample_awards as $award) {
            $stmt->execute($award);
        }
        echo "<p>✅ Added sample data to Awards.</p>\n";
    }

    // 3. Create Gallery Table
    $sql_gallery = "CREATE TABLE IF NOT EXISTS gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image VARCHAR(255) NOT NULL,
        title VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        date DATE DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_gallery);
    echo "<p style='color: green;'>✅ Gallery table created successfully!</p>\n";

    // 4. Insert Sample Gallery Items
    $stmt = $pdo->query("SELECT COUNT(*) FROM gallery");
    if ($stmt->fetchColumn() == 0) {
        $sample_gallery = [
            ['assets/img/portfolio/app-1.jpg', 'Conference Talk', 'Speaking at the annual developers conference about modern web standards.', '2024-05-10'],
            ['assets/img/portfolio/product-1.jpg', 'Team Outing', 'Hiking trip with the engineering team.', '2024-06-15']
        ];
        $stmt = $pdo->prepare("INSERT INTO gallery (image, title, description, date) VALUES (?, ?, ?, ?)");
        foreach ($sample_gallery as $item) {
            $stmt->execute($item);
        }
        echo "<p>✅ Added sample data to Gallery.</p>\n";
    }

    echo "<h3 style='color: green;'>All tables set up successfully!</h3>\n";
    echo "<p><a href='index.php'>Go to Home</a> | <a href='admin.php'>Go to Admin</a></p>";

} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>\n";
}
?>
