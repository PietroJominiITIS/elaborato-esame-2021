<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$case = $_GET['case'];
$date = $_POST['date'];
$court = $_SESSION['location'];

if ($case == null || $date == null) {
    header("location: ../../pages/index.php?page=create&type=box&case=$case&date=$date&error=true");
    die();
}

$query = "INSERT INTO Box(CaseT, Location, ArchivingDate) VALUES ('$case', '$court','$date')";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case");
