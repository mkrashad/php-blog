<?php 
include("lock.php");
include("blocks/bd.php");

if(isset($_POST['id'])){$id = $_POST['id'];}
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
                    
                    if(isset($id)){

						$result0 = mysql_query("SELECT id FROM data WHERE cat='$id'",$db);
							
							 if (mysql_num_rows($result0) > 0){

							 		echo "<p>В категории, которую вы хотите удалить есть заметки.</p>";
							 	}	

							 else{
							 		$result = mysql_query("DELETE FROM categories WHERE id='$id'");

							 		if($result == true) { echo "<p>Ваша категория успешна удалена</p>";}
										
							 			else{echo "<p>Ваша категория не удалена</p>";}
							 	}
					}


                    else{
                        echo "<p>Вы выбрали не категория заметку</p>";}
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