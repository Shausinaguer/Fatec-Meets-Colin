<?php
require_once 'conexao.php';

function redirecionaComMensagem($mensagem) {
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Cadastro</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                text-align: center;
                padding: 50px;
            }
            .mensagem {
                background-color: #fff3cd;
                color: #856404;
                padding: 20px;
                border-radius: 10px;
                border: 1px solid #ffeeba;
                display: inline-block;
                margin-bottom: 20px;
            }
            a {
                display: inline-block;
                margin-top: 15px;
                text-decoration: none;
                color: #007bff;
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <strong>$mensagem</strong><br>
            <a href='../view/cadastro.php'>Voltar para o cadastro</a>
        </div>
    </body>
    </html>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $repetir_senha = $_POST['repetir_senha'] ?? '';

    if ($senha != $repetir_senha) {
        redirecionaComMensagem("❌ As senhas não coincidem!");
    }

    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

    $sql_verifica = "SELECT email FROM users WHERE email = ?";
    $stmt_verifica = $conexao->prepare($sql_verifica);
    $stmt_verifica->bind_param("s", $email);
    $stmt_verifica->execute();
    $stmt_verifica->store_result();

    if ($stmt_verifica->num_rows > 0) {
        redirecionaComMensagem("⚠️ Este e-mail já está cadastrado!");
    }

    $stmt_verifica->close();

    $sql = "INSERT INTO users (nome, email, usuario, celular, senha) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $usuario, $celular, $senha_cripto);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        redirecionaComMensagem("Erro ao cadastrar: " . $conexao->error);
    }

    $stmt->close();
    $conexao->close();
} else {
    redirecionaComMensagem("Acesso inválido ao formulário.");
}
?>
