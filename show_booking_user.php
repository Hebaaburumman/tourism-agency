<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Retrieve all bookings of a specific user by ID
        $userId = $_GET['id'];
        $sql = "SELECT * FROM booking WHERE user_id = $userId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $bookings = array();
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
            echo json_encode($bookings);
        } else {
            echo json_encode(array("message" => "No bookings found for the specified user ID."));
        }
    } else {
        echo json_encode(array("error" => "Please provide the 'id' parameter for the user."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}

$conn->close();
?>