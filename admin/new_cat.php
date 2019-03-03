<?php include("lock.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Страница добавления новой категории</title>
</head>
<body>
<table class="main_border">
<!--Подключаем шапку сайта-->
<?php include("blocks/header.php"); ?> 
    <tr>
        <td>
            <table>
                <tr>
                <!--Подключаем левый блок сайта-->
                  <?php include("blocks/lefttd.php"); ?>
                    <td valign="top">
                  <form name="form1" method="post" action="add_cat.php">
                  <p>
                  <label for="title">Введите название категории: </label><br>
                  <input type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите краткое описание категории: </label><br>
                  <input type="text" name="meta_d" id="meta_d">
                  </p>
                  <p>
                  <label for="meta_k">Введите ключевые слова для категории: </label><br>
                  <input type="text" name="meta_k" id="meta_k">
                  </p>
                  <p>
                  <label for="text">Введите полный текст заметки с тэгами: </label><br>
                  <textarea name="mytext" id="text" cols="40" rows="20"></textarea>
                  </p>
                  <p>
                  <input type="submit" name="submit" id="submit" value="Занести категорию в базу">
                  </p>
                  </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <!--Подключаем футер сайта-->
        <?php include("blocks/footer.php"); ?>
    </tr>
</table>
</body>
</html>