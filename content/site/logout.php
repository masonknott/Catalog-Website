<?php
// REG 1801459
session_start();
session_destroy();
$_SESSION = [];
header('Location: index.php');
