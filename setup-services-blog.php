<?php
/**
 * Database Setup Script for Services and Blog Sections
 */

require_once 'includes/config.php';

echo "<h2>Setting up New Sections: Services & Blog</h2>\n";

try {
    // 1. Create Services Table
    $sql_services = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        icon VARCHAR(100) DEFAULT 'bi-laptop',
        description TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_services);
    echo "<p style='color: green;'>✅ Services table created successfully!</p>\n";

    // 2. Insert Sample Services
    $stmt = $pdo->query("SELECT COUNT(*) FROM services");
    if ($stmt->fetchColumn() == 0) {
        $sample_services = [
            ['Web Development', 'bi-window-fullscreen', 'Building responsive, high-performance websites using modern technologies like React, PHP, and Bootstrap.'],
            ['UI/UX Design', 'bi-palette', 'Creating intuitive and visually appealing user interfaces with a focus on user experience.'],
            ['API Integration', 'bi-cloud-check', 'Seamlessly integrating third-party APIs and services into web applications.'],
            ['Database Management', 'bi-database', 'Designing and optimizing database schemas for efficient data storage and retrieval.']
        ];
        $stmt = $pdo->prepare("INSERT INTO services (title, icon, description) VALUES (?, ?, ?)");
        foreach ($sample_services as $service) {
            $stmt->execute($service);
        }
        echo "<p>✅ Added sample data to Services.</p>\n";
    }

    // 3. Create Blogs Table
    $sql_blogs = "CREATE TABLE IF NOT EXISTS blogs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        summary TEXT DEFAULT NULL,
        image VARCHAR(255) DEFAULT NULL,
        link VARCHAR(255) DEFAULT '#',
        date DATE DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_blogs);
    echo "<p style='color: green;'>✅ Blogs table created successfully!</p>\n";

    // 4. Insert Sample Blogs
    $stmt = $pdo->query("SELECT COUNT(*) FROM blogs");
    if ($stmt->fetchColumn() == 0) {
        $sample_blogs = [
            ['Understanding MVC Architecture', 'A deep dive into the Model-View-Controller design pattern and how it structures modern web applications.', 'assets/img/blog-1.jpg', '#', '2024-03-15'],
            ['The Future of Web Development', 'Exploring upcoming trends in web development including WebAssembly, AI integration, and Serverless computing.', 'assets/img/blog-2.jpg', '#', '2024-04-10'],
            ['Optimizing SQL Queries', 'Best practices for writing efficient SQL queries to improve application performance and scalability.', 'assets/img/blog-3.jpg', '#', '2024-05-05']
        ];
        $stmt = $pdo->prepare("INSERT INTO blogs (title, summary, image, link, date) VALUES (?, ?, ?, ?, ?)");
        foreach ($sample_blogs as $blog) {
            $stmt->execute($blog);
        }
        echo "<p>✅ Added sample data to Blogs.</p>\n";
    }

    echo "<h3 style='color: green;'>All tables set up successfully!</h3>\n";
    echo "<p><a href='index.php'>Go to Home</a> | <a href='admin.php'>Go to Admin</a></p>";

} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>\n";
}
?>
