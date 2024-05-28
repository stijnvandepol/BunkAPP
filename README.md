**Fontyen Vakantieparken Reserveringssysteem**
Welkom bij het Fontyen Vakantieparken Reserveringssysteem. Dit project bevat de broncode voor een website en een bijbehorend reserveringssysteem voor de vakantieparken van Fontyen. Dit document geeft een overzicht van het project, installatie-instructies, gebruikshandleidingen en andere relevante informatie.

**Beschrijving**
Dit project biedt een complete oplossing voor het beheren van reserveringen voor vakantieparken. De website maakt het voor klanten eenvoudig om reserveringen te maken. Het back-end systeem beheert alle reserveringen, parkeergegevens en klantgegevens .
Functies

    Reserveringen: Maak en annuleer reserveringen.
    Gebruikersbeheer: Beheer klantgegevens en inloggegevens.

**Vereisten**
Voordat je dit project kunt installeren, zorg ervoor dat je aan de volgende vereisten voldoet:

    
    Hosting: Docker
    Database: MySQL
    PHP: Versie 7.4 of hoger

**Installatie**
Volg de onderstaande stappen om het project te installeren:

Clone de repository:
git clone (https://github.com/stijnvandepol/fonteynapp.git)
cd fonteynapp

Bouw de app:
docker up -- build

Configuratie:
definieerd de database verbinding: fonteynapp/reservation/includes/dbconnection.php
<?php
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, $dbPort);
?>

**Gebruik**
Admin Paneel

    Inloggen: Beheerders kunnen inloggen via reservation/login.php.
    Dashboard: Beheerders hebben toegang tot het dashboard voor een overzicht van reserveringen via reservation/dashboard.php.

Klantgedeelte

    Registratie en inloggen: Klanten kunnen een account aanmaken en inloggen.
    Reserveren: Klanten kunnen beschikbare accommodaties bekijken en een reservering maken.
    Reserveringshistorie: Klanten kunnen hun vorige reserveringen bekijken en beheren.

Contributie

Wij verwelkomen bijdragen aan dit project! Volg deze stappen om bij te dragen:

    Fork de repository.
    Maak een nieuwe branch aan: git checkout -b mijn-branch
    Commit je wijzigingen: git commit -m 'Voeg nieuwe functie toe'
    Push naar de branch: git push origin mijn-branch
    Open een pull request.

Licentie

Dit project is gelicenseerd onder de MIT-licentie. Zie het LICENSE bestand voor meer informatie.
Contact

Voor vragen of ondersteuning, neem contact op via:

    Email: support@fontyen.com
    Website: Fontyen Vakantieparken

Bedankt voor het gebruik van het Fontyen Vakantieparken Reserveringssysteem!
