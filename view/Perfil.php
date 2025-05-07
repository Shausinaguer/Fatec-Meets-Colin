<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - InstaClone</title>
    <link rel="stylesheet" href="../view/css/estilo-perfil.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
    ?>
    <!-- Navbar -->
<?php include '../components/navbar.php'; ?>

    <!-- Perfil -->
    <section class="profile-container">
        <div class="profile-header">
            <img src="https://i.pravatar.cc/150?img=32" alt="Foto de Perfil" class="profile-img">

            <div class="profile-info">
                <div class="top-row">
                    <h2>joaodasilva</h2>
                    <button class="edit-btn">Editar perfil</button>
                </div>
                <div class="stats">
                    <span><strong>45</strong> publicações</span>
                    <span><strong>1023</strong> seguidores</span>
                    <span><strong>876</strong> seguindo</span>
                </div>
                <div class="bio">
                    <strong>João da Silva</strong><br>
                    Desenvolvedor e amante de fotografia 📸<br>
                    www.joaosilva.dev
                </div>
            </div>
        </div>

        <!-- Galeria de Fotos -->
        <div class="gallery">
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=1" alt=""></div>
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=2" alt=""></div>
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=3" alt=""></div>
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=4" alt=""></div>
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=5" alt=""></div>
            <div class="photo"><img src="https://source.unsplash.com/random/300x300?sig=6" alt=""></div>
        </div>
    </section>

</body>
</html>
