<?php

if (isset($_POST['submit'])) {

    include 'dbconnect.php';

    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    $usr = ($_POST['username']);
    $pas = ($_POST['password']);

    $query = "SELECT * FROM spieler WHERE username='$usr' AND password='$pas'";

    $result = mysql_query($query) or die(mysql_error());
    $count = mysql_num_rows($result);
      
    if ($count == 1) {
        $row = mysql_fetch_array($result);
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged'] = TRUE;
        header("Location: home.php"); // Modify to go to the page you would like 
        exit;
    } else {
        header("Location: test1.php");
        exit;
    }
} else {    //If the form button wasn't submitted go to the index page, or login page 
    header("Location: test2.php");
    exit;
}
?>