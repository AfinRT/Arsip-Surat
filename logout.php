<?php
// Mulai session
session_start();

// Hapus semua variabel session
session_unset();

// Hapus session data dari server
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit();
?>
