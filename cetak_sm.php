<?php
// Include file koneksi ke database
include "koneksi.php";

// Initialize date range variables
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Query untuk mengambil data surat masuk dengan filter rentang waktu
$sql = "SELECT * FROM surat_masuk";
if (!empty($startDate) && !empty($endDate)) {
    $sql .= " WHERE tgl_terima BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Surat Masuk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat h1, .kop-surat p {
            margin: 0;
        }
        .border {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="kop-surat">
            <h1>PT. PLN (PERSERO)</h1>
            <p>UNIT INDUK DISTRIBUSI SUMATERA BARAT</p>
            <p>Jl. Wahidin No. 8, Padang, Sumatera Barat 25000, Indonesia</p>
            <p>Telp: (0751) 123456 | Fax: (0751) 654321</p>
        </div>

        <div class="border"></div>

        <h2 class="text-center mb-4">Rekap Surat Masuk</h2>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nomor Surat</th>
                    <th scope="col">Tanggal Surat</th>
                    <th scope="col">Pengirim</th>
                    <th scope="col">Perihal</th>
                    <th scope="col">Tanggal Terima</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . htmlspecialchars($row["nomor_surat"]) . "</td>
                                <td>" . htmlspecialchars(date('d-m-Y', strtotime($row["tanggal_surat"]))) . "</td>
                                <td>" . htmlspecialchars($row["pengirim"]) . "</td>
                                <td>" . htmlspecialchars($row["perihal"]) . "</td>
                                <td>" . htmlspecialchars(date('d-m-Y', strtotime($row["tgl_terima"]))) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data surat masuk sesuai filter.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> PT. PLN (PERSERO) UNIT INDUK DISTRIBUSI SUMATERA BARAT. All rights reserved.</p>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Automatically trigger print dialog when page is loaded
        window.onload = function () {
            window.print();
        };

        // Redirect after printing or canceling print
        window.onafterprint = function () {
            window.location.href = "rekap_sm.php"; // Redirect back to the main page
        };
    </script>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
