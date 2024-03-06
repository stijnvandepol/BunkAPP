<?php
$base_url = 'http://' . $_SERVER['HTTP_HOST'];

ini_set('session.cookie_path', '/reservation');

session_start();
if(!isset($_SESSION['id'])) {
    header("Location: " . $base_url . "/reservation/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <link rel="icon" href="styles/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Reservation</h1>
            <div class="header-buttons">
                <a href="logout.php"><button id="btn">Logout</button></a>
            </div>
        </header>
        <main>
            <section class="dashboard-list">
                <h2>Make Reservation</h2>
                <ul id="dashboard-list"></ul>
            </section>

            <section class="dashboard-data">
                <form id="reservationForm" method="post">

                    <div class="inputbox">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required><br>
                    </div>
                    
                    <div class="inputbox">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required><br>
                    </div>

                    <div class="inputbox">
                        <label for="room_type">Room Type:</label>
                        <select id="room_type" name="room_type" required>
                            <option value="basic">Basic</option>
                            <option value="luxury">Luxury</option>
                        </select><br>
                    </div>

                    <div class="inputbox">
                        <label for="num_people">Number of People:</label>
                        <input type="number" id="num_people" name="num_people" min="1" max="8" required><br>
                    </div>

                    <div class="inputbox">
                        <label for="room_type">License plate:</label>
                        <input type="text" id="license_platee" name="license_plate"><br>
                    </div>

                    <div class="inputbox">
                        <label for="special_requests">Special Requests:</label>
                        <input id="special_requests" name="special_requests"><br>
                    </div>


                    
                    <button type="submit">Submit Reservation</button>
                </form>
            </section>
        </main>
    </div>

    <script>
        document.getElementById("reservationForm").addEventListener("submit", async function(event) {
            event.preventDefault();

            const form = event.target;
            if (!form.checkValidity()) {
                alert("Please fill out all required fields.");
                return;
            }

            const formData = new FormData(form);
            formData.append('id', <?php echo json_encode($_SESSION['id']); ?>);

            const response = await fetch('/reservation/includes/process_reservation.php', { // Vervang dit door de URL van je API
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                alert("An error occurred while submitting the reservation.");
                return;
            }

            const result = await response.json();
            if (result.success) {
                alert("Reservation submitted successfully!");
            } else {
                alert("Failed to submit reservation: " + result.message);
            }
        });
    </script>
</body>
</html>
