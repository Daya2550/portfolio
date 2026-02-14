<?php
/**
 * Project Images Management Page
 * Dedicated page for managing project images
 */

require_once 'includes/config.php';

// Ensure projects table has image column
try {
    $stmt = $pdo->query("SHOW COLUMNS FROM projects LIKE 'image'");
    if ($stmt->rowCount() == 0) {
        $pdo->exec("ALTER TABLE projects ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER name");
        $message = "Image column added to projects table. ";
    }
} catch (Exception $e) {
    $message = "Database setup error: " . $e->getMessage() . " ";
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'upload' && isset($_FILES['project_image'])) {
        $projectId = (int)$_POST['project_id'];
        $uploadDir = 'uploads/projects/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $file = $_FILES['project_image'];
        $fileName = time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Update project with image path
            $stmt = $pdo->prepare("UPDATE projects SET image = ? WHERE id = ?");
            $stmt->execute([$targetPath, $projectId]);
            $message = "Image uploaded successfully!";
        } else {
            $message = "Error uploading image.";
        }
    }
}

// Get all projects
try {
    $projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
} catch (Exception $e) {
    $projects = [];
    $message .= "Error loading projects: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Images Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .project-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
        }
        .project-image {
            width: 100%;
            max-width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ddd;
        }
        .no-image {
            width: 100%;
            max-width: 300px;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            border-radius: 8px;
            border: 2px solid #ddd;
        }
        .upload-section {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Project Images Management</h1>
            <div>
                <a href="admin.php?section=projects" class="btn btn-secondary">Back to Projects Admin</a>
                <a href="index.php" class="btn btn-success">View Portfolio</a>
            </div>
        </div>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="row">
            <?php if (empty($projects)): ?>
                <div class="col-12">
                    <div class="alert alert-warning">
                        <h4>No Projects Found</h4>
                        <p>You need to add some projects first before you can upload images.</p>
                        <a href="admin.php?section=projects" class="btn btn-primary">Add Projects</a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="project-card">
                            <h3><?= htmlspecialchars($project['name']) ?></h3>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Current Image:</h5>
                                    <?php if (!empty($project['image'])): ?>
                                        <img src="<?= htmlspecialchars($project['image']) ?>" alt="Project Image" class="project-image">
                                        <p class="mt-2 text-muted small">
                                            <strong>File:</strong> <?= basename($project['image']) ?>
                                        </p>
                                    <?php else: ?>
                                        <div class="no-image">
                                            <i class="bi bi-image" style="font-size: 3rem;">📷</i>
                                        </div>
                                        <p class="mt-2 text-muted">No image uploaded</p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <h5>Project Details:</h5>
                                    <p><strong>Description:</strong> <?= htmlspecialchars(substr($project['description'] ?? '', 0, 100)) ?>...</p>
                                    <p><strong>Skills:</strong> <?= htmlspecialchars($project['skills'] ?? 'Not specified') ?></p>
                                    <p><strong>Duration:</strong> <?= htmlspecialchars($project['start_date'] ?? '') ?> to <?= htmlspecialchars($project['end_date'] ?? '') ?></p>
                                    
                                    <?php if (!empty($project['github_link']) || !empty($project['live_link'])): ?>
                                        <p><strong>Links:</strong></p>
                                        <div class="d-flex gap-2">
                                            <?php if (!empty($project['github_link'])): ?>
                                                <a href="<?= htmlspecialchars($project['github_link']) ?>" target="_blank" class="btn btn-sm btn-outline-dark">GitHub</a>
                                            <?php endif; ?>
                                            <?php if (!empty($project['live_link'])): ?>
                                                <a href="<?= htmlspecialchars($project['live_link']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Live Demo</a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="upload-section">
                                <h5>Upload/Update Image:</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="upload">
                                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                                    
                                    <div class="row align-items-end">
                                        <div class="col-md-8">
                                            <label for="project_image_<?= $project['id'] ?>" class="form-label">Choose Image:</label>
                                            <input type="file" name="project_image" id="project_image_<?= $project['id'] ?>" 
                                                   class="form-control" accept="image/*" required>
                                            <small class="form-text text-muted">Recommended: 800x600px or similar aspect ratio</small>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <?= !empty($project['image']) ? 'Update Image' : 'Upload Image' ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="mt-5 p-4 bg-light rounded">
            <h4>📋 Image Guidelines</h4>
            <div class="row">
                <div class="col-md-6">
                    <h5>✅ Recommended:</h5>
                    <ul>
                        <li><strong>Size:</strong> 800x600px or 1200x800px</li>
                        <li><strong>Format:</strong> JPG, PNG, WebP</li>
                        <li><strong>File Size:</strong> Under 2MB</li>
                        <li><strong>Content:</strong> Project screenshots, demos, or mockups</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>💡 Tips:</h5>
                    <ul>
                        <li>Use high-quality screenshots of your project</li>
                        <li>Show the main features or interface</li>
                        <li>Ensure good contrast and readability</li>
                        <li>Consider creating a collage for multiple features</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
