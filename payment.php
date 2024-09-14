<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['total_amount']) || !isset($_SESSION['selected_items'])) {
    header("Location: signin.php"); // Redirect to signin page if not logged in or total amount not set
    exit();
}

require 'db.php'; 

// Initialize error message variable
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the form is submitted
    // Sanitize user inputs to prevent XSS attacks
    $card_number = preg_replace('/\s+/', '', filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING));
    $card_expiry = filter_input(INPUT_POST, 'card_expiry', FILTER_SANITIZE_STRING);
    $card_cvc = filter_input(INPUT_POST, 'card_cvc', FILTER_SANITIZE_STRING);

    // Validate payment details
    $expiryRegex = '/^(0[1-9]|1[0-2])\/?([0-9]{2})$/';
    $errors = [];

    if (!preg_match('/^\d{16}$/', $card_number)) {
        $errors[] = 'Card number must be 16 digits.';
    }

    if (!preg_match($expiryRegex, $card_expiry)) {
        $errors[] = 'Invalid expiry date format. Use MM/YY.';
    }

    if (!preg_match('/^\d{3}$/', $card_cvc)) {
        $errors[] = 'CVC must be 3 digits.';
    }

    if (empty($errors)) {
        $user_id = $_SESSION['user_id'];
        $selected_items = $_SESSION['selected_items'];
        $total_amount = $_SESSION['total_amount'];

        // Add purchased items to PurchasedResources table
        $stmt = $pdo->prepare("INSERT INTO PurchasedResources (user_id, resource_id, purchase_date) VALUES (?, ?, NOW())");
        foreach ($selected_items as $cart_id) {
            $resource_id_stmt = $pdo->prepare("SELECT resource_id FROM Cart WHERE cart_id = ?");
            $resource_id_stmt->execute([$cart_id]);
            $resource_id = $resource_id_stmt->fetchColumn();

            if ($resource_id) {
                $stmt->execute([$user_id, $resource_id]);
            }
        }

        // Clear the selected items from the user's cart
        $placeholders = str_repeat('?,', count($selected_items) - 1) . '?';
        $stmt = $pdo->prepare("DELETE FROM Cart WHERE user_id = ? AND cart_id IN ($placeholders)");
        $stmt->execute(array_merge([$user_id], $selected_items));

        unset($_SESSION['selected_items']);
        unset($_SESSION['total_amount']);

        $_SESSION['payment_success'] = true;
        $_SESSION['success'] = 'Payment was successful.';
        header("Location: purchased.php"); // Redirect to the purchased items page after successful payment
        exit();
    } else {
        $error = implode(' ', $errors); // Concatenate error messages
    }
}

$total_amount = $_SESSION['total_amount']; // Retrieve the total amount from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="css/payment.css"> <!-- Link to the payment CSS file -->
    <title>Payment - MMU Resources</title>
</head>
<body>
    <div class="container">
        <h2>Payment</h2>
        <p>Outstanding Sum: RM <?php echo number_format($total_amount, 2); ?></p> <!-- Display the total amount -->
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p> <!-- Display error message -->
        <?php endif; ?>
        <form method="post" action="payment.php">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" required placeholder="1234 5678 9101 1121" maxlength="19"> <!-- Card number input field -->
                <div class="card-icons">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="card_expiry">Expiration date (MM/YY):</label>
                    <input type="text" id="card_expiry" name="card_expiry" required placeholder="MM / YY" maxlength="5"> <!-- Expiration date input field -->
                </div>
                <div class="form-group">
                    <label for="card_cvc">Security code:</label>
                    <input type="password" id="card_cvc" name="card_cvc" required placeholder="CVC" maxlength="3"> <!-- CVC input field -->
                </div>
            </div>
            <button type="submit" class="btn">Pay Now</button> 
        </form>
    </div>
    <script src="javascript/payment.js"></script>
</body>
</html>
