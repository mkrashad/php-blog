<?php
include("lock.php");
include("blocks/bd.php"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Страница удаления категории</title>
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
                    <p><strong>Выберите категорию для удаления</strong></p>
                    <form action="drop_cat.php" method="post">
                    <?php 		
                    $result = mysql_query("SELECT title,id FROM categories");
                    $myrow = mysql_fetch_array($result);

                    do {
                        printf("<p><input name='id' type='radio' value='%s'><label> %s</label></p>",$myrow["id"],$myrow["title"]);
                      }
                      
                    while($myrow = mysql_fetch_array($result));  
                    ?>
                    <p><input name="submit" type="submit" value="Удалить категорию"></p>
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