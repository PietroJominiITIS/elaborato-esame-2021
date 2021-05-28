<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$case = $_GET['case'];
$box = $_GET['box'];
$description = $_POST['description'];
$label = $_POST['label'];
$date = $_POST['date'];
$court = $_SESSION['location'];

if ($description == null || $label == null || $date == null || $court == null || $box == null) {
    header("location: ../../pages/index.php?page=create&type=evidence&description=$description&date=$date&label=$label&box=$box&case=$case&error=true");
    die();
}

$query = "INSERT INTO Evidence(Box, Label, Description, AcquisitionDate) VALUES ('$box','$label','$description', '$date')";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case&box=$box");
