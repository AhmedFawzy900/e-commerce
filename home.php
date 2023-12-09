<?php 
    include 'connection.php';
    include 'functions.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    $select = mysqli_query($conn , "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    if(!isset($user_id)){
        header('location:login.php');
    }elseif(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }

    if(isset($_POST['add_to_cart'])) {
       $pid = $_POST['pid'];
       if(isset($pid)) {
          addToCard($pid,$user_id);
       }
      }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- bootstrap cdn -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- swiper cdns -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet">
    <!-- footer links -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">


</head>
<body>
    <!-- navbar -->
    <?php include 'shared\navbar.php'; ?>
    <!-- swiper -->
    <?php include 'shared/swiper.php'; ?>
    <div class="container home">
        <div class="container bootdey mt-5">
            <div class="row product-list">  
                <?php 
                    $products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if (mysqli_num_rows($products) > 0) {
                        while ($fetchProducts = mysqli_fetch_assoc($products)) {
                            ?>
                             
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <section class="panel">
                                    <div class="pro-img-box">
                                        <img src="./uploaded_images/<?php echo $fetchProducts['thump1']; ?>" alt="" />
                                        <form  method="post" id="myForm">
                                            <input type="submit" style="width: 100%;" name="add_to_cart" class="btn form-control btn-primary" value="Add to cart">
                                            <input type="hidden" name="pid" value="<?php echo $fetchProducts['id']; ?>">
                                        </form>
                                         
                                        <a href="./viewProduct.php?id=<?php echo $fetchProducts['id']; ?>" class="view">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>

                                    <div class="panel-body text-center">
                                        <h4>
                                            <a href="#" class="pro-title">
                                                <?php echo $fetchProducts['title']; ?>
                                            </a>
                                        </h4>
                                        <p class="price"><?php echo $fetchProducts['price']; ?></p>
                                    </div>
                                </section>
                            </div>
                            
                            <?php
                        }
                    }
                ?>
            </div>
            <!-- feedbacks -->
        </div>
    </div>
    <?php include 'shared/feedback.php'; ?>
    <?php include 'shared/footer.php'; ?>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- swiper js -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>