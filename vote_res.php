<?php include("blocks/bd.php");
if(isset($_POST['id']))
{
    $id = $_POST['id'];

}

if(isset($_POST['score']))
{
    $score = $_POST['score'];

}

$result = mysqli_query($db,"SELECT rating,q_vote FROM data WHERE id='$id'");

if(!$result){

echo "<p>Запрос на выборку данных из базы не прошел.Напишете об этом администратору admin@gmail.com <br><strong>Код ошибки:</strong></p>";

exit(mysqli_error());

}

if(mysqli_num_rows($result) > 0){
    $myrow = mysqli_fetch_array($result);

    $new_rating = $myrow['rating'] + $score;
    $new_q_vote = $myrow['q_vote'] + 1;

    $update = mysqli_query($db,"UPDATE data SET rating='$new_rating', q_vote='$new_q_vote' WHERE id='$id'");

    if($update){
        echo "<html>
        <head>
        <meta http-equiv='Refresh' content='0; URL=view_post.php?id=$id'>
        </head>
        </html>";
        exit();
    }
}

else{
    echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
    exit();
}

?>