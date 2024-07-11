
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Departemen</title>
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

    $item = 4;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(tambah_depart($_POST)) {
            echo '<script>
            swal("Berhasil!", "Data Departemen Berhasil Ditambah!", "success")
            .then((value) => {
                window.location.href = "tabel_depart.php";
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
                            <h3>Tambah Data Departemen</h3>
                            <!-- <p class="text-subtitle text-muted">Tambah Detail Barang</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Data Departemen</a></li>
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
                                                <label for="ID_Dept">ID Departemen</label> 
                                                <input name="ID_Dept" type="text" class="form-control" id="ID_Dept" placeholder="Masukkan ID Departemen" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Nama">Nama Departemen</label> 
                                                <input name="Nama" type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Departemen" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Sekretariat">Sekretariat</label>
                                                <input name="Sekretariat" type="text" class="form-control" id="Sekretariat" placeholder="Masukkan Ruang Sekretariat" required>
                                            </div>


                                            <?php
                                                $db = koneksi();

                                                $query = "SELECT ID_Dosen FROM Dosen WHERE ID_Dosen NOT IN (SELECT ID_Dosen FROM Departemen)";
                                                $result = sqlsrv_query($db, $query);

                                                $id_values = array();

                                                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                    $id_values[] = $row["ID_Dosen"];
                                                }

                                                if (isset($depart["ID_Dosen"])) {
                                                    $selected_dosen = $depart["ID_Dosen"];
                                                    $query_selected = "SELECT ID_Dosen FROM Dosen WHERE ID_Dosen = ?";
                                                    $params = array($selected_dosen);
                                                    $result_selected = sqlsrv_query($db, $query_selected, $params);
                                                    if ($row_selected = sqlsrv_fetch_array($result_selected, SQLSRV_FETCH_ASSOC)) {
                                                        $id_values[] = $row_selected["ID_Dosen"];
                                                    }
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <label for="ID_Dosen">ID Kepala Departemen</label>
                                                    <select name="ID_Dosen" class="custom-select form-control rounded">
                                                        <option value="" disabled selected hidden>Pilih Kepala Departemen</option>
                                                        <?php
                                                        foreach ($id_values as $value) {
                                                            $selected = (isset($depart["ID_Dosen"]) && $value == $depart["ID_Dosen"]) ? "selected" : "";
                                                            echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            <!-- <div class="form-group">
                                                <label for="ID_Dosen">Kepala Departemen</label>
                                                <select id="ID_Dosen" name="ID_Dosen" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih Kepala Departemen</option>
                                                    <?php
                                                    $conn = koneksi();
                                                    $result = sqlsrv_query($conn, "SELECT * FROM Dosen");
                                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value='" .  $row['ID_Dosen'] . "'>" . $row['ID_Dosen'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div> -->

                                            <div class="form-group">
                                                <button type="submit" class="bg-primary" name="tambah_depart">
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