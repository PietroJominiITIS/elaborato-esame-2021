<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/login.css">
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

    <form action="login.php" method="post">

        <select name="location" id="reg">
            <?php 
                $db_host = 'localhost';
                $db_name = 'elaborato';
                $db_user = 'root';
                $db_password = '';

                $connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                $cmd = $connection->prepare("SELECT Location FROM Court");
                $cmd->execute();

                foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $court) {
                    echo "<option value=" . $court['Location'] . ">" . $court["Location"] . "</option>";
                }
            ?>
        </select>

        <!-- TODO set password input to be "required" -->
        <input name="password" type="password" placeholder="password">
        <input type="submit" value="&rarr;">

    </form>

</body>
</html>
