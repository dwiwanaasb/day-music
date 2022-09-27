<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM keranjang");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | ORDER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_keranjang.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu</header>
        <ul>
            <li><a href="daftarProduk.php"><i class="fa fa-list-alt" aria-hidden="true"></i>List Produk</a></li>
            <li class="on"><a href="keranjang.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Keranjang</a></li>
            <li><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <div class="container-header">
        <h2>Keranjang</h2>
        <ul>
            <li>
                <?php
                $user_terlogin = $_SESSION["username"];
                $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
                $data_user = mysqli_fetch_assoc($sql_user);
                ?>
                <a href="update-profile.php">Selamat Datang, <?php error_reporting(E_ALL);
                                                                echo $data_user["username"]; ?> </a>
            </li>
        </ul>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah Beli</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_harga = 0; ?>
            <?php $i = 1; ?>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama_produk"]; ?></td>
                    <td><?php echo $row["jumlah_beli"]; ?></td>
                    <td><?php echo format_rupiah($row["harga"]); ?></td>
                    <td><a href="hapusPerItem.php?id_cart=<?php echo $row["id_cart"]; ?>"><button class="hapus">Hapus</button></a></td>
                </tr>
                <?php $i++; ?>
                <?php $total_harga += $row['harga']; ?>
            <?php endforeach; ?>
            <tr>
                <td>Total Harga</td>
                <td></td>
                <td></td>
                <td><?php echo format_rupiah($total_harga); ?></td>
                <td class="aksi"><a href="hapusKeranjang.php"><button class="bayar">Bayar</button></a>
            </tr>
            <?php $_SESSION["total_harga"] = $total_harga; ?>
        </tbody>
    </table>
</body>

</html>