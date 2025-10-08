<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "bus_reservation"; // Ensure this matches your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define locations and times
$locations = ["Hyderabad", "Chennai", "Bangalore", "Kochi", "Delhi"];
$bus_times = ["6:00 AM", "9:30 AM", "1:00 PM", "5:45 PM", "8:00 PM", "11:30 PM"];

// Create buses table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_location VARCHAR(50),
    to_location VARCHAR(50),
    departure_time VARCHAR(20),
    price INT,
    travel_date DATE
)");

// Check if buses are already added
$result = $conn->query("SELECT COUNT(*) as count FROM buses");
$row = $result->fetch_assoc();

if ($row['count'] == 0) { // Insert data only if table is empty
    for ($d = strtotime("2025-03-30"); $d <= strtotime("2025-04-30"); $d += 86400) {
        $date = date("Y-m-d", $d);
        foreach ($locations as $from) {
            foreach ($locations as $to) {
                if ($from !== $to) { // Avoid same from & to locations
                    foreach ($bus_times as $time) {
                        $price = rand(500, 2000);
                        $conn->query("INSERT INTO buses (from_location, to_location, departure_time, price, travel_date)
                                      VALUES ('$from', '$to', '$time', '$price', '$date')");
                    }
                }
            }
        }
    }
}
?>
