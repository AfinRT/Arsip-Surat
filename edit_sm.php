<?php
include "koneksi.php";
include "menubar.php";

// Variabel untuk menampung pesan feedback
$message = '';

// Jika parameter id ada dan merupakan bilangan bulat positif
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data surat masuk berdasarkan id
    $sql_select = "SELECT * FROM surat_masuk WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Data ditemukan, ambil data sebagai array asosiatif
        $row = $result->fetch_assoc();

        // Form akan menampilkan data yang diambil
        $nomor_surat = $row['nomor_surat'];
        $tanggal_surat = $row['tanggal_surat'];
        $pengirim = $row['pengirim'];
        $perihal = $row['perihal'];
        $tgl_terima = $row['tgl_terima'];

        // Jika form disubmit (untuk menyimpan perubahan)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data yang dikirim dari form
            $nomor_surat = $_POST['nomor_surat'];
            $tanggal_surat = $_POST['tanggal_surat'];
            $pengirim = $_POST['pengirim'];
            $perihal = $_POST['perihal'];
            $tgl_terima = $_POST['tgl_terima'];

            // Query untuk update data surat masuk
            $sql_update = "UPDATE surat_masuk SET 
                           nomor_surat = '$nomor_surat',
                           tanggal_surat = '$tanggal_surat',
                           pengirim = '$pengirim',
                           perihal = '$perihal',
                           tgl_terima = '$tgl_terima'
                           WHERE id = $id";

            if ($conn->query($sql_update) === TRUE) {
                $message = '<div class="alert alert-success" role="alert">Data berhasil diperbarui.</div>';

                // JavaScript untuk redirect setelah 1 detik
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'surat_masuk.php';
                        }, 1000);
                      </script>";
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error: ' . $sql_update . '<br>' . $conn->error . '</div>';
            }
        }
    } else {
        // Data tidak ditemukan
        $message = '<div class="alert alert-danger" role="alert">Data tidak ditemukan.</div>';
    }
} else {
    // Parameter id tidak valid
    $message = '<div class="alert alert-danger" role="alert">Invalid id parameter.</div>';
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Data Surat Masuk</title>
    <link rel="stylesheet" href="CSS\form.css">
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="mb-0"><i class="fas fa-envelope mr-2"></i> Edit Surat Masuk</h2>
                <?php echo $message; // Menampilkan pesan feedback ?>
                <div class="card">
                    <div class="card-body">
                        <form action="edit_sm.php?id=<?php echo $id; ?>" method="post">
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat:</label>
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo isset($nomor_surat) ? $nomor_surat : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat:</label>
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?php echo isset($tanggal_surat) ? $tanggal_surat : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pengirim">Pengirim:</label>
                                <input type="text" class="form-control" id="pengirim" name="pengirim" value="<?php echo isset($pengirim) ? $pengirim : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal:</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="<?php echo isset($perihal) ? $perihal : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_terima">Tanggal Terima:</label>
                                <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" value="<?php echo isset($tgl_terima) ? $tgl_terima : ''; ?>" required>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
