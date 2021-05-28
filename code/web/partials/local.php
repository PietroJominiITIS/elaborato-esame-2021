<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/middlebar.css">

<div class="middlebar">
    <div class="title">Case</div>

    <?php
        $cmd = $connection->prepare("SELECT CaseID, Crime FROM CaseT");
        $cmd->execute();

        foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $selected = ($row["CaseID"] == $_GET['case']) ? "selected" : "";
            $params = "?page=local&case=" . $row["CaseID"];
            echo "<a class='" . $selected . "' href='$params'>" . $row['Crime'] . "</a>";
        }
    ?>

    <a href="../pages/index.php?page=create&type=case" class="add">+</a>
</div>

<?php if($_GET['case'] != null) { ?>

    <div class="middlebar">
        <div class="title">Box</div>

        <?php
            $cmd = $connection->prepare("SELECT BoxID FROM Box WHERE CaseT = '" . $_GET['case'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $selected = ($row["BoxID"] == $_GET['box']) ? "selected" : "";
                $params = "?page=local&case=" . $_GET["case"] . '&box=' . $row["BoxID"];
                echo "<a class='" . $selected . "' href='$params'>" . $row['BoxID'] . "</a>";
            }
        ?>

    <a href="../pages/index.php?page=create&type=box&case=<?php echo $_GET['case'] ?>" class="add">+</a>
    </div>

<?php } ?>

<?php if($_GET['box'] != null) { ?>

    <div class="middlebar">
        <div class="title">Items</div>
        <a href="#" class="add">+</a>
    </div>

<?php } ?>