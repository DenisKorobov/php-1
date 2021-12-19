<?
require_once("functions.php");
if ($_GET['id']) {
	$id = (int)$_GET['id'];
    $good = getGood($connect, $id);
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

    <h1>
        <?=$good['name']?>
    </h1>
    <div class="detail">
        <div class="detail-left">
            <img src="img/<?=$good['id']?>.jpg" alt="<?=$good['name']?>" title="<?=$good['name']?>">
        </div>
        <div class="detail-right">
            <p>
                <?=nl2br($good['description'])?>
            </p>
            <p class="price">
                <?=number_format($good['price'], 0, ',', ' ')?> руб.
            </p>
            <a href="basket.php?id=<?=$good['id']?>" class="add-to-basket">
                Добавить в корзину
            </a>
        </div>
    </div>

</body>
</html>