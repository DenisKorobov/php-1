<?php

define("MYSQL_SERVER", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASSWORD", "");
define("MYSQL_DB", "shop");

$connect = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or die("Error: ".mysqli_error($connect));

function getGoods($connect) {
    $query = "SELECT * FROM goods ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    while ($data = mysqli_fetch_assoc($result)) {
        $goods[] = $data;
    }
    return $goods;
}

function getGood($connect, $id) {
    $query = "SELECT * FROM goods WHERE id=$id";
    $result = mysqli_query($connect, $query);
    $good = mysqli_fetch_assoc($result);
    return $good;
}

function getBasket($connect) {
    $query = "SELECT * FROM basket ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    while ($data = mysqli_fetch_assoc($result)) {
        $basket[] = $data;
    }
    return $basket;
}