<?php
session_start();
require_once 'Conexao.php';

function redirecionaComErro() {
    header('Location: ' . BASE_URL . 'view/login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação básica
    if (empty($email) || empty($senha)) {
        redirecionaComErro();
    }

    $stmt = $conexao->prepare("SELECT user_id, name, email, profile_image, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['user_id'],
                'nome' => $usuario['name'],
                'email' => $usuario['email'],
                'foto' => $usuario['profile_image'] ?? 'https://i.pravatar.cc/150?img=32'
            ];

            header("Location: ../index.php"); // ou a página de feed/logado
            exit;
        }
    }

    // Falha no login
    redirecionaComErro();
} else {
    header("Location: ../view/Login.php");
    exit;
}
