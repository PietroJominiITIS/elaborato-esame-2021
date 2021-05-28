<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$case = $_GET['case'];
$box = $_GET['box'];
$place = $_POST['place'];
$date = $_POST['date'];
$court = $_SESSION['location'];

if ($place == null || $date == null || $court == null || $box == null) {
    header("location: ../../pages/index.php?page=create&type=report&place=$place&date=$date&box=$box&case=&case$error=true");
    die();
}

$query = "INSERT INTO Report(Box, Place, Date) VALUES ('$box','$place', '$date')";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case&box=$box");
