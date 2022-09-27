<?php
session_start();
require 'functions.php';
$_SESSION["admin"] = "admin";

if (isset($_POST["tambah"])) {
    if (tambahProduk($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Data Produk Berhasil Di Tambah!');
                    document.location.href = 'adminProduk.php';
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | TAMBAH PRODUK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_tambahProduk.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-header">
        <h2>Tambah Produk</h2>
        <ul>
            <li>
                <a href="">Selamat Datang, <?php error_reporting(E_ALL);
                                            echo $_SESSION["admin"]; ?> </a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="content-form">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <div class="input_container">
                        <label>Nama Produk</label>
                        <input type="text" class="input" name="nama_produk" required>
                    </div>
                    <div class="input_container">
                        <label>Stok</label>
                        <input type="number" class="input" name="stok" required>
                    </div>
                    <div class="input_container">
                        <label>Harga</label>
                        <div class="harga"><label>Rp</label></div>
                        <input type="number" class="input" name="harga" required>
                    </div>
                    <div class="input_container">
                        <label>Gambar</label>
                        <input type="file" class="input-gambar" name="gambar" required>
                    </div>
                    <button type="submit" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>