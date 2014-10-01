<?php

if (isset($_POST['submit'])) {

	$msg = '';
    include 'dbconnect.php';

    $username = ($_POST['username']);
    $password = ($_POST['password']);

    $query = "SELECT * FROM spieler WHERE username='$username' AND password='$password'";

    $result = mysql_query($query) or die(mysql_error());
    $count = mysql_num_rows($result);
      
    if ($count == 1) {
        $row = mysql_fetch_array($result);
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged'] = TRUE;
        header("Location: home.php"); 
        exit;
    } else {
        $msg = "Benutzername und Passwort stimmt nicht!";
    }
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Browsergame | Strategia Imperialis | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Philippe Ruoss, Olivier Alther" />
	<!-- Bootstrap -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />

	<link href="http://fonts.googleapis.com/css?family=Abel|Open+Sans:400,600" rel="stylesheet" />

	<link href="css/login.css" rel="stylesheet">
	<script type="text/javascript">
		function chkFormular () {
		  if (document.Formular.username.value == "") {
		    document.Formular.username.focus();
		    return false;
		  }
		  if (document.Formular.password.value == "") {
		    document.Formular.password.focus();
		    return false;
		  }
		}
	</script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 panel panel-default">

				<h1 class="margin-base-vertical">Strategia Imperialis</h1>

				<p>
					Strategia Imperialis ist ein Browsergame, das im Mittelalter spielt. Jeder Spieler ist Herrscher eines kleinen Dorfes, dem er zu Ruhm und Macht verhelfen soll.
				</p>

				<form class="margin-base-vertical" action="index.php" method="post" onsubmit="return chkFormular()" name="Formular">
					<p class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control input-lg" name="username" placeholder="username" />
					</p>
					<p class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="password" class="form-control input-lg" name="password" placeholder="password" />
					</p>
					<p class="help-block text-center"><small>Noch keinen Account? <a href="registrieren.php">Klick hier!</a></small></p>
					<p class="text-center">
						<button type="submit" name="submit" class="btn btn-success btn-lg">Login</button>
					</p>
					<span class="fehlermeldung" style="color: red;"><?php echo $msg;?></span>
				</form>
			</div>
		</div>
	</div> 

</body>
</html>