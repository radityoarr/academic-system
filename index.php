<?php
    require 'functions.php';
    $conn = koneksi();
    $item = 1;

    $queries = array(
        "SELECT COUNT(*) AS total FROM Mahasiswa",
        "SELECT COUNT(*) AS total FROM Dosen",
        "SELECT COUNT(*) AS total FROM Departemen",
        "SELECT COUNT(*) AS total FROM MataKuliah",
        "SELECT COUNT(*) AS total FROM AmbilMK",
        "SELECT COUNT(*) AS total FROM Bimbingan",
        "SELECT COUNT(*) AS total FROM Asistensi",
      );
      
      $totals = array();
      foreach ($queries as $query) {
        $result = sqlsrv_query($conn, $query);
        if ($result === false) {
          die(print_r(sqlsrv_errors(), true));
        }
        $data = sqlsrv_fetch_array($result);
        $totals[] = $data['total'];
        sqlsrv_free_stmt($result); // Free the statement resource
      }
      
      list($totalData1, $totalData2, $totalData3, $totalData4, $totalData5, $totalData6, $totalData7) = $totals;
      
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/css/main/app.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/main/app-dark.css?<?php echo time(); ?>" />
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg?<?php echo time(); ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="assets/images/logo/favicon.png?<?php echo time(); ?>" type="image/png" />

    <link rel="stylesheet" href="assets/css/shared/iconly.css?<?php echo time(); ?>" />
    <style>

        .card {
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #8297e5;
        }
        body.theme-dark .card:hover {
            background-color: #6c757d; 
        }

    </style>
</head>

<body>
    <div id="app">
        <?php require 'sidebar.php';?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard Akademik</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_mhs.php">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon blue mb-2 ">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Mahasiswa</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData1; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_dosen.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Dosen</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData2; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_depart.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Departemen</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData3; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_mk.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Mata Kuliah</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData4; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_ambilmk.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Ambil MK</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData5; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_bimbingan.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Bimbingan</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData6; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <a href="tabel_asistensi.php">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Asistensi</h6>
                                                    <h6 class="font-extrabold mb-0 count"><?= $totalData7; ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                </section>
            </div>

        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
</body>

</html>