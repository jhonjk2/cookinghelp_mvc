<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="formulario pequeno">
<h1>Login</h1>
<?php if ($erro): ?><div class="erro"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
    <label>Email</label>
    <input type="email" name="email" required>

    <label>Palavra-passe</label>
    <input type="password" name="password" required>

    <button>Entrar</button>
</form>
<p>Ainda não tens conta? <a href="index.php?pagina=registo">Criar utilizador</a></p>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
