<?php
// Include file koneksi ke database
include "koneksi.php";
include "menubar.php";

// Get current date
$currentDate = date('d-m-Y'); // Adjust the format as per your requirement

// Initialize date range variables
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Query untuk mengambil data surat masuk dengan filter rentang waktu
$sql = "SELECT * FROM surat_keluar";
if (!empty($startDate) && !empty($endDate)) {
    $sql .= " WHERE tgl_kirim BETWEEN '$startDate' AND '$endDate'";
}
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Surat Masuk</title>
    <link rel="stylesheet" href="CSS\rekap.css">
</head>
<body>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="mb-0"><i class="fas fa-envelope mr-2"></i>Rekap Surat Masuk</h2>
           
            <div class="card">
                <div class="card-body">
                <div class="filter-container">
    <form method="GET" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" value="<?= $startDate ?>">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" value="<?= $endDate ?>">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="rekap_sk.php" class="btn btn-light"><i class="fas fa-sync-alt"></i></a>
    </form>
    <button onclick="window.location.href='cetak_sk.php?start_date=<?= $startDate ?>&end_date=<?= $endDate ?>'" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Penerima</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal Dikirim</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($result->num_rows > 0): ?>
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
                                            <button class="btn btn-info btn-sk previewBtn"
                                                    data-toggle="modal"
                                                    data-target="#previewModal"
                                                    data-id="<?= $row["id"] ?>"
                                                    data-nomor-surat="<?= $row["nomor_surat"] ?>"
                                                    data-tanggal-surat="<?= $row["tanggal_surat"] ?>"
                                                    data-penerima="<?= $row["penerima"] ?>"
                                                    data-perihal="<?= $row["perihal"] ?>"
                                                    data-tgl-terima="<?= $row["tgl_kirim"] ?>">
                                                <i class="fas fa-eye"></i> Preview
                                            </button>
                                            <a href="edit_sk.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sk ml-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="hapus_sk.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-sk ml-2"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="7">Tidak ada data surat keluar.</td></tr>
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
                <button type="button" class="close" data-diskiss="modal" aria-label="Close">
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
                        <label for="penerima">penerima</label>
                        <input type="text" class="form-control" id="penerima" readonly>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" id="perihal" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tglTerima">Tanggal Diterima</label>
                        <input type="text" class="form-control" id="tglTerima" readonly>
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
            var tglTerima = $(this).data('tgl-terima');

            // Populate form fields in modal with data from the clicked button
            $('#nomorSurat').val(nomorSurat);
            $('#tanggalSurat').val(tanggalSurat);
            $('#penerima').val(penerima);
            $('#perihal').val(perihal);
            $('#tglTerima').val(tglTerima);

            // Show the modal
            $('#previewModal').modal('show');
        });
    });
</script>

</body>
</html>
