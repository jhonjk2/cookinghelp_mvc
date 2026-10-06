<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Receitas</h1>
<p>Área pública: estas receitas são carregadas dinamicamente da base de dados.</p>
<form class="pesquisa" method="get">
    <input type="hidden" name="pagina" value="receitas">
    <input type="text" name="pesquisa" placeholder="Pesquisar receita ou categoria" value="<?= htmlspecialchars($pesquisa) ?>">
    <button>Pesquisar</button>
</form>
<div class="grid">
<?php foreach ($receitas as $r): ?>
    <article class="card">
        <?php if ($r['imagem']): ?><img src="imagem/<?= htmlspecialchars($r['imagem']) ?>" alt="<?= htmlspecialchars($r['titulo']) ?>"><?php endif; ?>
        <div class="card-body">
            <span class="categoria"><?= htmlspecialchars($r['categoria']) ?></span>
            <h2><?= htmlspecialchars($r['titulo']) ?></h2>
            <p><?= htmlspecialchars($r['tempo']) ?> · <?= htmlspecialchars($r['dificuldade']) ?></p>
            <a class="btn" href="index.php?pagina=receita&id=<?= $r['id'] ?>">Ver receita</a>
        </div>
    </article>
<?php endforeach; ?>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
