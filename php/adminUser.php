<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM users");
$_SESSION["admin"] = "admin";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE nama_lengkap LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_adminUser.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu Admin</header>
        <ul>
            <li><a href="adminOrder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Riwayat Keranjang</a></li>
            <li><a href="adminPembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Riwayat Pembayaran</a></li>
            <li><a href="adminProduk.php"><i class="fa fa-clipboard-list" aria-hidden="true"></i>Daftar Produk</a></li>
            <li class="on"><a href="adminUser.php"><i class="fa fa-user" aria-hidden="true"></i>Daftar User</a></li>
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
            <input type="text" name="keyword" placeholder="Masukkan Nama User.." autocomplete="off">
            <button type="submit" name="cari"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama_lengkap"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["jenis_kelamin"]; ?></td>
                    <td><?php echo $row["no_telepon"]; ?></td>
                    <td><?php echo $row["alamat"]; ?></td>
                    <td class="aksi"><a href="adminHapusUser.php?id_user=<?php echo $row["id_user"]; ?>"><button class="hapus"><i class="fas fa-trash"></i></button></a></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>