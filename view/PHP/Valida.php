<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Previne SQL Injection
    $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);  // "s" para string
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();  // Corrigido fetch_assoc
        
        // Verifica a senha hash
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: ../Feeds.html");  // Caminho corrigido
            exit();
        } else {
            header("Location: ../login.html?erro=1");  // Corrigido "erro" (não "error")
            exit();
        }
    } else {
        header("Location: ../login.html?erro=1");
        exit();
    }
} else {
    header("Location: ../login.html");
    exit();
}
?>