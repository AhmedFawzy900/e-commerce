<?php
    include 'connection.php';
    include 'functions.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['add_to_cart'])) {
        $pid = $_POST['pid'];
        if (isset($pid)) {
           addToCard($pid,$user_id);
        }
    }elseif (isset($_POST['add_to_wishlist'])) {
        $pid = $_POST['pid'];
        if (isset($pid)) {
           addToTrips($pid,$user_id);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- bootstrap cdn -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php include './shared/navbar.php' ?>
    <section class="product_detail ">
        <?php 
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $selectProducts = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $id")
                                 or die('query failed');
                if (mysqli_num_rows($selectProducts) > 0) {
                    while ($fetchProducts = mysqli_fetch_assoc($selectProducts)) {
                        ?>
                        <div class="popup-card">
                            <div class="popup-card-details">
                                <div class="popup-image">
                                    <div class="popup-img">
                                    <figure>
                                        <img src="./uploaded_images/<?= $fetchProducts['thump1']; ?>" id="mainImg" />
                                    </figure>
                                    <div class="thumb-list">
                                        <ul>
                                            <li><img src="./uploaded_images/<?= $fetchProducts['thump1']; ?>" id="thumb1"></li>
                                            <li><img src="./uploaded_images/<?= $fetchProducts['thump2']; ?>" id="thumb2"></li>
                                            <li><img src="./uploaded_images/<?= $fetchProducts['thump3']; ?>" id="thumb3"></li>
                                            <li><img src="./uploaded_images/<?= $fetchProducts['thump4']; ?>" id="thumb4"></li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <h2><?= $fetchProducts['title']; ?></h2>
                                    <h1>Price:<span><?= $fetchProducts['price']; ?></span>$</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A deserunt nulla ex odio repellat, aliquid at nam dolores in quasi excepturi dolore vitae expedita eaque corporis, saepe quisquam ad doloribus!<?= $fetchProducts['description']; ?></p>
                                    <form  method="post" class="d-flex justify-content-start align-items-center">
                                        <input type="hidden" name="pid" value="<?= $fetchProducts['id']; ?>">
                                        <input type="submit" name="add_to_cart" value="Add to cart" class="mr-3 add_to_card btn btn-outline-dark"> 
                                        <input type="submit" name="add_to_wishlist" value="Add to wishlist" class="add_to_wishlist btn btn-outline-secondary">
                                    </form>
                                </div>
                            </div>
                           
                        </div>
                        <?php
                    }
                }
            }
        ?>
    </section>


    <script>
        const mainImg = document.getElementById('mainImg'),
              thumb1= document.getElementById('thumb1'),
              thumb1Src = thumb1.src,
              thumb2 = document.getElementById('thumb2'),
              thumb2Src = thumb2.src,
              thumb3 = document.getElementById('thumb3'),
              thumb3Src = thumb3.src,
              thumb4 = document.getElementById('thumb4'),
              thumb4Src = thumb4.src;

        thumb1.onclick = () => mainImg.src = thumb1Src;
        thumb2.onclick = () => mainImg.src = thumb2Src;
        thumb3.onclick = () => mainImg.src = thumb3Src;
        thumb4.onclick = () => mainImg.src = thumb4Src;

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>