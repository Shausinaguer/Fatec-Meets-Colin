<?php
require __DIR__ . '/config.php';

// Consulta dos eventos
$stmt = $pdo->query("SELECT e.*, u.nome, u.foto FROM eventos e
                     JOIN users u ON e.usuario_id = u.user_id
                     ORDER BY e.data_criacao DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<!-- Navbar -->
<?php include __DIR__ . '/components/navbar.php'; ?>

<!-- Feed de Posts -->
<div class="feed">
    <?php if (count($eventos) === 0): ?>
        <p style="text-align:center;">Nenhum evento ainda. Seja o primeiro a postar!</p>
    <?php else: ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="post">
                <?php if ($evento['imagem']): ?>
                    <div class="post-image">
                        <img src="<?= htmlspecialchars($evento['imagem']) ?>" alt="Imagem do evento">
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <h3><?= htmlspecialchars($evento['titulo']) ?></h3>
                    <p><strong>Local:</strong> <?= htmlspecialchars($evento['local']) ?></p>
                    <p><strong>Categoria:</strong> <?= htmlspecialchars($evento['categoria']) ?></p>
                    <p><strong>Quando:</strong> <?= date('d/m/Y H:i', strtotime($evento['data_evento'])) ?></p>
                    <p><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                    <div class="post-footer">
                        Publicado em <?= date('d/m/Y H:i', strtotime($evento['data_criacao'])) ?> por:
                        <u><?= htmlspecialchars($evento['nome']) ?></u>
                        <img src="<?= htmlspecialchars($evento['foto']) ?>" class="profile-img-mini" alt="Foto perfil">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    // Toggle menu (mobile)
    document.querySelector('.menu-toggle').addEventListener('click', function () {
        document.querySelector('.navbar-links').classList.toggle('active');
    });

    // Aplica dark-mode se já estiver salvo
    if (localStorage.getItem('dark-mode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
</script>

</body>
</html>
