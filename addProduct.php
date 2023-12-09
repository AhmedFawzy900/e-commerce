
<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];


    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $thump1 = $_FILES['thump1']['name'];
        $thump1_temp_name = $_FILES['thump1']['tmp_name']; 
        $thump1_folder1 = './uploaded_images/'.$thump1; 

        $thump2 = $_FILES['thump2']['name'];
        $thump2_temp_name = $_FILES['thump2']['tmp_name']; 
        $thump2_folder2 = './uploaded_images/'.$thump2; 

        $thump3 = $_FILES['thump3']['name'];
        $thump3_temp_name = $_FILES['thump3']['tmp_name']; 
        $thump3_folder3 = './uploaded_images/'.$thump3; 
        
        $thump4 = $_FILES['thump4']['name'];
        $thump4_temp_name = $_FILES['thump4']['tmp_name']; 
        $thump4_folder4 = './uploaded_images/'.$thump4; 
     
        $query= mysqli_query($conn ,
                "INSERT INTO 
                `products`(`id`, `title`, `price`, `description`, `thump1`, `thump2`, `thump3`, `thump4`, `user_id`) 
                VALUES 
                ('','$title','$price','$description','$thump1','$thump2','$thump3','$thump4','$user_id')")
                or die('query Faild');

        if ($query) {
           move_uploaded_file($thump1_temp_name,$thump1_folder1);
           move_uploaded_file($thump2_temp_name,$thump2_folder2);
           move_uploaded_file($thump3_temp_name,$thump3_folder3);
           move_uploaded_file($thump4_temp_name,$thump4_folder4);

           header("Location: home.php");
        }else {
            echo "Product not Added";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- bootstrap cdn -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!-- navbar -->
    <?php include './shared/navbar.php'; ?>
    <div class="container">

        <form method="post" enctype="multipart/form-data" class="form">
            <h1>Add Product</h1>
            <div class="input_field">
                <label > Title </label>
                <input type="text" name="title" />
            </div>
            <div class="input_field">
                <label > Price </label>
                <input type="text" name="price" />
            </div>
            <div class="input_field">
                <label> Thumb1 </label>
                <input type="file" name="thump1" accept="image/*" />
            </div>
            <div class="input_field">
                <label > Thumb2 </label>
                <input type="file" name="thump2" accept="image/*" />
            </div>
            <div class="input_field">
                <label > Thumb3 </label>
                <input type="file" name="thump3" accept="image/*" />
            </div>
            <div class="input_field">
                <label > Thumb4 </label>
                <input type="file" name="thump4" accept="image/*" />
            </div>
            <div class="input_field textarea">
                <label > Description </label>
                <textarea  name="description" cols="30" rows="10"></textarea>
            </div>
            <input type="submit" name="submit" value="Add Product" class="add_product btn btn-primary">
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>