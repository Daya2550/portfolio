<?php 
require 'includes/config.php';  

// Handle single message deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'delete_message' && !empty($_POST['message_id'])) {
        $messageId = (int) $_POST['message_id'];
        $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
        $stmt->execute([$messageId]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Handle delete all messages
    if ($action === 'delete_all') {
        $stmt = $pdo->prepare("DELETE FROM messages");
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch messages from database
$stmt = $pdo->query("SELECT * FROM messages ORDER BY sent_at DESC"); 
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --shadow: 0 10px 25px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-dark);
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin: 2rem auto;
            max-width: 1200px;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0.5rem 0 0 0;
            position: relative;
            z-index: 1;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: 1px solid rgba(102, 126, 234, 0.1);
            text-align: center;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .stats-label {
            color: var(--text-light);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
        }

        .table-container {
            padding: 2rem;
            background: white;
        }

        .custom-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none;
        }

        .custom-table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .custom-table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .custom-table tbody tr {
            border: none;
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(240, 147, 251, 0.05));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .custom-table tbody td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            color: var(--text-light);
        }

        .message-preview:hover {
            color: var(--primary-color);
        }

        .badge-id {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .email-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .email-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .date-badge {
            background: var(--bg-light);
            color: var(--text-light);
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .no-messages {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }

        .no-messages i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .subject-text {
            font-weight: 600;
            color: var(--text-dark);
        }

        .name-text {
            font-weight: 500;
            color: var(--text-dark);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: var(--shadow-hover);
        }

        .delete-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
        }

        .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
            background: linear-gradient(135deg, #ff5252, #d32f2f);
        }

        .delete-all-btn {
            background: linear-gradient(135deg, #ff4757, #c44569);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
            margin-bottom: 1rem;
        }

        .delete-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 71, 87, 0.4);
            background: linear-gradient(135deg, #ff3742, #b83253);
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1001;
        }

        .confirmation-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: var(--shadow-hover);
        }

        .confirmation-icon {
            font-size: 3rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }

        .confirmation-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .confirm-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-btn {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .confirm-btn:hover {
            background: linear-gradient(135deg, #ff5252, #d32f2f);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .custom-table { font-size: 0.9rem; }
            .message-preview { max-width: 150px; }
            .action-buttons { flex-direction: column; align-items: center; }
            .delete-all-btn { width: 100%; max-width: 300px; }
        }
    </style>
</head>
<body>
    <div class="main-container fade-in">
        <div class="header">
            <h1><i class="fas fa-envelope-open-text me-3"></i>Message Dashboard</h1>
            <p>Manage and view all your received messages</p>
        </div>

        <?php if (!empty($messages)): ?>
            <div class="stats-card">
                <div class="stats-number"><?= count($messages) ?></div>
                <div class="stats-label">Total Messages</div>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <?php if (empty($messages)): ?>
                <div class="no-messages">
                    <i class="fas fa-inbox"></i>
                    <h3>No Messages Yet</h3>
                    <p>Your message inbox is empty. Messages will appear here once received.</p>
                </div>
            <?php else: ?>
                <div class="action-buttons">
                    <button class="delete-all-btn" onclick="confirmDeleteAll()">
                        <i class="fas fa-trash-alt me-2"></i>Delete All Messages
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                <th><i class="fas fa-user me-2"></i>Name</th>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th><i class="fas fa-tag me-2"></i>Subject</th>
                                <th><i class="fas fa-comment me-2"></i>Message</th>
                                <th><i class="fas fa-clock me-2"></i>Date</th>
                                <th><i class="fas fa-cog me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $msg): ?>
                                <tr>
                                    <td>
                                        <span class="badge-id">#<?= $msg['id'] ?></span>
                                    </td>
                                    <td>
                                        <span class="name-text"><?= htmlentities($msg['name']) ?></span>
                                    </td>
                                    <td>
                                        <a href="mailto:<?= htmlentities($msg['email']) ?>" class="email-link">
                                            <?= htmlentities($msg['email']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="subject-text"><?= htmlentities($msg['subject']) ?></span>
                                    </td>
                                    <td>
                                        <div class="message-preview" onclick="showMessage('<?= addslashes(htmlentities($msg['message'])) ?>', '<?= addslashes(htmlentities($msg['subject'])) ?>')">
                                            <?= htmlentities(substr($msg['message'], 0, 50)) ?><?= strlen($msg['message']) > 50 ? '...' : '' ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="date-badge">
                                            <?= date('M d, Y', strtotime($msg['sent_at'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="delete-btn" onclick="confirmDelete(<?= $msg['id'] ?>)">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="message-modal" id="messageModal">
        <div class="modal-content">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="modal-title" id="modalTitle">Message Details</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div id="modalMessage"></div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="confirmation-modal" id="confirmationModal">
        <div class="confirmation-content">
            <i class="fas fa-exclamation-triangle confirmation-icon"></i>
            <h4 id="confirmationTitle">Confirm Deletion</h4>
            <p id="confirmationMessage">Are you sure you want to delete this message? This action cannot be undone.</p>
            <div class="confirmation-buttons">
                <button class="confirm-btn" onclick="performDelete()">Yes, Delete</button>
                <button class="cancel-btn" onclick="closeConfirmation()">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Hidden forms for deletion -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete_message">
        <input type="hidden" name="message_id" id="deleteMessageId">
    </form>

    <form id="deleteAllForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete_all">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deleteAction = null;
        let deleteId = null;

        function showMessage(message, subject) {
            document.getElementById('modalTitle').textContent = subject;
            document.getElementById('modalMessage').innerHTML = message.replace(/\n/g, '<br>');
            document.getElementById('messageModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('messageModal').style.display = 'none';
        }

        function confirmDelete(messageId) {
            deleteAction = 'single';
            deleteId = messageId;
            document.getElementById('confirmationTitle').textContent = 'Delete Message';
            document.getElementById('confirmationMessage').textContent = 'Are you sure you want to delete this message? This action cannot be undone.';
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function confirmDeleteAll() {
            deleteAction = 'all';
            deleteId = null;
            document.getElementById('confirmationTitle').textContent = 'Delete All Messages';
            document.getElementById('confirmationMessage').textContent = 'Are you sure you want to delete ALL messages? This action cannot be undone and will permanently remove all messages from your database.';
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function performDelete() {
            if (deleteAction === 'single' && deleteId) {
                document.getElementById('deleteMessageId').value = deleteId;
                document.getElementById('deleteForm').submit();
            } else if (deleteAction === 'all') {
                document.getElementById('deleteAllForm').submit();
            }
        }

        function closeConfirmation() {
            document.getElementById('confirmationModal').style.display = 'none';
            deleteAction = null;
            deleteId = null;
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const messageModal = document.getElementById('messageModal');
            const confirmationModal = document.getElementById('confirmationModal');
            
            if (event.target === messageModal) {
                closeModal();
            } else if (event.target === confirmationModal) {
                closeConfirmation();
            }
        }

        // Add escape key support
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                closeConfirmation();
            }
        });
    </script>
</body>
</html>