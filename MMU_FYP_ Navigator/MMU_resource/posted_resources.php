<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

require 'db.php';

// Fetch user's uploaded resources
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT r.resource_id, r.title, r.description, r.price, r.cover_picture, r.pending_acceptance, f.faculty_name 
                       FROM resources r 
                       JOIN faculties f ON r.faculty_id = f.faculty_id 
                       WHERE r.user_id = ?");
$stmt->execute([$user_id]);
$resources = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all resources uploaded by the user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/posted_resources.css">
    <title>My Uploaded Resources - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?> 
    <div class="container">
        <h1>My Uploaded Resources</h1> 
        <div class="resources">
            <?php if (count($resources) > 0): ?> <!-- Check if there are resources -->
                <?php foreach ($resources as $resource): ?> 
                    <div class="resource">
                        <img src="<?php echo htmlspecialchars($resource['cover_picture']); ?>" alt="Cover Picture" class="cover-picture"> <!-- Resource cover picture -->
                        <h3><?php echo htmlspecialchars($resource['title']); ?></h3> <!-- Resource title -->
                        <p><?php echo nl2br(htmlspecialchars($resource['description'])); ?></p> <!-- Resource description -->
                        <p><strong>Price:</strong> RM <?php echo number_format($resource['price'], 2); ?></p> <!-- Resource price -->
                        <p><strong>Faculty:</strong> <?php echo htmlspecialchars($resource['faculty_name']); ?></p> <!-- Resource faculty -->
                        <p><strong>Status:</strong> 
                            <span class="status <?php echo $resource['pending_acceptance'] ? 'pending' : 'accepted'; ?>">
                                <?php echo $resource['pending_acceptance'] ? 'Pending Approval' : 'Accepted'; ?> <!-- Resource status -->
                            </span>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h4>You have not uploaded any resources.</h4> 
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
