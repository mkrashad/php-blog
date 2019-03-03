<?php 
include("lock.php");
include("blocks/bd.php");

if(isset($_POST['id'])){$id = $_POST['id'];}
if(isset($_POST['title'])){$title = $_POST['title']; if($title == '') {unset($title);}}
if(isset($_POST['meta_d'])){$meta_d = $_POST['meta_d']; if($meta_d == '') {unset($meta_d);}}
if(isset($_POST['meta_k'])){$meta_k = $_POST['meta_k']; if($meta_k == '') {unset($meta_k);}}
if(isset($_POST['mytext'])){$mytext = $_POST['mytext']; if($mytext == '') {unset($mytext);}}
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
                    
                    if(isset($title) && isset($meta_d) && isset($meta_k) && isset($mytext)){

                        //Здесь пишем что можно заносить информацию в базу
                        $result = mysql_query("UPDATE categories SET title='$title',meta_d='$meta_d',meta_k='$meta_k',mytext='$mytext' WHERE id='$id'");
                        
                        if($result == true) { echo "<p>Ваш категория успешно обновлен</p>";}
                        else{echo "<p>Ваша категория не обновлена</p>";}
                    }
                    else{
                        echo "<p>Вы ввели не всю информацию,категория не обновлена</p>";
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