<?php 
include("lock.php");
include("blocks/bd.php");

if(isset($_POST['id'])){$id = $_POST['id'];}
if(isset($_POST['title'])){$title = $_POST['title']; if($title == '') {unset($title);}}
if(isset($_POST['link'])){$link = $_POST['link']; if($link == '') {unset($link);}}
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
                    
                    if(isset($title) && isset($link)){

                        //Здесь пишем что можно заносить информацию в базу
                        $result = mysql_query("UPDATE friends SET title='$title',link='$link' WHERE id='$id'");
                        
                        if($result == true) { echo "<p>Ваш друг успешно обновлен!</p>";}
                        else{echo "<p>Ваш друг не обновлен!</p>";}
                    }
                    else{
                        echo "<p>Вы ввели не всю информацию,ваш друг не обновлен!</p>";
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