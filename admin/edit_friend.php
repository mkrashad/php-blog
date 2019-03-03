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
<title>Страница редактирования друга</title>
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
                    $result = mysql_query("SELECT title,id FROM friends");
                    $myrow = mysql_fetch_array($result);

                    do {
                        printf("<p><a href='edit_friend.php?id=%s'>%s</p>",$myrow["id"],$myrow["title"]);
                      }
                      
                    while($myrow = mysql_fetch_array($result));  
                }
								
                else{

                  $result = mysql_query("SELECT * FROM friends WHERE id=$id");
                  $myrow = mysql_fetch_array($result);
                  print <<<HERE
                  <h3 style="text-align:center">Редактирование друга</h3>
                  <form name='form1' method='post' action='update_friend.php'>
                  <p>
                  <label for="title">Введите название сайта друга: </label><br>
                  <input value="$myrow[title]" type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите ссылку на сайт друга: </label><br>
                  <input value="$myrow[link]" type="text" name="link" id="link">
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