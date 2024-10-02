<?php include_once('dbconnect.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><center><h1>Login</h1></center>
<div><center>
      <form action="" method="post">
        <p><b>Username:</b> <input type="text" name="username"></p>
        <p><b>Password:</b> <input type="password" name="password"></p>
        <input type="submit" value="Login" name="log"> <a href="register.php">Register</a>

      </form>
      </div>
      </center>
      <?php
            if(isset($_POST['log'])){
                $user_name = $_POST['username'];
                $pass_word = $_POST['password'];

                $query = "SELECT * FROM accounts WHERE username ='$user_name' and passkey= '$pass_word'";
                $stmt = mysqli_query($conn, $query);
                $result = mysqli_num_rows($stmt);

                if($result==1){
                    echo "<script>window.alert('Login Successfully'); window.location.href=('index.php');</script>";
                }else{
                    echo "<script>window.alert('Incorrect Username or Password');</script>";
                }
            }
      
      ?>
</body>
</html>