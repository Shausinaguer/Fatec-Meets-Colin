<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../components/navbar.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Exemplo de carregamento de dados do usuário logado
$usuario = $_SESSION['usuario']; // Aqui você pode substituir por um SELECT no banco de dados se necessário

// Mensagem de sucesso
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processamento do formulário
    $novoNome = $_POST['nome'] ?? $usuario['nome'];
    
    // Upload da imagem
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeFoto = uniqid('perfil_') . '.' . $ext;
        $caminhoDestino = __DIR__ . '/uploads/' . $nomeFoto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino);
        
        // Atualize o caminho da imagem na sessão (ou no banco de dados)
        $_SESSION['usuario']['foto'] = 'uploads/' . $nomeFoto;
    }

    // Atualize o nome na sessão (ou no banco de dados)
    $_SESSION['usuario']['nome'] = $novoNome;

    $mensagem = 'Perfil atualizado com sucesso!';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil - Meets</title>
    <link rel="stylesheet" href="css/estilo-editar-perfil.css">
</head>
<body>

<section class="edit-profile-container">
    <h1>Editar Perfil</h1>
    
    <?php if ($mensagem): ?>
        <p class="mensagem-sucesso"><?= $mensagem ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome completo:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($_SESSION['usuario']['nome']) ?>" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto de perfil:</label><br>
            <input type="file" name="foto" id="foto" accept="image/*">
            <div class="foto-atual">
                <p>Foto atual:</p>
                <img src="<?= $_SESSION['usuario']['foto'] ?? 'https://i.pravatar.cc/150?img=32' ?>" alt="Foto atual" width="100">
            </div>
        </div>

        <button type="submit" class="btn-salvar">Salvar Alterações</button>
    </form>
</section>

</body>
</html>
