<?php
require 'functions.php';

$id_cart = $_GET["id_cart"];

if (hapusPerItem($id_cart) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus!')
                document.location.href = 'keranjang.php';
            </script>";
} else {
    echo mysqli_error($conn);
    echo "
        <script>
            alert('data gagal dihapus!')
        </script>";
}
