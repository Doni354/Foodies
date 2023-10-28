<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>List panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
    table {
        width: 80%; /* Lebar tabel diperbesar */
        margin: 0 auto; /* Tabel di tengah */
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: left;
        font-size: 16px; /* Ubah ukuran font */
    }

    th {
        background-color: #f2f2f2;
    }

    .delete-button {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: darkred;
    }

    .center-text {
        text-align: center; /* Mengatur teks di tengah */
    }
</style>

</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
        };
    };
    ?>

    <?php include 'header.php'; ?>
    <section class="display-product-table">
    <table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th>Email</th>
                <th>Metode</th>
                <th>Flat</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Pin Code</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Buat koneksi ke database (gantilah dengan informasi koneksi Anda)
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $dbname = 'shop_db';

            $conn = new mysqli($host, $user, $pass, $dbname);

            // Periksa koneksi database
            if ($conn->connect_error) {
                die("Koneksi database gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil data dari tabel "order"
            $query = "SELECT * FROM `order`"; // Sesuaikan dengan nama tabel "order" yang sesuai di database Anda

            $result = $conn->query($query);

            $counter = 1;
            if ($result->num_rows > 0) {
                while ($order = $result->fetch_assoc()) {
                    echo "<tr>";
                                echo "<td class='center-text'>" . $counter . "</td>";
                                echo "<td>" . $order['name'] . "</td>";
                                echo "<td class='center-text'>" . $order['number'] . "</td>";
                                echo "<td>" . $order['email'] . "</td>";
                                echo "<td>" . $order['method'] . "</td>";
                                echo "<td>" . $order['flat'] . "</td>";
                                echo "<td>" . $order['street'] . "</td>";
                                echo "<td>" . $order['city'] . "</td>";
                                echo "<td>" . $order['state'] . "</td>";
                                echo "<td>" . $order['country'] . "</td>";
                                echo "<td>" . $order['pin_code'] . "</td>";
                                echo "<td><a href='delete.php?order_id=" . $order['order_id'] . "' class='delete-button'>Hapus</a></td>"; // Tombol "Hapus" di dalam kolom "Aksi"
                                echo "</tr>";

                    $counter++;
                }
            } else {
                echo "<tr><td colspan='12'>Tidak ada data dalam tabel order.</td></tr>";
            }

            // Tutup koneksi database
            $conn->close();
            ?>
        </tbody>
    </table>
    </section>
    <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
