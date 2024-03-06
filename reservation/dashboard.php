<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" href="styles/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/dashboard.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Dashboard</h1>
            <div class="logout-container">
                <a href="logout.php"><button class="logout-button">Logout</button></a>
            </div>
        </header>
        <main>
            <section class="reservation-dashboard">
                <h2>Reservation dashboard</h2>
                <?php
                include("includes/dashboard.api.php");

                $data = json_decode(GetData(), true);

                if ($data === NULL) {
                    echo 'Er is een fout opgetreden bij het decoderen van de JSON-gegevens.';
                } else {
                    if (empty($data)) {
                        echo 'Geen gegevens beschikbaar.';
                    } else {
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Name</th>';
                        echo '<th>Start date</th>';
                        echo '<th>End date</th>';
                        echo '<th>Type</th>';
                        echo '<th>People</th>';
                        echo '<th>Special</th>';
                        echo '<th>Status</th>';
                        echo '<th>License plate</th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        foreach ($data as $entry) {
                            echo '<tr>';
                            echo '<td>' . $entry['name'] . '</td>';
                            echo '<td>' . $entry['start_date'] . '</td>';
                            echo '<td>' . $entry['end_date'] . '</td>';
                            echo '<td>' . $entry['room_type'] . '</td>';
                            echo '<td>' . $entry['num_people'] . '</td>';
                            echo '<td>' . $entry['special_request'] . '</td>'; 
                            echo '<td>' . $entry['status'] . '</td>';
                            echo '<td>' . $entry['vehicle_license_plate'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    }
                }
                ?>
            </section>
        </main>
    </div>
</body>

</html>
