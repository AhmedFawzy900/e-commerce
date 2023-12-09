<?php 
    include 'connection.php';
    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
        $profile_image = $_FILES['profile_image']['name'];
        $temp_name = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size']; // Get the size of the uploaded image
        $folder = './uploaded_images/'.$profile_image;
        $select = mysqli_query($conn , "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$password' ") or die('query failed');
        if (mysqli_num_rows($select) > 0) {
            $massage[]='user already exist';
        }else{
            if($password != $cpassword){
                $massage[]='confirm password not matched';
            }elseif ($image_size > 2000000 ) {
                $massage[]= 'image size is too large';
            }else{
                if (!is_null($email) && !is_null($password) && !is_null($cpassword) && !is_null($username) && !is_null($profile_image)) {
                    $insert=mysqli_query($conn,"INSERT INTO `user_form`(name,email,password,profile_img)
                    VALUES('$username','$email','$password','$profile_image')") or die('query failed');
                    if ($insert) {
                        move_uploaded_file($temp_name,$folder);
                        $massage[]="Registered successfully";
                        header('location:login.php');
                    }else{
                        $massage[]='Registered failed';
                    }
            
                }else{
                    $massage[]='please fill all the field';
                }
                
        
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style.css">

</head>
<body>
    <div class="wrapper">
            <div class="logo">
                <img src="./images/logo.png" alt="">
            </div>
            <?php
                if (isset($massage)) {
                    foreach ($massage as $massage) {
                         echo '<div class="massage">'.$massage.'</div>';
                    }
                }
            ?>
            <form class="p-3 mt-3" method="POST" enctype="multipart/form-data">
                <div class="form-field d-flex align-items-center">
                    <span class="far fa-user"></span>
                    <input type="text" name="username" id="userName" placeholder="Username" required>
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fa-regular fa-envelope"></span>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password"  placeholder="Password" required>
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="cpassword" placeholder="Confitm Password" required>
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fa-regular fa-image"></span>
                    <input type="file" name="profile_image" required>
                </div>
                <input type="submit" class="btn mt-3" value="Sign up" name="submit">
            </form>
            <div class="text-center fs-6">
                <a href="#">Forget password?</a> or <a href="./login.php">Sign in</a>
            </div>
    </div>


    <script src="./js/script.js"></script>
</body>
</html>