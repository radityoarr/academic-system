
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mata Kuliah</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/pages/datatables.css">

</head>

<body>

    <?php

    require 'functions.php';

    $item = 5;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(tambah_mk($_POST)) {
            echo '<script>
            swal("Berhasil!", "Data Mata Kuliah Berhasil Ditambah!", "success")
            .then((value) => {
                window.location.href = "tabel_mk.php";
            });
            </script>';
        }
    }

    ?>
    <div id="app">
        <?php require 'sidebar.php';?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tambah Data Mata Kuliah</h3>
                            <!-- <p class="text-subtitle text-muted">Tambah Detail Barang</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Data Mata Kuliah</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <!-- <div class="card-header">
                            Data-data barang yang tersedia
                        </div> -->
                        <div class="card-body">
                            <table class="table" id="table1">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="ID_MK">ID Mata Kuliah</label> 
                                                <input name="ID_MK" type="text" class="form-control" id="ID_MK" placeholder="Masukkan ID Mata Kuliah">
                                            </div>

                                            <div class="form-group">
                                                <label for="Nama">Nama Mata Kuliah</label> 
                                                <input name="Nama" type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Mata Kuliah">
                                            </div>

                                            <div class="form-group">
                                                <label for="Sks">SKS</label>
                                                <input name="Sks" type="text" class="form-control" id="Sks" placeholder="Masukkan Bobot SKS">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="bg-primary" name="tambah_mk">
                                                    <span class="badge bg-primary">Tambah Data</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </table>
                        </div>

                    </div>

                </section>
                <!-- Basic Tables end -->
            </div>

        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>

</body>

</html>