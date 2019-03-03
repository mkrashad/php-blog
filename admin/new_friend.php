<?php include("lock.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Страница добавления нового сайта друга</title>
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
                    <p><strong>Страница добавление сайта друга</strong></p>
                  <form name="form1" method="post" action="add_friend.php">
                  <p>
                  <label for="title">Введите название сайта друга: </label><br>
                  <input type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="link">Введите ссылку на сайт друга: </label><br>
                  <input type="text" name="link" id="link">
                  </p>
                  <p>
                  <input type="submit" name="submit" id="submit" value="Занести сайт в базу">
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