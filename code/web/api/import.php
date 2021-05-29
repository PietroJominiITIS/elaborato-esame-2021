<?php
require_once('../partials/utils/conn.php');
require_once('../partials/utils/auth.php');

$case = $_GET['case'];
$box = $_GET['box'];
$court = $_SESSION['location'];

if ($case == null || $box == null) {
    echo 'Error: missing data';
    die();
}

$query = "SELECT Location FROM Box WHERE BoxID = '$box'";
$cmd = $connection->prepare($query);
$cmd->execute();
$origin = $cmd->fetch()['Location'];

$query = "INSERT INTO Transition(Box, FromL, ToL, Status) VALUES ($box, '$origin', '$court', 'Requested')";
$connection->prepare($query)->execute();

header('location: ../pages/index.php?page=transitions');