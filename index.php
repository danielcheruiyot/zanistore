<?php 
    include 'config.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)) {
        header('location:login.php');
    } 
    
    
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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

    <div class="container"> 
        <div class="user-profile"> 

        </div>

    </div>

    
</body>
</html>