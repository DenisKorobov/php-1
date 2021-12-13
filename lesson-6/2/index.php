<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 6</title>
    <style>
        input[type=text] {
            width: 30px;
        }
        form > p {
            display: none;
        }
        button {
            border: 1px solid grey;
            width: 21px;
            height: 21px;
            border-radius: 3px;
        }
        button.active {
            border: 1px solid #23cd23;
        }
    </style>
</head>
<body>

<form action="">
    <input type="text" name="firstNumber">
    <button data-value="+">+</button>
    <button data-value="-">-</button>
    <button data-value="*">*</button>
    <button data-value="/">/</button>
    <input type="text" name="secondumber">
    <input type="submit" value="=">
    <input type="text" name="result" disabled>
    <p></p>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("button").on("click", function() {
            $("button").removeClass("active");
            $(this).addClass("active");
            return false;
        });
        $("input[type=submit]").on("click", function() {
            if (!$("button.active").length) {
                $("form > p").text("Выберите операцию!").show();
            } else if (!$("input[name=firstNumber]").val() || !$("input[name=secondumber]").val()) {
                $("form > p").text("Введите число!").show();
            } else {
                $.ajax({
                    type: "POST",
                    url: 'ajax.php',
                    data: {
                        firstNumber: $("input[name=firstNumber]").val(),
                        secondumber: $("input[name=secondumber]").val(),
                        operation: $("button.active").data("value"),
                    },
                    dataType: 'json',
                    success: function(arResult) {
                        $("input[name=firstNumber]").val(arResult["firstNumber"]);
                        $("input[name=secondumber]").val(arResult["secondumber"]);
                        if (arResult["error"]) {
                            $("input[name=result]").val("");
                            $("form > p").text("Error! Division by zero!").show();
                        } else {
                            $("input[name=result]").val(arResult["result"]);
                            $("form > p").text("").hide();
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
    
</body>
</html>