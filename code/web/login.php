<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

<?php

    session_start();

    if (isset($_POST['location'])) {

        # TODO check for correct login
        if (true) {
            $_SESSION['location'] = $_POST['location'];
            header('location: index.php');
        }
    }

    if (isset($_SESSION['location'])) {
        header('location: index.php');
    }

?>

    <form action="./login.php" method="post">

        <select name="location" id="reg">
            <option value="AL">AL</option>
            <option value="AT">AT</option>
            <option value="BI">BI</option>
            <option value="CN">CN</option>
            <option value="NO">NO</option>
            <option value="TO">TO</option>
            <option value="VB">VB</option>
            <option value="VC">VC</option>
        </select>

        <!-- TODO set password input to be "required" -->
        <input name="password" type="password" placeholder="password">
        <input type="submit" value="&rarr;">

    </form>

</body>
</html>
