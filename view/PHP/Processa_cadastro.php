<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $celular = $_POST['celular'];
    $senha = $_POST['senha'];
    $repetir_senha = $_POST['repetir_senha'];
    
    // Validações básicas
    if ($senha != $repetir_senha) {
        die("As senhas não coincidem!");
    }
    
    // Criptografa a senha (importante para segurança)
    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);
    
    // Prepara o SQL para inserir no banco
    $sql = "INSERT INTO usuarios (nome, email, usuario, celular, senha) 
            VALUES (?, ?, ?, ?, ?)";
    
    // Prepara a declaração (evita SQL injection)
    $stmt = $conexao->prepare($sql);
    
    // Associa os parâmetros
    $stmt->bind_param("sssss", $nome, $email, $usuario, $celular, $senha_cripto);
    
    // Executa a inserção
    if ($stmt->execute()) {
        header("Location: ../Feeds.html");  // Redireciona para index.html
        exit(); // Encerra o script imediatamente
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
    
    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
} else {
    // Se alguém tentar acessar diretamente o arquivo
    echo "Acesso não permitido!";
}
?>