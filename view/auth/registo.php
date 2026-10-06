<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="formulario pequeno">
<h1>Novo utilizador</h1>
<?php if ($erro): ?><div class="erro"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
    <label>Nome</label><input type="text" name="nome" required>
    <label>Email</label><input type="email" name="email" required>
    <label>Palavra-passe</label><input type="password" name="password" required>
    <button>Criar utilizador</button>
</form>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
