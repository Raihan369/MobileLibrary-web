<?php

include 'config.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

// exit(); // eta ami add korchi 
?>