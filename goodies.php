<?php
include("blocks/bd.php"); 

$result = mysqli_query($db,"SELECT title, meta_d, meta_k, mytext FROM settings WHERE pages='goodies'");

if(!$result){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result) > 0){
    $myrow = mysqli_fetch_array($result);
}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php echo $myrow['meta_d']; ?>">
<meta name="keywords" content="<?php echo $myrow['meta_k']; ?> ">
<title><?php echo $myrow['title']; ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<table class="main_border">
 <?php include("blocks/header.php"); ?>
    <tr>
        <td valign="center">
            <table width="100%">
                <tr>
                <td><?php include("blocks/lefttd.php"); ?></td>
                    <td style="float:left;">
                    <?php $n=3; include("blocks/nav.php")?>
                    <?php echo $myrow['mytext'];?></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php include("blocks/footer.php"); ?>
</table>

</body>
</html>