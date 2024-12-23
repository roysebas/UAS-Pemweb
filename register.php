<?php
require_once 'config.php'; //  $db terhubung di sini
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container" id="signup">
        <div class="form-title">Daftar Akun</div>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <div class="radio-group">
                <label>Jenis Kelamin:</label><br>
                <input type="radio" id="male" name="gender" value="Laki-laki" required>
                <label for="male">Laki-Laki</label>
                <input type="radio" id="female" name="gender" value="Perempuan" required>
                <label for="female">Perempuan</label>
            </div>
            
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" id="terms" name="terms" required>
                    Saya setuju dengan syarat dan ketentuan
                </label>
            </div>
            
            <button type="submit" id="register" name="submit">Submit</button>
        </form>

        <div class="form-footer" style="margin-top: 20px;">
            Sudah punya akun? <a href="login.php">Login disini</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function(){
            $('#register').click(function(e){
                
                var valid = this.form.checkValidity();
                
                if(valid){

                    var username    = $('#username').val();
                    var email       = $('#email').val();
                    var password    = $('#password').val();
                    var gender      = $('input[name="gender"]:checked').val();

                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'proses.php',
                        data: {username: username, email: email, password: password, gender: gender},
                        success: function(data){
                            Swal.fire({
                                'title': 'Selamat!',
                                'text': data,
                                'icon': 'success'
                            });
                        },
                        error: function(data){
                            Swal.fire({
                                'title': 'Error!',
                                'text': 'Data gagal disimpan',
                                'icon': 'error'
                            });
                        }
                    });
                    
                }else{
                    
                }


            });
        
        });
    </script>
</body>
</html>
