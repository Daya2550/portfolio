<?php
require 'db.php'; // make sure this connects correctly using $pdo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $subject && $message) {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);

            // ✅ Redirect back to index.php with anchor to #contact
            header("Location: index.php#contact");
            exit;

        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
