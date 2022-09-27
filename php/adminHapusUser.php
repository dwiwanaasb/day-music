<?php
require 'functions.php';

$id_user = $_GET["id_user"];

if (adminHapusUser($id_user) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus!')
                document.location.href = 'adminUser.php';
            </script>";
} else {
    echo mysqli_error($conn);
    echo "
        <script>
            alert('data gagal dihapus!')
        </script>";
}
