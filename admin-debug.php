<?php
/**
 * Debug version of admin.php to help identify loading issues
 * Use this file to test what's working and what's not
 */

echo "<!DOCTYPE html><html><head><title>Admin Debug</title></head><body>";
echo "<h1>Admin Debug Page</h1>";

// Step 1: Test basic PHP functionality
echo "<h2>Step 1: PHP Basic Test</h2>";
echo "<p>✓ PHP is working</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// Step 2: Test file includes
echo "<h2>Step 2: File Include Test</h2>";
try {
    if (file_exists('includes/config.php')) {
        echo "<p>✓ config.php file exists</p>";
        require_once 'includes/config.php';
        echo "<p>✓ config.php loaded successfully</p>";
    } else {
        echo "<p>✗ config.php file not found</p>";
    }
} catch (Exception $e) {
    echo "<p>✗ Error loading config.php: " . $e->getMessage() . "</p>";
}

try {
    if (file_exists('includes/functions.php')) {
        echo "<p>✓ functions.php file exists</p>";
        require_once 'includes/functions.php';
        echo "<p>✓ functions.php loaded successfully</p>";
    } else {
        echo "<p>✗ functions.php file not found</p>";
    }
} catch (Exception $e) {
    echo "<p>✗ Error loading functions.php: " . $e->getMessage() . "</p>";
}

// Step 3: Test database connection
echo "<h2>Step 3: Database Connection Test</h2>";
if (isset($pdo)) {
    echo "<p>✓ Database connection object exists</p>";
    try {
        $stmt = $pdo->query("SELECT 1 as test");
        $result = $stmt->fetch();
        if ($result['test'] == 1) {
            echo "<p>✓ Database connection is working</p>";
        }
    } catch (Exception $e) {
        echo "<p>✗ Database query failed: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>✗ Database connection object not found</p>";
}

// Step 4: Test database tables
echo "<h2>Step 4: Database Tables Test</h2>";
if (isset($pdo)) {
    $tables = ['basic_details', 'contacts', 'about', 'education', 'experience', 'projects', 'certifications', 'skills', 'others'];
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("DESCRIBE $table");
            echo "<p>✓ Table '$table' exists</p>";
        } catch (Exception $e) {
            echo "<p>⚠ Table '$table' does not exist or has issues: " . $e->getMessage() . "</p>";
        }
    }
}

// Step 5: Test session functionality
echo "<h2>Step 5: Session Test</h2>";
try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    echo "<p>✓ Session started successfully</p>";
    echo "<p>Session ID: " . session_id() . "</p>";
} catch (Exception $e) {
    echo "<p>✗ Session error: " . $e->getMessage() . "</p>";
}

// Step 6: Test file permissions
echo "<h2>Step 6: File Permissions Test</h2>";
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    if (mkdir($upload_dir, 0755, true)) {
        echo "<p>✓ Created uploads directory</p>";
    } else {
        echo "<p>✗ Failed to create uploads directory</p>";
    }
} else {
    echo "<p>✓ Uploads directory exists</p>";
}

if (is_writable($upload_dir)) {
    echo "<p>✓ Uploads directory is writable</p>";
} else {
    echo "<p>✗ Uploads directory is not writable</p>";
}

// Step 7: Test basic functions
echo "<h2>Step 7: Functions Test</h2>";
if (function_exists('getBasicDetails')) {
    echo "<p>✓ getBasicDetails function exists</p>";
    try {
        $basic = getBasicDetails();
        echo "<p>✓ getBasicDetails executed successfully</p>";
    } catch (Exception $e) {
        echo "<p>✗ getBasicDetails error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>✗ getBasicDetails function not found</p>";
}

// Step 8: Test server environment
echo "<h2>Step 8: Server Environment</h2>";
echo "<p>Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";
echo "<p>Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "</p>";
echo "<p>Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'Unknown') . "</p>";
echo "<p>Current Working Directory: " . getcwd() . "</p>";

// Step 9: Test error log
echo "<h2>Step 9: Error Log Test</h2>";
if (ini_get('log_errors')) {
    echo "<p>✓ Error logging is enabled</p>";
    echo "<p>Error log location: " . ini_get('error_log') . "</p>";
} else {
    echo "<p>⚠ Error logging is disabled</p>";
}

echo "<h2>Debug Complete</h2>";
echo "<p>If you see this message, the debug script ran successfully.</p>";
echo "<p><a href='admin.php'>Try loading admin.php now</a></p>";

echo "</body></html>";
?>
