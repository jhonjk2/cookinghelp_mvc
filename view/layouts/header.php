<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Help</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topo">
    <div class="container nav">
        <a class="logo" href="index.php?pagina=receitas">🍳 Cooking Help</a>
        <nav>
            <a href="index.php?pagina=receitas">Receitas</a>

            <?php if (isset($_SESSION['utilizador'])): ?>
                <?php if ($_SESSION['utilizador']['tipo'] === 'admin'): ?>
                    <a href="index.php?pagina=admin">Dashboard</a>
                <?php else: ?>
                    <a href="index.php?pagina=utilizador">Minha área</a>
                <?php endif; ?>

                <a href="index.php?pagina=logout">Sair</a>
            <?php else: ?>
                <a href="index.php?pagina=login">Login</a>
                <a href="index.php?pagina=registo">Criar conta</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
