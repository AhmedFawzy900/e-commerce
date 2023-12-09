<?php 
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
     
    $select = mysqli_query($conn , "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select); 
    }

    if(isset($_POST['update_profile'])){
        $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
        $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
        
        mysqli_query($conn , "UPDATE `user_form` SET name='$update_name' , email='$update_email' WHERE id = '$user_id'")
        or die('update username and email failed');

        // $old_password=$_POST['old_password'];
        // $update_password = mysqli_real_escape_string($conn,md5($_POST['update_password']));
        // $new_password = mysqli_real_escape_string($conn,md5($_POST['new_password']));
        // $confirm_password = mysqli_real_escape_string($conn,md5($_POST['cnew_password']));
        
        // if (!empty($update_password) || !empty($new_password) || !empty($confirm_password)) {
        //     if($update_password != $old_password){
        //         $message[]="old password not matched";
        //     }elseif($new_password != $confirm_password){
        //         $message[]="confirm password not matched";
        //     }else{
        //         mysqli_query($conn , "UPDATE `user_form` SET password = '$confirm_password' WHERE id = '$user_id'") or die('update password failed');
        //         $message[]="password updated successfily";
        //     }
        // }
        $old_image=$fetch['profile_img'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp = $_FILES['update_image']['tmp_name'];
        $update_image_folder ='./uploaded_images/'.$update_image;

        if ($update_image_size > 2000000) {
            $message[]="image size is very large";
        }else{
            if(!empty($update_image)){
                $update_image_query=mysqli_query($conn,"UPDATE `user_form` SET profile_img='$update_image' WHERE id = '$user_id'") or die('image update failed');
                if ($update_image_query) {
                    move_uploaded_file($update_image_tmp,$update_image_folder);
                } 
                $message[]="image updated successfuly";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>
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
    <?php include './shared/navbar.php'; ?>
    
    <div class="wrapper">
            <div class="update-profile-image">
                <img src="./uploaded_images/<?= $fetch['profile_img']; ?>" alt="">
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
                    <input type="text" value="<?= $fetch['name']; ?>" name="update_name" id="userName" placeholder="Username">
                </div> 
                <div class="form-field d-flex align-items-center">
                    <span class="fa-regular fa-envelope"></span>
                    <input type="email" value="<?= $fetch['email']; ?>" name="update_email" id="email" placeholder="Email">
                </div>
                <!-- <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="hidden" name="old_password" value="<?php echo $fetch['password']?>" >
                    <input type="password"  name="update_password"  placeholder="Old Password">
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="new_password" placeholder="New Password" >
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="cnew_password" placeholder="Confirm New Password" >
                </div> -->
                <div class="form-field d-flex align-items-center">
                    <span class="fa-regular fa-image"></span>
                    <input type="file" name="update_image">
                </div>
                <input type="submit" class="btn mt-3" value="Update Profile" name="update_profile">
            </form>
            <!-- <div class="text-center fs-6">
                <a href="#">Forget password?</a> or <a href="./login.php">Sign in</a>
            </div> -->
    </div>


    <script src="./js/script.js"></script>
</body>
</html>