<?php
    require 'functions.php';
    $depart = query("    SELECT 
        Departemen.ID_Dept,
        Departemen.Nama as NamaDepartemen,
        Departemen.ID_Dosen,
        Departemen.Sekretariat,
        Dosen.Nama as NamaKepalaDepartemen
    FROM Departemen, Dosen
    WHERE Departemen.ID_Dosen = Dosen.ID_Dosen");
    $item = 4;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Departemen</title>
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
                            <h3>Tabel Data Departemen</h3>
                            <!-- <p class="text-subtitle text-muted">Data-data departemen yang tersedia</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Departemen</li>
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
                                <a href="tambah_depart.php">
                                    <button type="submit" class="btn btn-primary">
                                        Tambah Departemen<span class="badge bg-transparent"></span>
                                    </button>
                                </a>
                            </div>
                            <table class="table" id="table1">

                            <thead>
                                <tr class="tr-bold">
                                    <td>ID Departemen</td>
                                    <td>Nama Departemen</td>
                                    <td>ID Kadep</td>
                                    <td>Nama Kadep</td>
                                    <td>Sekretariat</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($depart as $row) : ?>
                                <tr>
                                    <td><?= $row["ID_Dept"]; ?></td>
                                    <td><?= $row["NamaDepartemen"]; ?></td>
                                    <td><?= $row["ID_Dosen"]; ?></td>
                                    <td><?= $row["NamaKepalaDepartemen"]; ?></td>
                                    <td><?= $row["Sekretariat"]; ?></td>
                                    <td>
                                        <a href="ubah_depart.php?ID_Dept=<?= $row['ID_Dept']; ?>" class="btn-edit">Edit</a>
                                        <a href="hapus_depart.php?ID_Dept=<?= $row['ID_Dept']; ?>" class="btn-delete">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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