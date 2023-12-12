<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Extract tour ID from the URL
    $tourId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($tourId !== null) {
        // Check if the tour exists
        $checkTourQuery = "SELECT * FROM tour WHERE id = $tourId"; // Assuming the table name for tours is 'tour'
        $checkTourResult = $conn->query($checkTourQuery);

        if ($checkTourResult->num_rows > 0) {
            $existingData = $checkTourResult->fetch_assoc();

            $data = json_decode(file_get_contents('php://input'), true);

            $updateFields = array();

            // Define the columns in the 'tour' table that you want to allow updating
            $allowedColumns = ['name', 'image', 'date', 'destination_id', 'description', 'price', 'seats', 'tour_guide_id'];

            // Loop through the allowed columns and construct the update query
            foreach ($allowedColumns as $column) {
                if (isset($data[$column]) && $column !== 'id') {
                    $updateFields[] = "$column = '" . ($data[$column] !== null ? $data[$column] : $existingData[$column]) . "'";
                }
            }

            if (!empty($updateFields)) {
                $updateQuery = "UPDATE tour SET " . implode(', ', $updateFields) . " WHERE id = $tourId"; // Assuming the table name for tours is 'tour'

                if ($conn->query($updateQuery) === TRUE) {
                    echo json_encode(array("message" => "Tour details updated successfully."));
                } else {
                    echo json_encode(array("error" => "Error updating tour details: " . $conn->error));
                }
            } else {
                echo json_encode(array("message" => "No fields to update provided."));
            }
        } else {
            echo json_encode(array("error" => "Tour not found."));
        }
    } else {
        echo json_encode(array("error" => "Please provide the tour ID in the URL."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method. Please use PUT method."));
}

$conn->close();
?>
