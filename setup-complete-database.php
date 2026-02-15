<?php
/**
 * Complete Database Setup Script
 * Creates all tables and inserts sample data for the portfolio
 */

// Database configuration
$host = 'sql100.infinityfree.com';
$dbname = 'if0_39432401_protfolio';
$username = 'if0_39432401';
$password = 'gGgd1nzsa9';

echo "<h1>🚀 Complete Portfolio Database Setup</h1>\n";
echo "<p>Setting up your complete portfolio database with all tables and sample data...</p>\n";

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>✅ Database Connection Successful</h2>\n";
    
    // Array of table creation queries
    $tables = [
        'basic_details' => "CREATE TABLE IF NOT EXISTS basic_details (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            designation VARCHAR(255),
            photo VARCHAR(255),
            birth_date DATE,
            age INT,
            degree VARCHAR(255),
            city VARCHAR(255),
            state VARCHAR(255),
            country VARCHAR(255),
            freelance BOOLEAN DEFAULT 0,
            resume VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'contacts' => "CREATE TABLE IF NOT EXISTS contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255),
            phone VARCHAR(20),
            address TEXT,
            linkedin VARCHAR(255),
            github VARCHAR(255),
            twitter VARCHAR(255),
            instagram VARCHAR(255),
            facebook VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'about' => "CREATE TABLE IF NOT EXISTS about (
            id INT AUTO_INCREMENT PRIMARY KEY,
            about_text TEXT NOT NULL,
            cv_file VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'education' => "CREATE TABLE IF NOT EXISTS education (
            id INT AUTO_INCREMENT PRIMARY KEY,
            degree VARCHAR(255) NOT NULL,
            stream VARCHAR(255),
            college VARCHAR(255),
            start_date DATE,
            end_date DATE,
            cgpa VARCHAR(10),
            graduation_type VARCHAR(50),
            description TEXT,
            marksheet VARCHAR(255),
            certificate VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'experience' => "CREATE TABLE IF NOT EXISTS experience (
            id INT AUTO_INCREMENT PRIMARY KEY,
            type ENUM('professional', 'internship') NOT NULL,
            designation VARCHAR(255) NOT NULL,
            organization VARCHAR(255) NOT NULL,
            city VARCHAR(255),
            state VARCHAR(255),
            start_date DATE,
            end_date DATE,
            ctc VARCHAR(100),
            industry VARCHAR(255),
            skills TEXT,
            description TEXT,
            certificate VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'projects' => "CREATE TABLE IF NOT EXISTS projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            description TEXT,
            skills TEXT,
            start_date DATE,
            end_date DATE,
            github_link VARCHAR(255),
            live_link VARCHAR(255),
            mentor VARCHAR(255),
            team_size INT DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'certifications' => "CREATE TABLE IF NOT EXISTS certifications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            provider VARCHAR(255),
            enrollment_no VARCHAR(100),
            marks VARCHAR(50),
            skills TEXT,
            certificate VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'skills' => "CREATE TABLE IF NOT EXISTS skills (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            category VARCHAR(50) NOT NULL DEFAULT 'frontend',
            image VARCHAR(255) DEFAULT NULL,
            proficiency INT DEFAULT 80,
            description TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'others' => "CREATE TABLE IF NOT EXISTS others (
            id INT AUTO_INCREMENT PRIMARY KEY,
            summary TEXT,
            key_expertise TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        
        'messages' => "CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    ];
    
    // Create all tables
    echo "<h2>📋 Creating Database Tables</h2>\n";
    foreach ($tables as $tableName => $sql) {
        $pdo->exec($sql);
        echo "<p>✅ Table '$tableName' created successfully</p>\n";
    }
    
    // Insert sample data
    echo "<h2>📝 Inserting Sample Data</h2>\n";
    
    // Basic Details
    $stmt = $pdo->prepare("INSERT IGNORE INTO basic_details (name, designation, birth_date, age, degree, city, state, country, freelance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['Your Name', 'Full Stack Developer', '1995-01-01', 29, 'Bachelor of Technology', 'Your City', 'Your State', 'India', 1]);
    echo "<p>✅ Basic details sample data inserted</p>\n";
    
    // Contact Information
    $stmt = $pdo->prepare("INSERT IGNORE INTO contacts (email, phone, address, linkedin, github) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(['your.email@example.com', '+91 9876543210', 'Your Address, City, State', 'https://linkedin.com/in/yourprofile', 'https://github.com/yourusername']);
    echo "<p>✅ Contact information sample data inserted</p>\n";
    
    // About Section
    $stmt = $pdo->prepare("INSERT IGNORE INTO about (about_text) VALUES (?)");
    $stmt->execute(['Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions. I specialize in full-stack development with a focus on creating user-friendly applications that solve real-world problems.']);
    echo "<p>✅ About section sample data inserted</p>\n";
    
    // Education
    $stmt = $pdo->prepare("INSERT IGNORE INTO education (degree, stream, college, start_date, end_date, cgpa, graduation_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['Bachelor of Technology', 'Computer Science', 'Your College Name', '2020-07-01', '2024-06-30', '8.50', 'Regular']);
    echo "<p>✅ Education sample data inserted</p>\n";
    
    // Skills
    $skills_data = [
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
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO skills (name, category, image, proficiency, description) VALUES (?, ?, ?, ?, ?)");
    foreach ($skills_data as $skill) {
        $stmt->execute($skill);
    }
    echo "<p>✅ Skills sample data inserted (" . count($skills_data) . " skills)</p>\n";
    
    // Projects
    $projects_data = [
        ['Personal Portfolio Website', 'A responsive personal portfolio website built with PHP, MySQL, and modern CSS. Features include dynamic content management, contact forms, and project showcases.', 'HTML, CSS, JavaScript, PHP, MySQL, Bootstrap', '2024-01-01', '2024-02-15', 'https://github.com/username/portfolio', 'https://yourportfolio.com', 1],
        ['E-commerce Platform', 'Full-stack e-commerce solution with user authentication, product catalog, shopping cart, and payment integration using Stripe API.', 'React, Node.js, Express, MongoDB, Stripe API', '2024-02-01', '2024-04-30', 'https://github.com/username/ecommerce', 'https://yourecommerce.com', 3]
    ];
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO projects (name, description, skills, start_date, end_date, github_link, live_link, team_size) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($projects_data as $project) {
        $stmt->execute($project);
    }
    echo "<p>✅ Projects sample data inserted (" . count($projects_data) . " projects)</p>\n";
    
    // Certifications
    $cert_data = [
        ['Web Development Certification', 'Online Learning Platform', 'WD2024001', '95%', 'HTML, CSS, JavaScript, PHP'],
        ['Full Stack Development', 'Tech Institute', 'FS2024002', '88%', 'React, Node.js, MongoDB, Express']
    ];
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO certifications (name, provider, enrollment_no, marks, skills) VALUES (?, ?, ?, ?, ?)");
    foreach ($cert_data as $cert) {
        $stmt->execute($cert);
    }
    echo "<p>✅ Certifications sample data inserted (" . count($cert_data) . " certifications)</p>\n";
    
    // Others
    $stmt = $pdo->prepare("INSERT IGNORE INTO others (summary, key_expertise) VALUES (?, ?)");
    $stmt->execute(['Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions.', 'Web Development, Frontend Development, Backend Development, Database Design']);
    echo "<p>✅ Others section sample data inserted</p>\n";
    
    // Create upload directories
    echo "<h2>📁 Creating Upload Directories</h2>\n";
    $directories = ['uploads/', 'uploads/cv/', 'uploads/projects/', 'uploads/skills/', 'uploads/certificates/'];
    
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            if (mkdir($dir, 0755, true)) {
                echo "<p>✅ Created directory: $dir</p>\n";
            } else {
                echo "<p style='color: red;'>❌ Failed to create: $dir</p>\n";
            }
        } else {
            echo "<p>✅ Directory exists: $dir</p>\n";
        }
    }
    
    echo "<h2 style='color: green;'>🎉 Database Setup Completed Successfully!</h2>\n";
    
    echo "<div style='background: #d4edda; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #c3e6cb;'>";
    echo "<h3 style='color: #155724;'>✅ What's Ready:</h3>";
    echo "<ul style='color: #155724;'>";
    echo "<li>All 9 database tables created</li>";
    echo "<li>Sample data inserted for all sections</li>";
    echo "<li>Upload directories created</li>";
    echo "<li>Admin panel ready to use</li>";
    echo "<li>Portfolio ready to display</li>";
    echo "</ul>";
    echo "</div>";
    
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #dee2e6;'>";
    echo "<h3>🚀 Next Steps:</h3>";
    echo "<ul>";
    echo "<li>🔗 <a href='admin.php'>Access Admin Panel</a> - Manage your portfolio content</li>";
    echo "<li>🔗 <a href='index.php'>View Portfolio</a> - See your portfolio in action</li>";
    echo "<li>🔗 <a href='project-images.php'>Manage Project Images</a> - Upload project screenshots</li>";
    echo "</ul>";
    echo "</div>";
    
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Database Error</h2>\n";
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>\n";
    echo "<p>Please check your database configuration and try again.</p>\n";
}
?>
