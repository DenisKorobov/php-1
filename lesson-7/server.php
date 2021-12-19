<?php

require_once("functions.php");

$login = $_POST['login'] ? strip_tags($_POST['login']) : '';
$password = $_POST['password'] ? strip_tags($_POST['password']) : '';
$good_id = $_POST['good_id'] ? (int)$_POST['good_id'] : '';

$sql = "SELECT id FROM users WHERE login='$login' AND password='$password'";
$res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));

if (mysqli_num_rows($res)) {
    setcookie("login", $login);
    setcookie("password", $password);
}

header("Location: basket.php?id=$good_id");