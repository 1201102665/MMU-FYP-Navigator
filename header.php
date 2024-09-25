<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'db.php'; // Include the database connection

$current_page = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT username, profile_picture, is_admin FROM Users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_picture'] = $user['profile_picture'];
        $_SESSION['is_admin'] = $user['is_admin'];
    } else {
        // If user data is not found, log out the user
        require 'logout.php';
    }

    // Fetch the number of items in the cart
    if (!$_SESSION['is_admin']) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS cart_count FROM Cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $cart = $stmt->fetch();
        $cart_count = $cart['cart_count'];
    } else {
        $cart_count = 0;
    }
} else {
    $cart_count = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>MMU Resources</title>
</head>
<body>

    <!-- Responsive Navbar with Offcanvas Side Menu -->
    <header class="bg-primary text-white py-3 shadow-sm">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-blue">
                <!-- Logo -->
                <a href="<?php echo $_SESSION['is_admin'] ? 'adminpanel.php' : 'home.php'; ?>" class="navbar-brand">
                    <img src="design/logo.png" alt="MMU Resources Logo" width="150">
                </a>

                <!-- Hamburger Menu (for small screens) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Offcanvas Side Menu for small screens -->
                <div class="offcanvas offcanvas-start bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a href="<?php echo $_SESSION['is_admin'] ? 'adminpanel.php' : 'home.php'; ?>" class="nav-link text-black <?php echo $current_page == ($_SESSION['is_admin'] ? 'adminpanel.php' : 'home.php') ? 'active' : ''; ?>">Home</a>
                            </li>
                            <li class="nav-item"></li>
    
    <?php if (!$_SESSION['is_admin']): ?>
        <li class="nav-item">
            <a href="announcements.php" class="nav-link text-primary <?php echo $current_page == 'announcements.php' ? 'active' : ''; ?>">Announcements</a>
        </li>
        <li class="nav-item">
            <a href="upload_resource.php" class="nav-link text-white <?php echo $current_page == 'upload_resource.php' ? 'active' : ''; ?>">Upload Resource</a>
        </li>
        <li class="nav-item">
            <a href="purchased.php" class="nav-link text-primary <?php echo $current_page == 'purchased.php' ? 'active' : ''; ?>">My Resources</a>
        </li>
        <li class="nav-item">
            <a href="posted_resources.php" class="nav-link text-primary <?php echo $current_page == 'posted_resources.php' ? 'active' : ''; ?>">Posted Resources</a>
        </li>
        <li class="nav-item">
            <a href="about_us.php" class="nav-link text-white <?php echo $current_page == 'about_us.php' ? 'active' : ''; ?>">About Us</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a href="my_announcements.php" class="nav-link text-white <?php echo $current_page == 'my_announcements.php' ? 'active' : ''; ?>">My Announcements</a>
        </li>
        <li class="nav-item">
            <a href="manage_resources.php" class="nav-link text-primary <?php echo $current_page == 'manage_resources.php' ? 'active' : ''; ?>">Manage Resources</a>
        </li>
        <li class="nav-item">
            <a href="manage_feedback.php" class="nav-link text-primary <?php echo $current_page == 'manage_feedback.php' ? 'active' : ''; ?>">View Feedback</a>
        </li>
        <li class="nav-item">
            <a href="faq_admin.php" class="nav-link text-primary <?php echo $current_page == 'faq_admin.php' ? 'active' : ''; ?>">Manage FAQs</a>
        </li>
        <li class="nav-item">
            <a href="view_contact_requests.php" class="nav-link text-primary <?php echo $current_page == 'view_contact_requests.php' ? 'active' : ''; ?>">Contact Requests</a>
        </li>
    <?php endif; ?>
</ul>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <?php if (!$_SESSION['is_admin']): ?>
                                    <div class="position-relative me-3">
                                        <a href="cart.php" class="text-white position-relative">
                                            <i class="bi bi-cart3 fs-4"></i>
                                            <?php if ($cart_count > 0): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $cart_count; ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="dropdown">
                                    <a href="#" class="d-flex align-items-center text-black dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                                        <span><?php echo $_SESSION['username']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="signin.php" class="btn btn-outline-light ms-3">Sign In</a>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
