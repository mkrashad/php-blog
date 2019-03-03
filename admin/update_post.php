<?php 
include("lock.php");
include("blocks/bd.php");

if(isset($_POST['id'])){$id = $_POST['id'];}
if(isset($_POST['title'])){$title = $_POST['title']; if($title == '') {unset($title);}}
if(isset($_POST['meta_d'])){$meta_d = $_POST['meta_d']; if($meta_d == '') {unset($meta_d);}}
if(isset($_POST['meta_k'])){$meta_k = $_POST['meta_k']; if($meta_k == '') {unset($meta_k);}}
if(isset($_POST['date'])){$date = $_POST['date']; if($date == '') {unset($date);}}
if(isset($_POST['description'])){$description = $_POST['description']; if($description == '') {unset($description);}}
if(isset($_POST['text'])){$text = $_POST['text']; if($text == '') {unset($text);}}
if(isset($_POST['author'])){$author = $_POST['author']; if($author == '') {unset($author);}}
if(isset($_POST['cat'])){$cat = $_POST['cat']; if($cat == '') {unset($cat);}}
if(isset($_POST['img'])){$img = $_POST['img']; if($img == '') {unset($img);}}
if(isset($_POST['secret'])){$secret = $_POST['secret']; if($secret == '') {unset($secret);}}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Обработчик</title>
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
                    
                    if(isset($title) && isset($meta_d) && isset($meta_k) && isset($date) && isset($description) && isset($text) && isset($author) && isset($cat) && isset($img) && isset($secret)){

                        //Здесь пишем что можно заносить информацию в базу
                        $result = mysql_query("UPDATE data SET title='$title',meta_d='$meta_d',meta_k='$meta_k',date='$date',description='$description',text='$text',author='$author',cat='$cat',mini_img='$img',secret='$secret' WHERE id='$id'");
                        
                        if($result == true) { echo "<p>Ваш заметка успешно обновлен</p>";}
                        else{echo "<p>Ваша заметка не обновлена</p>";}
                    }
                    else{
                        echo "<p>Вы ввели не всю информацию,заметка не обновлена</p>";
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