<?php include_once ("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body><center><h1>Register</h1></center>
<div>
<center>
    <form action="" method="post">
        <p>Username: <input type="text" name="username" required></p>
        <p>Full Name: <input type="text" name="fullname" required></p>
        <p>Password: <input type="password" name="passkey" required></p>
        <input type="submit" value="Register" name="register" > <a href="Login.php">Login</a>
    </form>
    </center>
    </div>
        <?php
             if(isset($_POST['register'])){
                $user_name = $_POST['username'];
                $full_name = $_POST['fullname'];
                $pass_key = $_POST['passkey'];


                $query = "INSERT INTO accounts (username, full_name, passkey) Value ('$user_name','$full_name', '$pass_key' )";
                mysqli_query($conn, $query);
                echo "<script>window.alert('Register Successfully'); window.location.href=('Login.php');</script>";
             }
        ?>

</body>
</html>