<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Área do utilizador</h1>
<p>Olá, <?= htmlspecialchars($_SESSION['utilizador']['nome']) ?>. Aqui podes criar receitas e apagar as tuas próprias receitas.</p>

<a class="btn" href="index.php?pagina=utilizador_criar">+ Nova receita</a>

<h2>As minhas receitas</h2>
<?php if (!$receitas): ?>
    <div class="aviso">Ainda não criaste nenhuma receita.</div>
<?php else: ?>
<table>
<tr><th>Imagem</th><th>Título</th><th>Categoria</th><th>Ações</th></tr>
<?php foreach ($receitas as $r): ?>
<tr>
    <td>
        <?php if ($r['imagem']): ?>
            <img class="mini" src="imagem/<?= htmlspecialchars($r['imagem']) ?>" alt="<?= htmlspecialchars($r['titulo']) ?>">
        <?php else: ?>
            Sem imagem
        <?php endif; ?>
    </td>
    <td><?= htmlspecialchars($r['titulo']) ?></td>
    <td><?= htmlspecialchars($r['categoria']) ?></td>
    <td>
        <a href="index.php?pagina=receita&id=<?= $r['id'] ?>">Ver</a> |
        <a href="index.php?pagina=utilizador_apagar&id=<?= $r['id'] ?>" onclick="return confirm('Apagar a sua receita?')">Apagar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
