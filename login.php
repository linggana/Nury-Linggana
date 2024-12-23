<?php
session_start();
include 'config/db.php';  // Pastikan koneksi ke database sudah benar

// Menangani form login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form login
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $query = "SELECT * FROM Pengguna WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Mengecek hasil query
    if (mysqli_num_rows($result) > 0) {
        // Jika data ditemukan, simpan session
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level'];

        // Arahkan berdasarkan level pengguna
        if ($user['level'] == 'admin') {
            header("Location: admin/dashboard.php"); // Admin diarahkan ke dashboard
        } elseif ($user['level'] == 'staff') {
            header("Location: staff/index.php"); // Staff diarahkan ke dashboard staff
        } elseif ($user['level'] == 'operator') {
            header("Location: operator/index.php"); // Operator diarahkan ke dashboard operator
        }
        exit;
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau Password salah!";
    }

    // Menutup prepared statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Belum punya akun? <a href="register.php">Daftar disini</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
