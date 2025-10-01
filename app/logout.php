<?php
/// logout.php
/// destroy the session and logout the user

session_start();
session_unset();
session_destroy();
("Location: login.php");
exit();

?>