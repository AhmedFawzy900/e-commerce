<?php 
    include 'connection.php';
    if(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }
?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg relative-top bg-light navbar-light" >
  <div class="container">
    <a class="navbar-brand" href="home.php"
      ><img
        id="logo"
        src="images\logo.png"
        alt="Logo"
        draggable="false"
        height="50px"
        width="170px"
        style="object-fit: cover;"
    /></a>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link mx-2" href="addProduct.php"><i class="fas fa-plus-circle pe-2"></i>Create</a>
        </li>
        <li class="nav-item">
          <a class="card-link nav-link mx-2" href="/e-commerce/card.php">
            <?php 
               $user_id = $_SESSION['user_id'];
               $select = mysqli_query($conn , "SELECT * FROM `card` WHERE user_id = '$user_id'") or die('query failed');
               if(mysqli_num_rows($select) > 0){
            ?>
            <span><?php echo mysqli_num_rows($select); ?></span>
            <?php  }?>
            <i class="fas fa-shopping-cart pe-2"></i>Card
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 trips-link" href="/e-commerce/trips.php">
          <?php 
               $user_id = $_SESSION['user_id'];
               $select = mysqli_query($conn , "SELECT * FROM `trips` WHERE user_id = '$user_id'") or die('query failed');
               if(mysqli_num_rows($select) > 0){
            ?>
            <span> <?php echo mysqli_num_rows($select); ?></span>
            <?php  }?>
            <i class="fas fa-heart pe-2"></i>Trips</a>
        </li>
        <li class="nav-item ms-3">
        <?php 
            include 'connection.php';

            $user_id = $_SESSION['user_id'];
            $select = mysqli_query($conn , "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select) > 0){
                $fetch = mysqli_fetch_assoc($select);
            }
            if(isset($user_id)){
                echo '<div class="dropdown d-flex justify-content-center align-items-center">
                            <a class="dropdown-toggle nav-link inline" href="#" role="button" id="username" data-bs-toggle="dropdown" aria-expanded="false">
                               <img class="profile_image" src="uploaded_images/'.$fetch['profile_img'].'" height="30px" width="30px" style="border-radius: 50%; margin-right: 5px; background: #c8c6c6; object-fit: cover;">'.$fetch['name'].'
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="username">
                                <li><a class="dropdown-item" href="update_profile.php?user_id='. $user_id .'">Update Profile</a></li>
                                <li><a class="dropdown-item" href="home.php?logout= '. $user_id .' " >Logout</a></li>
                            </ul>
                        </div>';
            }else{
                echo '<a class="nav-link" href="login.php"><i class="fas fa-user pe-2"></i>Login</a>';
            }
        ?>
        
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->

<script>
// Add the following JavaScript code to enable the toggle functionality
var navbarToggler = document.querySelector('.navbar-toggler');
var navbarCollapse = document.querySelector('.navbar-collapse');

navbarToggler.addEventListener('click', function() {
  navbarCollapse.classList.toggle('show');
});
</script>