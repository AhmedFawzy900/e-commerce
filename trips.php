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
    if (isset($_POST['delete_from_trips'])) {
        $pid = $_POST['pid'];
       if(isset($pid)) {
          deleteFromTrips($pid,$user_id);
       }
    }

    $tripsItems = mysqli_query($conn, "SELECT * FROM `trips` where user_id = '$user_id'") or die('query failed');
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- bootstrap cdn -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- navbar -->
    <?php include 'shared\navbar.php'; ?>
    <!-- add product button -->
    <!-- <div class="container home">
        <h1>trips page</h1>
        <div class="container bootdey mt-5">
            <div class="row product-list">  
                <?php 
                    $tripsItems = mysqli_query($conn, "SELECT * FROM `trips` where user_id = '$user_id'") or die('query failed');
                    if (mysqli_num_rows($tripsItems) > 0) {
                        while ($fetchProducts = mysqli_fetch_assoc($tripsItems)) {
                            ?>
                             
                            <div class="col-md-4 col-sm-4 col-xs-6 ">
                                <section class="panel">
                                    <div class="pro-img-box">
                                        <img src="./uploaded_images/<?php echo $fetchProducts['img1']; ?>" alt="" />
                                        <form  method="post" id="myForm">
                                            <input type="submit" style="width: 100%;" name="delete_from_trips" class="btn form-control btn-primary" value="Delete from Trips">
                                            <input type="hidden" name="pid" value="<?php echo $fetchProducts['id']; ?>">
                                        </form>
                                         
                                        <a href="./viewProduct.php?id=<?php echo $fetchProducts['product_id']; ?>" class="view">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>

                                    <div class="panel-body text-center">
                                        <h4>
                                            <a href="#" class="pro-title">
                                                <?php echo $fetchProducts['title']; ?>
                                            </a>
                                        </h4>
                                        <h4>
                                            <a href="#" class="pro-title">
                                                <?php echo $fetchProducts['quantity']; ?>
                                            </a>
                                        </h4>
                                        <p class="price"><?php echo $fetchProducts['price']; ?></p>
                                    </div>
                                </section>
                            </div>
          
                            <?php
                        }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
                    }
                ?>
            </div>
        </div>
    </div> -->
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-12">
                    
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">trips - <?php echo mysqli_num_rows($tripsItems); ?> items</h5>
                        </div>
                        <div class="card-body">
                            <?php 
                                $tripsItems = mysqli_query($conn, "SELECT * FROM `trips` where user_id = '$user_id'") or die('query failed');

                                if (mysqli_num_rows($tripsItems) > 0) {
                                    while ($fetchProducts = mysqli_fetch_assoc($tripsItems)) {
                            ?>
                            <!-- Single item -->
                            <div class="row">
                                
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                    <img src="./uploaded_images/<?php echo $fetchProducts['img1']; ?>"
                                        class="w-100" alt="Blue Jeans Jacket" />
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                    </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p><strong><?php echo $fetchProducts['title']; ?></strong></p>
                                    <p>Price: $<?php echo $fetchProducts['price']; ?></p>
                                    <p class="text-start ">
                                        <strong>Total Price: $<?php echo $fetchProducts['price']*$fetchProducts['quantity']; ?></strong>
                                    </p>
                                    <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                    title="View product">
                                    <a href="./viewProduct.php?id=<?php echo $fetchProducts['product_id']; ?>" class="text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm mb-2 " data-mdb-toggle="tooltip"
                                    title="Move to the wish list">
                                        <form  method="post" class="myForm" id="myForm">
                                            <input type="submit" class="btn btn-danger btn-sm"  name="delete_from_trips" value="delete from trips">
                                            <input type="hidden" name="pid" value="<?php echo $fetchProducts['id']; ?>">
                                        </form>     
                                    </button>
                                    <!-- Data -->
                                </div>

                             
                            </div>
                            <!-- Single item -->

                            <hr class="my-4" />
                            <?php
                                    }
                                }else{
                                    echo '<p class="empty">no products added yet!</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>