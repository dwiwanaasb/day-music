<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM riwayatKeranjang");
$_SESSION["admin"] = "admin";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_adminOrder.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu Admin</header>
        <ul>
            <li class="on"><a href="adminOrder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Riwayat Keranjang</a></li>
            <li><a href="adminPembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Riwayat Pembayaran</a></li>
            <li><a href="adminProduk.php"><i class="fa fa-clipboard-list" aria-hidden="true"></i>Daftar Produk</a></li>
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

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Produk</th>
                <th>Jumlah Beli</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama_user"]; ?></td>
                    <td><?php echo $row["nama_produk"]; ?></td>
                    <td><?php echo $row["jumlah_beli"]; ?></td>
                    <td><?php echo $row["tanggal"]; ?></td>
                    <td><?php echo $row["harga"]; ?></td>
                    <td class="aksi"><a href="adminHapusOrder.php?id_cart=<?php echo $row["id_cart"]; ?>"><button class="hapus">Hapus</button></a></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>