<?php include("blocks/bd.php");

if(isset($_POST['id']))
{
    $id = $_POST['id'];

}

if(isset($_POST['author']))
{
    $author = $_POST['author'];
}

if(isset($_POST['text']))
{
    $text = $_POST['text'];
}

if(isset($_POST['pr']))
{
    $pr = $_POST['pr'];
}

if(isset($_POST['sub_com']))
{
    $sub_com = $_POST['sub_com'];
}


if(isset($sub_com)){

    if(isset($author)){trim($author);  }
    else{$author = "";}

    if(isset($text)){trim($text);  }
    else{$text = "";}

    if(empty($author) or empty($text)){
        exit("<p>Вы ввели не всю информоцию, вернитесь назад и заполните все поля.<p><br><input type='button' name='back' value='Вернуться назад' onclick='history.go(-1);'>");
    }

    $author = stripcslashes($author);
    $text = stripcslashes($text);
    $author = htmlspecialchars($author);
    $text = htmlspecialchars($text);

    $result = mysqli_query($db,"SELECT sum FROM comment_settings");
    $myrow = mysqli_fetch_array($result);
    
    if($pr == $myrow['sum']){

        $mydate = date("Y-m-d");
        

        $result2 = mysqli_query($db,"INSERT INTO comments (post,author,mytext,mydate) VALUES ('$id','$author','$text','$mydate')");

        $address = "joseph.rich@mail.ru";
        $subject = "Новый комментарий на блоге";

        $result3 = mysqli_query($db,"SELECT title FROM data WHERE id='$id'");

        $myrow3 = mysqli_fetch_array($result3);
        $post_title = $myrow3["title"];

        $message = "Появился комментарий к заметке - ".$post_title."\nКомментарий добавил(а): ".$author."\nТекст комментария: ".$text."\nСсылка на заметку: http://localhost/popov/phpblog/view_post.php?id=".$id."";
        mail($address,$subject,$message,"Content-type:text/plain; Charset=utf8\r\n");

        echo "<html>
        <head>
        <meta http-equiv='Refresh' content='0; URL=view_post.php?id=$id'>
        </head>
        </html>";
        exit();

    }

    else{
        exit("<p>Вы ввели не верную сумму чисел</p><br><input type='button' name='back' value='Вернуться назад' onclick='history.go(-1);'>");
    }
}
?>