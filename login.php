<?php 
    include 'config.php';
    session_start();

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die("Query failed");

        if (mysqli_num_rows($select) > 0 ) {
            $row = mysqli_fetch_assoc($select);
            echo $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            $message[] = 'incorrect email or password';
        }
    }



?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h3>Login</h3> 
            <input type="email" name="email" required placeholder="Enter email" class="box">
            <input type="password" name="password" required placeholder="Enter password" class="box">
            <input type="submit" name="submit" class="btn" value="login">
            <p>Dont have an account? <a href="register.php">register now</a></p>
        </form>
    </div>  
    

    
</body>
</html>