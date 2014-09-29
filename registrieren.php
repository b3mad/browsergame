<?php
$msg = "";
include 'dbconnect.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ((!$username) || (!$password)) {
        $msg = "alle Felder ausf&uumlllen";
    } else {

        $con = "INSERT INTO spieler (username, password) VALUES ('$username', '$password')";
        $eintragen = mysql_query($con);
        
        if ($eintragen == true) {
            header("Location: index.php");
        } else {
            echo "Fehler beim Speichern";
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="author" content="Philippe Ruoss" />
            <meta name="Keywords" content="" />
            <meta name="Description" content="" />
            <link rel="stylesheet" type="text/css" href="style.css">
                <title>Formular DB</title>
        </head>
        <body>




            <form action="registrieren.php" method="post" class="login">
            <h1>Registration</h1>
                <dl>

                    <dd><input type="text" name="username" placeholder="username"/></dd>
                    <dd><input type="text" name="password" placeholder="Password"/></dd>
                </dl>

                <p>
                    <input type="submit" value="Senden" />
                    <input type="reset" value="Zurücksetzen" />
                </p>
                <p style="color: red"><?php echo ("$msg"); ?></p>
            </form>

        </body>
    </html>