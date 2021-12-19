<?php

if ($_POST["id"]) {
    $id = $_POST["id"];
    $connect = mysqli_connect("localhost", "root", "root", "gallery");
    $sql = "SELECT counter FROM gallery WHERE id=$id";
    $result = mysqli_query($connect, $sql);
    $counter = mysqli_fetch_assoc($result)["counter"] + 1;
    $sql = "UPDATE gallery SET counter=$counter where id=$id";
    if (mysqli_query($connect, $sql)) {
        echo $counter;
    }
}