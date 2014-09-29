<?php

$con = mysql_connect("localhost", "root", "", "browsergame");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$db_selected = mysql_select_db("browsergame", $con);

if (!$db_selected)
  {
  die ("Can\'t use test_db : " . mysql_error());
  }

?>