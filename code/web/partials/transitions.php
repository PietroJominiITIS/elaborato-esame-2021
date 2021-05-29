<?php require_once('../partials/utils/conn.php'); ?>
<?php require_once('../partials/utils/auth.php'); ?>
<link rel="stylesheet" href="../css/middlebar.css">

<div class="middlebar">
    <div class="title">Waiting acceptance</div>

    <?php 
    
        $court = $_SESSION["location"];
        $query = "SELECT * FROM Transition WHERE Status = 'Requested' AND ToL = '$court'";
        $cmd = $connection->prepare($query);
        $cmd->execute();

        foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo "<div>Box " . $row['Box'] . " from " . $row['FromL'] . "</div>";
        }
    ?>
</div>

<div class="middlebar">
    <div class="title">To accept</div>

    <?php 
    
        $court = $_SESSION["location"];
        $query = "SELECT * FROM Transition WHERE Status = 'Requested' AND FromL = '$court'";
        $cmd = $connection->prepare($query);
        $cmd->execute();

        foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $selected = ($_GET['accept'] == $row['TransitionId']) ? 'selected' : '';
            echo "<a class='$selected' href='?page=transitions&accept=" . $row["TransitionId"] . "'>Box " . $row['Box'] . " to " . $row['ToL'] . "</a>";
        }
    ?>
</div>

<?php if ($_GET["accept"] != null) { ?>

    <div class="middlebar">
        <div class="title">Accept</div>
        <a href="?page=local&<?php
            $query = "SELECT CaseT, BoxId FROM Transition JOIN Box ON Transition.Box = Box.BoxId WHERE Transition.TransitionId = " . $_GET['accept'];
            $cmd = $connection->prepare($query);
            $cmd->execute();
            $row = $cmd->fetch();

            echo 'box=' . $row["BoxId"] . '&case=' . $row["CaseT"];
        ?>">See box</a>
        <!-- <a href="?page=local&box=<?php echo $_GET['accept'] ?>&case=<?php
            $query = "SELECT CaseT FROM Transition JOIN Box ON Transition.Box = Box.BoxId WHERE Transition.TransitionId = " . $_GET['accept'];
            $cmd = $connection->prepare($query);
            $cmd->execute();
            echo $cmd->fetch()['CaseT'];
        ?>">See box</a> -->
        <a href="?page=transitions&accept=<?php echo $_GET['accept'] ?>&yes=true">Yes</a>
        <a href="?page=transitions">No</a>
    </div>

    <?php
        if ($_GET["yes"] != null) {
            // TODO 'Status' should be 'Accepted', medium set later to 'Transitioning' and 'Completed'
            // TODO Arrival and Departure dates
            $query = "UPDATE Transition SET Status = 'Completed', ArrivalTime = '' WHERE TransitionId = " . $_GET['accept'];
            $connection->prepare($query)->execute();

            // TODO And this should happen only when transition in 'Completed'
            $query = "SELECT ToL, Box FROM Transition WHERE TransitionId = " . $_GET['accept'];
            $cmd = $connection->prepare($query);
            $cmd->execute();
            $row = $cmd->fetch();
            $destination = $row['ToL'];
            $box = $row['Box'];

            $query = "UPDATE Box SET Location = '$destination' WHERE BoxID = $box";
            $connection->prepare($query)->execute();

            header('location: ?page=transitions');
        }
    ?>

<?php } else { ?>

    <div class="middlebar">
        <div class="title">History</div>
        <?php
            $court = $_SESSION["location"];
            $query = "SELECT ToL, FromL, Box FROM Transition WHERE (ToL = '$court' OR FromL = '$court') AND Status = 'Completed'";
            $cmd = $connection->prepare($query);
            $cmd->execute();

            foreach ($cmd->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<div>Box " . $row['Box'] . ' from ' . $row['FromL'] . ' to ' . $row['ToL'] . "</div>";
            }
        ?>
    </div>

<?php } ?>
