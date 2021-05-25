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
        </div>

    </div>

    <div class="page">
        <?php  if ($_GET['page'] == 'local') { ?>
            local page
        <?php } ?>

        <?php  if ($_GET['page'] == 'global') { ?>
            global page
        <?php } ?>

        <?php  if ($_GET['page'] == 'transactions') { ?>
            transactions page
        <?php } ?>
    </div>

</body>
</html>
