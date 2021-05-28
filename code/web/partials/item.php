<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/middlebar.css">

<?php  
    $type = $_GET['type']; 
    $id = $_GET['id'];    
?>

<div class="middlebar">
    <div class="title">Item coordinates</div>
    <div>Case: <?php echo $_GET['case'] ?></div>
    <div>Box: <?php echo $_GET['box'] ?></div>
    <div>Type: <?php echo ucfirst($_GET['type']) ?></div>
</div>

<div class="middlebar">
    <div class="title">Fields</div>

    <?php 
        if ($type == 'document') $query = "SELECT Type, Description, AcquisitionDate FROM Document WHERE DocumentID = '$id'";
        elseif ($type == 'evidence') $query = "SELECT Label, Description, AcquisitionDate FROM Evidence WHERE EvidenceID = '$id'";
        elseif ($type == 'report') $query = "SELECT Place, Date FROM Report WHERE ReportID = '$id'";
        elseif ($type == 'paper') $query = "SELECT Place, PersonCF as CF, RegistrationDate FROM Paper WHERE PaperID = $id";

        $cmd = $connection->prepare($query);
        $cmd->execute();
        $row = $cmd->fetch();
    
        foreach ($row as $key => $value) {
            if (!is_numeric($key)) echo "<div>$key: <b>$value</b></div>";
        }
    ?>

</div>

<div class="middlebar">
    <div class="title">Actions</div>
    <a href="../pages/index.php?page=local&case=<?php echo $_GET['case'] ?>&box=<?php echo $_GET['box'] ?>">Go back</a>
</div>
