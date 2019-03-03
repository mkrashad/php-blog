<td width="182px" valign="top" class="left">

<div class="nav_title">Категории</div>

<?php 
$result2 = mysqli_query($db,"SELECT * FROM categories ORDER BY id");

if(!$result2){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result2) > 0){

    $myrow2 = mysqli_fetch_array($result2);
        
        do{
            printf("<p class='point'><img src='img/arr.jpg'><a class='nav_link' href='view_cat.php?cat=%s'>%s</a></p>",$myrow2['id'],$myrow2['title']);
        }
        while($myrow2 = mysqli_fetch_array($result2));

}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}

?>

<div class="nav_title">Последние заметки</div>

<?php 

$result3 = mysqli_query($db,"SELECT id,title FROM data WHERE secret = 0  ORDER BY id DESC LIMIT 5");

if(!$result3){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result3) > 0){
    $myrow3 = mysqli_fetch_array($result3);

    do {

        printf("<p class='point'><img src='img/arr2.jpg'><a class='nav_link' href='view_post.php?id=%s'>%s</a></p>",$myrow3['id'],$myrow3['title']);

    } while ($myrow3 = mysqli_fetch_array($result3));
}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}

?>

<div class="nav_title">Архив</div>


<?php 

$result4 = mysqli_query($db,"SELECT DISTINCT left(date,7) AS month FROM data ORDER BY month DESC");

if(!$result4){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result4) > 0){
    $myrow4 = mysqli_fetch_array($result4);

    do {

        printf("<p class='point'><img src='img/arr3.jpg'><a class='nav_link' href='view_date.php?date=%s'>%s</a></p>",$myrow4['month'],$myrow4['month']);

    } while ($myrow4 = mysqli_fetch_array($result4));
}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}

?>

<div class="nav_title">Блоги друзей</div>

<?php 

$result5 = mysqli_query($db,"SELECT title,link FROM friends");

if(!$result5){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result5) > 0){
    $myrow5 = mysqli_fetch_array($result5);

    do {

        printf("<p class='point'><img src='img/arr4.jpg'><a class='nav_link' href='%s' target='_blank'>%s</a></p>",$myrow5['link'],$myrow5['title']);

    } while ($myrow5 = mysqli_fetch_array($result5));
}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}

?>
<div class="nav_title">Поиск</div>

<form action="view_search.php" method="post" name="form_s">

<p class="search_t">Поисковый запрос должен быть не менее 4-х символов.</p>
<input type="text" name="search" id="search" size="20">
<br>
<input  class="search_b" type="submit" value="Искать" name="submit_s">
</form>

<p><a href="secret.php">Секретный раздел</a></p>

<div class="nav_title">Статистика</div>

<?php 

$result10 = mysqli_query($db,"SELECT COUNT(*) FROM data");
$sum = mysqli_fetch_array($result10);

$result11 = mysqli_query($db,"SELECT COUNT(*) FROM comments");
$sum2 = mysqli_fetch_array($result11);

echo "<p class='comments'>Заметок в базе: $sum[0]<br> Комментариев: $sum2[0]</p>";
?>


</td>