<?php
session_start();

// Hubungkan ke database
$koneksi = new mysqli("localhost", "root", "", "shop_db");

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST["email_or_username"];
    $password = $_POST["password"];

    // Periksa apakah email atau username ada dalam database
    $sql = "SELECT * FROM users WHERE (email = ? OR username = ?) AND password = ? LIMIT 1";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $email_or_username, $email_or_username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];

        header("Location: Index.php"); // Ganti ini dengan halaman yang sesuai
        exit();
      }else{
         $error[] = '<h5 style="color:red">incorrect username/email or password!</h5>';
      }
   
   };

$koneksi->close();
?>




<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>LOGIN TO CONTINUE</title>
      <link rel="stylesheet" href="loginUI.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            LOGIN
         </div>
         <form action="" method="post" >
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="text" name="email_or_username" placeholder="Email or Username">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="password" placeholder="Password">
            </div>
            <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
            <button>LOGIN</button>
            <div class="link">
               Not a member?
               <a href="register.php">Signup now</a>
            </div>
         </form>
      </div>
   </body>
</html>