<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$case = $_GET['case'];
$box = $_GET['box'];
$place = $_POST['place'];
$cf = $_POST['cf'];
$date = $_POST['date'];
$court = $_SESSION['location'];

if ($place == null || $cf == null || $date == null || $court == null || $box == null) {
    header("location: ../../pages/index.php?page=create&type=paper&place=$place&date=$date&cf=$cf&box=$box&case=$case&error=true");
    die();
}

$query = "INSERT INTO Paper(Box, Place, PersonCF, RegistrationDate) VALUES ('$box','$place','$cf', '$date')";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case&box=$box");
