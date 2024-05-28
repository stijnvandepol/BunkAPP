<?php
$dbServername = "parkbase.mysql.database.azure.com"; // Gebruik de servicenaam van de MySQL-container
$dbPort = "3306"; 
$dbUsername = "APIUSER";
$dbPassword = "4nzGxR68XKtJVSCq";
$dbName = "parkbase";

// Maak verbinding met MySQL
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, $dbPort);

date_default_timezone_set('Europe/Amsterdam');
?>