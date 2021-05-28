<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$case = $_GET['case'];
$box = $_GET['box'];
$description = $_POST['description'];
$doctype = $_POST['doctype'];
$date = $_POST['date'];
$court = $_SESSION['location'];

if ($description == null || $doctype == null || $date == null || $court == null || $box == null) {
    header("location: ../../pages/index.php?page=create&type=document&description=$description&date=$date&doctype=$doctype&box=$box&case=$case&error=true");
    die();
}

$query = "INSERT INTO Document(Box, Type, Description, AcquisitionDate) VALUES ('$box','$doctype','$description', '$date')";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case&box=$box");
