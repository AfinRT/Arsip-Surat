<?php
include "koneksi.php";
include "menubar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data yang dikirim dari form, dengan validasi untuk menghindari undefined array key
    $nomor_surat = isset($_POST['nomor_surat']) ? $_POST['nomor_surat'] : '';
    $tanggal_surat = isset($_POST['tanggal_surat']) ? $_POST['tanggal_surat'] : '';
    $pengirim = isset($_POST['pengirim']) ? $_POST['pengirim'] : '';
    $perihal = isset($_POST['perihal']) ? $_POST['perihal'] : '';
    $tgl_terima = isset($_POST['tgl_terima']) ? $_POST['tgl_terima'] : '';

    // SQL query untuk insert data
    $sql = "INSERT INTO surat_masuk (nomor_surat, tanggal_surat, pengirim, perihal, tgl_terima) VALUES ('$nomor_surat', '$tanggal_surat', '$pengirim', '$perihal', '$tgl_terima')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert1 alert-success' role='alert'>Data berhasil disimpan</div>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'surat_masuk.php';
                }, 1000);
              </script>";
    } else {
        echo "<div class='alert1 alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    // Menutup koneksi
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\form.css">
    <title>Form Insert Data Surat Masuk</title>
</head>
</style>
<body>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="mb-0"><i class="fas fa-envelope mr-2"></i></i>Tambah Surat Masuk</h2>
        <div class="card">
            <div class="card-body">
                <form action="tambah_sm.php" method="post">
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat:</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat:</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="pengirim">Pengirim:</label>
                        <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal:</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_terima">Tanggal Terima:</label>
                        <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" required>
                    </div> 
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                   
                </form>
            </div>
        </div>
    </div>
</body>
</html>
