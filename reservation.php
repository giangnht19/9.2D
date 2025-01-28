<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Default MySQL password for root in XAMPP
$dbname = "hotel_db";
$port = 3306; // MySQL port (default is 3306)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $guest_name = $_POST['guest_name'];
    $room_type = $_POST['room_type'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $payment_status = $_POST['payment_status'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO reservations (guest_name, room_type, check_in_date, check_out_date, payment_status) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $guest_name, $room_type, $check_in_date, $check_out_date, $payment_status);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        echo "<p>Reservation made successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="reservation.php" method="POST">
        <h2>Hotel Reservation</h2>
        <label for="guest_name">Guest Name:</label>
        <input type="text" id="guest_name" name="guest_name" placeholder="Enter your name" required>

        <label for="room_type">Room Type:</label>
        <select id="room_type" name="room_type" required>
            <option value="">Select a room type</option>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
        </select>

        <label for="check_in_date">Check-in Date:</label>
        <input type="date" id="check_in_date" name="check_in_date" required>

        <label for="check_out_date">Check-out Date:</label>
        <input type="date" id="check_out_date" name="check_out_date" required>

        <label for="payment_status">Payment Status:</label>
        <select id="payment_status" name="payment_status" required>
            <option value="">Select payment status</option>
            <option value="Paid">Paid</option>
            <option value="Pending">Pending</option>
        </select>

        <button type="submit">Submit Reservation</button>
    </form>
</body>
</html>
