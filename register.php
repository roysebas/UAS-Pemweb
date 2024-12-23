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
    <div class="container" id="register">
        <div class="form-title">Register</div>
        <form id="registerForm" action="proses.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="terms">
                    <input type="checkbox" id="terms" name="terms"> I accept the terms and conditions
                </label>
            </div>
            <div class="form-footer">
            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
            </div>
            <button type="submit" id="register">Register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            // Event handling for form submission
            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var valid = this.checkValidity();

                if (valid) {
                    var username = $('#username').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var gender = $('#gender').val();
                    var terms = $('#terms').is(':checked') ? 'Accepted' : 'Not Accepted';

                    $.ajax({
                        url: 'proses.php',
                        type: 'post',
                        data: {
                            username: username,
                            email: email,
                            password: password,
                            gender: gender,
                            terms: terms
                        },
                        success: function(data) {
                            Swal.fire({
                                'title': 'Selamat!',
                                'text': data,
                                'icon': 'success'
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                'title': 'Error!',
                                'text': 'Data gagal disimpan',
                                'icon': 'error'
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        'title': 'Error!',
                        'text': 'Form tidak valid',
                        'icon': 'error'
                    });
                }
            });

            // Event handling for input change
            $('#username, #email, #password, #gender').on('input change', function() {
                console.log('Input changed: ', $(this).attr('id'), $(this).val());
            });

            // Event handling for button click
            $('#register').on('click', function() {
                console.log('Register button clicked');
            });
        });
    </script>
</body>
</html>
