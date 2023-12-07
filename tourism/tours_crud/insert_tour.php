<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process non-file fields
    $name = $_POST['name'] ?? '';
    $date = $_POST['date'] ?? '';
    $destinationId = $_POST['destination_id'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $seats = $_POST['seats'] ?? '';
    $tourGuideId = $_POST['tour_guide_id'] ?? '';

    // Check if all required fields are present
    $requiredFields = ['name', 'date', 'destination_id', 'description', 'price', 'seats', 'tour_guide_id'];
    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (empty($missingFields)) {
        // Process file field
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];

            // Adjust the directory to store images
            $upload_path = 'src/' . $image_name;

            // Create the directory if it doesn't exist
            if (!file_exists('src')) {
                mkdir('src', 0777, true);
            }

            move_uploaded_file($image_tmp_name, $upload_path);
        } else {
            $response = array(
                'error' => 'Image file is required.'
            );
            echo json_encode($response);
            exit;
        }

        // Insert tour into the database
        $insertTourQuery = "INSERT INTO tour (name, image, date, destination_id, description, price, seats, tour_guide_id) VALUES (
            '$name', '$upload_path', '$date', '$destinationId', '$description', '$price', '$seats', '$tourGuideId'
        )";

        if (mysqli_query($conn, $insertTourQuery)) {
            $response = array(
                'success' => 'Tour inserted successfully.'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'error' => 'Error inserting tour: ' . mysqli_error($conn)
            );
            echo json_encode($response);
        }

        mysqli_close($conn);
    } else {
        // Handle the case when there are missing required fields
        $response = array(
            'error' => 'Missing required fields: ' . implode(', ', $missingFields)
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'error' => 'Please use POST'
    );
    echo json_encode($response);
}
?>
