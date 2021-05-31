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
    require_once('../partials/utils/conn.php');
    require_once('../partials/utils/md5.php');

    if ($_POST['location'] != null) {

        $cmd = $connection->prepare("SELECT Password FROM Court WHERE Location = '" . $_POST['location'] . "'");
        $cmd->execute();
        $row = $cmd->fetch();

        if (md5_digest($_POST['password']) == $row['Password']) {
            $_SESSION['location'] = $_POST['location'];
            header('location: index.php');
            die();
        } else {
            header('location: login.php?error=true');
            die();
        }
    }

    if ($_SESSION['location'] != null) {
        header('location: index.php');
        die();
    }

?>

    <form action="login.php" method="post">

        <?php if ($_GET['error'] != null) { ?> <div class="error">Wrong password</div> <?php } ?>

        <select name="location" id="reg">
            <?php
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
