<?php 
    include 'config.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)) {
        header('location:login.php');
    };
    
    if (isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
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
            <?php 
                $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
                if (mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user);
                };
             ?>

                <p> username : <span> <?php echo $fetch_user['name']; ?> </span> </p>
                <p> email : <span> <?php echo $fetch_user['email']; ?> </span> </p>

                <div class="flex"> 
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php" class="option-btn">register</a>
                    <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are you sure you wanna logout?');" class="delete-btn">logout</a>

                </div>
            </div>


            <div class="products">
                <h1 class="heading"> 
                    latest products

                </h1>

           
                <div class="box-container"> 
                    <?php 
                        $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                        if (mysqli_num_rows($select_product) > 0){
                            while ($fetch_product = mysqli_fetch_assoc($select_product)) {
                    ?>
                        <form class="box" action="" method="post"> 
                            <img src="images/<?php echo $fetch_product['image'] ?>" alt="">    
                            <div class="name"><?php echo $fetch_product['name'] ?></div>
                            <div class="price"><?php echo $fetch_product['price'] ?></div>
                            <input type="number" min="1" max="15" name="product_quantity" value="1">

                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="hidden" name="name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">

                            <input type="submit" value="add to cart" name="add_to_cart" class="btn">

                        </form>

                    <?php 
                            };
                        };
                    ?>

                </div>

            </div>

    </div>

    
</body>
</html>