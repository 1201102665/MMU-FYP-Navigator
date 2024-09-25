<?php
session_start(); 
require 'db.php';

$error = ''; 
$is_signup = false; 

$username = ''; 
$email = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signup'])) {
        // Sign Up Logic
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS); // Updated
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $profile_picture = $_FILES['profile_picture'];

        // Check if all fields are filled
        if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
            if ($password === $confirm_password) {
                // Check if username or email already exists
                $stmt = $pdo->prepare("SELECT user_id FROM Users WHERE username = :username OR email = :email");
                $stmt->execute([':username' => $username, ':email' => $email]);
                if ($stmt->fetch()) {
                    $_SESSION['error'] = 'Username or email already exists';
                    header("Location: index.php");
                } else {
                    $target_file = "profilePicture/super/default.png"; // Default profile picture setting
                    if (!empty($profile_picture['name'])) {
                        $target_dir = "profilePicture/";
                        $target_file = $target_dir . basename($profile_picture["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

                        // Check if file type is allowed
                        if (in_array($imageFileType, $allowed_types)) {
                            // Attempt to move uploaded file to target directory
                            if (!move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                                $_SESSION['error'] = 'Failed to upload profile picture';
                                header("Location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'Only JPG, JPEG, PNG, and GIF files are allowed';
                            header("Location: index.php");
                        }
                    }
                    // Inserting user into database
                    if (empty($_SESSION['error'])) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO Users (username, email, password, profile_picture) VALUES (:username, :email, :password, :profile_picture)");
                        $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hashed_password, ':profile_picture' => $target_file]);

                        $_SESSION['success'] = 'Account created successfully. Please sign in.';
                        header("Location: index.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['error'] = 'Passwords do not match';
                header("Location: index.php");
            }
        } else {
            $_SESSION['error'] = 'Please fill in all fields';
            header("Location: index.php");
        }
        $is_signup = true;
    } else if (isset($_POST['signin'])) {
        // Sign In Logic
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        // Check if email and password fields are filled
        if (!empty($email) && !empty($password)) {
            $stmt = $pdo->prepare("SELECT user_id, email, password, profile_picture, is_admin FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Verify the user's password
            if ($user && password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                $_SESSION['is_admin'] = $user['is_admin'];

                // Redirect based on admin status
                if ($user['is_admin']) {
                    header("Location: adminpanel.php");
                } else {
                    header("Location: home.php");
                }
                exit();
            } else {
                $_SESSION['error'] = 'Invalid email or password';
                header("Location: index.php"); // Redirect back to index.php
                exit();
            }
        } else {
            $_SESSION['error'] = 'Please fill in all fields';
            header("Location: index.php"); // Redirect back to index.php
            exit();
        }
    }
}
?>
