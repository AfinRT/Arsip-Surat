<?php
include "koneksi.php";
include "menubar.php";

// Variabel untuk menampung pesan feedback
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data yang dikirim dari form, dengan validasi untuk menghindari undefined array key
    $nomor_surat = isset($_POST['nomor_surat']) ? $_POST['nomor_surat'] : '';
    $tanggal_surat = isset($_POST['tanggal_surat']) ? $_POST['tanggal_surat'] : '';
    $penerima = isset($_POST['penerima']) ? $_POST['penerima'] : '';
    $perihal = isset($_POST['perihal']) ? $_POST['perihal'] : '';
    $tgl_kirim = isset($_POST['tgl_kirim']) ? $_POST['tgl_kirim'] : '';

    // SQL query untuk insert data
    $sql = "INSERT INTO surat_keluar (nomor_surat, tanggal_surat, penerima, perihal, tgl_kirim) VALUES ('$nomor_surat', '$tanggal_surat', '$penerima', '$perihal', '$tgl_kirim')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert1 alert-success' role='alert'>Data berhasil disimpan</div>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'surat_keluar.php';
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
    <title>Form Insert Data Surat Keluar</title>
</head>
</style>
<body>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="mb-0"><i class="fas fa-envelope mr-2"></i> Tambah Surat Keluar</h2>
        <div class="card">
            <div class="card-body">
                <form action="tambah_sk.php" method="post">
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat:</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat:</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="penerima">penerima:</label>
                        <input type="text" class="form-control" id="penerima" name="penerima" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal:</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kirim">Tanggal Terima:</label>
                        <input type="date" class="form-control" id="tgl_kirim" name="tgl_kirim" required>
                    </div> 
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                   
                </form>
            </div>
        </div>
    </div>
</body>
</html>
