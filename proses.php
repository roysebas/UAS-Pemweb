<?php
require_once 'config.php'; // Pastikan $db terhubung di sini

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['gender'])) {
    // Mengambil data dari form dan melakukan sanitasi
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $gender     = $_POST['gender'];
    $terms      = isset($_POST['terms']) ? 'Accepted' : 'Not Accepted';

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = file_get_contents('https://api.ipify.org');
    // Menyiapkan query untuk insert data ke database
    $sql = "INSERT INTO users (username, email, password, gender, browser, ip_address) VALUES(?, ?, ?, ?, ?, ?)";
    $stminsert = $db->prepare($sql);

    // Mengeksekusi query dengan data yang diterima dari form
    $result = $stminsert->execute([$username, $email, $hashed_password, $gender, $browser, $ip_address]);
    if ($result) {
        echo"Data berhasil disimpan";
    }else {
        echo "Terdapat error saat menyimpan data";
    }
}else { 
    echo"Tidak ada data";
}
?>