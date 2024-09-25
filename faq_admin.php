<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

$success = '';

// Handle delete request for FAQs
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM faq WHERE id = ?");
    $stmt->execute([$delete_id]);
    $success = 'FAQ has been deleted successfully.';
}

// Handle delete request for User Questions
if (isset($_GET['delete_user_question_id'])) {
    $delete_id = $_GET['delete_user_question_id'];
    $stmt = $pdo->prepare("DELETE FROM userquestions WHERE question_id = ?");
    $stmt->execute([$delete_id]);
    $success = 'User question has been deleted successfully.';
}

// Handle form submissions for FAQs
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if (isset($_POST['add_faq'])) {
        $stmt = $pdo->prepare("INSERT INTO faq (question, answer) VALUES (?, ?)");
        $stmt->execute([$question, $answer]);
        $success = 'FAQ has been added successfully.';
    } elseif (isset($_POST['edit_faq'])) {
        $edit_id = $_POST['edit_id'];
        $stmt = $pdo->prepare("UPDATE faq SET question = ?, answer = ? WHERE id = ?");
        $stmt->execute([$question, $answer, $edit_id]);
        $success = 'FAQ has been updated successfully.';
    }
}

// Retrieve existing FAQs
$stmt = $pdo->prepare("SELECT * FROM faq ORDER BY created_at DESC");
$stmt->execute();
$faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all user questions
$stmt = $pdo->prepare("SELECT * FROM userquestions ORDER BY asked_at DESC");
$stmt->execute();
$user_questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/faq_admin.css">
    <title>Manage FAQs and User Questions - MMU Resources</title>
    <style>
        /* Updated Modern Tabs Styling */
        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #4257e1; /* New Background Color */
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            color: white; /* White text on tabs */
        }

        .tab.active {
            background-color: #2d3ba8;
            color: white;
        }

        .tab:hover {
            background-color: #3339a4;
        }

        .tab-content {
            display: none;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-content.active {
            display: block;
        }

        /* Form and Table Styling */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
            color: black; /* Black font for table headers */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Centered Submit Button */
        .btn {
            background-color: #1E90FF; /* New button color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin: 20px auto 0 auto; /* Centered Button */
        }

        .btn:hover {
            background-color: #007a53;
        }

        .btn-cancel {
            background-color: #f44336;
        }

        .btn-cancel:hover {
            background-color: #e53935;
        }

        .btn-table {
            background-color: #1E90FF; /* Blue for Edit button */
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        .btn-table:hover {
            background-color: #1c86ee;
        }

        .btn-cancel-table {
            background-color: #f44336; /* Red for Delete button */
        }

        .btn-cancel-table:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" onclick="openTab('addFaqTab')">Add FAQ</div>
            <div class="tab" onclick="openTab('viewQuestionsTab')">View User Questions</div>
            <div class="tab" onclick="openTab('manageFaqTab')">Manage FAQs</div>
        </div>

        <!-- Tab Contents -->
        <div id="addFaqTab" class="tab-content active">
            <h2>Add FAQ</h2>
            <form method="post" action="faq_admin.php">
                <input type="hidden" name="add_faq" value="1">
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea id="question" name="question" required></textarea>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <textarea id="answer" name="answer" required></textarea>
                </div>
                <button type="submit" class="btn" style="display: block; margin: 0 auto; background-color: green;">Submit</button> <!-- Centered Submit Button -->
            </form>
        </div>

        <div id="viewQuestionsTab" class="tab-content">
            <h2>User Questions</h2>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($user_questions as $question): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($question['question_text']); ?></td>
                        <td><?php echo htmlspecialchars($question['asked_at']); ?></td>
                        <td>
                            <a href="faq_admin.php?delete_user_question_id=<?php echo $question['question_id']; ?>"><button type="button" class="btn btn-cancel-table" style="background-color: red;">Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div id="manageFaqTab" class="tab-content">
            <h2>Manage FAQs</h2>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($faqs as $faq): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($faq['question']); ?></td>
                        <td><?php echo htmlspecialchars($faq['answer']); ?></td>
                        <td>
                            <a href="faq_admin.php?edit_id=<?php echo $faq['id']; ?>"><button type="button" class="btn-table">Edit</button></a>
                            <a href="faq_admin.php?delete_id=<?php echo $faq['id']; ?>"><button type="button" class="btn btn-cancel-table" style="background-color: red;">Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script>
        // Function to open tab content
        function openTab(tabId) {
            var i, tabContent, tabs;

            // Hide all tab contents
            tabContent = document.getElementsByClassName('tab-content');
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].classList.remove('active');
            }

            // Remove active class from all tabs
            tabs = document.getElementsByClassName('tab');
            for (i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            // Show current tab and set it as active
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>