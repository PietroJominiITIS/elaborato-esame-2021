<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>

<div style="padding: 1em;">

    <?php if ($_GET['type'] == 'case') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/case.php" method="post">
            <input type="text" name="crime" value="<?php echo $_GET['crime'] ?>" placeholder="Crime">
            <input type="number" name="year" value="<?php echo $_GET['year'] ?>"  min="0" max="9999" placeholder="Year">
            <button value="submit">Create</button>
        </form>

    <?php } ?>

    <?php if ($_GET['type'] == 'box') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/box.php?case=<?php echo $_GET['case'] ?>" method="post">
            <input type="date" name="date" value="<?php echo $_GET['date'] ?>">
            <button value="submit">Create</button>
        </form>

    <?php } ?>

    <?php if ($_GET['type'] == 'document') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/document.php?box=<?php echo $_GET['box'] ?>&case=<?php echo $_GET['case'] ?>" method="post">
            <select name="doctype">
                <?php 
                    $cmd = $connection->prepare("SELECT Name FROM DocumentType");
                    $cmd->execute();

                    foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $name = $row['Name'];
                        $selected = ($row['Name'] == $_GET['doctype']) ? "selected" : "";
                        echo "<option value='$name' $selected>$name</option>";
                    }
                ?>
            </select>
            <input type="text" name="description" placeholder="Description" value="<?php echo $_GET['description'] ?>">
            <input type="date" name="date" value="<?php echo $_GET['date'] ?>">
            <button value="submit">Create</button>
        </form>

    <?php } ?>

    <?php if ($_GET['type'] == 'evidence') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/evidence.php?box=<?php echo $_GET['box'] ?>&case=<?php echo $_GET['case'] ?>" method="post">
            <form action="">
                <input type="text" name="description" placeholder="Description" value="<?php echo $_GET['description'] ?>">
                <input type="text" name="label" placeholder="Label" value="<?php echo $_GET['label'] ?>">
                <input type="date" name="date" value="<?php echo $_GET['date'] ?>">
                <button value="submit">Create</button>
            </form>
        </form>

    <?php } ?>

    <?php if ($_GET['type'] == 'report') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/report.php?box=<?php echo $_GET['box'] ?>&case=<?php echo $_GET['case'] ?>" method="post">
            <form action="">
                <input type="text" name="place" placeholder="Place" value="<?php echo $_GET['place'] ?>">
                <input type="date" name="date" value="<?php echo $_GET['date'] ?>">
                <button value="submit">Create</button>
            </form>
        </form>

    <?php } ?>

    <?php if ($_GET['type'] == 'paper') { 
        if ($_GET['error'] != null) echo '<div class="error">Missing fields!</div>';
    ?>

        <form action="../api/create/paper.php?box=<?php echo $_GET['box'] ?>&case=<?php echo $_GET['case'] ?>" method="post">
            <form action="">
                <input type="text" name="place" placeholder="Place" value="<?php echo $_GET['place'] ?>">
                <input type="text" name="cf" placeholder="CF" value="<?php echo $_GET['cf'] ?>">
                <input type="date" name="date" value="<?php echo $_GET['date'] ?>">
                <button value="submit">Create</button>
            </form>
        </form>

    <?php } ?>

</div>
