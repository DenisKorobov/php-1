<?php

if ($_POST) {
   $firstNumber = (float) $_POST["firstNumber"];
   $secondumber = (float) $_POST["secondumber"];
   $operation = strip_tags($_POST["operation"]);
   $arResult["error"] = false;
   if (!$secondumber && $operation == "/") {
        $arResult["error"] = true;
    } else {
        switch ($operation) {
            case "+":
                $arResult["result"] = $firstNumber + $secondumber;
                break;
            case "-":
                $arResult["result"] = $firstNumber - $secondumber;
                break;
            case "*":
                $arResult["result"] = $firstNumber * $secondumber;
                break;
            case "/":
                $arResult["result"] = $firstNumber / $secondumber;
                break;
        }
   }
   echo json_encode($arResult);
}