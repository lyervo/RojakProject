<?php

session_start();

session_destroy();

$current = 'logout';
header('Location: ../controller/index.php');
exit();
?>
