
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Dosen</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/pages/datatables.css">
    <style>
        /* Gaya untuk input readonly */
        .form-control[readonly] {
            background-color: #e9ecef; /* Warna latar belakang berbeda */
            cursor: not-allowed; /* Cursor menunjukkan bahwa tidak bisa diubah */
        }

        /* Gaya untuk select dropdown */
        .custom-select {
            position: relative;
            display: inline-block;
            width: 100%; /* Agar select menyesuaikan lebar form */
        }

        .custom-select::after {
            content: "\25BC"; /* Unicode untuk panah bawah */
            position: absolute;
            top: 50%;
            right: 10px;
            pointer-events: none;
            transform: translateY(-50%);
            color: #495057;
        }

        /* Menghilangkan panah default */
        select {
            -webkit-appearance: none; /* Safari dan Chrome */
            -moz-appearance: none; /* Firefox */
            appearance: none; /* CSS3 */
            padding-right: 30px; /* Ruang untuk ikon dropdown */
        }

        /* Gaya untuk select agar terlihat konsisten */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<body>
    <?php

    require 'functions.php';

    $item = 3;
    $id=$_GET['ID_Dosen']; 
    $dosen = query("SELECT * FROM Dosen WHERE ID_Dosen ='$id'")[0];

    if (isset($_POST["ubah_dosen"])) {

        // cek apakah data berhasil ditambahkan atau tidak
        if (ubah_dosen($_POST) > 0) {
            echo '<script>
            swal("Berhasil!", "Data Dosen Berhasil Diubah!", "success")
            .then((value) => {
                window.location.href = "tabel_dosen.php";
            });
            </script>';
        } else {
            echo '<script>
            swal("Oops!", "Data Dosen Gagal Diubah!", "error")
            .then((value) => {
                window.history.back();
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
                            <h3>Ubah Data Dosen</h3>
                            <!-- <p class="text-subtitle text-muted">Ubah Detail Barang</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Data Dosen</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
                                                <input type="text" name="ID_Dosen" readonly value="<?= $dosen["ID_Dosen"]; ?>" class="form-control" id="ID_Dosen" placeholder="Masukkan ID Dosen">
                                            </div>

                                            <div class="form-group">
                                                <label for="Nama">Nama Dosen</label> 
                                                <input name="Nama" type="text" value="<?= $dosen["Nama"]; ?>" class="form-control" id="Nama" placeholder="Masukkan Nama Dosen">
                                            </div>


                                            <div class="form-group">
                                                <label for="Alamat">Alamat</label>
                                                <input name="Alamat" type="text" value="<?= $dosen["Alamat"]; ?>" class="form-control" id="Alamat" placeholder="Masukkan Alamat">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="bg-primary" name="ubah_dosen">
                                                    <span class="badge bg-primary">Ubah Data</span>
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