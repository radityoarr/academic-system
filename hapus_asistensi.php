<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Asistensi</title>
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

    if (isset($_GET['NRP']) && isset($_GET['NRP_Asisten']) ) {
        $nrp = $_GET['NRP'];
        $nrp_asisten = $_GET['NRP_Asisten'];

        if (hapus_asistensi($nrp, $nrp_asisten)) {
            echo '<script>
            swal("Berhasil!", "Data Asistensi Berhasi Dihapus", "success")
            .then((value) => {
                window.location.href = "tabel_asistensi.php";
            });
            </script>';
        } else {
            echo '<script>
            swal("Oops!", "Data Asistensi Gagal Dihapus", "error")
            .then((value) => {
                window.history.back();
                });
            </script>';
        }
    }
    ?>
</body>
</html>