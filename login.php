<?php
    // Memulai sesi PHP
    session_start();

    // Mengecek apakah pengguna sudah login, jika ya, diarahkan ke halaman home.php
    if (isset($_SESSION['userlogin'])) {
        header('Location: home.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UAS PEMWEB</title>
    <!-- Menyertakan file CSS eksternal -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container" id="signin">
        <div class="form-title">Login</div>
        <!-- Form login dengan metode POST -->
        <form id="loginForm" action="jslogin.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <!-- Input untuk username -->
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <!-- Input untuk password -->
                <input type="password" id="password" name="password" required>
            </div>
            <!-- Tombol untuk submit form -->
            <button type="submit" id="login">Login</button>
            <div class="form-footer">
                <!-- Link untuk pendaftaran akun baru -->
                <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
            </div>
        </form>
    </div>
    <!-- Menyertakan library SweetAlert2 untuk tampilan alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Menyertakan library jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            // Penanganan event untuk submit form
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                var valid = this.checkValidity();

                if (valid) {
                    // Mengambil data username dan password dari input
                    var username = $('#username').val();
                    var password = $('#password').val();

                    // Mengirim data ke jslogin.php menggunakan AJAX
                    $.ajax({
                        url: 'jslogin.php', // Tujuan pengiriman data
                        type: 'post',       // Metode pengiriman data
                        data: {
                            username: username,
                            password: password
                        },
                        success: function(response) {
                            const data = JSON.parse(response); // Mengubah respon JSON ke objek
                            if (data.status === 'success') {
                                // Menampilkan notifikasi sukses
                                Swal.fire({
                                    'title': 'Success!',
                                    'text': 'Login berhasil',
                                    'icon': 'success'
                                }).then(() => {
                                    // Mengarahkan ke halaman home.php jika berhasil
                                    window.location.href = 'home.php';
                                });
                            } else {
                                // Menampilkan notifikasi error jika login gagal
                                Swal.fire({
                                    'title': 'Error!',
                                    'text': data.message,
                                    'icon': 'error'
                                });
                            }
                        },
                        error: function() {
                            // Menampilkan notifikasi error jika AJAX gagal
                            Swal.fire({
                                'title': 'Error!',
                                'text': 'Data gagal disimpan',
                                'icon': 'error'
                            });
                        }
                    });
                }
            });

            // Penanganan event untuk perubahan input username atau password
            $('#username, #password').on('input', function() {
                console.log('Input changed: ', $(this).attr('id'), $(this).val());
            });

            // Penanganan event ketika tombol login diklik
            $('#login').on('click', function() {
                console.log('Login button clicked');
            });
        });
    </script>
</body>
</html>
