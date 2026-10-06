<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Dashboard do Administrador</h1>
<p>Olá, <?= htmlspecialchars($_SESSION['utilizador']['nome']) ?>. Aqui pode Gerir as receitas e os utilizadores.</p>

<a class="btn" href="index.php?pagina=criar">+ Nova receita</a>

<h2>Receitas</h2>
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
        <a href="index.php?pagina=editar&id=<?= $r['id'] ?>">Alterar</a> |
        <a href="index.php?pagina=apagar&id=<?= $r['id'] ?>" onclick="return confirm('Apagar esta receita?')">Apagar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>Utilizadores</h2>
<table>
<tr><th>ID</th><th>Nome</th><th>Email</th><th>Tipo</th><th>Ações</th></tr>
<?php foreach ($utilizadores as $u): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['nome']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= htmlspecialchars($u['tipo']) ?></td>
    <td>
        <?php if ((int)$u['id'] !== (int)$_SESSION['utilizador']['id']): ?>
            <a href="index.php?pagina=apagar_utilizador&id=<?= $u['id'] ?>" onclick="return confirm('Apagar este utilizador?')">Apagar</a>
        <?php else: ?>
            Conta atual
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
