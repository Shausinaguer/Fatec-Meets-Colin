<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/login.php');
    exit;
}

require 'Conexao.php'; // conexão PDO ao banco

$titulo = $_POST['titulo'];
$local = $_POST['local'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$user_id = $_SESSION['usuario']['user_id'];

// Data e hora do evento vindos do formulário
if (!empty($_POST['data_evento'])) {
    $event_date = date('Y-m-d H:i:s', strtotime($_POST['data_evento']));
} else {
    die("Data do evento inválida.");
}

// Pasta para salvar as imagens
$diretorio = '../uploads/';

if (!is_dir($diretorio)) {
    mkdir($diretorio, 0755, true);
}

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagemTmp = $_FILES['imagem']['tmp_name'];
    $nomeOriginal = basename($_FILES['imagem']['name']);
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    
    // Verificação simples da extensão
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Formato de imagem não permitido.");
    }

    // Geração de nome único
    $nomeUnico = uniqid('img_', true) . '.' . $extensao;
    $caminhoFinal = $diretorio . $nomeUnico;
    $caminhoNoBanco = 'uploads/' . $nomeUnico;

    if (move_uploaded_file($imagemTmp, $caminhoFinal)) {
        // Inserir evento no banco
        $stmt = $pdo->prepare("INSERT INTO events (user_id, title, description, event_date, location, image_reference) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $titulo, $descricao, $event_date, $local, $caminhoNoBanco]);

        header("Location: feed.php?sucesso=1");
        exit;
    } else {
        echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Erro no upload da imagem.";
}
?>
