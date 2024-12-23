<?php
require_once 'config.php';
require_once 'controllers/PostController.php';

$postController = new PostController($db);

if (!isset($_GET['id'])) {
    header('Location: home.php');
    exit;
}

$post = $postController->getPostById($_GET['id']);

if (!$post) {
    header('Location: home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['post-content'];
    $imagePath = $post['image'];

    if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['post-image']['name']);
        move_uploaded_file($_FILES['post-image']['tmp_name'], $imagePath);
    }

    $postController->edit($_POST['id'], $content, $imagePath);
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile">
                <img src="assets/hero.jpg" alt="Profile Picture" class="profile-pic">
                <h2>Username</h2>
                <p>@username</p>
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
            <h2>Edit Postingan</h2>
            <section id="edit-post" class="edit-post">
                <form action="edit.php?id=<?= $post['id'] ?>" method="POST" enctype="multipart/form-data">
                    <textarea name="post-content" rows="4" required><?= htmlspecialchars($post['content']) ?></textarea>
                    <input type="file" name="post-image" accept="image/*">
                    <?php if ($post['image']): ?>
                        <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image" class="post-image">
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button type="submit">Update</button>
                </form>
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