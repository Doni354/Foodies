<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>admin</span></h3>
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>this is an admin page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>
<header class="header">

   <div class="flex">
      <?php if ($_SESSION["role"] === "Admin"): ?>
         <a href="index.php" class="logo">Admin|Foodies</a>
      <?php endif; ?>
      <?php if ($_SESSION["role"] === "User"): ?>
         <a href="index.php" class="logo">Foodies</a>
      <?php endif; ?>

      <nav class="navbar">
      <?php if ($_SESSION["role"] === "Admin"): ?>
         <a href="admin.php">Add products</a>
         <a href="order.php">Order</a>
            <?php endif; ?>
         <a href="products.php">View products</a>
         <a href="logout.php">Logout</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>