<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="formulario">
<h1>Nova receita</h1>
<p>Preenche os dados da tua receita. Ela ficará associada à tua conta.</p>
<?php if ($erro): ?><div class="erro"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <label>Título</label>
    <input type="text" name="titulo" required>

    <label>Categoria</label>
    <input type="text" name="categoria" required>

    <label>Ingredientes</label>
    <textarea name="ingredientes" required></textarea>

    <label>Preparação</label>
    <textarea name="preparacao" required></textarea>

    <label>Tempo</label>
    <input type="text" name="tempo" required>

    <label>Dificuldade</label>
    <select name="dificuldade">
        <option>Fácil</option>
        <option>Média</option>
        <option>Difícil</option>
    </select>

    <label>Imagem da receita (JPG, PNG ou WEBP, até 3 MB)</label>
    <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp">

    <button>Adicionar receita</button>
</form>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
