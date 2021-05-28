<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/middlebar.css">

<div class="middlebar">
    <div class="title">Case</div>

    <?php
        $cmd = $connection->prepare("SELECT CaseID, Crime FROM CaseT WHERE Court <> '" . $_SESSION['location'] . "'");
        $cmd->execute();

        foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $selected = ($row["CaseID"] == $_GET['case']) ? "selected" : "";
            $params = "?page=global&case=" . $row["CaseID"];
            echo "<a class='" . $selected . "' href='$params'>" . $row['CaseID'] . ' - ' . $row['Crime'] . "</a>";
        }
    ?>

    <a href="../pages/index.php?page=global&type=case" class="add">+</a>
</div>

<?php if($_GET['case'] != null) { ?>

    <div class="middlebar">
        <div class="title">Box</div>

        <?php
            $cmd = $connection->prepare("
                SELECT BoxID FROM Box 
                JOIN CaseT ON Box.CaseT = CaseT.CaseId 
                WHERE Court <> '" . $_SESSION['location'] . "' and CaseT = '" . $_GET['case'] . "'
            ");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $selected = ($row["BoxID"] == $_GET['box']) ? "selected" : "";
                $params = "?page=global&case=" . $_GET["case"] . '&box=' . $row["BoxID"];
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
            $cmd = $connection->prepare("
                SELECT DocumentID, Type FROM Document
                JOIN Box ON Document.Box = Box.BoxId
                WHERE Location <> '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $params = "page=item&type=document&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['DocumentID'];
                echo "<a href='../pages/index.php?$params'>" . $row['DocumentID'] . ' - ' . $row['Type'] . "</a>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=document&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- evidence -->
    <div class="middlebar">
        <div class="title">Evidence</div>

        <?php
            $cmd = $connection->prepare("
                SELECT EvidenceID, Label FROM Evidence
                JOIN Box ON Evidence.Box = Box.BoxId
                WHERE Location <> '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $params = "page=item&type=evidence&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['EvidenceID'];
                echo "<a href='../pages/index.php?$params'>" . $row['EvidenceID'] . ' - ' . $row['Label'] . "</a>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=evidence&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- report -->
    <div class="middlebar">
        <div class="title">Report</div>

        <?php
            $cmd = $connection->prepare("
                SELECT ReportID, Place FROM Report
                JOIN Box ON Report.Box = Box.BoxId
                WHERE Location <> '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $params = "page=item&type=report&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['ReportID'];
                echo "<a href='../pages/index.php?$params'>" . $row['ReportID'] . ' - ' . $row['Place'] . "</a>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=report&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

    <!-- paper -->
    <div class="middlebar">
        <div class="title">Paper</div>

        <?php
            $cmd = $connection->prepare("
                SELECT PaperID, PersonCF FROM Paper
                JOIN Box ON Paper.Box = Box.BoxId
                WHERE Location <> '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'");
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $params = "page=item&type=paper&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['PaperID'];
                echo "<a href='../pages/index.php?$params'>" . $row['PaperID'] . ' - ' . $row['PersonCF'] . "</a>";
            }
        ?>

        <a href="../pages/index.php?page=create&type=paper&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
    </div>

<?php } ?>
