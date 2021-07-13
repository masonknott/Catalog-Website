<html>
<head>
    <title>Game-Catalogue</title>
    <link href="/assets/css/main.css" rel="stylesheet">
    <script src="/vendor/js/jquery.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php require 'connect.php'; ?>
<?php require 'nav.php'; ?>
<main>
<?php
    if (isset($_GET['error'])) {
        echo '<div id="alertMain" class="alert alert__danger">'.$_GET['error'].'</div>';
    }
    if (isset($_GET['success'])) {
        echo '<div id="alertMain" class="alert alert__success">'.$_GET['success'].'</div>';
    }
?>
