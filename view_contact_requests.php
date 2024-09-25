<?php
// Start session and check if user is admin
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

require 'db.php'; // Your database connection

// Fetch contact requests from the database
try {
    $stmt = $pdo->query("SELECT * FROM contact_requests");
    $contact_requests = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching contact requests: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Contact Requests - Admin Panel</title>
</head>

<body>
<?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Contact Requests</h2>
            
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Inquiry Type</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contact_requests): ?>
                    <?php foreach ($contact_requests as $request): ?>
                        <tr>
                            
                            <td><?= isset($request['name']) ? htmlspecialchars($request['name']) : 'N/A'; ?></td>
                            <td><?= isset($request['email']) ? htmlspecialchars($request['email']) : 'N/A'; ?></td>
                            <td><?= isset($request['phone']) ? htmlspecialchars($request['phone']) : 'N/A'; ?></td>
                            <td><?= isset($request['inquiry_type']) ? htmlspecialchars($request['inquiry_type']) : 'N/A'; ?></td>
                            <td><?= isset($request['message']) ? htmlspecialchars($request['message']) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No contact requests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
