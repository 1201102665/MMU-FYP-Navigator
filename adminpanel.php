<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']){
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminpanel.css">
    <title>Admin Panel - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="background-overlay">
        <div class="admin-panel">
            <h1 style="color: black; font-weight: bold;">
                <i class="bi bi-speedometer2"></i> Admin Panel
            </h1>
            <div class="admin-cards">
                <a href="my_announcements.php" class="admin-card">
                    <div class="card-content">
                        <span class="emoji">📢</span>
                        <h2>My Announcements</h2>
                    </div>
                </a>
                <a href="manage_resources.php" class="admin-card">
                    <div class="card-content">
                        <span class="emoji">📦</span>
                        <h2>Manage Resources</h2>
                    </div>
                </a>
                <a href="manage_feedback.php" class="admin-card">
                    <div class="card-content">
                        <span class="emoji">💬</span>
                        <h2>View Feedback</h2>
                    </div>
                </a>
                <a href="faq_admin.php" class="admin-card">
                    <div class="card-content">
                        <span class="emoji">❓</span>
                        <h2>Manage FAQs</h2>
                    </div>
                </a>
                <a href="view_contact_requests.php" class="admin-card">
    <div class="card-content">
        <span class="emoji">📧</span>
        <h2>View Contact Requests</h2>
    </div>
</a>
            </div>
        </div>
    </div>
</body>
</html>
