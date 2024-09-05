<?php
session_start();
require 'db.php';

// Fetch all answered FAQs
$stmt = $pdo->prepare("SELECT question, answer FROM faq ORDER BY created_at DESC");
$stmt->execute();
$faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $user_id = $_SESSION['user_id'] ?? null;

    if (!empty($question_text)) {
        if ($user_id) {
            // Insert the user's question into the database
            $stmt = $pdo->prepare("INSERT INTO userquestions (user_id, question_text) VALUES (?, ?)");
            $stmt->execute([$user_id, $question_text]);
            $success = 'Your question has been submitted successfully.';
        } else {
            $error = 'You need to be logged in to submit a question.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/faq_user.css">
    <title>FAQ - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <?php if (count($faqs) > 0): ?>
                <ul>
                    <!-- Loop through and display all FAQs -->
                    <?php foreach ($faqs as $faq): ?>
                        <li>
                            <p class="question"><?php echo nl2br(htmlspecialchars($faq['question'])); ?></p>
                            <div class="answer"><strong>Answer:</strong> <?php echo nl2br(htmlspecialchars($faq['answer'])); ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No FAQs available.</p>
            <?php endif; ?>
        </div>

        <h3>Have a Question? Ask Us!</h3>
        <?php if ($success): ?>
            <!-- Display success message if the question is submitted successfully -->
            <div class="alert success">
                <div class="alert--content">
                    <div class="alert--words"><?php echo htmlspecialchars($success); ?></div>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" action="faq_user.php">
            <div class="form-group">
                <label for="question_text">Your Question:</label>
                <!-- Textarea for the user to input their question -->
                <textarea id="question_text" name="question_text" required></textarea>
            </div>
            <button type="submit" class="btn">Submit Question</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script src="javascript/faq_user.js"></script>
</body>
</html>
