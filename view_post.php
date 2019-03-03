<?php include("blocks/bd.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (!isset($id)) {
    $id = 1;
}

/* Проверяем, является ли переменная числом */
if (!preg_match("|^[\d]+$|", $id)) {
    exit ("<p>Неверный формат запроса! Проверьте URL!");
    }

$result = mysqli_query($db,"SELECT * FROM data WHERE id='$id'");

if (!$result) {

    echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

    exit(mysqli_error());

}

if (mysqli_num_rows($result) > 0) {
    $myrow = mysqli_fetch_array($result);
    $new_view = $myrow['view'] + 1;
    $update = mysqli_query($db,"UPDATE data SET view='$new_view' WHERE id='$id'");

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
<title><?php echo $myrow[title]; ?></title>
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

                                    printf("<p class='post_title2'>%s</p><p class='post_add'>Автор: %s</p><p class='post_add'>Дата: %s</p>%s<p class='post_view'>Просмотров: %s</p>", $myrow['title'], $myrow['author'], $myrow['date'], $myrow['text'], $myrow['view']);?>

                                    <form action="vote_res.php" method="post" name="vv">
                                    <p class="pvote">Оцените заметку: 1 <input type="radio" name="score" id="score" value="1">
                                    2<input type="radio" name="score" id="score" value="2">
                                    3<input type="radio" name="score" id="score" value="3">
                                    4<input type="radio" name="score" id="score" value="4">
                                    5<input type="radio" name="score" id="score" value="5" checked>
                                    <input type="submit"  class="sub_vote" name="submit" value="Оценить">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    </p>
                                    </form>



                                    <?php
                                    echo "<p class='post_comment'>Комментарии к этой заметки</p>";

                                    $result3 = mysqli_query($db,"SELECT * FROM comments WHERE post='$id'");

                                    if (mysqli_num_rows($result) > 0) {

                                        $myrow3 = mysqli_fetch_array($result3);

                                        do {

                                            printf("<div class='post_div'><p class='post_comment_add'>Коментарий добовил(а): <strong>%s</strong><br>Дата: <strong>%s</strong></p><p>%s</p></div>", $myrow3['author'], $myrow3['mydate'], $myrow3['mytext']);

                                        } while ($myrow3 = mysqli_fetch_array($result3));
                                    }

                                    $result4 = mysqli_query($db,"SELECT img FROM comment_settings");

                                    if (!$result4) {

                                        echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

                                        exit(mysqli_error());

                                    }

                                    if (mysqli_num_rows($result4) > 0) {
                                        $myrow4 = mysqli_fetch_array($result4);
                                    } else {
                                        echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
                                        exit();
                                    }
                                    ?>
                                    <p class='post_comment'>Добавить ваш комментарии</p>
                                    <form action="comment.php" method="post" name="form_com">
                                    <p><label for="author">Ваше имя: </label><input type="text" name="author" size="30" id="author"></p>
                                    <p><label for="text">Текст комментария: </label><br><textarea name="text" id="text" cols="40" rows="4"></textarea></p>
                                    <p>Введите сумму чисел с картинки</p>
                                    <p><img src="<?php echo $myrow4['img']; ?>" alt="sum" style="margin-top:17px;" width="80" height="40">
                                        <input type="text" style="margin-bottom:13px;" name="pr" id="pr" size="5"></p>
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <p><input type="submit" value="Комментировать" name="sub_com"></p>
                                    </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php include("blocks/footer.php"); ?>
</table>

</body>
</html>