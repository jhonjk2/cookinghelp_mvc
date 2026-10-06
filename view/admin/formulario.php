<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="formulario">
<h1><?= $receita ? 'Alterar receita' : 'Nova receita' ?></h1>
<?php if ($erro): ?><div class="erro"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <label>Título</label><input type="text" name="titulo" required value="<?= htmlspecialchars($receita['titulo'] ?? '') ?>">
    <label>Categoria</label><input type="text" name="categoria" required value="<?= htmlspecialchars($receita['categoria'] ?? '') ?>">
    <label>Ingredientes</label><textarea name="ingredientes" required><?= htmlspecialchars($receita['ingredientes'] ?? '') ?></textarea>
    <label>Preparação</label><textarea name="preparacao" required><?= htmlspecialchars($receita['preparacao'] ?? '') ?></textarea>
    <label>Tempo</label><input type="text" name="tempo" required value="<?= htmlspecialchars($receita['tempo'] ?? '') ?>">
    <label>Dificuldade</label><select name="dificuldade"><option>Fácil</option><option>Média</option><option>Difícil</option></select>
    <label>Imagem da receita (JPG, PNG ou WEBP, até 3 MB)</label><input type="file" name="imagem" accept="image/jpeg,image/png,image/webp">
    <?php if (!empty($receita['imagem'])): ?><p>Imagem atual: <?= htmlspecialchars($receita['imagem']) ?></p><img class="preview" src="imagem/<?= htmlspecialchars($receita['imagem']) ?>"><?php endif; ?>
    <button><?= $receita ? 'Guardar alterações' : 'Adicionar receita' ?></button>
</form>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
