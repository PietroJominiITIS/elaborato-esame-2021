<?php

session_start();
unset($_SESSION['location']);
header('location: login.php');
