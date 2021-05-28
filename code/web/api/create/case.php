<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$year = $_POST['year'];
$crime = $_POST['crime'];
$court = $_SESSION['location'];

if ($year == null || $crime == null || $court == null) {
    header("location: ../../pages/index.php?page=create&type=case&crime=$crime&year=$year&error=true");
    die();
}

$query = "INSERT INTO CaseT(Crime, Year, Court) VALUES ('$crime',$year,'$court')";
$cmd = $connection->prepare($query);
$cmd->execute();

header('location: ../../pages/index.php?page=local');
