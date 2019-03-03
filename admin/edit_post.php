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
                    $result = mysql_query("SELECT title,id FROM data");
                    $myrow = mysql_fetch_array($result);

                    do {
                        printf("<p><a href='edit_post.php?id=%s'>%s</p>",$myrow["id"],$myrow["title"]);
                      }
                      
                    while($myrow = mysql_fetch_array($result));  
                }
								
                else{

                  $result = mysql_query("SELECT * FROM data WHERE id=$id");
                  $myrow = mysql_fetch_array($result);

                  $result2 = mysql_query("SELECT id,title FROM categories");
                  $myrow2 = mysql_fetch_array($result2);

                  $count = mysql_num_rows($result2);

                  echo "<h3 style='text-align:center'>Редактирование заметки</h3>";

                  echo "<form name='form1' method='post' action='update_post.php'>
                  <p>Выберите категорию для заметки<br><select name='cat' id='cat' size='$count'>";

                  do{

                    if($myrow['cat'] == $myrow2['id']){

                        printf("<option value='%s' selected>%s</option>",$myrow2['id'],$myrow2['title']);
                    }

                    else{
                    printf("<option value='%s'>%s</option>",$myrow2['id'],$myrow2['title']);
                }
                }
                while($myrow2 = mysql_fetch_array($result2));

                echo "</select></p>";

                echo '<p>
                <label for="img">Добавить в секретный раздел?</label><br>
                <strong>Да</strong><input type="radio"'; 

                if($myrow["secret"] == 1) {echo ' checked ';}

                echo 'name="secret" id="secret" value="1"<strong>Нет</strong><input type="radio"';
                
                if($myrow["secret"] == 0) {echo ' checked ';}

                 echo'name="secret" id="secret" value="0"> </p>';
               

                  print <<<HERE
                  <p>
                  <label for="title">Введите название заметки: </label><br>
                  <input value="$myrow[title]" type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите краткое описание заметки: </label><br>
                  <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
                  </p>
                  <p>
                  <label for="meta_k">Введите ключевые слова для заметки: </label><br>
                  <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
                  </p>
                  <p>
                  <label for="date">Введите дату добавления заметки: </label><br>
                  <input value="$myrow[data]" type="date" name="date" id="date">
                  </p>
                  <p>
                  <label for="description">Введите краткое описание заметки с тэгами абзацев: </label>
                  <textarea name="description" id="description" cols="40" rows="10">$myrow[description]</textarea>
                  </p>
                  <p>
                  <label for="text">Введите полный текст заметки с тэгами: </label><br>
                  <textarea name="text" id="text" cols="40" rows="20">$myrow[text]</textarea>
                  </p>
                  <p>
                  <label for="author">Введите автор заметки: </label><br>
                  <input value="$myrow[author]" type="text" name="author" id="author">
                  </p>
                  <p>
                  <label for="img">Введите где лежит миниатюра: </label><br>
                  <input value="$myrow[mini_img]" type="text" name="img" id="img">
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