
<!DOCTYPE html>
<html>
<head>
    <?php 
    include'config.php'
    ?>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

    <div class="container">
        <?php if (isset($_SESSION["username"])) : ?>
            <h1 style="font-size: 36px;
            margin: 10px 0;">Selamat datang, <?php echo $_SESSION["username"]; ?></h1>
            
            <?php if ($_SESSION["role"] === "Admin"): ?>
            <?php endif; ?>

            <?php if ($_SESSION["role"] === "User"): ?>
            <?php endif; ?>
        <?php else : ?>
            <p>Anda belum login. Silakan <a href="login.html">login</a> terlebih dahulu.</p>
        <?php endif; ?>
    </div>

    <!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
