<?php

include '../connect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate required fields
    if (
        !empty($data['name']) && !empty($data['image'])
        && !empty($data['date']) && !empty($data['destination_id'])
        && !empty($data['description']) && !empty($data['price'])
        && !empty($data['seats']) && !empty($data['tour_guide_id'])
    ) {
        $name = $data['name'];
        $image = $data['image'];
        $date = $data['date'];
        $destinationId = $data['destination_id'];
        $description = $data['description'];
        $price = $data['price'];
        $seats = $data['seats'];
        $tourGuideId = $data['tour_guide_id'];

        // Insert new tour into the database
        $sql = "INSERT INTO tour (name, image, date, destination_id, description, price, seats, tour_guide_id) 
                VALUES ('$name', '$image', '$date', '$destinationId', '$description', '$price', '$seats', '$tourGuideId')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Tour created successfully"]);
        } else {
            echo json_encode(["error" => "Error creating tour: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Invalid data. Please provide all required parameters"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
