<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="detalhe">
    <?php if ($receita['imagem']): ?><img class="imagem-detalhe" src="imagem/<?= htmlspecialchars($receita['imagem']) ?>" alt="<?= htmlspecialchars($receita['titulo']) ?>"><?php endif; ?>
    <span class="categoria"><?= htmlspecialchars($receita['categoria']) ?></span>
    <h1><?= htmlspecialchars($receita['titulo']) ?></h1>
    <p><strong>Tempo:</strong> <?= htmlspecialchars($receita['tempo']) ?> | <strong>Dificuldade:</strong> <?= htmlspecialchars($receita['dificuldade']) ?></p>
    <h2>Ingredientes</h2><p><?= nl2br(htmlspecialchars($receita['ingredientes'])) ?></p>
    <h2>Preparação</h2><p><?= nl2br(htmlspecialchars($receita['preparacao'])) ?></p>
    <a class="btn" href="index.php?pagina=receitas">← Voltar</a>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
