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
<title>Страница редактирования заметки</title>
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
                    <?php 
                    
					    if (!isset($id))
						    {
                    $result = mysql_query("SELECT title,id FROM categories");
                    $myrow = mysql_fetch_array($result);

                    do {
                        printf("<p><a href='edit_cat.php?id=%s'>%s</p>",$myrow["id"],$myrow["title"]);
                      }
                      
                    while($myrow = mysql_fetch_array($result));  
                }
								
                else{

                  $result = mysql_query("SELECT * FROM categories WHERE id=$id");
                  $myrow = mysql_fetch_array($result);
                  print <<<HERE
                  <h3 style='text-align:center'>Редактирование категории</h3>
                  <form name='form1' method='post' action='update_cat.php'>
                  <p>
                  <label for="title">Введите название категории: </label><br>
                  <input value="$myrow[title]" type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите краткое описание категории: </label><br>
                  <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
                  </p>
                  <p>
                  <label for="meta_k">Введите ключевые слова для категории: </label><br>
                  <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
                  </p>
                  <p>
                  <label for="text">Введите полный текст категории с тэгами: </label><br>
                  <textarea name="mytext" id="text" cols="40" rows="20">$myrow[mytext]</textarea>
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