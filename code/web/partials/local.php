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
            echo "<a class='" . $selected . "' href='$params'>" . $row['CaseID'] . ' - ' . $row['Crime'] . "</a>";
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

    <!-- document -->
    <div class="middlebar">
        <div class="title">Document</div>

        <?php
            $cmd = $connection->prepare("SELECT DocumentID, Type FROM Document WHERE Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<div>" . $row['DocumentID'] . ' - ' . $row['Type'] . "</div>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=document&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- evidence -->
    <div class="middlebar">
        <div class="title">Evidence</div>

        <?php
            $cmd = $connection->prepare("SELECT EvidenceID, Label FROM Evidence WHERE Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<div>" . $row['EvidenceID'] . ' - ' . $row['Label'] . "</div>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=evidence&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- report -->
    <div class="middlebar">
        <div class="title">Report</div>

        <?php
            $cmd = $connection->prepare("SELECT ReportID, Place FROM Report WHERE Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<div>" . $row['ReportID'] . ' - ' . $row['Place'] . "</div>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=report&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- paper -->
    <div class="middlebar">
        <div class="title">Paper</div>
        <a href="../pages/index.php?page=create&type=paper&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

<?php } ?>
