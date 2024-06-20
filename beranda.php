<?php
// Include database connection and any necessary files
include 'koneksi.php'; // Assuming this file contains database connection logic
include 'menubar.php'; // Include other necessary files

// Initialize variables
$count1_today = 0;
$count2_today = 0;
$count1_month = 0;
$count2_month = 0;

// Check if the connection to the database is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get today's date
$today = date('Y-m-d');

// Query to get number of records from surat_masuk for today
$get1_today = mysqli_query($conn, "SELECT COUNT(*) AS count1_today FROM surat_masuk WHERE DATE(tgl_terima) = '$today'");
if ($get1_today) {
    $row1_today = mysqli_fetch_assoc($get1_today);
    $count1_today = $row1_today['count1_today'];
} else {
    echo "Error fetching data for surat_masuk today: " . mysqli_error($conn);
}

// Query to get number of records from surat_keluar for today
$get2_today = mysqli_query($conn, "SELECT COUNT(*) AS count2_today FROM surat_keluar WHERE DATE(tgl_kirim) = '$today'");
if ($get2_today) {
    $row2_today = mysqli_fetch_assoc($get2_today);
    $count2_today = $row2_today['count2_today'];
} else {
    echo "Error fetching data for surat_keluar today: " . mysqli_error($conn);
}

// Get the first day of the current month
$first_day_current_month = date('Y-m-01');

// Query to get number of records from surat_masuk for the current month
$get1_month = mysqli_query($conn, "SELECT COUNT(*) AS count1_month FROM surat_masuk WHERE DATE(tgl_terima) >= '$first_day_current_month'");
if ($get1_month) {
    $row1_month = mysqli_fetch_assoc($get1_month);
    $count1_month = $row1_month['count1_month'];
} else {
    echo "Error fetching data for surat_masuk this month: " . mysqli_error($conn);
}

// Query to get number of records from surat_keluar for the current month
$get2_month = mysqli_query($conn, "SELECT COUNT(*) AS count2_month FROM surat_keluar WHERE DATE(tgl_kirim) >= '$first_day_current_month'");
if ($get2_month) {
    $row2_month = mysqli_fetch_assoc($get2_month);
    $count2_month = $row2_month['count2_month'];
} else {
    echo "Error fetching data for surat_keluar this month: " . mysqli_error($conn);
}

?>
    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    <link rel="stylesheet" href="CSS\beranda.css">
</head>
<body>
    <!-- Content area -->
    <div class="container">
    <h2>Selamat Datang di Aplikasi Arsip Surat PT. PLN (PERSERO) <br> Unit Induk Distribusi Sumatera Barat</h2>
    <p>Silakan mulai menggunakan fitur-fitur yang tersedia.</p>
        <div class="row">
            <div class="col-md-3">
                <div class="summary-box">
                    <h2><i class="fas fa-inbox icon"></i> Surat Masuk Hari Ini</h2>
                    <p><?php echo $count1_today; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-box">
                    <h2><i class="fas fa-paper-plane icon"></i> Surat Keluar Hari Ini</h2>
                    <p><?php echo $count2_today; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-box">
                    <h2><i class="fas fa-inbox icon"></i> Surat Masuk Bulan Ini</h2>
                    <p><?php echo $count1_month; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-box">
                    <h2><i class="fas fa-paper-plane icon"></i> Surat Keluar Bulan Ini</h2>
                    <p><?php echo $count2_month; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
