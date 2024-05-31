<?php
$base_url = 'https://' . $_SERVER['HTTP_HOST'];

session_start();

// Vernietig alle sessievariabelen
session_unset();

// Vernietig de sessie
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="styles/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/succes.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <main>
        <div class="left-side"></div>

        <div class="right-side">
            <h1>Reservation successful!</h1>
            <br>
            
            <h3>Reservation is being processed</h3>
            <br>
            <br>

            <a href="https://webapplicatie-reserveringsysteem.azurewebsites.net">Back to homepage</a>
        </div>

    </main>
</body>

</html>
