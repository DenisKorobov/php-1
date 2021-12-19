<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
    <title>Lesson 5</title>
    <style>
        .gallery-row {
            display: flex;
        }

        .gallery-cell {
            width: 200px;
            height: 150px;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .gallery-cell a {
            line-height: 0;
        }

        .gallery-cell a img {
            max-height: 125px;
        }

        .gallery-cell p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="gallery">
    <?
    $connect = mysqli_connect("localhost", "root", "root", "gallery");
    $sql = "SELECT * FROM gallery ORDER BY counter DESC";
    $result = mysqli_query($connect, $sql);

    $i = 0;
    while ($data = mysqli_fetch_assoc($result)) {
    ?>
        <?if (!($i % 3)) {?>
            <div class="gallery-row">
        <?}?>
            <div class="gallery-cell">
                <a href="<?=str_replace("small", "big", $data["src"])?>" data-fancybox="gallery">
                    <img src="<?=$data["src"]?>" alt="image" data-id="<?=$data["id"]?>">
                </a>
                <p data-id="<?=$data["id"]?>">
                    Кликов: <?=$data["counter"]?>
                </p>
            </div>
        <?if (!(($i - 2) % 3)) {?>
            </div>
        <?}?>
    <?
    $i++;
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
    $(document).ready(function() {
        Fancybox.bind('[data-fancybox="gallery"]', {
            caption: function (fancybox, carousel, slide) {
                return (
                   `${slide.index + 1} / ${carousel.slides.length}`
                );
            },
        });
        $(".gallery-cell > a > img").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: 'ajax.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(counter) {
                    $("p[data-id=" + id + "]").text("Кликов: " + counter);
                }
            });
        });
    });
</script>
    
</body>
</html>