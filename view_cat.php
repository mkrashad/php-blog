<?php include("blocks/bd.php");

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
}
if (!isset($cat)) {
    $cat = 1;
}

/* Проверяем, является ли переменная числом */
if (!preg_match("|^[\d]+$|", $cat)) {
    exit("<p>Неверный формат запроса! Проверьте URL!");
}

$result = mysqli_query($db,"SELECT * FROM categories WHERE id='$cat'");

if (!$result) {

    echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

    exit(mysqli_error());
}

if (mysqli_num_rows($result) > 0) {
    $myrow = mysqli_fetch_array($result);
} else {
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
    <title>
        <?php echo "Заметки категории - $myrow[title]"; ?>
    </title>
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
                            <?php $n = 0;
                            include("blocks/nav.php") ?>

                            <?php echo $myrow['mytext'];

                            $result77 = mysqli_query($db,"SELECT str FROM options");
                            $myrow77 = mysqli_fetch_array($result77);
                            $num = $myrow77["str"];
                            // »звлекаем из URL текущую страницу
                            @$page = $_GET['page'];
                            // ќпредел¤ем общее число сообщений в базе данных
                            $result00 = mysqli_query("SELECT COUNT(*) FROM data WHERE secret=0 AND cat='$cat'");
                            $temp = mysqli_fetch_array($result00);
                            $posts = $temp[0];
                            // Ќаходим общее число страниц
                            $total = (($posts - 1) / $num) + 1;
                            $total =  intval($total);
                            // ќпредел¤ем начало сообщений дл¤ текущей страницы
                            $page = intval($page);
                            // ≈сли значение $page меньше единицы или отрицательно
                            // переходим на первую страницу
                            // ј если слишком большое, то переходим на последнюю
                            if (empty($page) or $page < 0) $page = 1;
                            if ($page > $total) $page = $total;
                            // ¬ычисл¤ем начина¤ с какого номера
                            // следует выводить сообщени¤
                            $start = $page * $num - $num;
                            // ¬ыбираем $num сообщений начина¤ с номера $start	



                            $result = mysqli_query($db,"SELECT id,title,description,date,author,mini_img,view,rating,q_vote FROM data WHERE secret=0 AND cat='$cat' ORDER BY id LIMIT $start, $num");

                            if (!$result) {

                                echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

                                exit(mysqli_error());
                            }

                            if (mysqli_num_rows($result) > 0) {

                                $myrow = mysqli_fetch_array($result);
                                do {

                                    $r = $myrow["rating"] / $myrow["q_vote"];
                                    $r = intval($r);

                                    printf('<table class="post">
                    	                    <tr>
                                                <td class="post_title">
                                                    <p class="post_name"><img class="mini" src="%s"><a href="view_post.php?id=%s">%s</a></p>
											        <p class="post_adds">Дата добавления: %s</p>
											        <p class="post_adds">Автор урока: %s</p>
											    </td>
										    </tr>
                                            <tr>
                                                <td>%s <p class="post_view">Просмотров: %s &nbsp;&nbsp; Рейтинг: <img src="img/%s.gif"></p></td>
                                            </tr>
										</table><br><br>', $myrow['mini_img'], $myrow['id'], $myrow['title'], $myrow['date'], $myrow['author'], $myrow['description'], $myrow['view'],$r);
                                } while ($myrow = mysqli_fetch_array($result));

                                // Проверяем нужны ли стрелки назад
                                if ($page != 1) $pervpage = '<a href=view_cat.php?cat=' . $cat . '&page=1>Первая</a> | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 1) . '>Предыдущая</a> | ';
                                // Проверяем нужны ли стрелки вперед
                                if ($page != $total) $nextpage = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 1) . '>Следующая</a> | <a href=view_cat.php?cat=' . $cat . '&page=' . $total . '>Последняя</a>';

                                // Находим две ближайшие станицы с обоих краев, если они есть
                                if ($page - 5 > 0) $page5left = ' <a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 5) . '>' . ($page - 5) . '</a> | ';
                                if ($page - 4 > 0) $page4left = ' <a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 4) . '>' . ($page - 4) . '</a> | ';
                                if ($page - 3 > 0) $page3left = ' <a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 3) . '>' . ($page - 3) . '</a> | ';
                                if ($page - 2 > 0) $page2left = ' <a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 2) . '>' . ($page - 2) . '</a> | ';
                                if ($page - 1 > 0) $page1left = '<a href=view_cat.php?cat=' . $cat . '&page=' . ($page - 1) . '>' . ($page - 1) . '</a> | ';

                                if ($page + 5 <= $total) $page5right = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 5) . '>' . ($page + 5) . '</a>';
                                if ($page + 4 <= $total) $page4right = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 4) . '>' . ($page + 4) . '</a>';
                                if ($page + 3 <= $total) $page3right = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 3) . '>' . ($page + 3) . '</a>';
                                if ($page + 2 <= $total) $page2right = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 2) . '>' . ($page + 2) . '</a>';
                                if ($page + 1 <= $total) $page1right = ' | <a href=view_cat.php?cat=' . $cat . '&page=' . ($page + 1) . '>' . ($page + 1) . '</a>';

                                // Вывод меню если страниц больше одной

                                if ($total > 1) {
                                    Error_Reporting(E_ALL & ~E_NOTICE);
                                    echo "<div class=\"pstrnav\">";
                                    echo $pervpage . $page5left . $page4left . $page3left . $page2left . $page1left . '<b>' . $page . '</b>' . $page1right . $page2right . $page3right . $page4right . $page5right . $nextpage;
                                    echo "</div>";
                                }
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