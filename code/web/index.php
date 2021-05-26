<?php
session_start();

if ($_SESSION['location'] == null) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard <?php echo $_SESSION['location'] ?></title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

    <div class="navbar">

        <div class="picture"></div>
        <div class="pages">
            <a href="?page=local" class="<?php  if ($_GET['page'] == 'local') echo 'selected' ?>">Local warehouse</a>
            <a href="?page=global" class="<?php  if ($_GET['page'] == 'global') echo 'selected' ?>">Global catalog</a>
            <a href="?page=transactions" class="<?php  if ($_GET['page'] == 'transactions') echo 'selected' ?>">Transactions</a>
            <a href="?page=queries" class="<?php  if ($_GET['page'] == 'queries') echo 'selected' ?>">Queries</a>
        </div>

    </div>

    <div class="page">
        <?php  if ($_GET['page'] == 'local') { ?>

            <div class="middle-bar">
                <div class="tree">
                    <div class="case">
                        <div class="title">case</div>
                        <div class="box">
                            <div class="title">box1</div>
                            <a href="?page=local&item=a" class="<?php  if ($_GET['item'] == 'a') echo 'selected' ?>">item a</a>
                            <a href="?page=local&item=b" class="<?php  if ($_GET['item'] == 'b') echo 'selected' ?>">item b</a>
                            <a href="?page=local&item=c" class="<?php  if ($_GET['item'] == 'c') echo 'selected' ?>">item c</a>
                        </div>
                        <div class="box">
                            <div class="title">box2</div>
                            <a href="?page=local&item=a1" class="<?php  if ($_GET['item'] == 'a1') echo 'selected' ?>">item a</a>
                            <a href="?page=local&item=b1" class="<?php  if ($_GET['item'] == 'b1') echo 'selected' ?>">item b</a>
                            <a href="?page=local&item=c1" class="<?php  if ($_GET['item'] == 'c1') echo 'selected' ?>">item c</a>
                        </div>
                    </div>
                </div>

                <a href="./wip.html" class="add">+</a>
            </div>

        <?php } ?>

        <?php  if ($_GET['page'] == 'global') { ?>
            global page
        <?php } ?>

        <?php  if ($_GET['page'] == 'transactions') { ?>
            transactions page
        <?php } ?>

        <?php  if ($_GET['page'] == 'queries') { ?>
            queries page
        <?php } ?>
    </div>
</body>
</html>
