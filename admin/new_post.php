<?php include("lock.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Страница добавления нового заметки</title>
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
                  <form name="form1" method="post" action="add_post.php">
                  <p>
                  <label for="title">Введите название заметки: </label><br>
                  <input type="text" name="title" id="title">
                  </p>
                  <p>
                  <label for="meta_d">Введите краткое описание заметки: </label><br>
                  <input type="text" name="meta_d" id="meta_d">
                  </p>
                  <p>
                  <label for="meta_k">Введите ключевые слова для заметки: </label><br>
                  <input type="text" name="meta_k" id="meta_k">
                  </p>
                  <p>
                  <label for="date">Введите дату добавления заметки: </label><br>
                  <input type="date" name="date" id="date" value="">
                  </p>
                  <p>
                  <label for="description">Введите краткое описание заметки с тэгами абзацев: </label>
                  <textarea name="description" id="description" cols="40" rows="10"></textarea>
                  </p>
                  <p>
                  <label for="text">Введите полный текст заметки с тэгами: </label><br>
                  <textarea name="text" id="text" cols="40" rows="20"></textarea>
                  </p>
                  <p>
                  <label for="author">Введите автор заметки: </label><br>
                  <input type="text" name="author" id="author">
                  </p>
                  <p>
                  <label for="img">Введите где лежит миниатюра: </label><br>
                  <input type="text" name="img" id="img">
                  </p>
                  <p>
                  <label for="cat">Выберите категорию заметки: </label><br>
                  <select name="cat" id="cat">
                    <?php
                    $result = mysql_query("SELECT id,title FROM categories",$db);

                    if(!$result){
                    
                    echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";
                    
                    exit(mysql_error());
                    
                    }
                    
                    if(mysql_num_rows($result) > 0){
                        $myrow = mysql_fetch_array($result);
                        do{
                            printf("<option value='%s'>%s</option>",$myrow['id'],$myrow['title']);
                        }
                        while($myrow = mysql_fetch_array($result));

                    }
                    
                    else{
                        echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
                        exit();
                    }
                    ?>
                      
                  </select>
                  </p>
                  <p>
                  <label for="img">Добавить в секретный раздел?</label><br>
                  <strong>Да</strong><input type="radio" name="secret" id="secret" value="1">
                  <strong>Нет</strong><input type="radio" name="secret" id="secret" value="0" checked>
                  </p>
                  <p>
                  <input type="submit" name="submit" id="submit" value="Занести заметку в базу">
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