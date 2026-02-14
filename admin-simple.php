<?php
/**
 * Simplified Admin Panel for Testing
 * Use this if the main admin.php is not loading
 */

// Basic error handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Simple Admin Panel</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }";
echo ".container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }";
echo ".section { margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }";
echo ".form-group { margin-bottom: 15px; }";
echo "label { display: block; margin-bottom: 5px; font-weight: bold; }";
echo "input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }";
echo "button { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }";
echo "button:hover { background: #005a87; }";
echo ".alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }";
echo ".alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }";
echo ".alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }";
echo "</style>";
echo "</head>";
echo "<body>";

echo "<div class='container'>";
echo "<h1>Simple Admin Panel</h1>";

// Test database connection
try {
    require_once 'includes/config.php';
    echo "<div class='alert alert-success'>✓ Database connection successful</div>";
    
    // Test if we can query the database
    $stmt = $pdo->query("SELECT 1");
    echo "<div class='alert alert-success'>✓ Database query test successful</div>";
    
} catch (Exception $e) {
    echo "<div class='alert alert-error'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</div>";
    echo "<p>Please check your database configuration in includes/config.php</p>";
    echo "<p><a href='setup-database.php'>Run Database Setup</a></p>";
    echo "</div></body></html>";
    exit;
}

// Handle form submission
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $section = $_POST['section'] ?? '';
        
        if ($section === 'basic') {
            // Handle basic details
            $stmt = $pdo->prepare("DELETE FROM basic_details");
            $stmt->execute();
            
            $stmt = $pdo->prepare("INSERT INTO basic_details (name, course, gender, birth_date, languages) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['name'] ?? '',
                $_POST['course'] ?? '',
                $_POST['gender'] ?? '',
                $_POST['birth_date'] ?? null,
                $_POST['languages'] ?? ''
            ]);
            $message = "Basic information saved successfully!";
            
        } elseif ($section === 'contact') {
            // Handle contact details
            $stmt = $pdo->prepare("DELETE FROM contacts");
            $stmt->execute();
            
            $stmt = $pdo->prepare("INSERT INTO contacts (phone, email, address, social_links) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $_POST['phone'] ?? '',
                $_POST['email'] ?? '',
                $_POST['address'] ?? '',
                $_POST['social_links'] ?? ''
            ]);
            $message = "Contact information saved successfully!";
        }
        
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get current data
try {
    $stmt = $pdo->query("SELECT * FROM basic_details LIMIT 1");
    $basicData = $stmt->fetch() ?: [];
    
    $stmt = $pdo->query("SELECT * FROM contacts LIMIT 1");
    $contactData = $stmt->fetch() ?: [];
} catch (Exception $e) {
    $basicData = [];
    $contactData = [];
    $error = "Could not retrieve data: " . $e->getMessage();
}

// Display messages
if ($message) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($message) . "</div>";
}
if ($error) {
    echo "<div class='alert alert-error'>" . htmlspecialchars($error) . "</div>";
}

// Basic Information Form
echo "<div class='section'>";
echo "<h2>Basic Information</h2>";
echo "<form method='post'>";
echo "<input type='hidden' name='section' value='basic'>";
echo "<div class='form-group'>";
echo "<label for='name'>Full Name:</label>";
echo "<input type='text' id='name' name='name' value='" . htmlspecialchars($basicData['name'] ?? '') . "'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='course'>Course/Field:</label>";
echo "<input type='text' id='course' name='course' value='" . htmlspecialchars($basicData['course'] ?? '') . "'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='gender'>Gender:</label>";
echo "<select id='gender' name='gender'>";
echo "<option value=''>Select Gender</option>";
echo "<option value='Male'" . (($basicData['gender'] ?? '') === 'Male' ? ' selected' : '') . ">Male</option>";
echo "<option value='Female'" . (($basicData['gender'] ?? '') === 'Female' ? ' selected' : '') . ">Female</option>";
echo "<option value='Other'" . (($basicData['gender'] ?? '') === 'Other' ? ' selected' : '') . ">Other</option>";
echo "</select>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='birth_date'>Date of Birth:</label>";
echo "<input type='date' id='birth_date' name='birth_date' value='" . htmlspecialchars($basicData['birth_date'] ?? '') . "'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='languages'>Languages:</label>";
echo "<input type='text' id='languages' name='languages' value='" . htmlspecialchars($basicData['languages'] ?? '') . "' placeholder='e.g., English, Hindi, Spanish'>";
echo "</div>";
echo "<button type='submit'>Save Basic Information</button>";
echo "</form>";
echo "</div>";

// Contact Information Form
echo "<div class='section'>";
echo "<h2>Contact Information</h2>";
echo "<form method='post'>";
echo "<input type='hidden' name='section' value='contact'>";
echo "<div class='form-group'>";
echo "<label for='phone'>Phone Number:</label>";
echo "<input type='tel' id='phone' name='phone' value='" . htmlspecialchars($contactData['phone'] ?? '') . "'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='email'>Email Address:</label>";
echo "<input type='email' id='email' name='email' value='" . htmlspecialchars($contactData['email'] ?? '') . "'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='address'>Address:</label>";
echo "<textarea id='address' name='address' rows='3'>" . htmlspecialchars($contactData['address'] ?? '') . "</textarea>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='social_links'>Social Media Links:</label>";
echo "<input type='text' id='social_links' name='social_links' value='" . htmlspecialchars($contactData['social_links'] ?? '') . "' placeholder='LinkedIn, GitHub, Twitter (comma separated)'>";
echo "</div>";
echo "<button type='submit'>Save Contact Information</button>";
echo "</form>";
echo "</div>";

echo "<div class='section'>";
echo "<h2>Admin Tools</h2>";
echo "<p><a href='admin.php'>Try Full Admin Panel</a></p>";
echo "<p><a href='admin-debug.php'>Run Debug Test</a></p>";
echo "<p><a href='setup-database.php'>Setup Database</a></p>";
echo "<p><a href='index.php'>View Portfolio</a></p>";
echo "</div>";

echo "</div>";
echo "</body>";
echo "</html>";
?>
