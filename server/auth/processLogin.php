<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lokasi file JSON
    $file_path = '../data/users.json';

    // Memuat data pengguna dari file JSON
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $users = json_decode($json_data, true);

        if (is_array($users)) {
            // Loop untuk memeriksa apakah email dan password cocok
            foreach ($users as $user) {
                if ($user['email'] === $email && password_verify($password, $user['password'])) {
                    // Jika cocok, simpan informasi pengguna dalam session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $user['email'];

                    // Set session untuk notifikasi sukses
                    $_SESSION['login_success'] = true;

                    // Redirect ke halaman /UTS/
                    header("Location: /UTS/");
                    exit();
                }
            }
        }
    }

    // Jika email atau password salah, atur session notifikasi gagal
    $_SESSION['login_error'] = true;

    // Redirect kembali ke halaman login
    header("Location: /UTS/login");
    exit();
} else {
    die("Server Error.");
}
?>