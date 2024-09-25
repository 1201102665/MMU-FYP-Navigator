<?php
session_start();
require 'db.php';

// Check if the user is logged in and is not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

// Fetch faculties for the dropdown
$stmt = $pdo->prepare("SELECT faculty_id, faculty_name FROM Faculties");
$stmt->execute();
$faculties = $stmt->fetchAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $faculty_id = filter_input(INPUT_POST, 'faculty', FILTER_SANITIZE_NUMBER_INT);
    $file_path = $_FILES['file_path'];
    $cover_picture = $_FILES['cover_picture'];

    $allowed_file_types = ['pdf', 'doc', 'docx'];
    $allowed_cover_types = ['jpg', 'jpeg', 'png'];

    $fileFileType = strtolower(pathinfo($file_path["name"], PATHINFO_EXTENSION));
    $coverFileType = strtolower(pathinfo($cover_picture["name"], PATHINFO_EXTENSION));

    if ($price === false || $price <= 0) {
        $error = 'Price must be a positive number';
    } elseif (!in_array($fileFileType, $allowed_file_types)) {
        $error = 'Only PDF, DOC, DOCX files for resources are allowed';
    } elseif (!in_array($coverFileType, $allowed_cover_types)) {
        $error = 'Only JPG, JPEG, PNG files for cover pictures are allowed';
    } elseif (!empty($title) && !empty($description) && !empty($price) && !empty($faculty_id) && !empty($file_path['name']) && !empty($cover_picture['name'])) {
        $target_dir = "resources/";
        $target_file = $target_dir . basename($file_path["name"]);

        $cover_target_dir = "coverPictures/";
        $cover_target_file = $cover_target_dir . basename($cover_picture["name"]);

        if (move_uploaded_file($file_path["tmp_name"], $target_file) && move_uploaded_file($cover_picture["tmp_name"], $cover_target_file)) {
            $stmt = $pdo->prepare("INSERT INTO Resources (title, description, price, file_path, cover_picture, faculty_id, user_id, pending_acceptance) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
            $stmt->execute([$title, $description, $price, $target_file, $cover_target_file, $faculty_id, $_SESSION['user_id']]);

            $_SESSION['success'] = 'Resource uploaded successfully.';
            header("Location: home.php");
            exit();
        } else {
            $error = 'Failed to upload files';
        }
    }
    $_SESSION['file_path'] = $file_path['name'];
    $_SESSION['cover_picture'] = $cover_picture['name'];
} else {
    unset($_SESSION['file_path']);
    unset($_SESSION['cover_picture']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/upload_resource.css">
    <title>Upload Resource - MMU Resources</title>
    <script>
        function validateForm() {
            var price = document.getElementById('price').value;
            if (isNaN(price) || price <= 0) {
                alert("Price must be a positive number.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-container">
        <h2>Upload Resource</h2>
        <?php if ($error): ?>
            <div class="alert error">
                <div class="alert--content">
                    <div class="alert--words"><?php echo htmlspecialchars($error); ?></div>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" action="upload_resource.php" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="faculty">Faculty:</label>
                <select id="faculty" name="faculty" required>
                    <option value="">Select Faculty</option>
                    <?php foreach ($faculties as $faculty): ?>
                        <option value="<?php echo htmlspecialchars($faculty['faculty_id']); ?>" <?php echo isset($faculty_id) && $faculty_id == $faculty['faculty_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($faculty['faculty_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group smaller-upload">
                <label for="file_path">Resource File:</label>
                <div class="drag-drop-container" id="file-drop-container">
                    <img src="design/cloud.png" alt="Upload File" class="upload-icon">
                    <p>Drag & Drop to Upload File<br>OR</p>
                    <button type="button" class="browse-btn" onclick="document.getElementById('file_path').click()">Browse File</button>
                    <input type="file" id="file_path" name="file_path" accept=".pdf,.doc,.docx" required>
                    <p class="file-name" id="file-name"><?php echo isset($_SESSION['file_path']) ? htmlspecialchars($_SESSION['file_path']) : ''; ?></p>
                </div>
            </div>
            <div class="form-group smaller-upload">
                <label for="cover_picture">Cover Picture:</label>
                <div class="drag-drop-container" id="cover-drop-container">
                    <img src="design/picture.png" alt="Upload Cover" class="upload-icon">
                    <p>Drag & Drop to Upload Photo<br>OR</p>
                    <button type="button" class="browse-btn" onclick="document.getElementById('cover_picture').click()">Browse Photo</button>
                    <input type="file" id="cover_picture" name="cover_picture" accept=".jpg,.jpeg,.png" required>
                    <p class="file-name" id="cover-name"><?php echo isset($_SESSION['cover_picture']) ? htmlspecialchars($_SESSION['cover_picture']) : ''; ?></p>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn">Upload Resource</button>
            </div>
        </form>
    </div>
    <script src="javascript/upload_resource.js"></script>
</body>
</html>
