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
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/index.css">
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
        <div class="logout">
            <a href="logout.php">Logout</a>
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

                <a href="?page=create" class="add">+</a>
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

        <?php  if ($_GET['page'] == 'create') { ?>

            <div class="middle-bar create">
                <a href="?page=create&type=case">Add case</a>
                <a href="?page=create&type=box">Add box</a>
                <a href="?page=create&type=document">Add document</a>
                <a href="?page=create&type=evidence">Add evidence</a>
                <a href="?page=create&type=report">Add report</a>
                <a href="?page=create&type=paper">Add paper</a>
            </div>

            <div class="content">
                <?php  if ($_GET['type'] == 'case') { ?>
                    <form action="">
                        <input type="text" name="name" placeholder="Crime">
                        <input type="date">
                        <button value="submit">Create</button>
                    </form>
                <?php } ?>

                <?php  if ($_GET['type'] == 'box') { ?>
                    <form action="">
                        <select name="case">
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="d">d</option>
                        </select>
                        <input type="date">
                        <button value="submit">Create</button>
                    </form>
                <?php } ?>

                <?php if (in_array($_GET['type'], array("document", "evidence", "report", "paper"))) $box_sel_form = '
                    <select name="case">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                    </select>
                    <select name="box">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                '; ?>

                <?php  if ($_GET['type'] == 'document') { ?>
                    <form action="">
                        <?php echo $box_sel_form ?>
                        <select name="type">
                            <option value="image">Image</option>
                            <option value="song">Song</option>
                            <option value="boh">Boh</option>
                        </select>
                        <input type="text" name="description" placeholder="description">
                        <input type="date">
                        <button value="submit">Create</button>
                    </form>
                <?php } ?>

                <?php  if ($_GET['type'] == 'evidence') { ?>
                    <form action="">
                        <?php echo $box_sel_form ?>
                        <input type="text" name="description" placeholder="description">
                        <input type="text" name="label" placeholder="label">
                        <input type="date">
                        <button value="submit">Create</button>
                    </form>
                <?php } ?>

                <?php  if ($_GET['type'] == 'report') { ?>
                    <form action="">
                        <?php echo $box_sel_form ?>
                        <input type="text" name="place" placeholder="place">
                        <input type="date">
                        <button value="submit">Create</button>
                    </form>
                <?php } ?>

                <?php  if ($_GET['type'] == 'paper') { ?>
                    WIP
                <?php } ?>
            </div>

        <?php } ?>
    </div>
</body>
</html>
