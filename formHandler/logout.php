<?php
session_start();
$_SESSION["user"] = "";
$_SESSION["login"] = false;

header("Location: ../index.php");