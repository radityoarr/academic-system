<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Ambil MK</title>
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

    if (isset($_GET['ID_MK']) && isset($_GET['NRP']) ) {
        $id_mk = $_GET['ID_MK'];
        $nrp = $_GET['NRP'];

        if (hapus_ambilmk($id_mk, $nrp)) {
            echo '<script>
            swal("Berhasil!", "Data Ambil MK Berhasi Dihapus", "success")
            .then((value) => {
                window.location.href = "tabel_ambilmk.php";
            });
            </script>';
        } else {
            echo '<script>
            swal("Oops!", "Data Ambil MK Gagal Dihapus", "error")
            .then((value) => {
                window.history.back();
                });
            </script>';
        }
    }
    ?>
</body>
</html>