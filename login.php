<?php
// Sertakan file koneksi.php
include 'koneksi.php';

// Mulai session
session_start();

// Memeriksa apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Melakukan query ke database untuk mendapatkan data user
    $query = "SELECT id, username FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Jika data ditemukan, simpan ID pengguna dan nama pengguna ke dalam sesi
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect ke halaman beranda.php setelah login berhasil
        header("Location: beranda.php");
        exit();
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        $error_message = "Email atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="CSS\login.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="form-container">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php if(isset($error_message)) { ?>
                            <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                        <?php } ?>
                        <div class="social-icons">
                            <img src="img\PLN2.png" alt="logo" style="width: 200px; height: auto;">
                            <p class="text-black mt-2" style="border-bottom: 2px solid black;">PT. PLN (PERSERO)<br>UNIT INDUK DISTRIBUSI SUMATERA BARAT</p>
                        </div>
                        <h1>MASUK</h1>
                        <input type="email" name="email" id="email" class="input-field" placeholder="Email" required>
                        <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
