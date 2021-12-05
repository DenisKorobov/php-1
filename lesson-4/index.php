<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jquery.fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen">
    <title>Lesson 4</title>
    <style>
        .gallery-row {
            display: flex;
        }

        .gallery-cell {
            width: 200px;
            height: 125px;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gallery-cell a {
            line-height: 0;
        }

        .gallery-cell a img {
            max-width: 200px;
            max-height: 125px;
        }
    </style>
</head>
<body>

<div class="gallery">
    <?
    $files = scandir("img");
    for($i=2; $i < count($files); $i++){
    ?>
        <?if (!(($i - 2) % 3)) {?>
            <div class="gallery-row">
        <?}?>
            <div class="gallery-cell">
                <a href="img/<?=$files[$i]?>" rel="group">
                    <img src="img/<?=$files[$i]?>" alt="image">
                </a>
            </div>
        <?if (!(($i - 4) % 3)) {?>
            </div>
        <?}?>
    <?}?>
</div>

<br><hr><br>

<?
 function resize($image, $w_o = false, $h_o = false) {
    if (($w_o < 0) || ($h_o < 0)) {
      echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
      $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
    } else {
      echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
      return false;
    }
    /* Если указать только 1 параметр, то второй подстроится пропорционально */
    if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
    if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
    $func = 'image'.$ext; // Получаем функцию для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
}

if ($_FILES) {
    $path = "files/big/".$_FILES['photo']['name'];
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
        copy("files/big/".$_FILES['photo']['name'], "files/small/".$_FILES['photo']['name']);
        resize("files/small/".$_FILES['photo']['name'], 200);
        echo $_FILES['photo']['name']." успешно загружен!";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
     <p>Выберите файл</p>
     <input type="file" name="photo" accept="image/*">
     <input type="submit" value="Загрузить">
</form>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script>
    $(document).ready(function() {
        $(".gallery-cell a").fancybox();
    });
</script>
    
</body>
</html>