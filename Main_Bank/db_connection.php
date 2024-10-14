<?php 

$db_server = "localhost";
$db_user = "root";
$db_pass="";
$db_name = "MyProject";
// $conn= "";

$conn= mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if($conn){
  $connection_status= "You are connected!";
}

else{
  echo "Not connectd!";
}

     ?>