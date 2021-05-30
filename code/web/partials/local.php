<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/middlebar.css">

<div class="middlebar">
    <div class="title">Case</div>

    <?php
        $cmd = $connection->prepare("SELECT CaseID, Crime FROM CaseT WHERE Court = '" . $_SESSION['location'] . "'");
        $cmd->execute();

        foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $selected = ($row["CaseID"] == $_GET['case']) ? "selected" : "";
            $params = "?page=local&case=" . $row["CaseID"];
            echo "<a class='" . $selected . "' href='$params'>" . $row['CaseID'] . ' - ' . $row['Crime'] . "</a>";
        }
    ?>

    <?php
        $cmd = $connection->prepare("
            SELECT DISTINCT CaseID, Crime 
            FROM Box JOIN CaseT ON Box.CaseT = CaseT.CaseId
            WHERE Box.Location = '" . $_SESSION['location'] . "' AND Box.Location <> CaseT.Court AND Box.DeletionDate IS NULL
        ");
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
            $cmd = $connection->prepare("
                SELECT BoxID FROM Box 
                JOIN CaseT ON Box.CaseT = CaseT.CaseId 
                WHERE Location = '" . $_SESSION['location'] . "' and CaseT = '" . $_GET['case'] . "' AND Box.DeletionDate IS NULL
            ");
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
    <div class="container">

        <!-- document -->
        <div class="middlebar">
            <div class="title">Document</div>

            <?php
                $cmd = $connection->prepare("
                    SELECT DocumentID, Type FROM Document
                    JOIN Box ON Document.Box = Box.BoxId
                    WHERE Location = '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "' AND Box.DeletionDate IS NULL
                ");
                $cmd->execute();

                foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $params = "page=item&src=local&type=document&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['DocumentID'];
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
                    WHERE Location = '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'  AND Box.DeletionDate IS NULL
                ");
                $cmd->execute();

                foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $params = "page=item&src=local&type=evidence&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['EvidenceID'];
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
                    WHERE Location = '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'  AND Box.DeletionDate IS NULL
                ");
                $cmd->execute();

                foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $params = "page=item&src=local&type=report&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['ReportID'];
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
                    WHERE Location = '" . $_SESSION['location'] . "' and Box = '" . $_GET['box'] . "'  AND Box.DeletionDate IS NULL
                ");
                $cmd->execute();

                foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $params = "page=item&src=local&type=paper&case=" . $_GET['case'] . "&box=" . $_GET['box'] . "&id=" . $row['PaperID'];
                    echo "<a href='../pages/index.php?$params'>" . $row['PaperID'] . ' - ' . $row['PersonCF'] . "</a>";
                }
            ?>

            <a href="../pages/index.php?page=create&type=paper&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>" class="add">+</a>
        </div>
    </div>
</div>

<?php 
    $cmd = $connection->prepare("SELECT YEAR(ArchivingDate) AS ArchivingDate FROM Box WHERE BoxId = " . $_GET['box']);
    $cmd->execute();
    $archivingDate = $cmd->fetch()['ArchivingDate'];

    if (date("Y") - $archivingDate >= 50) { 
?>

    <div class="middlebar">
        <div class="title">Actions</div>
        <a href="../api/delete/box.php?box=<?php echo $_GET['box'] ?>&case=<?php echo $_GET['case'] ?>">Destroy</a>
    </div>

<?php } ?>

<?php } elseif ($_GET['case'] != null) { ?>

    <div class="middlebar">
        <div class="title">Actions</div>
        <a href="../pages/wip.html">Update</a>
    </div>

<?php } ?>
