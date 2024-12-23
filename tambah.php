<?php
session_start();

$user = $_SESSION['userlogin'];

require_once 'config.php';
require_once 'controllers/PostController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController = new PostController($db);
    $content = $_POST['post-content'];
    $imagePath = null;

    if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['post-image']['name']);
        move_uploaded_file($_FILES['post-image']['tmp_name'], $imagePath);
    }

    $postController->store($content, $imagePath);
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Postingan</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile">
                <img src="assets/hero.jpg" alt="Profile Picture" class="profile-pic">
                <h2><?= htmlspecialchars($user['username']) ?></h2>
                <p>@<?= htmlspecialchars($user['username']) ?></p>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="tambah.php">Tambah Postingan</a></li>
                    <li><a href="home.php?logout" onclick="return confirmLogout();">Keluar</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <h2>Tambah Postingan</h2>
            <section id="add-post" class="add-post">
                <form id="postForm" action="tambah.php" method="POST" enctype="multipart/form-data">
                    <textarea id="postContent" name="post-content" rows="4" placeholder="Apa yang sedang terjadi?" required></textarea>
                    <!-- <input id="postImage" type="file" name="post-image" accept="image/*"> -->
                    <button type="submit">Post</button>
                </form>
            </section>
        </main>
    </div>
    <script src="js/scripts.js"></script>
    <script>
        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir default

            const postContent = document.getElementById('postContent').value;
            const postImage = document.getElementById('postImage').files[0];

            // Simpan teks ke dalam cookies dan local storage
            setCookie('postContent', postContent, 7);
            setLocalStorage('postContent', postContent);

            // Simpan gambar ke dalam local storage (cookies tidak mendukung penyimpanan file)
            if (postImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageData = e.target.result;
                    setLocalStorage('postImage', imageData);
                };
                reader.readAsDataURL(postImage);
            }

            // Lanjutkan pengiriman formulir setelah menyimpan data
            this.submit();
        });

        // Contoh penggunaan fungsi cookie
        setCookie('username', '<?= htmlspecialchars($user['username']) ?>', 7);
        console.log('Cookie set: ' + getCookie('username')); // Check if cookie is set

        // Get Cookie
        const usernameCookie = getCookie('username');
        if (usernameCookie) {
            console.log('Cookie retrieved: ' + usernameCookie); // Check if cookie is retrieved
        } else {
            console.log('Cookie not found');
        }

        // Delete Cookie
        deleteCookie('username');
        console.log('Cookie after deletion: ' + getCookie('username')); // Check if cookie is deleted

        // Contoh penggunaan browser storage
        setLocalStorage('username', '<?= htmlspecialchars($user['username']) ?>');
        console.log('LocalStorage set: ' + getLocalStorage('username')); // Check if local storage is set
        removeLocalStorage('username');
        console.log('LocalStorage after removal: ' + getLocalStorage('username')); // Check if local storage is removed

        setSessionStorage('sessionKey', 'sessionValue');
        console.log('SessionStorage set: ' + getSessionStorage('sessionKey')); // Check if session storage is set
        removeSessionStorage('sessionKey');
        console.log('SessionStorage after removal: ' + getSessionStorage('sessionKey')); // Check if session storage is removed
    </script>
</body>
</html>