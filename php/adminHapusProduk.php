<?php
require 'functions.php';

$id_produk = $_GET["id_produk"];

if (adminHapusProduk($id_produk) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus!')
                document.location.href = 'adminProduk.php';
            </script>";
} else {
    echo mysqli_error($conn);
    echo "
        <script>
            alert('data gagal dihapus!')
        </script>";
}
