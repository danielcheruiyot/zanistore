<?php 
    include 'config.php';

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND name = '$name'") or die("Query failed");

        if (mysqli_num_rows($select) > 0 ) {
            $message[] = 'user already exists';
        } else {
            mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name','$email','$pass')") or die('Query failed');
            $message[] = 'registration successfully!!';
            header('location:login.php');
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!--custom css filel ink-->
    <link href="css/style.css?<?=filemtime("css/style.css")?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php 
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
            }
        }
    ?>
    
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3> 
            <input type="text" name="name" required placeholder="Enter username" class="box">
            <input type="email" name="email" required placeholder="Enter email" class="box">
            <input type="password" name="password" required placeholder="Enter password" class="box">
            <input type="password" name="cpassword" required placeholder="Confirm password" class="box">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>Already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>  

  
    

    
</body>
</html>