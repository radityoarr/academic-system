<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Mata Kuliah</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<style>
    body {
        font-family: 'Maven Pro', sans-serif !important;
    }
</style>
<body>
    <?php 
    require 'functions.php';

    if (isset($_GET['ID_MK'])) {
        $id = $_GET['ID_MK'];

        $result = hapus_mk($id);

        if ($result['success']) {
            echo '<script>
            swal("Berhasil!", "Data Mata Kuliah Berhasil Dihapus", "success")
            .then((value) => {
                window.location.href = "tabel_mk.php";
            });
            </script>';
        } else {
            if ($result['code'] == 547) { // Check for the constraint error code
                echo '<script>
                swal("Oops!", "Data Mata Kuliah Gagal Dihapus Karena Terdapat Relasi dengan Tabel AmbilMK.", "error")
                .then((value) => {
                    window.history.back();
                });
                </script>';
            } else {
                echo '<script>
                swal("Oops!", "Data Mata Kuliah Gagal Dihapus: ' . htmlspecialchars($result['message']) . '", "error")
                .then((value) => {
                    window.history.back();
                });
                </script>';
            }
        }
    }
    ?>
</body>
</html>
