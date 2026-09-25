<?php include __DIR__ . '/layout.php'; ?>

<div class="breadcrumb">
    <a href="index.php">Livros</a> &raquo; Confirmar Exclusão
</div>

<div class="card">
    <div class="confirm-box">
        <h2 style="margin-bottom: 20px; color: #6b4c9a;">Confirmar Exclusão</h2>
        
        <?php if ($livro): ?>
            <p>Tem certeza que deseja excluir o livro "<strong><?php echo htmlspecialchars($livro['titulo']); ?></strong>"?</p>
            <p style="color: #c53030; font-size: 0.95rem;">Esta ação não pode ser desfeita.</p>
            
            <form method="POST" action="index.php?acao=confirmarExclusao">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($livro['id']); ?>">
                <div class="buttons">
                    <button type="submit" class="btn btn-danger">Sim, excluir</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        <?php else: ?>
            <p>Livro não encontrado.</p>
            <a href="index.php" class="btn btn-primary">Voltar</a>
        <?php endif; ?>
    </div>
</div>

</main>
</body>
</html>