<?php
/**
 * View: Formulário de edição de livro.
 * Variáveis recebidas do Controller:
 *   $livro — dados do livro (array do BD)
 *   $erros — array de mensagens de erro (validação)
 *   $dados — array com os dados (repopulação ou BD)
 */
$pageTitle = 'Editar Livro';
require __DIR__ . '/../layout/header.php';
?>

<div class="container">

    <!-- ═══ HEADER DA PÁGINA (Título + Ação) ═══ -->
    <header class="page-header">
        <div class="page-header__left">
            <h1 class="page-header__title">
                <i class="fa-solid fa-pen-nib"></i> Editar Livro
            </h1>
            <p class="page-header__subtitle">Atualizar informações do livro no acervo</p>
        </div>
        <div class="page-header__right">
            <a href="index.php" class="btn btn--secondary">
                <i class="fa-solid fa-arrow-left"></i> Voltar ao Acervo
            </a>
        </div>
    </header>

    <div class="form-page">

        <!-- Erros de Validação -->
        <?php if (!empty($erros)): ?>
            <div class="alert alert--error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <ul class="errors-list">
                    <?php foreach ($erros as $erro): ?>
                        <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button class="alert__close" aria-label="Fechar"><i class="fa-solid fa-xmark"></i></button>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <h2 class="form-card__title"><i class="fa-solid fa-pen-to-square"></i> Editar Livro</h2>
            <p class="form-card__subtitle">Atualize as informações de
                "<strong><?= htmlspecialchars($livro['titulo']) ?></strong>"</p>

            <form action="index.php?acao=atualizar" method="POST">
                <input type="hidden" name="id" value="<?= (int) $livro['id'] ?>">

                <div class="form-group">
                    <label for="titulo">Título <span class="required">*</span></label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ex: Dom Casmurro"
                        value="<?= htmlspecialchars($dados['titulo'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="autor">Autor <span class="required">*</span></label>
                    <input type="text" id="autor" name="autor" class="form-control" placeholder="Ex: Machado de Assis"
                        value="<?= htmlspecialchars($dados['autor'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="genero">Gênero</label>
                    <input type="text" id="genero" name="genero" class="form-control"
                        placeholder="Ex: Romance, Ficção Científica, Poesia…"
                        value="<?= htmlspecialchars($dados['genero'] ?? '') ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ano">Ano de Publicação <span class="required">*</span></label>
                        <input type="number" id="ano" name="ano" class="form-control" placeholder="Ex: 1899" min="0"
                            max="<?= date('Y') ?>" value="<?= htmlspecialchars($dados['ano'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">Exemplares <span class="required">*</span></label>
                        <input type="number" id="quantidade" name="quantidade" class="form-control" placeholder="Ex: 3"
                            min="0" value="<?= htmlspecialchars($dados['quantidade'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn--secondary"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                    <button type="submit" class="btn btn--primary"><i class="fa-solid fa-floppy-disk"></i> Salvar
                        Alterações</button>
                </div>

            </form>
        </div>

    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>