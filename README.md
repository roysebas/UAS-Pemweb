**UAS PEMWEB**

**Bagian 1: Client-side Programming (Bobot: 30%)**

**1.1 Manipulasi DOM dengan JavaScript (15%)**

Buat form input dengan minimal 4 elemen input (teks, checkbox, radio, dll.)
```
body>
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
```

Tampilkan data dari server ke dalam sebuah tabel HTML.
![image](https://github.com/user-attachments/assets/dc32b81f-963e-4edb-89fa-42f498170043)

**Manipulasi DOM dengan JavaScript**

**1.2 Event Handling (15%)**

Tambahkan minimal 3 event yang berbeda untuk meng-handle form pada 1.1.
Implementasikan JavaScript untuk validasi setiap input sebelum diproses oleh PHP.
```
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
```


**Form Validation**

**Bagian 2: Server-side Programming (Bobot: 30%)**

**2.1 Pengelolaan Data dengan PHP (20%)**
Gunakan metode POST atau GET pada formulir.
```
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
```

Parsing data dari variabel global dan lakukan validasi di sisi server.
Simpan ke basis data termasuk jenis browser dan alamat IP pengguna.
Pengelolaan Data dengan PHP

**2.2 Objek PHP Berbasis OOP (10%)**
Buat sebuah objek PHP berbasis OOP yang memiliki minimal dua metode dan gunakan objek tersebut dalam skenario tertentu.
Class Mahasiswa

**Bagian 3: Database Management (Bobot: 20%)**

**3.1 Pembuatan Tabel Database (5%)**


![image](https://github.com/user-attachments/assets/32fab63c-388c-4bf4-918e-f31df490e812)
![image](https://github.com/user-attachments/assets/a6308a2e-7c79-4cc7-8663-906b040ad2f7)


**3.2 Konfigurasi Koneksi Database (5%)**

```
<?php
try {
    $db_user = "root";
    $db_password = "";
    $db_name = "uaspemweb";

    $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
```


**3.3 Manipulasi Data pada Database (10%)**

```
<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getAllPosts() {
        $stmt = $this->db->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
```

**Bagian 4: State Management (Bobot: 20%)
4.1 State Management dengan Session (10%)**
Gunakan session_start() untuk memulai session.
Simpan informasi pengguna ke dalam session.
```
<?php
    // Memulai sesi PHP
    session_start();
    // Mengecek apakah pengguna sudah login, jika ya, diarahkan ke halaman home.php
    if (isset($_SESSION['userlogin'])) {
        header('Location: home.php');
        exit;
    }
?>
```

**4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
Buat fungsi untuk menetapkan, mendapatkan, dan menghapus cookie.**

```
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function deleteCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999;";
```

**Gunakan browser storage untuk menyimpan informasi secara lokal.
Browser Storage JavaScript**
```
function setLocalStorage(key, value) {
    localStorage.setItem(key, value);
}

function getLocalStorage(key) {
    return localStorage.getItem(key);
}

function removeLocalStorage(key) {
    localStorage.removeItem(key);
}

function setSessionStorage(key, value) {
    sessionStorage.setItem(key, value);
}

function getSessionStorage(key) {
    return sessionStorage.getItem(key);
}

function removeSessionStorage(key) {
    sessionStorage.removeItem(key);
}
```

**Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)**
(5%) Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
(5%) Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda.
(5%) Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
(5%) Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
