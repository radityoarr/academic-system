
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Asistensi</title>
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

    $item = 8;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(tambah_asistensi($_POST)) {
            echo '<script>
            swal("Berhasil!", "Data Asistensi Berhasil Ditambah!", "success")
            .then((value) => {
                window.location.href = "tabel_Asistensi.php";
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
                            <h3>Tambah Data Asistensi</h3>
                            <!-- <p class="text-subtitle text-muted">Tambah Detail Barang</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Data Asistensi</a></li>
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
                                                <label for="NRP">NRP Mahasiswa</label> 
                                                <select id="NRP" name="NRP" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih NRP Mahasiswa</option>
                                                    <?php
                                                    $conn = koneksi();
                                                    $result = sqlsrv_query($conn, "SELECT NRP FROM Mahasiswa");
                                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value='" .  $row['NRP'] . "'>" . $row['NRP'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="NRP_Asisten">NRP Asisten</label> 
                                                <select id="NRP_Asisten" name="NRP_Asisten" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih NRP Asisten</option>
                                                    <?php
                                                    $conn = koneksi();
                                                    $result = sqlsrv_query($conn, "SELECT NRP FROM Mahasiswa");
                                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value='" .  $row['NRP'] . "'>" . $row['NRP'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="Periode">Periode</label> 
                                                <select id="Periode" name="Periode" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih Periode Asistensi</option>
                                                    <option value="Genap 2023/2024" >Genap 2023/2024</option>
                                                    <option value="Gasal 2024/2025" >Gasal 2024/2025</option>
                                                    <option value="Genap 2024/2025" >Genap 2024/2025</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="bg-primary" name="tambah_Asistensi">
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