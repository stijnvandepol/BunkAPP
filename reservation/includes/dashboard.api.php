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
        if ($result) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $response[$i]['reservation_id'] = $row['reservation_id'];
                $response[$i]['name'] = $row['name'];
                $response[$i]['reservation_date'] = $row['reservation_date'];
                $response[$i]['start_date'] = $row['start_date'];
                $response[$i]['end_date'] = $row['end_date'];
                $response[$i]['room_type'] = $row['room_type'];
                $response[$i]['num_people'] = $row['num_people'];
                $response[$i]['status'] = $row['status'];
                $response[$i]['vehicle_license_plate'] = $row['vehicle_license_plate'];
                
                // Check if 'special_request' key exists in $row array
                if (array_key_exists('special_request', $row)) {
                    $response[$i]['special_request'] = $row['special_request'];
                } else {
                    $response[$i]['special_request'] = null;
                }
                
                $i++;
            }
            return json_encode($response, JSON_PRETTY_PRINT);
        }
    } else {
        echo "Database connection failed";
    }
}

?>
