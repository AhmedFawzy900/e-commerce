<?php 
    include 'connection.php';
    session_start();
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        
        $select = mysqli_query($conn , "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$password' ") or die('query failed');
        if (mysqli_num_rows($select) > 0) {
           $row = mysqli_fetch_assoc($select);
           $_SESSION['user_id'] = $row['id'];
           header('location:home.php');
        }else{
            $massage[]="incorrect email or password";
        }
    
    
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
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
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password" id="pwd" placeholder="Password">
                </div>
                <input type="submit" name="submit" class="btn mt-3" value="Login">
            </form>
            <div class="text-center fs-6">
                <a href="#">Forget password?</a> or <a href="./register.php">Sign up</a>
            </div>
    </div>


    <script src="./js/script.js"></script>
</body>
</html>