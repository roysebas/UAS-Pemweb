<?php
try {
    // Membuat koneksi ke database dengan PDO
    $db = new PDO("mysql:host=autorack.proxy.rlwy.net;port=59422;dbname=railway;charset=utf8mb4", "root", "kKCWYbbPvdwCInezfRjdCMKkZyOUkeVd");

    // Menetapkan mode error untuk PDO agar menghasilkan exception jika ada kesalahan
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    // Jika terjadi error saat koneksi ke database maka akan menampilkan pesan error
    die("Database connection failed: " . $e->getMessage());
}
?>