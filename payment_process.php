<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Simulate payment processing
$payment_method = $_POST['payment_method'];
$payment_details = $_POST['payment_details']; // Dummy details

// Here, you could add database logic if needed, like storing transaction details.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .success-container {
            text-align: center;
            margin-top: 50px;
        }
        .success-icon {
            font-size: 80px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h2>✅ Payment Successful!</h2>
        <p>Thank you for your payment via <?= htmlspecialchars($payment_method); ?>.</p>
        <a href="dashboard.php">Go to Dashboard</a>
    </div>
</body>
</html>
