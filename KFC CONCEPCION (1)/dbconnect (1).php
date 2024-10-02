<?php
 $server = "localhost";
 $username ="root";
 $password = "";
 $dbname = "users1";

 $conn = mysqli_connect($server,$username,$password,$dbname);
 if(!$conn){
    echo "Failed";
    
 }else{
   // echo"Connected Successfully";
 }
?>
