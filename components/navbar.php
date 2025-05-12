<?php
// Inicie a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Defina a URL base do projeto (ajuste conforme necessário)
define('BASE_URL', '/'); // se o projeto estiver na pasta /Meets


?>

<style>

:root {
    --primary-color: #ff6b6b; /* Vermelho pastel */
    --secondary-color: #ff9e9e; /* Vermelho mais claro */
    --text-color: #333;
    --light-gray: #f5f5f5;
    --white: #ffffff;
    --background: #fff;
    --btn-color: #ff6b6b;
    --btn-hover: #ff5252;
}

.profile-img-mini {
    width: 40px;
   height: 40px;
   border-radius: 50%;
   object-fit: cover;
   margin-right: 10px;
   }
   .navbar-user-area {
    display: flex;
    align-items: center;
    gap: 10px;
    }

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

button, .edit-btn {
    padding: 8px 15px;
    background-color: var(--btn-color);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.3s;
}

button:hover, .edit-btn:hover {
    background-color: var(--btn-hover);
}

/* Navbar Responsiva */
.navbar {
    background: var(--white);
    padding: 15px 0;
    border-bottom: 1px solid var(--light-gray);
    position: sticky;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.navbar-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.navbar-logo {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 0;
}

.navbar-links {
    display: flex;
    gap: 20px;
}

.navbar-item {
    color: var(--text-color);
    text-decoration: none;
    padding: 10px;
    transition: color 0.3s;
}

.navbar-item:hover, .navbar-item.active {
    color: var(--primary-color);
}

/* Menu Hambúrguer para mobile */
.menu-toggle {
    display: none;
    cursor: pointer;
    padding: 10px;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .navbar-links {
        display: none;
        width: 100%;
        flex-direction: column;
        gap: 0;
    }
    
    .navbar-links.active {
        display: flex;
    }
    
    .navbar-item {
        padding: 15px;
        border-top: 1px solid var(--light-gray);
    }
    
    .menu-toggle {
        display: block;
    }
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?= BASE_URL ?>index.php" class="navbar-logo">Fatec Meet</a>

        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <div class="navbar-links">
            <a href="<?= BASE_URL ?>index.php" class="navbar-item">Página inicial</a>
            <a href="<?= BASE_URL ?>view/Busca.php" class="navbar-item">Buscar</a>
            <a href="<?= BASE_URL ?>view/Postar.php" class="navbar-item">Postar</a>
            <a href="<?= BASE_URL ?>view/Perfil.php" class="navbar-item">Perfil</a>
        </div>

        <div class="navbar-user-area">
        <?php if (isset($_SESSION['usuario'])): ?>
                <img src="<?= htmlspecialchars($_SESSION['usuario']['foto']) ?>" class="profile-img-mini" alt="Perfil">
                <a href="<?= BASE_URL ?>PHP/logout.php"><button class="profile-btn">Logout</button></a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>view/Login.php"><button class="profile-btn">Login</button></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
