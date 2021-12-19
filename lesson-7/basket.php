<?
require_once("functions.php");
if ($_GET['delete_id']) {
	$delete_id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM basket WHERE id='$delete_id'";
    $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
    header("Location: basket.php");
}
$good_id = (int)$_GET['id'];
if ($_COOKIE['login'] && $good_id) {
    $login = $_COOKIE['login'];
    $sql = "SELECT id FROM users WHERE login='$login'";
    $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
    $data = mysqli_fetch_assoc($res);
    $user_id = $data['id'];

    $sql = "SELECT id FROM basket WHERE good_id='$good_id'";
    $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
    if (mysqli_num_rows($res)) {
        $data = mysqli_fetch_assoc($res);
        $id = $data['id'];
        $sql = "UPDATE basket SET quantity=quantity+1 WHERE id='$id'";
        $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
    } else {
        $sql = "INSERT INTO basket (good_id, quantity, user_id) VALUES ('$good_id', 1, '$user_id')";
        $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
    }
    header("Location: basket.php");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-магазин</title>
    <link rel="stylesheet" href="css/style.css?v=<?=time()?>" type="text/css" media="all">
</head>
<body>

    <header>
        <div class="container">
            <a href="/">
                Главная
            </a>
            <a href="basket.php">
                Корзина
            </a>
        </div>
    </header>

    <?if ($_COOKIE['login']) {?>

        <p class="welcome">
            <?=$_COOKIE['login']?>, добро пожаловать!
        </p>

        <div class="list">
            <?
            $items = getBasket($connect);
            if ($items) {
                foreach ($items as $item) {
                    $good_id = $item['good_id'];
                    $sql = "SELECT * FROM goods WHERE id=' $good_id'";
                    $res = mysqli_query($connect, $sql) or die("Error: ".mysqli_error($connect));
                    $data = mysqli_fetch_assoc($res);
                    ?>
                    <div class="item">
                        <a href="detail.php?id=<?=$data['id']?>">
                            <img src="img/<?=$data['id']?>.jpg" alt="<?=$data['name']?>" title="<?=$data['name']?>">
                        </a>
                        <a href="detail.php?id=<?=$data['id']?>" class="item-name">
                            <?=$data['name']?>
                        </a>
                        <p class="price">
                            <?=number_format($data['price'], 0, ',', ' ')?> руб.
                        </p>
                        <p class="quantity">
                            Количество: <?=$item['quantity']?>
                        </p>
                        <a href="basket.php?delete_id=<?=$item['id']?>" class="delete-from-basket">
                            Удалить
                        </a>
                    </div>
                <?}
            }
            ?>
        </div>

    <?} else {?>

        <form action="server.php" method="post">
            <p>Логин:</p>
            <input type="text" name="login" value="<?=$_COOKIE['login']?>">
            <p>Пароль:</p>
            <input type="password" name="password" value="<?=$_COOKIE['password']?>">
            <input type="hidden" name="good_id" value="<?=strip_tags($_GET['id'])?>">
            <input type="submit" value="Войти">
        </form>

    <?}?>

</body>
</html>