<?php
session_start();
require 'functions.php';

$id_produk = $_GET["id_produk"];
$result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id_produk");
$data = mysqli_fetch_assoc($result);

if (isset($_POST["order"])) {
    if (order($_POST) > 0) {
        $stokAfter = $data["stok"] - $_POST["jumlah_beli"];
        mysqli_query($conn, "UPDATE produk SET stok = $stokAfter WHERE id_produk = $id_produk");
        echo "<script type='text/javascript'>
                    alert('Order Berhasil Ditambahkan!');
                    document.location.href = 'keranjang.php';
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
    <title>DAY MUSIC | DAFTAR HARGA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_tambahOrder.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-header">
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

    <div class="container">
        <div class="content-form">
            <form method="post" action="" class="form">
                <input type="hidden" name="id_produk" value="<?php echo $data["id_produk"]; ?>">
                <div class="input_container">
                    <label>Nama Produk</label>
                    <input type="text" class="input" id="nama_produk" name="nama_produk" value="<?php echo $data["nama_produk"]; ?>" readonly>
                </div>
                <div class="input_container">
                    <label>Stok</label>
                    <input type="number" class="input" id="stok" name="stok" value="<?php echo $data["stok"]; ?>" readonly>
                </div>
                <div class="input_container">
                    <label>Harga</label>
                    <div class="rp"><label>Rp</label></div>
                    <input type="text" class="input-harga" id="harga" name="harga" value="<?php echo $data["harga"]; ?>" readonly>
                </div>
                <div class="input_container">
                    <label>Jumlah Beli</label>
                    <input type="number" class="input" id="jumlah_beli" name="jumlah_beli" onchange="hitung()" required>
                </div>
                <button type="submit" name="order">Masukkan Ke Keranjang</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript">
    function hitung() {
        var harga = parseInt(document.getElementById('harga').value);
        var jumlah_beli = parseInt(document.getElementById('jumlah_beli').value);
        var harga2 = jumlah_beli * harga;

        document.getElementById('harga').value = harga2;
    }
</script>

</html>