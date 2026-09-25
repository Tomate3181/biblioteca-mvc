<?php 
$isEdit = isset($livro) && $livro;
$pageTitle = $isEdit ? 'Editar Livro' : 'Novo Livro';
include __DIR__ . '/layout.php'; 
?>

<div class="breadcrumb">
    <a href="index.php">Livros</a> &raquo; <?php echo $pageTitle; ?>
</div>

<div class="card">
    <h2 style="margin-bottom: 20px; color: #6b4c9a;"><?php echo $pageTitle; ?></h2>
    
    <form method="POST" action="index.php?acao=salvar">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($livro['id']); ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($_POST['titulo'] ?? ($livro['titulo'] ?? '')); ?>" class="<?php echo isset($errors['titulo']) ? 'error-input' : ''; ?>">
            <?php if (isset($errors['titulo'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['titulo']); ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="autor">Autor *</label>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_POST['autor'] ?? ($livro['autor'] ?? '')); ?>" class="<?php echo isset($errors['autor']) ? 'error-input' : ''; ?>">
            <?php if (isset($errors['autor'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['autor']); ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="genero">Gênero</label>
            <select id="genero" name="genero">
                <option value="">Selecione...</option>
                <option value="Ficção" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Ficção') ? 'selected' : ''; ?>>Ficção</option>
                <option value="Não Ficção" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Não Ficção') ? 'selected' : ''; ?>>Não Ficção</option>
                <option value="Romance" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Romance') ? 'selected' : ''; ?>>Romance</option>
                <option value="Infantil" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Infantil') ? 'selected' : ''; ?>>Infantil</option>
                <option value="Didático" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Didático') ? 'selected' : ''; ?>>Didático</option>
                <option value="Biografia" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Biografia') ? 'selected' : ''; ?>>Biografia</option>
                <option value="História" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'História') ? 'selected' : ''; ?>>História</option>
                <option value="Ciências" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Ciências') ? 'selected' : ''; ?>>Ciências</option>
                <option value="Outros" <?php echo (($_POST['genero'] ?? ($livro['genero'] ?? '')) === 'Outros') ? 'selected' : ''; ?>>Outros</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação *</label>
            <input type="number" id="ano_publicacao" name="ano_publicacao" min="0" max="2026" value="<?php echo htmlspecialchars($_POST['ano_publicacao'] ?? ($livro['ano_publicacao'] ?? '')); ?>" class="<?php echo isset($errors['ano']) ? 'error-input' : ''; ?>">
            <?php if (isset($errors['ano'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['ano']); ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="quantidade">Quantidade de Exemplares *</label>
            <input type="number" id="quantidade" name="quantidade" min="0" value="<?php echo htmlspecialchars($_POST['quantidade'] ?? ($livro['quantidade'] ?? 1)); ?>" class="<?php echo isset($errors['quantidade']) ? 'error-input' : ''; ?>">
            <?php if (isset($errors['quantidade'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['quantidade']); ?></div>
            <?php endif; ?>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

</main>
</body>
</html>