<?php
/**
 * Database Repair Script
 * This script will fix missing columns and ensure all tables have the correct structure
 */

require_once 'includes/config.php';

echo "<!DOCTYPE html><html><head><title>Database Repair</title></head><body>";
echo "<h1>Database Repair Script</h1>";

try {
    // Test database connection
    $pdo->query("SELECT 1");
    echo "<p>✓ Database connection successful</p>";
    
    // Fix basic_details table
    echo "<h2>Fixing basic_details table</h2>";
    
    // First, check if table exists
    try {
        $pdo->query("SELECT 1 FROM basic_details LIMIT 1");
        echo "<p>✓ basic_details table exists</p>";
    } catch (Exception $e) {
        // Create the table if it doesn't exist
        $sql = "CREATE TABLE basic_details (
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
        echo "<p>✓ Created basic_details table</p>";
    }
    
    // Check and add missing columns
    $required_columns = [
        'name' => 'VARCHAR(100) NOT NULL',
        'course' => 'VARCHAR(100) DEFAULT NULL',
        'gender' => 'VARCHAR(20) DEFAULT NULL',
        'birth_date' => 'DATE DEFAULT NULL',
        'languages' => 'VARCHAR(255) DEFAULT NULL',
        'profile_photo' => 'VARCHAR(255) DEFAULT NULL',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ];
    
    foreach ($required_columns as $column => $definition) {
        try {
            $stmt = $pdo->query("SHOW COLUMNS FROM basic_details LIKE '$column'");
            if ($stmt->rowCount() == 0) {
                $pdo->exec("ALTER TABLE basic_details ADD COLUMN $column $definition");
                echo "<p>✓ Added column '$column' to basic_details</p>";
            } else {
                echo "<p>✓ Column '$column' already exists</p>";
            }
        } catch (Exception $e) {
            echo "<p>⚠ Error with column '$column': " . $e->getMessage() . "</p>";
        }
    }
    
    // Fix contacts table
    echo "<h2>Fixing contacts table</h2>";
    
    try {
        $pdo->query("SELECT 1 FROM contacts LIMIT 1");
        echo "<p>✓ contacts table exists</p>";
    } catch (Exception $e) {
        $sql = "CREATE TABLE contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            phone VARCHAR(20) DEFAULT NULL,
            email VARCHAR(100) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            social_links TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "<p>✓ Created contacts table</p>";
    }
    
    // Fix about table
    echo "<h2>Fixing about table</h2>";
    
    try {
        $pdo->query("SELECT 1 FROM about LIMIT 1");
        echo "<p>✓ about table exists</p>";
    } catch (Exception $e) {
        $sql = "CREATE TABLE about (
            id INT AUTO_INCREMENT PRIMARY KEY,
            about_text TEXT NOT NULL,
            cv_file VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "<p>✓ Created about table</p>";
    }
    
    // Fix others table
    echo "<h2>Fixing others table</h2>";
    
    try {
        $pdo->query("SELECT 1 FROM others LIMIT 1");
        echo "<p>✓ others table exists</p>";
    } catch (Exception $e) {
        $sql = "CREATE TABLE others (
            id INT AUTO_INCREMENT PRIMARY KEY,
            summary TEXT DEFAULT NULL,
            key_expertise TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "<p>✓ Created others table</p>";
    }
    
    // Fix messages table
    echo "<h2>Fixing messages table</h2>";
    
    try {
        $pdo->query("SELECT 1 FROM messages LIMIT 1");
        echo "<p>✓ messages table exists</p>";
    } catch (Exception $e) {
        $sql = "CREATE TABLE messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "<p>✓ Created messages table</p>";
    }
    
    // Test inserting data into basic_details
    echo "<h2>Testing Data Insert</h2>";
    
    try {
        // Try to insert test data
        $stmt = $pdo->prepare("INSERT INTO basic_details (name, course, gender, birth_date, languages) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['Test Name', 'Test Course', 'Male', '1990-01-01', 'English']);
        echo "<p>✓ Test insert successful</p>";
        
        // Remove test data
        $pdo->exec("DELETE FROM basic_details WHERE name = 'Test Name'");
        echo "<p>✓ Test data cleaned up</p>";
        
    } catch (Exception $e) {
        echo "<p>✗ Insert test failed: " . $e->getMessage() . "</p>";
    }
    
    echo "<h2>Database Repair Complete!</h2>";
    echo "<p>All tables should now have the correct structure.</p>";
    echo "<p><a href='admin.php'>Try Admin Panel</a></p>";
    echo "<p><a href='admin-simple.php'>Try Simple Admin</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database repair failed: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration.</p>";
}

echo "</body></html>";
?>
