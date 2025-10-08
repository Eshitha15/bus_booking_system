<?php
session_start();
include __DIR__ . '/database.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get bus ID from form
$bus_id = $_POST['bus_id'];

// Redirect to payment page
header("Location: payment.php?bus_id=" . $bus_id);
exit();
?>
