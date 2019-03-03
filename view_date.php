<?php include("blocks/bd.php");

if(isset($_GET['date'])) 
{
    $date = $_GET['date'];
}
else{
    exit("<p>Вы обратились к файлу без необходимых параметров. Проверьте адресную строку браузера.");
}

$date_title = $date;

$date_begin = $date;
$date++;
$date_end = $date;

$date_begin = $date_begin."-01";
$date_end = $date_end."-01";


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo "Заметки за $date_title"; ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<table class="main_border">
 <?php include("blocks/header.php"); ?>
    <tr>
        <td valign="center">
            <table width="100%">
                <tr>
                <?php include("blocks/lefttd.php"); ?>
                    <td valign="top">
                    <?php $n=0; include("blocks/nav.php")?>
                    <?php 
                                    $result = mysqli_query($db,"SELECT id,title,description,date,author,mini_img,view,rating,q_vote FROM data WHERE secret=0 AND date>'$date_begin' AND date<'$date_end'");

                                    if (!$result) {

                                        echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

                                        exit(mysqli_error());

                                    }

                                    if (mysqli_num_rows($result) > 0) {

                                        $myrow = mysqli_fetch_array($result);
                                        do {
                                            $r = $myrow["rating"] / $myrow["q_vote"];
                                            $r = intval($r);

                                            printf('<p><table class="post">
                    	                    <tr>
                                                <td class="post_title">
                                                    <p class="post_name"><img class="mini" src="%s"><a href="view_post.php?id=%s">%s</a></p>
											        <p class="post_adds">Дата добавления: %s</p>
											        <p class="post_adds">Автор урока: %s</p>
											    </td>
										    </tr>
                                            <tr>
                                                <td>%s <p class="post_view">Просмотров: %s &nbsp;&nbsp; Рейтинг: <img src="img/%s.gif"</p></td>
                                            </tr>
										</table><br></p>', $myrow['mini_img'],$myrow['id'], $myrow['title'], $myrow['date'], $myrow['author'], $myrow['description'],$myrow['view'],$r);
                                        } while ($myrow = mysqli_fetch_array($result));





                                    } else {
                                        echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
                                        exit();
                                    }
                                    ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php include("blocks/footer.php"); ?>
</table>

</body>
</html>