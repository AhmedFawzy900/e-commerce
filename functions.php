<?php
   include 'connection.php';
   
  function addToCard($id,$user_id){
    global $conn;
    $product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $id") or die('query failed');
    $fetchProduct = mysqli_fetch_assoc($product);
    if ($fetchProduct) {
        $title = $fetchProduct['title'];
        $price = $fetchProduct['price'];
        $description = $fetchProduct['description'];
        $thumb1 = $fetchProduct['thump1'];
        $thumb2 = $fetchProduct['thump2'];
        $thumb3 = $fetchProduct['thump3'];
        $thumb4 = $fetchProduct['thump4'];
        $quantity = 1;
        $selectCardItems = mysqli_query($conn, "SELECT * FROM `card` WHERE title = '$title' AND price = $price AND user_id = '$user_id'") or die('select failed');
        if (mysqli_num_rows($selectCardItems) > 0) {
            $fetchCardItems = mysqli_fetch_assoc($selectCardItems);
            $newQuantity = $fetchCardItems['quantity'] + 1;
            mysqli_query($conn, "UPDATE `card` SET quantity = $newQuantity WHERE title = '$title' AND price = '$price' AND user_id = '$user_id'") or die('ubdate failed');
        }else{
           mysqli_query($conn, "INSERT INTO `card` (`title`, `description`, `price`, `quantity`, `img1`, `img2`, `img3`, `img4`,`product_id`, `user_id`)
           VALUES ('$title','$description', $price, $quantity, '$thumb1', '$thumb2', '$thumb3', '$thumb4','$id', $user_id)") or die('insert failed');
        }
       
    }
}
  function addToTrips($product_id,$user_id){
    global $conn;
    $product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $product_id") or die('query failed');
    $fetchProduct = mysqli_fetch_assoc($product);
    if ($fetchProduct) {
        $id = $fetchProduct['id'];
        $title = $fetchProduct['title'];
        $price = $fetchProduct['price'];
        $description = $fetchProduct['description'];
        $thumb1 = $fetchProduct['thump1'];
        $thumb2 = $fetchProduct['thump2'];
        $thumb3 = $fetchProduct['thump3'];
        $thumb4 = $fetchProduct['thump4'];
        $quantity = 1;
        $selectTripsItems = mysqli_query($conn, "SELECT * FROM `trips` WHERE title = '$title' AND price = $price AND user_id = '$user_id'") or die('select failed');
        if (mysqli_num_rows($selectTripsItems) > 0) {
            $fetchTripsItems = mysqli_fetch_assoc($selectTripsItems);
            $newQuantity = $fetchTripsItems['quantity'] + 1;
            mysqli_query($conn, "UPDATE `trips` SET quantity = $newQuantity WHERE title = '$title' AND price = '$price' AND user_id = '$user_id'") or die('ubdate failed');
        }else{
           mysqli_query($conn, "INSERT INTO `trips` (`title`, `description`, `price`, `quantity`, `img2`, `img1`, `img3`, `img4`, `product_id`,`user_id`)
           VALUES ('$title','$description', $price, $quantity, '$thumb2', '$thumb1', '$thumb3', '$thumb4','$id' ,$user_id)") or die('insert failed');
        }
       
    }
}

function deleteFromCard($pid, $user_id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM `card` WHERE id = $pid AND user_id = $user_id") or die('delete failed');
}
function deleteFromTrips($pid, $user_id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM `trips` WHERE id = $pid AND user_id = $user_id") or die('delete failed');
}

function increaseQuantity($pid, $user_id) {
    global $conn;
    mysqli_query($conn, "UPDATE `card` SET quantity = quantity + 1 WHERE product_id = $pid AND user_id = $user_id") or die('update failed');
}
function decreaseQuantity($pid, $user_id) {
    global $conn;
    $selectCardItems = mysqli_query($conn, "SELECT * FROM `card` WHERE product_id = $pid AND user_id = '$user_id'") or die('select failed');
    if (mysqli_num_rows($selectCardItems) > 0) {
        $fetchCardItems = mysqli_fetch_assoc($selectCardItems);
        if ($fetchCardItems['quantity'] == 1) {
            deleteFromCard($pid, $user_id);
        }else{
            mysqli_query($conn, "UPDATE `card` SET quantity = quantity - 1 WHERE product_id = $pid AND user_id = $user_id") or die('update failed');
        }
    }
}
    
