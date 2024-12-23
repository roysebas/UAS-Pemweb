<?php
    session_start();
   
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container" id="signin">
        <div class="form-title">Login</div>
        <form action="jslogin.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="login">Login</button>
            <div class="form-footer">
                <p>Sudah punya akun? <a href="register.php">Daftar disini</a></p>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(function(){
                $('#login').click(function(e){

                    var valid = this.form.checkValidity();

                    if(valid){
                        var username = $('#username').val();
                        var password = $('#password').val();
                    }

                    e.preventDefault();

                    $.ajax({
                        url: 'jslogin.php',
                        type: 'post',
                        data: {
                            username: $('#username').val(),
                            password: $('#password').val()
                        },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.status === 'success') {
                                Swal.fire({
                                    'title': 'Success!',
                                    'text': 'Login berhasil',
                                    'icon': 'success'
                                }).then(() => {
                                    window.location.href = 'home.php';
                                });
                            } else {
                                Swal.fire({
                                    'title': 'Error!',
                                    'text': data.message,
                                    'icon': 'error'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                'title': 'Error!',
                                'text': 'Data gagal disimpan',
                                'icon': 'error'
                            });
                        }
                    });

                });
            });
        });
    </script>
</body>
</html>