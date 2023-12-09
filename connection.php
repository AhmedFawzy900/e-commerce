<?php
$conn = mysqli_connect("localhost","root","","ecommerce");
if(!$conn)
{
   die("connection failed:".mysqli_connect_error());
} else{
    // echo "connection successful";
}

?>