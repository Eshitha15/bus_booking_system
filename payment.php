<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$bus_id = $_POST['bus_id']; // Get selected bus ID

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .payment-container {
            text-align: center;
            margin-top: 50px;
        }
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 300px;
            margin: auto;
        }
    </style>
    <script>
        function showPaymentFields() {
            let method = document.querySelector('input[name="payment_method"]:checked').value;
            let detailsDiv = document.getElementById("payment-details");

            if (method === "Credit/Debit Card") {
                detailsDiv.innerHTML = '<label>Card Number:</label><input type="text" name="payment_details" required placeholder="1234 5678 9012 3456"><br><label>Expiry Date:</label><input type="text" name="expiry_date" required placeholder="MM/YY"><br><label>CVV:</label><input type="text" name="cvv" required placeholder="123">';
            } else {
                detailsDiv.innerHTML = '<label>UPI/Mobile Number:</label><input type="text" name="payment_details" required placeholder="Enter UPI ID or Mobile Number">';
            }
        }
    </script>
</head>
<body>
    <div class="payment-container">
        <h2>Select Payment Method</h2>
        <form action="payment_process.php" method="POST">
            <input type="hidden" name="bus_id" value="<?= $bus_id; ?>">

            <div class="payment-methods">
                <label><input type="radio" name="payment_method" value="PhonePe" onclick="showPaymentFields()" required> PhonePe</label>
                <label><input type="radio" name="payment_method" value="Google Pay" onclick="showPaymentFields()"> Google Pay</label>
                <label><input type="radio" name="payment_method" value="Paytm" onclick="showPaymentFields()"> Paytm</label>
                <label><input type="radio" name="payment_method" value="Credit/Debit Card" onclick="showPaymentFields()"> Credit/Debit Card</label>
            </div>

            <div id="payment-details"></div>

            <br>
            <button type="submit">Pay</button>
        </form>
    </div>
</body>
</html>
