<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Retrieve a specific review by ID
        $reviewId = $_GET['id'];
        $sql = "SELECT * FROM reviews WHERE id = $reviewId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $review = $result->fetch_assoc();
            echo json_encode($review);
        } else {
            echo json_encode(array("message" => "Review with the provided ID not found."));
        }
    } else {
        // Retrieve all reviews
        $sql = "SELECT * FROM reviews";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $reviews = array();
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
            echo json_encode($reviews);
        } else {
            echo json_encode(array("message" => "No review records found."));
        }
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}

$conn->close();
?>


