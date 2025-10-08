<?php
session_start();
include __DIR__ . '/database.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT name FROM users WHERE id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();
$username = $user ? $user['name'] : "User"; // Default to "User" if missing

// Available locations
$locations = ["Hyderabad", "Chennai", "Bangalore", "Kochi", "Delhi"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        // Ensure back button takes user to login page instead of exiting
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.location.href = "index.php?logout=true";
        };
    </script>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?= htmlspecialchars($username); ?>!</h2>

        <form action="search.php" method="POST">
            <label>From:</label>
            <select name="from_location" required>
                <option value="" disabled selected>Select Location</option>
                <?php foreach ($locations as $location) { ?>
                    <option value="<?= $location; ?>"><?= $location; ?></option>
                <?php } ?>
            </select>

            <label>To:</label>
            <select name="to_location" required>
                <option value="" disabled selected>Select Destination</option>
                <?php foreach ($locations as $location) { ?>
                    <option value="<?= $location; ?>"><?= $location; ?></option>
                <?php } ?>
            </select>

            <label>Date of Journey:</label>
            <input type="date" name="journey_date" min="2025-03-30" max="2025-04-30" required>

            <label>Bus Type:</label>
            <select name="bus_type">
                <option value="all">All</option>
                <option value="AC">AC</option>
                <option value="Non-AC">Non-AC</option>
            </select>

            <label>Seat Type:</label>
            <select name="seat_type">
                <option value="all">All</option>
                <option value="Seater">Seater</option>
                <option value="Sleeper">Sleeper</option>
            </select>

            <button type="submit">Search Buses</button>
        </form>

        <a href="index.php?logout=true">Logout</a>
    </div>

    <script>
        // Prevent selecting the same location for 'From' and 'To'
        document.querySelector("form").addEventListener("submit", function(event) {
            let from = document.querySelector("[name='from_location']").value;
            let to = document.querySelector("[name='to_location']").value;
            if (from === to) {
                alert("From and To locations cannot be the same.");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
