<?php

session_start();

$user = $_SESSION['userlogin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
            <h2>Profil</h2>
            <section id="profile" class="profile-section">
                <table class="profile-table">
                    <tr>
                        <th>Username</th>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= htmlspecialchars($user['gender']) ?></td>
                    </tr>
                    <tr>
                        <th>Browser</th>
                        <td><?= htmlspecialchars($user['browser']) ?></td>
                    </tr>
                    <tr>
                        <th>IP Address</th>
                        <td><?= htmlspecialchars($user['ip_address']) ?></td>
                    </tr>
                </table>
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