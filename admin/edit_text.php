<?php
include("lock.php");
include("blocks/bd.php"); 

if(isset($_GET['id'])){$id = $_GET['id'];}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>страницы изменения текстов</title>
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
                    <p><strong>Выберите страницу для редактирования данных</strong></p>
                    <?php 
                    
					if (!isset($id))
					{
                    $result = mysql_query("SELECT title,id FROM settings ORDER BY id");
                    $myrow = mysql_fetch_array($result);

                    do {
                        printf("<p><a href='edit_text.php?id=%s'>%s</p>",$myrow["id"],$myrow["title"]);
                      }
                      
                    while($myrow = mysql_fetch_array($result));  
                }
								
                else{

                  $result = mysql_query("SELECT * FROM settings WHERE id=$id");
                  $myrow = mysql_fetch_array($result);

                  print <<<HERE

                  <form name="form1" method="post" action="update_text.php">
                  <p>
                  <label for="title">Введите название страницы: </label><br>
                  <input value="$myrow[title]" type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите краткое описание страницы: </label><br>
                  <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
                  </p>
                  <p>
                  <label for="meta_k">Введите ключевые слова для страницы: </label><br>
                  <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
                  </p>
                  <p>
                  <label for="mytext">Введите полный текст страницы с тэгами: </label><br>
                  <textarea name="mytext" id="mytext" cols="40" rows="20">$myrow[mytext]</textarea>
                  </p>
                  <input name="id" type="hidden" value="$myrow[id]">

                  <p>
                  <input type="submit" name="submit" id="submit" value="Сохранить изменения">
                  </p>
                  </form>          
HERE;
								}

                    ?>
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