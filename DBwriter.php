<?php
$con = mysql_connect("localhost", "root", "", "browsergame");
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



$meldung = "Es konnten keine Daten in die Datenbank geschrieben werden!";
$sql1 = "INSERT INTO spieler WHERE username='$usr' (holz, stein, lehm, gold, holzPm, steinPm, lehmPm, godlPm, sword, archer, speicher) VALUES ('$holz', '$stein', '$lehm', '$gold', '$holzPm', '$steinPm', '$lehmPm', '$goldPm', '$sword', '$archer', '$speicher')";
$sql2 = "SELECT * FROM spieler WHERE username='$usr'";


/*
  echo $holz;
  echo $stein;
  echo $lehm;
  echo $gold;
  echo $archer;
 */

if (isset($_SESSION['username'])) {
$eintragen = mysql_query($sql1, $con);
$auslesen = mysql_query($sql2, $con);
$row = mysql_fetch_row($auslesen);

$holzN = $row[3];
$steinN = $row[4];
$lehmN = $row[5];
$goldN = $row[6];
$holzPmN = $row[7];
$steinPmN = $row[8];
$lehmPmN = $row[9];
$goldPmN = $row[10];
$archerN = $row[11];
$swordN = $row[12];
$speicherN = $row[13];

}


//Array übergeben und nacher auslesen statt alle übergeben?
?>

