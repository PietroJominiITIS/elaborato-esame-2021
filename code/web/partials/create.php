<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/page.css">

<div class="page">

    <?php if ($_GET['type'] == 'case') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/case.php" method="post">
            <input type="text" name="crime" value="<?php echo $_GET['crime'] ?>" placeholder="Crime">
            <input type="number" name="year" value="<?php echo $_GET['year'] ?>"  min="0" max="9999" placeholder="Year">
            <button value="submit">Create</button>
        </form>

    <?php } ?>

</div>
