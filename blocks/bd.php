<?php
$db = mysqli_connect("localhost","id8332451_bloguser","rashad3129");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// ...some PHP code for database "my_db"...

// Change database to "test"
mysqli_select_db($db,"id8332451_phpblog");
?>