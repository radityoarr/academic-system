<?php

function koneksi() {
    $serverName = "RADITYO-PC"; 
    $connectionOptions = array(
        "Database" => "DBAkademik" 
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    return $conn;
}

function query($query) {
    $conn = koneksi();
    $result = sqlsrv_query($conn, $query);
    if ($result === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $rows = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }

    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);

    return $rows;
}


function tambah_dosen($data) {
    $conn = koneksi();

    // sanitasi data
    $id = htmlspecialchars($data['ID_Dosen']);
    $nama = htmlspecialchars($data['Nama']);
    $alamat = htmlspecialchars($data['Alamat']);

    // Periksa apakah ID Dosen sudah ada
    $check_query = "SELECT COUNT(*) AS count FROM Dosen WHERE ID_Dosen = ?";
    $check_params = array($id);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        // ID Dosen sudah ada, tampilkan pesan error
        echo '<script>
        swal("Oops!", "ID Dosen Sudah Terdapat Dalam Database!", "error")
        .then((value) => {
            window.history.back();
        });
        </script>';
        return false;
    }

    // query INSERT
    $query = "INSERT INTO Dosen (ID_Dosen, Nama, Alamat) VALUES (?, ?, ?)";
    $params = array($id, $nama, $alamat);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $rowsAffected;
}


function hapus_dosen($id_dosen) {
    $conn = koneksi();

    $id = htmlspecialchars($id_dosen);

    $query = "DELETE FROM Dosen WHERE ID_Dosen = ?";
    $params = array($id);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        $errors = sqlsrv_errors();
        $errorCode = $errors[0]['code'];
        $errorMessage = $errors[0]['message'];
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return array('success' => false, 'code' => $errorCode, 'message' => $errorMessage);
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return array('success' => true, 'rowsAffected' => $rowsAffected);
}


function ubah_dosen($data) {
    $conn = koneksi();

    // sanitasi data
    $id = htmlspecialchars($data['ID_Dosen']);
    $nama = htmlspecialchars($data['Nama']);
    $alamat = htmlspecialchars($data['Alamat']);

    // query
    $query = "UPDATE Dosen SET Nama = ?, Alamat = ? WHERE ID_Dosen = ?";
    $params = array($nama, $alamat, $id);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    } 
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $rowsAffected;
}

function tambah_mk($data) {
    $conn = koneksi();
  
    // sanitasi data
    $id = htmlspecialchars($data['ID_MK']);
    $nama = htmlspecialchars($data['Nama']);
    $sks = htmlspecialchars($data['Sks']);

    $check_query = "SELECT COUNT(*) AS count FROM MataKuliah WHERE ID_MK = ?";
    $check_params = array($id);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal("Oops!", "ID Mata Kuliah Sudah Terdapat Dalam Database!", "error")
        .then((value) => {
            window.history.back();
        });
        </script>';
        return false;
    }

    if (!is_numeric($sks) || $sks < 1 || $sks > 6 || !ctype_digit($sks)) {
        echo '<script>
        swal({
            title: "Oops!",
            text: "Input Bobot SKS Tidak Valid!",
            icon: "error",
            button: "OK"
        });
        </script>';
        return false;
    }
  
    // query
    $query = "INSERT INTO MataKuliah (ID_MK, Nama, Sks) VALUES (?, ?, ?)";
    $params = array($id, $nama, $sks);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    } 
    
    return $rowsAffected;
  }
  
  function hapus_mk($id_mk) {
    $conn = koneksi();

    $id = htmlspecialchars($id_mk);

    $query = "DELETE FROM MataKuliah WHERE ID_MK = ?";
    $params = array($id);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        $errors = sqlsrv_errors();
        $errorCode = $errors[0]['code'];
        $errorMessage = $errors[0]['message'];
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return array('success' => false, 'code' => $errorCode, 'message' => $errorMessage);
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return array('success' => true, 'rowsAffected' => $rowsAffected);
}

  
  
  
function ubah_mk($data) {
    $conn = koneksi();

    // sanitasi data
    if (!isset($data['ID_MK']) || !isset($data['Nama']) || !isset($data['Sks'])) {
        die("Invalid data: ID_MK, Nama, or Sks not set.");
    }

    $id = htmlspecialchars($data['ID_MK']);
    $nama = htmlspecialchars($data['Nama']);
    $sks = htmlspecialchars($data['Sks']);


    // query
    $query = "UPDATE MataKuliah SET Nama = ?, Sks = ? WHERE ID_MK = ?";
    $params = array($nama, $sks, $id);

    // Cek koneksi sebelum prepare statement
    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);

    return $rowsAffected;
}

  function tambah_depart($data) {
    $conn = koneksi();
  
    // sanitasi data
    $id_dept = htmlspecialchars($data['ID_Dept']);
    $id_dosen = htmlspecialchars($data['ID_Dosen']);
    $nama = htmlspecialchars($data['Nama']);
    $sekre = htmlspecialchars($data['Sekretariat']);

    $check_query = "SELECT COUNT(*) AS count FROM Departemen WHERE ID_Dept = ?";
    $check_params = array($id_dept);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal("Oops!", "ID Departemen Sudah Terdapat Dalam Database!", "error")
        .then((value) => {
            window.history.back();
        });
        </script>';
        return false;
    }
  
    // query
    $query = "INSERT INTO Departemen (ID_Dept, ID_Dosen, Nama, Sekretariat) VALUES (?, ?, ?, ?)";
    $params = array($id_dept, $id_dosen, $nama, $sekre);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    return $rowsAffected;
  }
  
  function hapus_depart($id_depart) {
      $conn = koneksi();
      $id = htmlspecialchars($id_depart);
  
      $query = "DELETE FROM Departemen WHERE ID_Dept = ?";
      $params = array($id);
      
      $stmt = sqlsrv_prepare($conn, $query, $params);
      
      if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
      }
      
      if (sqlsrv_execute($stmt) === false) {
          die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
      }
      
      $rowsAffected = sqlsrv_rows_affected($stmt);
      
      if ($rowsAffected === false) {
          die(print_r(sqlsrv_errors(), true));
      }
      
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn);
  
      return $rowsAffected;
  }
  
  
  
  function ubah_depart($data) {
      $conn = koneksi();
  
      // sanitasi data
      $id_dept = htmlspecialchars($data['ID_Dept']);
      $id_dosen = htmlspecialchars($data['ID_Dosen']);
      $nama = htmlspecialchars($data['Nama']);
      $sekre = htmlspecialchars($data['Sekretariat']);
  
      // query
      $query = "UPDATE Departemen SET ID_Dosen = ?, Nama = ?, Sekretariat = ? WHERE ID_Dept = ?";
      $params = array($id_dosen, $nama, $sekre, $id_dept);
      
      $stmt = sqlsrv_prepare($conn, $query, $params);
      
      if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
      }
      
      if (sqlsrv_execute($stmt) === false) {
          die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
      }
      
      $rowsAffected = sqlsrv_rows_affected($stmt);
      
      if ($rowsAffected === false) {
          die(print_r(sqlsrv_errors(), true));
      }
      
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn);
  
      return $rowsAffected;
  }
  function tambah_mhs($data) {
    $conn = koneksi();
  
    // sanitasi data
    $nrp = htmlspecialchars($data['NRP']);
    $nrp_komting = htmlspecialchars($data['NRP_Komting']);
    $id_dosen = htmlspecialchars($data['ID_Dosen']);
    $nama = htmlspecialchars($data['Nama']);
    $alamat = htmlspecialchars($data['Alamat']);

    // Periksa apakah ID Dosen sudah ada
    $check_query = "SELECT COUNT(*) AS count FROM Mahasiswa WHERE NRP = ?";
    $check_params = array($nrp);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal("Oops!", "NRP Sudah Terdapat Dalam Database!", "error")
        .then((value) => {
            window.history.back();
        });
        </script>';
        return false;
    }
  
    // query
    $query = "INSERT INTO Mahasiswa (NRP, NRP_Komting, ID_Dosen, Nama, Alamat) VALUES (?, ?, ?, ?, ?)";
    $params = array($nrp, $nrp_komting, $id_dosen, $nama, $alamat);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    return $rowsAffected;
  }
  
  function hapus_mhs($nrp) {
    $conn = koneksi();
    $id = htmlspecialchars($nrp);

    $query = "DELETE FROM Mahasiswa WHERE NRP = ?";
    $params = array($id);

    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        $errors = sqlsrv_errors();
        $errorCode = $errors[0]['code'];
        $errorMessage = $errors[0]['message'];
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return array('success' => false, 'code' => $errorCode, 'message' => $errorMessage);
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return array('success' => true, 'rowsAffected' => $rowsAffected);
}

  
  
  
  function ubah_mhs($data) {
    $conn = koneksi();
  
      // sanitasi data
      $nrp = htmlspecialchars($data['NRP']);
      $nrp_komting = htmlspecialchars($data['NRP_Komting']);
      $id_dosen = htmlspecialchars($data['ID_Dosen']);
      $nama = htmlspecialchars($data['Nama']);
      $alamat = htmlspecialchars($data['Alamat']);
  
      // query
      $query = "UPDATE Mahasiswa SET NRP_komting = ? , ID_Dosen = ?, Nama = ?, Alamat = ? WHERE NRP = ?";
      $params = array($nrp_komting, $id_dosen, $nama, $alamat, $nrp);
      
      $stmt = sqlsrv_prepare($conn, $query, $params);
      
      if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
      }
      
      if (sqlsrv_execute($stmt) === false) {
          die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
      }
      
      $rowsAffected = sqlsrv_rows_affected($stmt);
      
      if ($rowsAffected === false) {
          die(print_r(sqlsrv_errors(), true));
      } 
      
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn);
  
      return $rowsAffected;
  }

  function hapus_ambilmk($id_mk, $nrp) {
    $conn = koneksi();

    $id = htmlspecialchars($id_mk);
    $nrp = htmlspecialchars($nrp);


    $query = "DELETE FROM AmbilMK WHERE ID_MK = ? AND NRP = ?";
    $params = array($id, $nrp);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $rowsAffected;
}

function tambah_ambilmk($data) {
    $conn = koneksi();
  
    $id = htmlspecialchars($data['ID_MK']);
    $nrp = htmlspecialchars($data['NRP']);

    $check_query = "SELECT COUNT(*) AS count FROM AmbilMK WHERE ID_MK = ? AND NRP = ?";
    $check_params = array($id, $nrp);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal("Oops!", "Mahasiswa Sudah Mengambil Mata Kuliah Terkait!", "error")
        .then((value) => {
            window.history.back();
        });
        </script>';
        return false;
    }
  
    $query = "INSERT INTO AmbilMK (NRP, ID_MK) VALUES (?, ?)";
    $params = array($nrp, $id);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    } 
    
    return $rowsAffected;
  }

  function hapus_bimbingan($id_dosen, $nrp) {
    $conn = koneksi();

    $id = htmlspecialchars($id_dosen);
    $nrp = htmlspecialchars($nrp);


    $query = "DELETE FROM Bimbingan WHERE ID_Dosen = ? AND NRP = ?";
    $params = array($id, $nrp);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $rowsAffected;
}

function hapus_asistensi($nrp, $nrp_asisten) {
    $conn = koneksi();

    $nrp_asisten = htmlspecialchars($nrp_asisten);
    $nrp = htmlspecialchars($nrp);


    $query = "DELETE FROM Asistensi WHERE NRP = ? AND NRP_Asisten = ?";
    $params = array($nrp, $nrp_asisten);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $rowsAffected;
}

function tambah_bimbingan($data) {
    $conn = koneksi();
  
    $id = htmlspecialchars($data['ID_Dosen']);
    $nrp = htmlspecialchars($data['NRP']);
    $periode = htmlspecialchars($data['Periode']);

    $check_query = "SELECT COUNT(*) AS count FROM Bimbingan WHERE ID_Dosen = ? AND NRP = ?";
    $check_params = array($id, $nrp);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal({
            title: "Oops!",
            text: "Mahasiswa Sudah Bimbingan dengan Dosen Tersebut!",
            icon: "error",
            button: "OK"
        });
        </script>';
        return false;
    }
  
    $query = "INSERT INTO Bimbingan (ID_Dosen ,NRP, Periode) VALUES (?, ?, ?)";
    $params = array($id, $nrp, $periode);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    } 
    
    return $rowsAffected;
}






function tambah_asistensi($data) {
    $conn = koneksi();
  
    $nrp = htmlspecialchars($data['NRP']);
    $nrp_asisten = htmlspecialchars($data['NRP_Asisten']);
    $periode = htmlspecialchars($data['Periode']);

    $check_query = "SELECT COUNT(*) AS count FROM Asistensi WHERE NRP_Asisten = ? AND NRP = ?";
    $check_params = array($nrp_asisten, $nrp);

    $check_stmt = sqlsrv_prepare($conn, $check_query, $check_params);
    
    if ($check_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($check_stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $count = 0;
    while ($row = sqlsrv_fetch_array($check_stmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];
    }

    sqlsrv_free_stmt($check_stmt);

    if ($count > 0) {
        echo '<script>
        swal({
            title: "Oops!",
            text: "Mahasiswa Sudah Asistensi dengan Asisten Tersebut!",
            icon: "error",
            button: "OK"
        });
        </script>';
        return false;
    }
  
    $query = "INSERT INTO Asistensi (NRP, NRP_Asisten, Periode) VALUES (?, ?, ?)";
    $params = array($nrp, $nrp_asisten, $periode);
    
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    
    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    } 
    
    return $rowsAffected;
  }

  function hitung_predikat($nilai_angka) {
    if ($nilai_angka >= 86 && $nilai_angka <= 100) {
        return 'A';
    } elseif ($nilai_angka >= 76 && $nilai_angka <= 85) {
        return 'AB';
    } elseif ($nilai_angka >= 66 && $nilai_angka <= 75) {
        return 'B';
    } elseif ($nilai_angka >= 61 && $nilai_angka <= 65) {
        return 'BC';
    } elseif ($nilai_angka >= 56 && $nilai_angka <= 60) {
        return 'C';
    } elseif ($nilai_angka >= 41 && $nilai_angka <= 55) {
        return 'D';
    } elseif ($nilai_angka >= 0 && $nilai_angka <= 40) {
        return 'E';
    } else {
        return 'Invalid';
    }
}

function nilai($data) {
    $conn = koneksi();

    $id = htmlspecialchars($data['ID_MK']);
    $nrp = htmlspecialchars($data['NRP']);
    $nilai = htmlspecialchars($data['Nilai_Angka']);
    $predikat = hitung_predikat($nilai);

    $query = "UPDATE AmbilMK SET Nilai_Angka = ?, Predikat = ? WHERE ID_MK = ? AND NRP = ?";
    $params = array($nilai, $predikat, $id, $nrp);

    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    return $rowsAffected;
}


function ubah_periode($data) {
    $conn = koneksi();

    $id_dosen = htmlspecialchars($data['ID_Dosen']);
    $nrp = htmlspecialchars($data['NRP']);
    $periode = htmlspecialchars($data['Periode']);


    $query = "UPDATE Bimbingan SET Periode = ? WHERE ID_Dosen = ? AND NRP = ?";
    $params = array($periode, $id_dosen, $nrp);

    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);

    return $rowsAffected;
}

function ubah_periode_asistensi($data) {
    $conn = koneksi();

    $nrp = htmlspecialchars($data['NRP']);
    $nrp_asisten = htmlspecialchars($data['NRP_Asisten']);
    $periode = htmlspecialchars($data['Periode']);


    $query = "UPDATE Asistensi SET Periode = ? WHERE NRP_Asisten = ? AND NRP = ?";
    $params = array($periode, $nrp_asisten, $nrp);

    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die("Query Gagal! Error: " . print_r(sqlsrv_errors(), true));
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);

    if ($rowsAffected === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);

    return $rowsAffected;
}
?>