
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
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

    $item = 3;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(tambah_dosen($_POST)) {
            echo '<script>
            swal("Berhasil!", "Data Dosen Berhasil Ditambah!", "success")
            .then((value) => {
                window.location.href = "tabel_dosen.php";
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
                            <h3>Tambah Data Dosen</h3>
                            <!-- <p class="text-subtitle text-muted">Tambah Detail Barang</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Data Dosen</a></li>
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
                                                <label for="ID_Dosen">ID Dosen</label> 
                                                <input name="ID_Dosen" type="text" class="form-control" id="ID_Dosen" placeholder="Masukkan ID Dosen">
                                            </div>

                                            <div class="form-group">
                                                <label for="Nama">Nama Dosen</label> 
                                                <input name="Nama" type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Dosen">
                                            </div>

                                            <div class="form-group">
                                                <label for="Alamat">Alamat</label>
                                                <input name="Alamat" type="text" class="form-control" id="Alamat" placeholder="Masukkan Alamat">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="bg-primary" name="tambah_dosen">
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