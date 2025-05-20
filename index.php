<?php
require __DIR__ . '/config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Fatec Meet</title>
    <link rel="stylesheet" href="view/css/estilo-feeds.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>


<button id="toggle-dark-mode" style="position: fixed; top: 10px; right: 10px; z-index: 999;">
    🌙
</button>


<!-- Navbar -->
<?php include __DIR__ . '/components/navbar.php'; ?>


<!-- Feed de Posts -->
<div class="feed">
    <a href="view/Meet.php" class="post">
        <!-- Exemplo de post fixo (você pode carregar do banco depois) -->
            <div class="post">
                <img src="view/imagens/post1.jpg" alt="Imagem do Post 1" class="post-image">
                <h2 class="post-title">Reunião Grupo ADM</h2>
                <p class="post-text">Este é o conteúdo do primeiro post. Aqui você pode compartilhar ideias, fotos e muito mais.</p>
                <div class="post-footer">Publicado em 10/10/2023 por Usuário: <u>NicolasCagezinho</u>
            </div>
        </div>
    </a>
</div>



<script>
 document.querySelector('.menu-toggle').addEventListener('click', function () {
 document.querySelector('.navbar-links').classList.toggle('active');
 });
</script>


<script>
    const toggle = document.getElementById('toggle-dark-mode');
    const body = document.body;

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
        }
    });
</script>


</body>
</html>
