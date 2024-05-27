<?php
include('dbconnection.php');

$base_url = 'http://' . $_SERVER['HTTP_HOST'];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Controleer of zowel email als wachtwoord zijn ingevoerd
    if (empty($email) || empty($password)) {
        $response['success'] = false;
        $response['message'] = 'Please enter both email and password';

        // Stuur gebruiker terug naar het loginformulier met een foutmelding
        header('Location: ' . $base_url . '/reservation/dashboard_login.php?error=' . urlencode($response['message']));
        exit();
    }

    $response = array();

    // Haal het opgeslagen gehashte wachtwoord op basis van het e-mailadres
    $getPasswordQuery = "SELECT id, email, password FROM users WHERE email = '$email'";
    $getPasswordResult = mysqli_query($conn, $getPasswordQuery);

    if ($getPasswordResult) {
        if ($row = mysqli_fetch_assoc($getPasswordResult)) {
            $hashedPassword = $row['password'];

            // Vergelijk het ingevoerde wachtwoord met het opgeslagen gehashte wachtwoord
            if (password_verify($password, $hashedPassword)) {
                $response['success'] = true;
                $response['message'] = 'Login successful';
                $response['redirect'] = $base_url . '/reservation/dashboard.php';
                $response['id'] = $row['id'];

                ini_set('session.cookie_lifetime', 86400);
                session_start();
                $_SESSION['id'] = $response['id'];

                // Stuur gebruiker door naar het dashboard
                header('Location: ' . $response['redirect']);
                exit();
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid email or password';

                // Stuur gebruiker terug naar het loginformulier met een foutmelding
                header('Location: ' . $base_url . '/reservation/dashboard_login.php?login_error=2');
                exit();
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Invalid email or password';

            // Stuur gebruiker terug naar het loginformulier met een foutmelding
            header('Location: ' . $base_url . '/reservation/dashboard_login.php?login_error=2');
            exit();
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Error executing query';

        // Stuur gebruiker terug naar het loginformulier met een foutmelding
        header('Location: ' . $base_url . '/reservation/dashboard_login.php?login_error=2');
        exit();
    }
}
?>
