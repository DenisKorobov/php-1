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
    </style>
</head>
<body>

<form action="">
    <input type="text" name="firstNumber">
    <select name="operation">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="text" name="secondumber">
    <input type="submit" value="=">
    <input type="text" name="result" disabled>
    <p>Error! Division by zero!</p>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("input[type=submit]").on("click", function() {
            $.ajax({
                type: "POST",
                url: 'ajax.php',
                data: {
                    firstNumber: $("input[name=firstNumber]").val(),
                    secondumber: $("input[name=secondumber]").val(),
                    operation: $("select[name=operation]").val(),
                },
                dataType: 'json',
                success: function(arResult) {
                    if (arResult["error"]) {
                        $("input[name=result]").val("");
                        $("form > p").show();
                    } else {
                        $("input[name=result]").val(arResult["result"]);
                        $("form > p").hide();
                    }
                }
            });
            return false;
        });
    });
</script>
    
</body>
</html>