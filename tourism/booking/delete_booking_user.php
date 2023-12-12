<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && isset($data['booking_id'])) {
        $userid = $data['id'];
        $bookingId = $data['booking_id'];

        $deleteSql = "DELETE FROM booking WHERE user_id = $userid AND id = $bookingId";
        $deleteResult = $conn->query($deleteSql);

        if ($deleteResult) {
            echo json_encode(array("message" => "Booking deleted successfully."));
        } else {
            echo json_encode(array("error" => "Failed to delete booking."));
        }
    } else {
        echo json_encode(array("error" => "Please provide both the user id and booking id to delete."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}

$conn->close();
