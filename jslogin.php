<?php
session_start();
require_once('config.php');

if (empty($_POST['username']) || empty($_POST['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Username dan password tidak boleh kosong']);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
$stmtselect = $db->prepare($sql);
$result = $stmtselect->execute([$username]);

if ($result) {
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
    if ($stmtselect->rowCount() > 0) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['userlogin'] = $user;

            // Dapatkan jenis browser
            $browser = $_SERVER['HTTP_USER_AGENT'];

            // Dapatkan alamat IP
            $ip_address = file_get_contents('https://api.ipify.org');

            // Ambil user ID dari sesi
            $user_id = $user['id'];

            // Query untuk menyimpan data ke basis data
            $query = "UPDATE users SET browser = :browser, ip_address = :ip_address WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':browser', $browser);
            $stmt->bindParam(':ip_address', $ip_address);
            $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Password salah']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Username tidak ditemukan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Kesalahan saat mengakses database']);
}