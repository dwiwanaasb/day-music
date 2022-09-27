<?php
require 'functions.php';

$id_bayar = $_GET["id_bayar"];

if (adminHapusBayar($id_bayar) > 0) {
    echo "
        <script>
            alert('Data Berhasil Di Hapus!')
            document.location.href = 'adminPembayaran.php';
        </script>";
} else {
    echo mysqli_error($conn);
    echo "
        <script>
            alert('data gagal dihapus!')
        </script>";
}
