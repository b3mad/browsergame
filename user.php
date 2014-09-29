
<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Bitte erst <a href=\"index.php\">einloggen</a>";
    exit;
} else {
    // session_destroy();
}
include 'dbconnect.php';
$usr = $_SESSION["username"];

$result = mysql_query("SELECT * FROM spieler WHERE username = '$usr'");
if (!$result) {
    echo 'Konnte Abfrage nicht ausführen: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

$holz = $row[3];
$stein = $row[4];
$lehm = $row[5];
$gold = $row[6];
$holzPm = $row[7];
$steinPm = $row[8];
$lehmPm = $row[9];
$goldPm = $row[10];
$archer = $row[11];
$sword = $row[12];
$speicher = $row[13];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="author" content="Philippe Ruoss" />
            <meta name="Keywords" content="" />
            <meta name="Description" content="" />
                <meta http-equiv="refresh" content="; url=user.php" />
                <title>Browsergame | Strategia Imperialis</title>

            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/main.css" rel="stylesheet">

            <script type="text/javascript">

                //Timer Starten
                var timerStart = Date.now();
                
            </script>
        </head>
        <body>
            <!-- Header -->
            <div class="row">
                <div class="span12 centered-text">
                    <h1>Strategia Imperialis</h1>
                    <p>Wilkommen bei meinem Strategiespiel</p>
                </div>
            </div>

            <!-- Navigation mit Rohstoffanzeige -->
             <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" >Rohstoffe:</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><p class="navbar-text" id="holz">Holz: 100</p></li>
                    <li><p class="navbar-text" id="stein">Stein: 100</p></li>
                    <li><p class="navbar-text" id="lehm">Lehm: 100</p></li>
                    <li><p class="navbar-text" id="gold">Gold: 100</p></li>
                  </ul>
                  <div class="pull-right">
                    <ul class="nav pull-right">
                        <li><p class="navbar-text">Wilkommen, <?php echo ucfirst($usr)?></p></li>
                    </ul>
                  </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12 column">
                        <div class="row clearfix">
                            <div class="col-md-3 column">

                                <!-- Rohstoffe Upgrades -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-center">Rohstoffe-Upgrades</h4>
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item"><a href="javascript:check(1)">+10 Holz</a></li>
                                        <li class="list-group-item"><a href="javascript:check(2)">+10 Stein</a></li>
                                        <li class="list-group-item"><a href="javascript:check(3)">+10 Lehm</a></li>
                                        <li class="list-group-item"><a href="javascript:check(4)">+10 Gold</a></li>
                                    </ul>
                                </div> 

                                <!-- Truppen Upgrades -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-center">Truppen-Upgrades</h4>
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item"><a href="javascript:check(5)">+1 Schwertkämpfer</a></li>
                                        <li class="list-group-item"><a href="javascript:check(6)">+1 Bogenschützen</a></li>
                                    </ul>
                                </div> 
                            </div>                           
                            <div class="col-md-6 column">

                                <!-- Meldung -->
                                <div id="meldung" class="alert alert-info" role="alert"><b>Willkommen</b> bei Strategia Imperialis</div>

                                <!-- iFrame -->
                                <iframe src="http://www.game-2.de/game-2-content/bilder/browsergames/browser-games-die-siedler-staemme.gif" width="100%" height="420px">
                                  <p>Your browser does not support iframes.</p>
                                </iframe>   

                            </div>
                            <div class="col-md-3 column">

                                <!-- Speicher Übersicht -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-center">Speicher</h4>
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item"><p id="speicher">10000 Speichervolumen</p></li>
                                    </ul>
                                </div>        

                                <!-- Truppen Übersicht -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-center">Truppen</h4>
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item"><p id="sword">0 Schwertkämpfer</p></li>
                                        <li class="list-group-item"><p id="archer">0 Bogenschützen</p></li>
                                    </ul>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" >Verdienste pro Sekunde:</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><p class="navbar-text" id="holzPm">Holz: 10</p></li>
                    <li><p class="navbar-text" id="steinPm">Stein: 10</p></li>
                    <li><p class="navbar-text" id="lehmPm">Lehm: 10</p></li>
                    <li><p class="navbar-text" id="goldPm">Gold: 10</p></li>
                  </ul>
                  <div class="pull-right">
                    <ul class="nav pull-right">
                        <li><p class="navbar-text" id="zaehler">Time on Server: 0</p></li>
                    </ul>
                  </div> 
                </div>
            </nav>


            <script type="text/javascript">
                var holzPm = "<?php echo $holzPm ?>";
                var steinPm = "<?php echo $steinPm ?>";
                var lehmPm = "<?php echo $lehmPm ?>";
                var goldPm = "<?php echo $goldPm ?>";

                var holz = "<?php echo $holz ?>";
                var stein = "<?php echo $stein ?>";
                var lehm = "<?php echo $lehm ?>";
                var gold = "<?php echo $gold ?>";
                var sword = "<?php echo $sword ?>";
                var archer = "<?php echo $archer ?>";
                var speicher = "<?php echo $speicher ?>";

                status = 0;

                kostenlvl1 = 100;

                archer = 0;
                sword = 0;

                update();
                anzeige();

                function check(id) {

                    switch (id) {
                        case 1:
                            if (holz, stein, lehm, gold >= kostenlvl1) {
                                holzPm = holzPm * 2;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                        case 2:
                           if (holz, stein, lehm, gold >= kostenlvl1) {
                                steinPm = steinPm * 2;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                        case 3:
                            if (holz, stein, lehm, gold >= kostenlvl1) {
                                lehmPm = lehmPm * 2;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                        case 4:
                            if (holz, stein, lehm, gold >= kostenlvl1) {
                                goldPm = goldPm * 2;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                        case 5:
                            if (holz, stein, lehm, gold >= kostenlvl1) {
                                sword = sword + 1;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                        case 6:
                            if (holz, stein, lehm, gold >= kostenlvl1) {
                                archer = archer + 1;
                                bezahlen();
                                meldung("success");
                            }
                            else {
                                meldung("danger");
                            }
                            break;
                    }

                }


                function update() {
                    window.setInterval(
                            function erzeugen() {

                                holzPm = parseInt(holzPm, 10);
                                holz = parseInt(holz, 10);
                                holz = holz + holzPm;

                                steinPm = parseInt(steinPm, 10);
                                stein = parseInt(stein, 10);
                                stein = stein + steinPm;

                                lehmPm = parseInt(lehmPm, 10);
                                lehm = parseInt(lehm, 10);
                                lehm = lehm + lehmPm;

                                goldPm = parseInt(goldPm, 10);
                                gold = parseInt(gold, 10);
                                gold = gold + goldPm;

                            }, 1000);

                }


                function anzeige() {

                    var time = 0;

                    window.setInterval(
                            function() {
                                time = time + 1;

                                document.getElementById("zaehler").innerHTML = "Time on Server: " + time + "s";

                                document.getElementById("holz").innerHTML = "Holz: " + holz;
                                document.getElementById("stein").innerHTML = "Stein: " + stein;
                                document.getElementById("lehm").innerHTML = "Lehm: " + lehm;
                                document.getElementById("gold").innerHTML = "Gold: " + gold;

                                document.getElementById("holzPm").innerHTML = "Holz: " + holzPm;
                                document.getElementById("steinPm").innerHTML = "Stein: " + steinPm;
                                document.getElementById("lehmPm").innerHTML = "Lehm: " + lehmPm;
                                document.getElementById("goldPm").innerHTML = "Gold: " + goldPm;
                                document.getElementById("sword").innerHTML = sword + " Schwertkämpfer";
                                document.getElementById("archer").innerHTML = archer + " Bogenschützen";
                                document.getElementById("speicher").innerHTML = speicher + " Speichervolumen";
                            }, 1000);

                }

                function meldung(status) {
                    if (status == "success"){
                        document.getElementById("meldung").className = "alert alert-success";
                        document.getElementById("meldung").innerHTML = "<b>Glückwunsch!</b> Sie verdienen jetzt mehr";
                    } else if (status == "danger"){
                        document.getElementById("meldung").className = "alert alert-danger";
                        document.getElementById("meldung").innerHTML = "<b>Achtung!</b> Nicht genügend Ressourcen!";
                    } else if (status == "info"){
                        document.getElementById("meldung").className = "alert alert-info";
                        document.getElementById("meldung").innerHTML = "<b>Willkommen</b> bei Strategia Imperialis";
                    }
                }

                function bezahlen() {
                    holz = holz - kostenlvl1;
                    stein = stein - kostenlvl1;
                    lehm = lehm - kostenlvl1;
                    gold = gold - kostenlvl1;
                }

            </script>
        </body>
    </html>