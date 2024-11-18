<?php
// Connect to database (adjust with your actual connection details)
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form submission
    $flightType = $_POST['flightType'] ?? '';
    $departure = $_POST['departure'] ?? '';
    $arrival = $_POST['arrival'] ?? '';
    $departureDate = $_POST['departureDate'] ?? '';
    $arrivalDate = $_POST['arrivalDate'] ?? '';
    $adultCount = $_POST['adultCount'] ?? 0;
    $childCount = $_POST['childCount'] ?? 0;
    $infantCount = $_POST['infantCount'] ?? 0;

    // Example validation (ensure all required fields are filled)
    if (empty($departure) || empty($arrival) || empty($departureDate)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Insert booking data into database
    $stmt = $conn->prepare("INSERT INTO bookings (flight_type, departure, arrival, departure_date, arrival_date, adult_count, child_count, infant_count) VALUES (:flightType, :departure, :arrival, :departureDate, :arrivalDate, :adultCount, :childCount, :infantCount)");
    $stmt->bindParam(':flightType', $flightType);
    $stmt->bindParam(':departure', $departure);
    $stmt->bindParam(':arrival', $arrival);
    $stmt->bindParam(':departureDate', $departureDate);
    $stmt->bindParam(':arrivalDate', $arrivalDate);
    $stmt->bindParam(':adultCount', $adultCount);
    $stmt->bindParam(':childCount', $childCount);
    $stmt->bindParam(':infantCount', $infantCount);

    if ($stmt->execute()) {
        echo "Booking successfully created!";
    } else {
        echo "An error occurred while processing the booking.";
    }
}
?>
