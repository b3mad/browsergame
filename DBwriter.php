<?php

$con = mysql_connect("localhost", "root", "root", "browsergame");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db("browsergame", $con);

if (!$db_selected) {
    die("Can\'t use database : " . mysql_error());
}

session_start();
$usr = $_SESSION["username"];
$holz = $_GET['holz'];
$stein = $_GET['stein'];
$lehm = $_GET['lehm'];
$gold = $_GET['gold'];
$holzPm = $_GET['holzPm'];
$steinPm = $_GET['steinPm'];
$lehmPm = $_GET['lehmPm'];
$goldPm = $_GET['goldPm'];
$sword = $_GET['sword'];
$archer = $_GET['archer'];
$speicher = $_GET['speicher'];







/*
echo $holz;
echo $stein;
echo $lehm;
echo $gold;
echo $archer;
*/

if (isset($_SESSION['username'])) {

    $sql1 = "UPDATE table
SET holz = '$holz',
    stein = '$stein',
    lehm = '$lehm',
    gold = '$gold',
    holzPm = '$holzPm',
    steinPm = '$steinPm',
    lehmPm = '$lehmPm',
    goldPm = '$goldPm',
    sword = '$sword',
    archer = '$archer',
    speicher = '$speicher',
WHERE username='$usr'";

    $sql2 = "SELECT * FROM spieler WHERE username='$usr'";
    $eintragen = mysql_query($sql1, $con);
    $auslesen = mysql_query($sql2, $con);
    $row = mysql_fetch_row($auslesen);

    if ($eintragen == true) {
        echo "Eintrag war erfolgreich";
    } else {
        echo "Fehler beim Speichern";
    }

}


//Array übergeben und nacher auslesen statt alle übergeben?
?>
