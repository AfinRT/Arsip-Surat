<?php
// Mulai session
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Anda bisa mengambil informasi lain dari sesi sesuai kebutuhan, seperti username
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="CSS/menubar.css"> <!-- Lokasi CSS sesuaikan dengan struktur folder Anda -->
</head>
<body>

    <div class="sidebar">
        <!-- PLN Logo and Company Name -->
        <div class="sidebar-logo">
            <img src="img/pln.png" alt="PLN Logo">
            <p class="text-white mt-2">PT. PLN (PERSERO)<br>UNIT INDUK DISTRIBUSI SUMATERA BARAT</p>
        </div>
        
        <!-- Sidebar Menu Links -->
        <a href="beranda.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'beranda.php') ? 'active' : ''; ?>"><i class="fas fa-home mr-2"></i>Dashboard</a>
        <a href="surat_masuk.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'surat_masuk.php') ? 'active' : ''; ?>"><i class="fas fa-envelope mr-2"></i>Surat Masuk</a>
        <a href="surat_keluar.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'surat_keluar.php') ? 'active' : ''; ?>"><i class="fas fa-paper-plane mr-2"></i>Surat Keluar</a>
        
        <!-- Dropdown Menu -->
        <div class="dropdown">
            <a class="dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'rekap_sm.php' || basename($_SERVER['PHP_SELF']) == 'rekap_sk.php') ? 'active' : ''; ?>" href="#" role="button" id="rekapDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file-alt mr-2"></i>Rekap
            </a>
            <div class="dropdown-menu" aria-labelledby="rekapDropdown">
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'rekap_sm.php') ? 'active' : ''; ?>" href="rekap_sm.php?type=masuk">Rekap Surat Masuk</a>
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'rekap_sk.php') ? 'active' : ''; ?>" href="rekap_sk.php?type=keluar">Rekap Surat Keluar</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="font-size: 22px; color:white;" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle mr-1"></i> <?= $username ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#rekapDropdown').on('click', function(e) {
                $(this).next('.dropdown-menu').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
        });
    </script>
</body>
</html>
