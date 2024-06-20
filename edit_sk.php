<?php
include "koneksi.php";
include "menubar.php";

// Variabel untuk menampung pesan feedback
$message = '';

// Check if id parameter is set and is a positive integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve surat keluar data based on id
    $sql_select = "SELECT * FROM surat_keluar WHERE id = ?";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found, fetch as associative array
        $row = $result->fetch_assoc();

        // Assign retrieved data to variables
        $nomor_surat = $row['nomor_surat'];
        $tanggal_surat = $row['tanggal_surat'];
        $penerima = $row['penerima'];
        $perihal = $row['perihal'];
        $tgl_kirim = $row['tgl_kirim'];

        // Handle form submission (to update data)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomor_surat = $_POST['nomor_surat'];
            $tanggal_surat = $_POST['tanggal_surat'];
            $penerima = $_POST['penerima'];
            $perihal = $_POST['perihal'];
            $tgl_kirim = $_POST['tgl_kirim'];

            // Update query using prepared statement
            $sql_update = "UPDATE surat_keluar SET 
                           nomor_surat = ?,
                           tanggal_surat = ?,
                           penerima = ?,
                           perihal = ?,
                           tgl_kirim = ?
                           WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param('sssssi', $nomor_surat, $tanggal_surat, $penerima, $perihal, $tgl_kirim, $id);

            if ($stmt_update->execute()) {
                $message = '<div class="alert alert-success" role="alert">Data berhasil diperbarui.</div>';

                // Redirect after 1 second using JavaScript
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'surat_keluar.php';
                        }, 1000);
                      </script>";
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error: ' . $stmt_update->error . '</div>';
            }
        }
    } else {
        // Data not found
        $message = '<div class="alert alert-danger" role="alert">Data tidak ditemukan.</div>';
    }

    // Close statement
    $stmt->close();
} else {
    // Invalid id parameter
    $message = '<div class="alert alert-danger" role="alert">Invalid id parameter.</div>';
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Data Surat Keluar</title>
    <link rel="stylesheet" href="CSS\form.css">
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="mb-0"><i class="fas fa-envelope mr-2"></i> Edit Surat Keluar</h2>
                <?php echo $message; ?>
                <div class="card">
                    <div class="card-body">
                        <form action="edit_sk.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat:</label>
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo htmlspecialchars($nomor_surat); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat:</label>
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?php echo htmlspecialchars($tanggal_surat); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="penerima">Penerima:</label>
                                <input type="text" class="form-control" id="penerima" name="penerima" value="<?php echo htmlspecialchars($penerima); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal:</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="<?php echo htmlspecialchars($perihal); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_kirim">Tanggal Kirim:</label>
                                <input type="date" class="form-control" id="tgl_kirim" name="tgl_kirim" value="<?php echo htmlspecialchars($tgl_kirim); ?>" required>
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
