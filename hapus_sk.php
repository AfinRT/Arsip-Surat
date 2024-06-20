<?php
// Include file koneksi ke database
include "koneksi.php";

// Cek apakah parameter id telah ada dan merupakan bilangan bulat positif
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data surat masuk berdasarkan id
    $sql = "DELETE FROM surat_keluar WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Data berhasil dihapus
        // Tambahkan alert berhasil dihapus menggunakan JavaScript
        echo '<script>';
        echo 'alert("Data berhasil dihapus.");';
        echo 'window.location.href = "surat_keluar.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid id parameter.";
}

// Menutup koneksi database
$conn->close();
?>
