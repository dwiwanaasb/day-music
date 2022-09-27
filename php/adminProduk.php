<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM produk");
$_SESSION["admin"] = "admin";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $result = mysqli_query($conn, "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_adminProduk.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu Admin</header>
        <ul>
            <li><a href="adminOrder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Riwayat Keranjang</a></li>
            <li><a href="adminPembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Riwayat Pembayaran</a></li>
            <li class="on"><a href="adminProduk.php"><i class="fa fa-clipboard-list" aria-hidden="true"></i>Daftar Produk</a></li>
            <li><a href="adminUser.php"><i class="fa fa-user" aria-hidden="true"></i>Daftar User</a></li>
            <li><a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <div class="container-header">
        <h2>Day Music</h2>
        <ul>
            <li>
                <a href="">Selamat Datang, <?php error_reporting(E_ALL);
                                            echo $_SESSION["admin"]; ?> </a>
            </li>
        </ul>
    </div>


    <div class="container-search">
        <form method="post" action="">
            <input type="text" name="keyword" placeholder="Masukkan Nama Produk.." autocomplete="off">
            <button type="submit" name="cari"><i class="fas fa-search"></i></button>
        </form>
        <a href="tambahProduk.php"><button class="tambah"><i class="fas fa-plus"></i>Tambah Data</button></a>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama_produk"]; ?></td>
                    <td><?php echo $row["stok"]; ?></td>
                    <td><?php echo $row["harga"]; ?></td>
                    <td><img src="../img/<?php echo $row["gambar"]; ?>"></td>
                    <td class="aksi"><a href="updateProduk.php?id_produk=<?php echo $row["id_produk"]; ?>"><button class="update"><i class="fas fa-pencil-alt"></i></button></a><a href="adminHapusProduk.php?id_produk=<?php echo $row["id_produk"]; ?>"><button class="hapus"><i class="fas fa-trash"></i></button></a></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>