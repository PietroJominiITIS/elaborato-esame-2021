<?php

$db_host = 'localhost';
$db_name = 'elaborato';
$db_user = 'root';
$db_password = '';

$connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
