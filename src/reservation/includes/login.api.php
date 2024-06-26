<?php
include('dbconnection.php');

$base_url = 'https://' . $_SERVER['HTTP_HOST'];

$response = array(); // Initialisatie van de response-variabele

if (isset($_POST['submit'])) {
    $name = $_POST['email'];
    $password = $_POST['password'];

    // Controleer of zowel naam als wachtwoord zijn ingevoerd
    if (empty($name) || empty($password)) {
        $response['success'] = false;
        $response['message'] = 'Please enter both email and password';
            
        header('Location: ' . $base_url . '/reservation/login.php?login_error=1');
        exit();
    }

    // Haal het opgeslagen gehashte wachtwoord op basis van het e-mailadres
    $getPasswordQuery = "SELECT id, email, password FROM customers WHERE email = '$name'";
    $getPasswordResult = mysqli_query($conn, $getPasswordQuery);

    if ($getPasswordResult) {
        if ($row = mysqli_fetch_assoc($getPasswordResult)) {
            $hashedPassword = $row['password'];

            // Vergelijk het ingevoerde wachtwoord met het opgeslagen gehashte wachtwoord
            if (password_verify($password, $hashedPassword)) {
                $response['success'] = true;
                $response['message'] = 'Login successful';
                $response['redirect'] = $base_url . '/reservation/reservation.php';
                $response['id'] = $row['id'];

                ini_set('session.cookie_lifetime', 86400);
                session_start();
                $_SESSION['id'] = $response['id'];

            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid name or password';

                header('Location: ' . $base_url . '/reservation/login.php?login_error=1');
                exit();
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Error executing query';

        header('Location: ' . $base_url . '/reservation/login.php?login_error=1');
        exit();
    }

    if ($response['success'] && isset($response['redirect'])) {
        header('Location: ' . $response['redirect']);
        exit();
    }
}
?>
