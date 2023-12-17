<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'])) {
        $userid = $data['id'];
        $sql = "SELECT booking.id as booking_id, tour.name, tour.image, tour.date, tour.description, tour.price, booking.booking_date 
                FROM booking 
                JOIN users ON users.id = booking.user_id 
                JOIN tour ON tour.id = booking.tour_id 
                WHERE users.id = $userid";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $bookedTours = array();
            while ($row = $result->fetch_assoc()) {
                $bookedTours[] = $row;
            }
            echo json_encode($bookedTours);
        } else {
            echo json_encode(array("message" => "No booked tours found for the provided user ID."));
        }
    } else {
        echo json_encode(array("error" => "Please provide the user ID."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}
$conn->close();
?>
