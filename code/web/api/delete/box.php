<?php
require_once('../../partials/utils/conn.php');
require_once('../../partials/utils/auth.php');

$id = $_GET['box'];
$case = $_GET['case'];
$location = $_SESSION['location'];

if ($id == null) die();

$query = "UPDATE Box SET DeletionDate = CURDATE() WHERE BoxId = $id AND Location = '$location' AND YEAR(CURDATE()) - YEAR(ArchivingDate) >= 50";
$cmd = $connection->prepare($query);
$cmd->execute();

header("location: ../../pages/index.php?page=local&case=$case");
