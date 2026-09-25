<?php include __DIR__ . '/layout.php'; ?>

<form class="search-form" method="GET" action="index.php">
    <input type="text" name="busca" placeholder="Buscar por título ou autor..." value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>">
    <button type="submit" class="btn btn-primary">Buscar</button>
    <?php if (isset($_GET['busca']) && $_GET['busca']): ?>
        <a href="index.php" class="btn btn-secondary">Limpar</a>
    <?php endif; ?>
</form>

<div class="card">
    <?php if (empty($livros)): ?>
        <div class="empty">
            <p>Nenhum livro encontrado.</p>
            <a href="index.php?acao=criar" class="btn btn-primary">Cadastrar primeiro livro</a>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Exemplares</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                    <td><?php echo htmlspecialchars($livro['genero']); ?></td>
                    <td><?php echo htmlspecialchars($livro['ano_publicacao']); ?></td>
                    <td>
                        <?php if ($livro['quantidade'] == 0): ?>
                            <span class="indisponivel">Indisponível</span>
                        <?php else: ?>
                            <span class="disponivel"><?php echo htmlspecialchars($livro['quantidade']); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="index.php?acao=editar&id=<?php echo $livro['id']; ?>" class="btn btn-secondary btn-small">Editar</a>
                        <a href="index.php?acao=excluir&id=<?php echo $livro['id']; ?>" class="btn btn-danger btn-small">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</main>
</body>
</html>