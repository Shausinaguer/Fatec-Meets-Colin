<?php
// components/navbar.php
// Incluir o arquivo de configuração
require __DIR__ . '/config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo-cadastro.css"> <!-- Usando o mesmo CSS -->
</head>
<body>


<?php if (isset($_GET['erro'])): ?>
    <div style="color: red; text-align: center; margin-bottom: 10px;">
        ❌ E-mail ou senha incorretos. Tente novamente.
    </div>
<?php endif; ?>



    <div class="container">
        <h2>Login</h2>

        <form action="/Meets-main/PHP/Valida.php" method="POST">
            <img src="../view/imagens/logo.png" alt="Logo" style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <hr>
            <p style="text-align: center; margin: 15px 0; font-size: 14px;">Não tem uma conta? <a href="Cadastro.php" style="color: #28a745;">Cadastre-se aqui</a></p>
        </form>

        <a href="../index.php"><button>Voltar</button></a>
    </div>
</body>
</html>