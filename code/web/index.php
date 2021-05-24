<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <?php

        session_start();

        if (isset($_SESSION['location'])) {
            print_r($_SESSION);
        } else {
            header('location: login.php');
        }

    ?>

</body>
</html>
