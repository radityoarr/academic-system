<?php
    require 'functions.php';
    $mhs = query("SELECT 
        m1.Nama as NamaMahasiswa,
        m1.NRP,
        m1.Alamat,
        m2.Nama as NamaKomting,
        d.Nama as NamaDosen,
        m1.NRP_Komting,
        m1.ID_Dosen
    FROM Mahasiswa m1, Mahasiswa m2, Dosen d
    WHERE m1.NRP_Komting = m2.NRP AND m1.ID_Dosen = d.ID_Dosen");
    $item = 2;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        th {
            white-space: nowrap;
            text-align: center !important;
        }
        td {
            white-space: nowrap;
            text-align: center !important;
        }
        .tr-bold {
            font-weight: bold;
        }
        .btn-edit {
            background-color: yellow;
            padding: 5px 10px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
        }

        .btn-delete {
            background-color: red;
            padding: 5px 10px;
            border: 1px solid black;
            text-decoration: none;
            color: white;
        }
    </style>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/pages/datatables.css">

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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tabel Data Mahasiswa</h3>
                            <!-- <p class="text-subtitle text-muted">Data-data barang yang tersedia</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
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
                            <div class="buttons">
                                <a href="tambah_mhs.php">
                                    <button type="submit" class="btn btn-primary">
                                        Tambah Mahasiswa<span class="badge bg-transparent"></span>
                                    </button>
                                </a>
                            </div>
                            <table class="table" id="table1">

                                <thead>
                                    <tr class="tr-bold">
                                        <td>Nama</td>
                                        <td>NRP</td>
                                        <td>Alamat</td>
                                        <td>NRP Komting</td>
                                        <td>Nama Komting</td>
                                        <td>ID Doswal</td>
                                        <td>Nama Doswal</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $i = 1;
                                        foreach ($mhs as $row) :
                                    ?>
                                    <tr>
                                        <td><?= $row["NamaMahasiswa"]; ?></td>
                                        <td><?= $row["NRP"]; ?></td>
                                        <td><?= $row["Alamat"]; ?></td>
                                        <td><?= $row["NRP_Komting"]; ?></td>
                                        <td><?= $row["NamaKomting"]; ?></td>
                                        <td><?= $row["ID_Dosen"]; ?></td>
                                        <td><?= $row["NamaDosen"]; ?></td>
                                        <td>
                                            <a href="ubah_mhs.php?NRP=<?= $row['NRP']; ?>" class="btn-edit">Edit</a>
                                            <a href="hapus_mhs.php?NRP=<?= $row['NRP']; ?>" class="btn-delete">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                        $i++;
                                        endforeach; 
                                    ?>
                                </tbody>
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