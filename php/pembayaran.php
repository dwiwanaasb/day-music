<?php
session_start();
require 'functions.php';
$result = mysqli_query($conn, "SELECT * FROM keranjang");

if (isset($_POST["bayar"])) {
    if (pembayaran($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Pembayaran Berhasil Dilakukan!');
                    document.location.href = 'daftarProduk.php';
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
    <title>DAY MUSIC | PEMBAYARAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_pembayaran.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <header>Menu</header>
        <ul>
            <li><a href="daftarProduk.php"><i class="fa fa-list-alt" aria-hidden="true"></i>List Produk</a></li>
            <li><a href="keranjang.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Keranjang</a></li>
            <li class="on"><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <div class="container-header">
        <h2>Pembayaran</h2>
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
                <div class="input_container">
                    <label>Metode Pembayaran</label>
                    <div class="custom_select">
                        <select name="metode" id="metode" onchange="pilih()" required>
                            <option value="">Pilih</option>
                            <option value="1" metode_pembayaran="OVO">OVO</option>
                            <option value="2" metode_pembayaran="GoPay">GoPay</option>
                            <option value="3" metode_pembayaran="Transfer Bank">Transfer Bank</option>
                            <option value="4" metode_pembayaran="Cash On Delivery">COD</option>
                        </select>
                    </div>
                    <input type="hidden" class="metode_pembayaran" id="metode_pembayaran" name="metode_pembayaran">
                </div>
                <div class="input_container">
                    <label>Total Harga</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="text" class="total_harga" id="total_harga" name="total_harga" readonly value='<?php echo $_SESSION["total_harga"]; ?>'>
                </div>
                <div class="input_container">
                    <label>Nominal Pembayaran</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="number" class="nominal_pembayaran" id="nominal_pembayaran" name="nominal_pembayaran" required value="0" onchange="hitung()">
                </div>
                <div class="input_container">
                    <label>Jumlah Kembalian</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="text" class="jumlah_kembalian" id="jumlah_kembalian" name="jumlah_kembalian" value="0">
                </div>
                <button type="submit" name="bayar">Bayar</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function pilih() {
            var pilih_metode = document.getElementById("metode");
            var pilihan = pilih_metode.options[pilih_metode.selectedIndex].text;
            document.getElementById("metode_pembayaran").value = pilihan;
        }
    </script>

    <script type="text/javascript">
        function hitung() {
            var total = parseInt(document.getElementById('total_harga').value);
            var nominal = parseInt(document.getElementById('nominal_pembayaran').value);

            var kembalian = nominal - total;

            document.getElementById('jumlah_kembalian').value = kembalian;
        }
    </script>
</body>

</html>