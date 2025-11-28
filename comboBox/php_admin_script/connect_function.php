<?php
$hostName = "localhost";
$userName = "root";
$pass = "!!Break@@4444";
$dbName = "equipments";

$mysqli = new mysqli($hostName, $userName, $pass, $dbName) or die ($mysqli->error);
?>