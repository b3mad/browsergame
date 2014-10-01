<?php
include 'dbconnect.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $con = "INSERT INTO spieler (username, password) VALUES ('$username', '$password')";
    $eintragen = mysql_query($con);
        
    if ($eintragen == true) {
        header("Location: index.php");
    } else {
        echo "Fehler beim Speichern";
    }
}

?>