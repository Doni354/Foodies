<?php
session_start();

// Hubungkan ke database
$koneksi = new mysqli("localhost", "root", "", "shop_db");

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"]; // Ambil alamat email dari formulir
    $password = $_POST["password"];
    $role = "User"; // Tetapkan peran sebagai "User" untuk pendaftar

    // Periksa apakah username atau email sudah digunakan
    $checkQuery = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
    $checkStmt = $koneksi->prepare($checkQuery);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
      $error[] = '<h5 style="color:red">username/email already exist</h5>';
    } else {
        // Simpan pengguna baru ke database
        $insertQuery = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $insertStmt = $koneksi->prepare($insertQuery);
        $insertStmt->bind_param("ssss", $username, $email, $password, $role);
        
        if ($insertStmt->execute()) {
            echo "Pendaftaran berhasil. Silakan <a href='login.php'>login</a>.";
        } else {
            echo "Pendaftaran gagal. Silakan coba lagi.";
        }
    }
}

$koneksi->close();
?>


<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Register</title>
      <link rel="stylesheet" href="loginUI.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            REGISTER
         </div>
            <form method="post" action="register.php">
                <div class="field">
                    <div class="fas fa-user"></div>
                <input type="text" name="username"placeholder="Username" required><br>
                </div>
                <div class="field">
                    <div class="fas fa-envelope"></div>
                <input type="email" name="email" placeholder="Email" required><br> <!-- Tambahkan kolom email -->
                </div>
                <div class="field">
                    <div class="fas fa-lock"></div>
                <input type="password" name="password" placeholder="Password" required><br>
                </div>
                <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
            <button>Register</button>
            <div class="link">
                Have an account
                <a href="login.php">Login now!</a>
             </div>
         </form>
      </div>
   </body>
</html>