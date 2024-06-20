<?php
// Include file koneksi ke database
include "koneksi.php";
include "menubar.php";

// Get current date
$currentDate = date('d-m-Y'); // Adjust the format as per your requirement

// Query untuk mengambil data surat masuk
$sql = "SELECT id, nomor_surat, tanggal_surat, penerima, perihal, tgl_kirim
        FROM surat_keluar 
        WHERE DATE(tgl_kirim) = CURDATE()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Surat Masuk</title>
    <link rel="stylesheet" href="CSS\surat.css">
</head>
<body>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="mb-0"><i class="fas fa-paper-plane mr-2"></i>Surat Keluar</h2>
           
            <div class="card">
                <div class="card-body">
                    <div class="text-right mb-3"> 
                        <p class="mb-11">Today's Date: <?php echo date('d-m-Y'); ?></p> <!-- Display current date here -->
                        <a href="tambah_sk.php" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Penerima</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal Kirim</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php $no = 1; ?>
                                <?php $no = 1; ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= (strlen($row["nomor_surat"]) > 15) ? substr($row["nomor_surat"], 0, 15) . '...' : $row["nomor_surat"] ?></td>
                                        <td><?= date('d-m-Y', strtotime($row["tanggal_surat"])) ?></td>
                                        <td><?= (strlen($row["penerima"]) > 15) ? substr($row["penerima"], 0, 15) . '...' : $row["penerima"] ?></td>
                                        <td><?= (strlen($row["perihal"]) > 15) ? substr($row["perihal"], 0, 15) . '...' : $row["perihal"] ?></td>
                                        <td><?= date('d-m-Y', strtotime($row["tgl_kirim"])) ?></td>

                                        <td class="btn-action">
                                            <button class="btn btn-info btn-sm previewBtn"
                                                    data-toggle="modal"
                                                    data-target="#previewModal"
                                                    data-id="<?= $row["id"] ?>"
                                                    data-nomor-surat="<?= $row["nomor_surat"] ?>"
                                                    data-tanggal-surat="<?= $row["tanggal_surat"] ?>"
                                                    data-penerima="<?= $row["penerima"] ?>"
                                                    data-perihal="<?= $row["perihal"] ?>"
                                                    data-tgl-kirim="<?= $row["tgl_kirim"] ?>">
                                                <i class="fas fa-eye"></i> Preview
                                            </button>
                                            <a href="edit_sk.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sm ml-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="hapus_sk.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-sm ml-2"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="7">Tidak ada data surat keluar hari ini.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nomorSurat">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomorSurat" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggalSurat">Tanggal Surat</label>
                        <input type="text" class="form-control" id="tanggalSurat" readonly>
                    </div>
                    <div class="form-group">
                        <label for="penerima">Penerima</label>
                        <input type="text" class="form-control" id="penerima" readonly>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" id="perihal" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tglKirim">Tanggal Kirim</label>
                        <input type="text" class="form-control" id="tglKirim" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to populate form in preview modal -->
<script>
    $(document).ready(function() {
        $('.previewBtn').click(function() {
            var id = $(this).data('id');
            var nomorSurat = $(this).data('nomor-surat');
            var tanggalSurat = $(this).data('tanggal-surat');
            var penerima = $(this).data('penerima');
            var perihal = $(this).data('perihal');
            var tglKirim = $(this).data('tgl-kirim');

            // Populate form fields in modal with data from the clicked button
            $('#nomorSurat').val(nomorSurat);
            $('#tanggalSurat').val(tanggalSurat);
            $('#penerima').val(penerima);
            $('#perihal').val(perihal);
            $('#tglKirim').val(tglKirim);

            // Show the modal
            $('#previewModal').modal('show');
        });
    });
</script>

</body>
</html>
