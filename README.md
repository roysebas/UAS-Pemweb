AS PemWeb (Pengembangan Web)
Bagian 1: Client-side Programming (Bobot: 30%)
1.1 Manipulasi DOM dengan JavaScript (15%)
Tugas:
Buat form input dengan minimal 4 elemen input (teks, checkbox, radio, dll.).
Tampilkan data dari server ke dalam tabel HTML.
Manipulasi DOM menggunakan JavaScript.
1.2 Event Handling (15%)
Tugas:
Tambahkan minimal 3 event yang berbeda untuk meng-handle form.
Implementasikan validasi setiap input dengan JavaScript sebelum diproses oleh PHP.
Bagian 2: Server-side Programming (Bobot: 30%)
2.1 Pengelolaan Data dengan PHP (20%)
Tugas:
Gunakan metode POST atau GET pada formulir.
Parsing data dari variabel global dan lakukan validasi di sisi server.
Simpan data ke basis data, termasuk jenis browser dan alamat IP pengguna.
Contoh Koneksi DB:

php
Salin kode
try {
    $db_user = "root";
    $db_password = "";
    $db_name = "uaspemweb";

    $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
2.2 Objek PHP Berbasis OOP (10%)
Tugas:
Buat objek PHP berbasis OOP dengan minimal dua metode.
Gunakan objek tersebut dalam skenario tertentu.
Contoh Kelas:

php
Salin kode
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
}
Bagian 3: Database Management (Bobot: 20%)
3.1 Pembuatan Tabel Database (5%)
Tugas:
Buat tabel database untuk menyimpan data.
3.2 Konfigurasi Koneksi Database (5%)
Tugas:
Pastikan koneksi database menggunakan PDO (lihat contoh di Bagian 2.1).
3.3 Manipulasi Data pada Database (10%)
Tugas:
Buat metode untuk membaca dan menulis data ke database.
Bagian 4: State Management (Bobot: 20%)
4.1 State Management dengan Session (10%)
Tugas:
Gunakan session_start() untuk memulai session.
Simpan informasi pengguna ke dalam session.
Contoh:

php
Salin kode
session_start();
if (isset($_SESSION['userlogin'])) {
    header('Location: home.php');
    exit;
}
4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
Tugas:
Buat fungsi untuk mengelola cookie dan localStorage/sessionStorage.
Cookie JavaScript:

javascript
Salin kode
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
        while (c.charAt(0) === ' ') c = c.substring(1);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
    }
    return null;
}

function deleteCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999;";
}
Browser Storage JavaScript:

javascript
Salin kode
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
Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)
Hosting Langkah-langkah (5%)
Pilih penyedia hosting.
Upload file ke server melalui FTP atau panel hosting.
Konfigurasikan database pada server.
Pastikan file config.php sudah diatur dengan benar.
Penyedia Hosting (5%)
Gunakan layanan seperti AWS, Heroku, Hostinger, atau DigitalOcean untuk performa dan fleksibilitas.
Keamanan (5%)
Gunakan HTTPS untuk enkripsi.
Terapkan validasi input dan sanitasi.
Perbarui library dan framework yang digunakan.
Konfigurasi Server (5%)
Gunakan PHP versi terbaru.
Konfigurasikan firewall dan aturan akses server.
Aktifkan logging untuk pemantauan aplikasi.
