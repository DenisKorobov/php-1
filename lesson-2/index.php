<?php

/* Task №1 */

$a = rand(-10, 10);
$b = rand(-10, 10);

if ($a >= 0 && $b >= 0) {
    $result = $a - $b;
}

if ($a < 0 && $b < 0) {
    $result = $a * $b;
}

if (($a >= 0 && $b < 0) || ($a < 0 && $b >= 0)) {
    $result = $a + $b;
}

echo "Число а = $a<br>Число b = $b<br>Результат: $result";

echo "<br><br>";

/* Task №2 */

$a = rand(0, 15);

echo "Число а = $a<br>";

switch ($a) {
    case 0:
        echo "0<br>";
    case 1:
        echo "1<br>";
    case 2:
        echo "2<br>";
    case 3:
        echo "3<br>";
    case 4:
        echo "4<br>";
    case 5:
        echo "5<br>";
    case 6:
        echo "6<br>";
    case 7:
        echo "7<br>";
    case 8:
        echo "8<br>";
    case 9:
        echo "9<br>";
    case 10:
        echo "10<br>";
    case 11:
        echo "11<br>";
    case 12:
        echo "12<br>";
    case 13:
        echo "13<br>";
    case 14:
        echo "14<br>";
    case 15:
        echo "15";
}

echo "<br><br>";

/* Task №3 */

function sum($a, $b) {
    return $a + $b;
}

function difference($a, $b) {
    return $a - $b;
}

function multiplication($a, $b) {
    return $a * $b;
}

function division($a, $b) {
    return $a / $b;
}

/* Task №4 */

function mathOperation($a, $b, $operation) {

    switch ($operation) {
        case "+":
            return sum($a, $b);
        case "-":
            return difference($a, $b);
        case "*":
            return multiplication($a, $b);
        case "/":
            return division($a, $b);
    }
 
}

echo mathOperation(4, 8, "+") . "<br>";
echo mathOperation(4, 8, "-") . "<br>";
echo mathOperation(4, 8, "*") . "<br>";
echo mathOperation(4, 8, "/");

echo "<br><br>";

/* Task №6 */

function power($val, $pow) {

    if ($pow > 0) {
        return $val * power($val, $pow - 1);
    }
    return 1;

}

echo power(3, 4);