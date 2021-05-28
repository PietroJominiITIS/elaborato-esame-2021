<?php require_once('../partials/utils/auth.php') ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION['location'] ?> | Dashboard</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    

    <?php require('../partials/navbar.php'); ?>
    <?php 
        $pages = ['local', 'create', 'item', 'global'];
        $page = $_GET['page'];
        if ( in_array($page, $pages))
            require('../partials/' . $_GET['page'] . '.php');
    ?>
    
</body>
</html>
