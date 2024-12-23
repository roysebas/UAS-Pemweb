<?php
session_start();
require_once 'config.php';
require_once 'controllers/PostController.php';

$user = $_SESSION['userlogin'];

if (!isset($_SESSION['userlogin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

$postController = new PostController($db);
$posts = $postController->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $postController->destroy($_POST['id']);
    }
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <section id="posts" class="posts">
                <h2>Postingan Anda</h2>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <div class="post-header">
                            <img src="assets/hero.jpg" alt="Profile Picture" class="post-profile-pic">
                            <div class="post-user-info">
                                <h3><?= htmlspecialchars($user['username']) ?></h3>
                                <p>@<?= htmlspecialchars($user['username']) ?></p>
                            </div>
                        </div>
                        <div class="post-content">
                            <?php if ($post['image']): ?>
                                <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image" class="post-image">
                            <?php endif; ?>
                            <p><?= htmlspecialchars($post['content']) ?></p>
                        </div>
                        <div class="post-actions">
                            <form action="home.php" method="POST">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit" class="delete-button" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Delete</button>
                            </form>
                            <a href="edit.php?id=<?= $post['id'] ?>" class="edit-button">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
    <script>
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin keluar?");
        }
    </script>
</body>
</html>