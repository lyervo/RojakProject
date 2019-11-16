<?php

session_start();

session_destroy();

$current = 'logout';
header('Location: ../controller/?action=home');
exit();
?>
