<?php include("blocks/bd.php");

$result = mysqli_query($db,"SELECT title, meta_d, meta_k, mytext FROM settings WHERE pages='secret'");

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

if (isset($_POST['code'])) {

  $code = $_POST['code'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $myrow['meta_d']; ?>">
    <meta name="keywords" content="<?php echo $myrow['meta_k']; ?> ">
    <title>
        <?php echo $myrow['title']; ?>
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
                        <td>
                            <?php include("blocks/lefttd.php"); ?>
                        </td>
                        <td style="float:left;">
                            <?php $n = 0;
                            include("blocks/nav.php") ?>
                            <?php 
                            echo $myrow['mytext'];

                            $result0 = mysqli_query($db,"SELECT prcode FROM options");
                            if ($result0) {

                              $myrow0 = mysqli_fetch_array($result0);
                              $prcode = $myrow0['prcode'];
                            } else {
                              exit("<p>Не удалось получить код секретного раздела. Проверьте наличие таблиц./p>");
                            }


                            if (!isset($code) or $code != $prcode){
                            echo "<form name='sec' acrtion='secret.php' method='post'>
                        <p class='middle'><strong>Введите код подписчика</strong></p>
                        <p class='middle'><input type ='text' class='sinput'name='code'></p>
                        <p class='middle'><input type ='submit' class='sbutton' name='submit' value='Получить доступ'></p>
                        </form>
                        <p class='middle'><img src='img/zam.jpg'></p>";

                            $result = mysqli_query($db,"SELECT id,title,description,date,author,mini_img,view FROM data WHERE secret='1'");

                            if (!$result) {

                              echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

                              exit(mysqli_error());
                            }

                            if (mysqli_num_rows($result) > 0) {

                              $myrow = mysqli_fetch_array($result);
                              do {
                                printf('<table class="post">
                                         <tr>
                                                <td class="post_title">
                                                    <p class="post_secret"><img class="mini" src="%s"><a href="#">%s{доступ закрыт}</a></p>
                   <p class="post_adds">Дата добавления: %s</p>
                   <p class="post_adds">Автор урока: %s</p>
               </td>
              </tr>
                                            <tr>
                                                <td>%s <p class="post_view">Просмотров: %s</p></td>
                                            </tr>
          </table><br><br>', $myrow['mini_img'], $myrow['title'], $myrow['date'], $myrow['author'], $myrow['description'], $myrow['view']);
                              } while ($myrow = mysqli_fetch_array($result));
														}
													}

													else{
                            $result = mysqli_query($db,"SELECT id,title,description,date,author,mini_img,view FROM data WHERE secret='1'");

                            if (!$result) {

                              echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

                              exit(mysqli_error());
                            }

                            if (mysqli_num_rows($result) > 0) {

                              $myrow = mysqli_fetch_array($result);
                              do {
                                printf('<table class="post">
                                         <tr>
                                                <td class="post_title">
                                                    <p class="post_name"><img class="mini" src="%s"><a href="view_post.php?id=%s">%s</a></p>
                   <p class="post_adds">Дата добавления: %s</p>
                   <p class="post_adds">Автор урока: %s</p>
               </td>
              </tr>
                                            <tr>
                                                <td>%s <p class="post_view">Просмотров: %s</p></td>
                                            </tr>
          </table><br><br>', $myrow['mini_img'], $myrow['id'], $myrow['title'], $myrow['date'], $myrow['author'], $myrow['description'], $myrow['view']);
                              } while ($myrow = mysqli_fetch_array($result));
														}
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