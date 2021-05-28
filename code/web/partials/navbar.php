<link rel="stylesheet" href="../css/navbar.css">

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