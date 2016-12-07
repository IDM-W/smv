<?php
session_start();

unset($_SESSION['facebook']);
unset($_SESSION['email']);
header('Location: ../index.php');
