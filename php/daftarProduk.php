<?php
session_start();
require 'functions.php';
$result = mysqli_query($conn, "SELECT * FROM produk");

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $result = mysqli_query($conn, "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | DAFTAR PRODUK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_daftarProduk.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu</header>
        <ul>
            <li class="on"><a href="daftarProduk.php"><i class="fa fa-list-alt" aria-hidden="true"></i>List Produk</a></li>
            <li><a href="keranjang.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Keranjang</a></li>
            <li><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <div class="container-header">
        <h2>Daftar Produk</h2>
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

    <div class="container-search">
        <form method="post" action="">
            <input type="text" name="keyword" placeholder="Masukkan Nama Produk.." autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
    </div>

    <div class="container-content">
        <?php foreach ($result as $row) : ?>
            <div class="produk">
                <img src="../img/<?php echo $row["gambar"]; ?>" alt="">
                <h4><?php echo $row["nama_produk"]; ?></h4>
                <h5>Rp <?php echo format_rupiah($row["harga"]); ?></h5>
                <h5 class="stok">Stok : <?php echo $row["stok"]; ?></h5>
                <a href="tambahOrder.php?id_produk=<?php echo $row["id_produk"]; ?>"><button>Tambah Ke Keranjang</button></a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>