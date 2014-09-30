
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
                        <meta name="author" content="Philippe Ruoss, Olivier Alther" />
                        <meta name="Keywords" content="" />
                        <meta name="Description" content="" />
                        <meta http-equiv="refresh" content="; url=user.php" />
                        <title>Browsergame | Strategia Imperialis</title>

                        <link href="css/bootstrap.min.css" rel="stylesheet">
                            <link href="css/main.css" rel="stylesheet">

                                <script type="text/javascript">

                                    //Timer Starten
                                    var timerStart = Date.now();

                                    //Rohstoffe setzen
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

                                    //Einheiten setzen
                                    archer = 100;
                                    sword = 100;


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
                                                        <li><p class="navbar-text">Wilkommen, <?php echo ucfirst($usr) ?></p></li>
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
                                                                <li class="list-group-item"><a href="javascript:check(1)">+10 Holz</a><p id="kostenHolz1"></p><p id="kostenStein1"></p><p id="kostenLehm1"></p><p id="kostenGold1"></p></li>
                                                                <li class="list-group-item"><a href="javascript:check(2)">+10 Stein</a><p id="kostenHolz2"></p><p id="kostenStein2"></p><p id="kostenLehm2"></p><p id="kostenGold2"></p></li>
                                                                <li class="list-group-item"><a href="javascript:check(3)">+10 Lehm</a><p id="kostenHolz3"></p><p id="kostenStein3"></p><p id="kostenLehm3"></p><p id="kostenGold3"></p></li>
                                                                <li class="list-group-item"><a href="javascript:check(4)">+10 Gold</a><p id="kostenHolz4"></p><p id="kostenStein4"></p><p id="kostenLehm4"></p><p id="kostenGold4"></p></li>
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
                                                        <p id="ajaxmeldung"></p>

                                                        <!-- Kampffeld -->
                                                        <script type="text/javascript">
                                                            var rows = 4;
                                                            var columns = 5;
                                                            var ID = 0;
                                                            var str = "";
                                                            generateFieldValues();

                                                            str += '<table id="karten_container" class="table-condensed">'

                                                            for (i = 0; i < rows; i++) {
                                                                str += '<tr>'
                                                                for (j = 0; j < columns; j++) {
                                                                    str += '<td>' + '<a class="thumbnail" href="javascript:attack(' + ID + ')"><div id="' + ID + '" style="width:100%; height:100px;">' + (ID + 1) + '</div></a>' + '</td>'
                                                                    ID = ID + 1;
                                                                }
                                                                str += '</tr>'
                                                            }

                                                            str += '</table>'
                                                            document.write(str)

                                                            fieldSet();

                                                            function fieldSet() {
                                                                //Gegner in rot
                                                                document.getElementById(0).style.backgroundColor = "red";

                                                                //Neutral in blau
                                                                for (i = 1; i < 19; i++) {
                                                                    document.getElementById(i).style.backgroundColor = "blue";
                                                                }

                                                                //Eigene grün
                                                                document.getElementById(19).style.backgroundColor = "green";

                                                            }

                                                            function generateFieldValues() {

                                                                Felder = new Array(20);

                                                                for (i = 0; i < 20; i++) {
                                                                    Felder[i] = new Array();

                                                                    //Werte einfüllen

                                                                    //Schwert
                                                                    temp = Math.floor((Math.random() * 10) + 5);
                                                                    Felder[i][0] = temp;
                                                                    //Bogen
                                                                    temp = Math.floor((Math.random() * 6) + 2);
                                                                    Felder[i][1] = temp;
                                                                    //Sekunden
                                                                    temp = Math.floor((Math.random() * 10) + 1);
                                                                    Felder[i][2] = temp;
                                                                }

                                                            }

                                                            function attack(Feldnummer) {
                                                                var anzSchwert = Felder[Feldnummer][0];
                                                                var anzBogen = Felder[Feldnummer][1];
                                                                var anzSekunden = Felder[Feldnummer][2];

                                                                if (anzSchwert < sword && anzBogen < archer) {
                                                                    meldung("info", "angriff");
                                                                    sword = sword - anzSchwert;
                                                                    archer = archer - anzBogen;
                                                                    function angriff() {
                                                                        document.getElementById(Feldnummer).style.backgroundColor = "green";
                                                                        meldung("success", "angriff", anzSchwert, "Schwertkämpfer", anzBogen, "Bogenschützen");
                                                                    }
                                                                    setTimeout(angriff, (anzSekunden * 1000));
                                                                } else {
                                                                    meldung("danger", "angriff", anzSchwert, "Schwertkämpfer", anzBogen, "Bogenschützen");
                                                                }
                                                            }
                                                        </script>   

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

                                        konstruktor();

                                        //Wird beim ersten Programmstart ausgeführt
                                        function konstruktor() {
                                            kosten = 100;
                                            multiplikator = 1.2;

                                            lvlHolz = 1;
                                            lvlStein = 1;
                                            lvlLehm = 1;
                                            lvlGold = 1;

                                            //Anfangskosten Holzproduktion
                                            kostenHolz1 = 500;
                                            kostenStein1 = 600;
                                            kostenLehm1 = 400;
                                            kostenGold1 = 300;
                                            //Anfangskosten Steinproduktion
                                            kostenHolz2 = 750;
                                            kostenStein2 = 650;
                                            kostenLehm2 = 700;
                                            kostenGold2 = 1000;
                                            //Anfangskosten Lehmproduktion
                                            kostenHolz3 = 650;
                                            kostenStein3 = 500;
                                            kostenLehm3 = 400;
                                            kostenGold3 = 300;
                                            //Anfangskosten Goldproduktion
                                            kostenHolz4 = 100;
                                            kostenStein4 = 100;
                                            kostenLehm4 = 100;
                                            kostenGold4 = 1000;

                                            update();
                                            anzeige();
                                        }

                                        function check(id) {

                                            switch (id) {

                                                case 1:
                                                    if (holz >= kostenHolz1 && stein >= kostenStein1 && lehm >= kostenLehm1 && gold >= kostenGold1) {
                                                        holzPm = holzPm * 1.2;
                                                        holz = holz - kostenHolz1;
                                                        stein = stein - kostenStein1;
                                                        lehm = lehm - kostenLehm1;
                                                        gold = gold - kostenGold1;

                                                        kostenHolz1 = kostenHolz1 * multiplikator;
                                                        kostenStein1 = kostenStein1 * multiplikator;
                                                        kostenLehm1 = kostenLehm1 * multiplikator;
                                                        kostenGold1 = kostenGold1 * multiplikator;

                                                        lvlHolz = lvlHolz + 1;
                                                        meldung("success", "rohstoffKauf", holzPm, "Holz");
                                                    }
                                                    else {
                                                        meldung("danger", "rohstoffKauf", holzPm, "Holz");
                                                    }
                                                    break;

                                                case 2:
                                                    if (holz >= kostenHolz2 && stein >= kostenStein2 && lehm >= kostenLehm2 && gold >= kostenGold2) {
                                                        steinPm = steinPm * 1.2;
                                                        holz = holz - kostenHolz2;
                                                        stein = stein - kostenStein2;
                                                        lehm = lehm - kostenLehm2;
                                                        gold = gold - kostenGold2;

                                                        kostenHolz2 = kostenHolz2 * multiplikator;
                                                        kostenStein2 = kostenStein2 * multiplikator;
                                                        kostenLehm2 = kostenLehm2 * multiplikator;
                                                        kostenGold2 = kostenGold2 * multiplikator;

                                                        lvlStein = lvlStein + 1;
                                                        meldung("success", "rohstoffKauf", steinPm, "Stein");
                                                    }
                                                    else {
                                                        meldung("danger", "rohstoffKauf", steinPm, "Stein");
                                                    }
                                                    break;

                                                case 3:
                                                    if (holz >= kostenHolz3 && stein >= kostenStein3 && lehm >= kostenLehm3 && gold >= kostenGold3) {
                                                        lehmPm = lehmPm * 1.2;
                                                        holz = holz - kostenHolz3;
                                                        stein = stein - kostenStein3;
                                                        lehm = lehm - kostenLehm3;
                                                        gold = gold - kostenGold3;

                                                        kostenHolz3 = kostenHolz3 * multiplikator;
                                                        kostenStein3 = kostenStein3 * multiplikator;
                                                        kostenLehm3 = kostenLehm3 * multiplikator;
                                                        kostenGold3 = kostenGold3 * multiplikator;

                                                        lvlLehm = lvlLehm + 1;
                                                        meldung("success", "rohstoffKauf", lehmPm, "Lehm");
                                                    }
                                                    else {
                                                        meldung("danger", "rohstoffKauf", lehmPm, "Lehm");
                                                    }
                                                    break;

                                                case 4:
                                                    if (holz >= kostenHolz4 && stein >= kostenStein4 && lehm >= kostenLehm4 && gold >= kostenGold4) {
                                                        goldPm = goldPm * 1.2;
                                                        holz = holz - kostenHolz4;
                                                        stein = stein - kostenStein4;
                                                        lehm = lehm - kostenLehm4;
                                                        gold = gold - kostenGold4;

                                                        kostenHolz4 = kostenHolz4 * multiplikator;
                                                        kostenStein4 = kostenStein4 * multiplikator;
                                                        kostenLehm4 = kostenLehm4 * multiplikator;
                                                        kostenGold4 = kostenGold4 * multiplikator;

                                                        lvlGold = lvlGold + 1;
                                                        meldung("success", "rohstoffKauf", goldPm, "Gold");
                                                    }
                                                    else {
                                                        meldung("danger", "rohstoffKauf", goldPm, "Gold");
                                                    }
                                                    break;

                                                case 5:
                                                    if (holz, stein, lehm, gold >= kosten) {
                                                        sword = sword + 1;
                                                        bezahlenEinfach(1);
                                                        meldung("success", "einheitenKauf", sword, "Schwertkämpfer");
                                                    }
                                                    else {
                                                        meldung("danger", "einheitenKauf", sword, "Schwertkämpfer");
                                                    }
                                                    break;

                                                case 6:
                                                    if (holz, stein, lehm, gold >= kosten) {
                                                        archer = archer + 1;
                                                        bezahlenEinfach(2);
                                                        meldung("success", "einheitenKauf", archer, "Bogenschützen");
                                                    }
                                                    else {
                                                        meldung("danger", "einheitenKauf", archer, "Bogenschützen");
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
                                                        //Ressis
                                                        document.getElementById("holz").innerHTML = "Holz: " + holz;
                                                        document.getElementById("stein").innerHTML = "Stein: " + stein;
                                                        document.getElementById("lehm").innerHTML = "Lehm: " + lehm;
                                                        document.getElementById("gold").innerHTML = "Gold: " + gold;
                                                        //Ressis per minute
                                                        document.getElementById("holzPm").innerHTML = "Holz: " + holzPm;
                                                        document.getElementById("steinPm").innerHTML = "Stein: " + steinPm;
                                                        document.getElementById("lehmPm").innerHTML = "Lehm: " + lehmPm;
                                                        document.getElementById("goldPm").innerHTML = "Gold: " + goldPm;
                                                        //Soldaten
                                                        document.getElementById("sword").innerHTML = sword + " Schwertkämpfer";
                                                        document.getElementById("archer").innerHTML = archer + " Bogenschützen";
                                                        //Speicher
                                                        document.getElementById("speicher").innerHTML = speicher + " Speichervolumen";
                                                        //Anzeige Kosten Holz Upgrade
                                                        document.getElementById("kostenHolz1").innerHTML = "Kosten Holz: " + kostenHolz1;
                                                        document.getElementById("kostenStein1").innerHTML = "Kosten Stein: " + kostenStein1;
                                                        document.getElementById("kostenLehm1").innerHTML = "Kosten Lehm: " + kostenLehm1;
                                                        document.getElementById("kostenGold1").innerHTML = "Kosten Gold: " + kostenGold1;
                                                        //Anzeige Kosten Stein Upgrade
                                                        document.getElementById("kostenHolz2").innerHTML = "Kosten Holz: " + kostenHolz2;
                                                        document.getElementById("kostenStein2").innerHTML = "Kosten Stein: " + kostenStein2;
                                                        document.getElementById("kostenLehm2").innerHTML = "Kosten Lehm: " + kostenLehm2;
                                                        document.getElementById("kostenGold2").innerHTML = "Kosten Gold: " + kostenGold2;
                                                         //Anzeige Kosten Lehm Upgrade
                                                        document.getElementById("kostenHolz3").innerHTML = "Kosten Holz: " + kostenHolz3;
                                                        document.getElementById("kostenStein3").innerHTML = "Kosten Stein: " + kostenStein3;
                                                        document.getElementById("kostenLehm3").innerHTML = "Kosten Lehm: " + kostenLehm3;
                                                        document.getElementById("kostenGold3").innerHTML = "Kosten Gold: " + kostenGold3;
                                                        //Anzeige Kosten Gold Upgrade
                                                        document.getElementById("kostenHolz4").innerHTML = "Kosten Holz: " + kostenHolz4;
                                                        document.getElementById("kostenStein4").innerHTML = "Kosten Stein: " + kostenStein4;
                                                        document.getElementById("kostenLehm4").innerHTML = "Kosten Lehm: " + kostenLehm4;
                                                        document.getElementById("kostenGold4").innerHTML = "Kosten Gold: " + kostenGold4;
                                                        ajaxwrite();
                                                    }, 1000);

                                        }

                                        function meldung(status, betreff, anzahl, einheit, anzahl2, einheit2) {

                                            if (status == "success") {
                                                document.getElementById("meldung").className = "alert alert-success";

                                                if (betreff == "rohstoffKauf") {
                                                    document.getElementById("meldung").innerHTML = "<b>Glückwunsch!</b> Sie verdienen jetzt " + anzahl + " " + einheit + " pro Sekunde";
                                                }
                                                if (betreff == "einheitenKauf") {
                                                    document.getElementById("meldung").innerHTML = "<b>Glückwunsch!</b> Sie besitzen jetzt " + anzahl + " " + einheit + "";
                                                }
                                                if (betreff == "angriff") {
                                                    document.getElementById("meldung").innerHTML = "<b>Glückwunsch!</b> Du hast ein neues Feld erobert. Dabei sind " + anzahl + " " + einheit + " und " + anzahl2 + " " + einheit2 + " gestorben";
                                                }
                                            }

                                            else if (status == "danger") {
                                                document.getElementById("meldung").className = "alert alert-danger";

                                                if (betreff == "rohstoffKauf") {
                                                    document.getElementById("meldung").innerHTML = "<b>Achtung!</b> Nicht genügend Ressourcen!";
                                                }
                                                if (betreff == "einheitenKauf") {
                                                    document.getElementById("meldung").innerHTML = "<b>Achtung!</b> Nicht genügend Ressourcen!";
                                                }
                                                if (betreff == "angriff") {
                                                    document.getElementById("meldung").innerHTML = "<b>Achtung!</b> Du besitzt zu wenig Einheiten. Es werden mindestens  " + anzahl + " " + einheit + " und " + anzahl2 + " " + einheit2 + " benötigt";
                                                }
                                            }

                                            else if (status == "info") {
                                                document.getElementById("meldung").className = "alert alert-info";
                                                document.getElementById("meldung").innerHTML = "<b>Willkommen</b> bei Strategia Imperialis";

                                                if (betreff == "angriff") {
                                                    document.getElementById("meldung").innerHTML = "<b>Achtung!</b> Angriff läuft!";
                                                }
                                            }
                                        }

                                        function bezahlenEinfach(Nr2) {
                                            switch (Nr2) {
                                                case 1:
                                                    holz = holz - 100;
                                                    stein = stein - 100;
                                                    lehm = lehm - 100;
                                                    gold = gold - 100;

                                                case 2:
                                                    holz = holz - 100;
                                                    stein = stein - 100;
                                                    lehm = lehm - 100;
                                                    gold = gold - 100;
                                            }

                                        }


                                        function ajaxwrite() {
                                            //Create XHR instance
                                            var xhr;
                                            if (window.XMLHttpRequest) {
                                                xhr = new XMLHttpRequest();
                                            }
                                            else if (window.ActiveXObject) {
                                                xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                            }
                                            else {
                                                throw new Error("Ajax is not supported by this browser");
                                            }

                                            // 2. Define what to do when XHR feed you the response from the server
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4) {
                                                    if (xhr.status == 200 && xhr.status < 300) {
                                                        document.getElementById("ajaxmeldung").innerHTML = xhr.responseText;
                                                    }
                                                }
                                            }

                                            // 3. Specify your action, location and Send to the server - Start
                                            xhr.open('GET', 'DBwriter.php?holz=' + holz + '&stein=' + stein + '&lehm=' + lehm + '&gold=' + gold + '&holzPm=' + holzPm + '&steinPm=' + steinPm + '&lehmPm= ' + lehmPm + '&goldPm=' + goldPm + '&sword=' + sword + '&archer=' + archer + '&speicher=' + speicher, true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.send();
                                        }

                                    </script>
                                </body>
                                </html>