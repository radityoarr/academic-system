<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Bimbingan</title>
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

    if (isset($_GET['ID_Dosen']) && isset($_GET['NRP']) ) {
        $id_dosen = $_GET['ID_Dosen'];
        $nrp = $_GET['NRP'];

        if (hapus_bimbingan($id_dosen, $nrp)) {
            echo '<script>
            swal("Berhasil!", "Data Bimbingan Berhasi Dihapus", "success")
            .then((value) => {
                window.location.href = "tabel_bimbingan.php";
            });
            </script>';
        } else {
            echo '<script>
            swal("Oops!", "Data Bimbingan Gagal Dihapus", "error")
            .then((value) => {
                window.history.back();
                });
            </script>';
        }
    }
    ?>
</body>
</html>