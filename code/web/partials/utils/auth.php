<?php
session_start();

if ($_SESSION['location'] == null) {
    header('location: login.php');
    die();
}
