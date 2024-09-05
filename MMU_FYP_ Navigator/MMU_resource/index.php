<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and set the appropriate redirect URL
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['is_admin']) {
        $redirectUrl = 'adminpanel.php';
    } else {
        $redirectUrl = 'home.php';
    }
} else {
    $redirectUrl = 'signin.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMU-FYP Navigator</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
        <div class="welcome-content">
            <h1>welcome to MMU-FYP Navigator</h1>
            <p>Your Path to Project Excellence</p>
            <a href="<?php echo $redirectUrl; ?>" class="btn">Join us now!</a>
        </div>
</body>
</html>
