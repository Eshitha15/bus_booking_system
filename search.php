<?php
session_start();
include __DIR__ . '/database.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get user inputs
$from_location = $_POST['from_location'];
$to_location = $_POST['to_location'];
$journey_date = $_POST['journey_date'];
$bus_type = $_POST['bus_type'] ?? "all";
$seat_type = $_POST['seat_type'] ?? "all";

// Fetch buses based on filters
$query = "SELECT * FROM buses WHERE from_location='$from_location' AND to_location='$to_location' AND travel_date='$journey_date'";

if ($bus_type !== "all") {
    $query .= " AND bus_type='$bus_type'";
}
if ($seat_type !== "all") {
    $query .= " AND seat_type='$seat_type'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Buses</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Available Buses from <?= htmlspecialchars($from_location); ?> to <?= htmlspecialchars($to_location); ?> on <?= $journey_date; ?></h2>

    <?php if ($result->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Departure Time</th>
                <th>Bus Type</th>
                <th>Seat Type</th>
                <th>Price (₹)</th>
                <th>Action</th>
            </tr>
            <?php while ($bus = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($bus['departure_time'] ?? 'Not Available'); ?></td>
                    <td><?= htmlspecialchars($bus['bus_type'] ?? 'Unknown'); ?></td>
                    <td><?= htmlspecialchars($bus['seat_type'] ?? 'Unknown'); ?></td>
                    <td>₹<?= htmlspecialchars($bus['price'] ?? '0'); ?></td>
                    <td>
                        <form action="book.php" method="POST">
                            <input type="hidden" name="bus_id" value="<?= $bus['id']; ?>">
                            <button type="submit">Book</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No buses available for this route.</p>
    <?php } ?>

    <br>
    <a href="dashboard.php">Go Back</a>
</body>
</html>
