<?php

function GetData()
{
    include("dbconnection.php");
    $response = array();
    
    if ($conn) {
        $sql = "SELECT reservations.*, customers.name 
            FROM reservations 
            INNER JOIN customers ON reservations.customers_id = customers.id";

        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) { // Controleer of er gegevens zijn opgehaald
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $response[$i]['reservation_id'] = $row['reservation_id'];
                $response[$i]['name'] = $row['name'];
                $response[$i]['reservation_date'] = $row['reservation_date'];
                $response[$i]['start_date'] = $row['start_date'];
                $response[$i]['end_date'] = $row['end_date'];
                $response[$i]['location'] = $row['location'];
                $response[$i]['room_type'] = $row['room_type'];
                $response[$i]['num_people'] = $row['num_people'];
                $response[$i]['status'] = $row['status'];
                $response[$i]['vehicle_license_plate'] = $row['vehicle_license_plate'];
                $response[$i]['special_requests'] = $row['special_requests'] ?? null; 
                
                $i++;
            }
            return json_encode($response, JSON_PRETTY_PRINT);
        } else {
            return json_encode($response); // Return een lege array als er geen gegevens zijn opgehaald
        }
    } else {
        echo "Database connection failed";
    }
}



function removeData($conn, $reservation_id)
{
    include("dbconnection.php");

    // Haal het gebruikers-ID op uit de POST-gegevens
    $user_id = $_POST['user_id'];

    // Haal de gegevens van de te verwijderen reservering op voor logging
    $query = "SELECT * FROM reservations WHERE reservation_id = '$reservation_id'";
    $result = mysqli_query($conn, $query);
    $reservationData = mysqli_fetch_assoc($result);

    if ($reservationData) {
        // Verwijder de reservering
        $deleteQuery = "DELETE FROM reservations WHERE reservation_id = '$reservation_id'";
        if (mysqli_query($conn, $deleteQuery)) {
            // Log de verwijderde reservering inclusief het gebruikers-ID
            $logMessage = "Reservation deleted: ID = " . $reservationData['reservation_id'] . ", Customers id = " . $reservationData['customers_id'] . ", Creation date = " . $reservationData['reservation_date'] . ", Date deleted = " . date("Y-m-d H:i:s") . ", User id = " . $user_id . "\n";
            file_put_contents('/var/www/html/logs/reservation_deletions.log', $logMessage, FILE_APPEND);
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reservation_id']) && isset($_GET['action']) && $_GET['action'] == 'remove') {
        removeData($conn, $_POST['reservation_id']);
    }
}

?>