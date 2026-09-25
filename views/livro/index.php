<?php
/**
 * View: Listagem de livros (index).
 * Variáveis recebidas do Controller:
 *   $livros           — array de livros
 *   $busca            — termo de busca (ou '')
 *   $totalLivros      — int
 *   $totalExemplares  — int
 *   $totalIndisponiveis — int
 */
$pageTitle = 'Acervo';
require __DIR__ . '/../layout/header.php';
?>

<div class="container">

    <!-- ═══ HEADER DA PÁGINA (Nome da Biblioteca + Ação) ═══ -->
    <header class="page-header">
        <div class="page-header__left">
            <h1 class="page-header__title">
                <i class="fa-solid fa-book-journal-whills"></i> Biblioteca Arcana
            </h1>
            <p class="page-header__subtitle">Gerenciamento do Acervo Escolar</p>
        </div>
        <div class="page-header__right">
            <a href="index.php?acao=criar" class="btn btn--primary">
                <i class="fa-solid fa-plus"></i> Novo Livro
            </a>
        </div>
    </header>

    <!-- ═══ Flash Messages ═══ -->
    <?php if (!empty($_SESSION['mensagem'])): ?>
        <div class="alert alert--<?= $_SESSION['tipo_mensagem'] === 'sucesso' ? 'success' : 'error' ?>">
            <i
                class="fa-solid <?= $_SESSION['tipo_mensagem'] === 'sucesso' ? 'fa-circle-check' : 'fa-circle-exclamation' ?>"></i>
            <span><?= htmlspecialchars($_SESSION['mensagem']) ?></span>
            <button class="alert__close" aria-label="Fechar"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
    <?php endif; ?>

    <!-- ═══ Estatísticas ═══ -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-card__icon"><i class="fa-solid fa-book"></i></div>
            <div class="stat-card__value"><?= htmlspecialchars((string) $totalLivros) ?></div>
            <div class="stat-card__label">Títulos no Acervo</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div class="stat-card__value"><?= htmlspecialchars((string) $totalExemplares) ?></div>
            <div class="stat-card__label">Exemplares Totais</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon"><i class="fa-solid fa-lock"></i></div>
            <div class="stat-card__value"><?= htmlspecialchars((string) $totalIndisponiveis) ?></div>
            <div class="stat-card__label">Indisponíveis</div>
        </div>
    </div>

    <!-- ═══ Toolbar — Busca ═══ -->
    <div class="toolbar">
        <form class="search-form" action="index.php" method="GET" style="max-width: 100%;">
            <input type="text" name="busca" class="search-form__input" placeholder="Buscar por título ou autor…"
                value="<?= htmlspecialchars($busca) ?>" aria-label="Buscar livros">
            <button type="submit" class="search-form__btn" aria-label="Buscar"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- ═══ Resultado de Busca ═══ -->
    <?php if ($busca !== ''): ?>
        <div class="search-info">
            <span><i class="fa-solid fa-magnifying-glass"></i> <?= count($livros) ?> resultado(s) para
                "<strong><?= htmlspecialchars($busca) ?></strong>"</span>
            <a href="index.php"><i class="fa-solid fa-xmark"></i> Limpar busca</a>
        </div>
    <?php endif; ?>

    <!-- ═══ Grid de Livros ═══ -->
    <?php if (empty($livros)): ?>
        <div class="empty-state">
            <div class="empty-state__icon"><i class="fa-solid fa-book-open"></i></div>
            <h2 class="empty-state__title">
                <?= $busca !== '' ? 'Nenhum livro encontrado' : 'O acervo está vazio' ?>
            </h2>
            <p class="empty-state__text">
                <?= $busca !== ''
                    ? 'Tente buscar com outros termos.'
                    : 'Comece cadastrando o primeiro livro da biblioteca.'
                    ?>
            </p>
            <?php if ($busca === ''): ?>
                <a href="index.php?acao=criar" class="btn btn--primary"><i class="fa-solid fa-plus"></i> Cadastrar Primeiro
                    Livro</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="shelf-label">
            <i class="fa-solid fa-lines-leaning"></i> Estante — <?= count($livros) ?> título(s)
        </div>
        <div class="books-grid">
            <?php foreach ($livros as $livro): ?>
                <article class="book-card">
                    <div class="book-card__spine"></div>

                    <div class="book-card__header">
                        <h3 class="book-card__title"><?= htmlspecialchars($livro['titulo']) ?></h3>
                        <p class="book-card__author">por <?= htmlspecialchars($livro['autor']) ?></p>
                    </div>

                    <div class="book-card__details">
                        <?php if (!empty($livro['genero'])): ?>
                            <span class="book-card__tag book-card__tag--genre">
                                <i class="fa-solid fa-bookmark"></i> <?= htmlspecialchars($livro['genero']) ?>
                            </span>
                        <?php endif; ?>
                        <span class="book-card__tag">
                            <i class="fa-solid fa-calendar-days"></i> <?= htmlspecialchars((string) $livro['ano']) ?>
                        </span>
                        <span class="book-card__tag">
                            <i class="fa-solid fa-cubes-stacked"></i> <?= htmlspecialchars((string) $livro['quantidade']) ?> ex.
                        </span>

                        <?php if ((int) $livro['quantidade'] === 0): ?>
                            <span class="book-card__status book-card__status--unavailable">
                                <i class="fa-solid fa-ban"></i> Indisponível
                            </span>
                        <?php else: ?>
                            <span class="book-card__status book-card__status--available">
                                <i class="fa-solid fa-check"></i> Disponível
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="book-card__actions">
                        <a href="index.php?acao=editar&id=<?= (int) $livro['id'] ?>" class="btn btn--secondary btn--sm"
                            title="Editar livro">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <button class="btn btn--danger btn--sm"
                            onclick="confirmarExclusao(<?= (int) $livro['id'] ?>, '<?= htmlspecialchars(addslashes($livro['titulo']), ENT_QUOTES) ?>')"
                            title="Excluir livro">
                            <i class="fa-solid fa-trash-can"></i> Excluir
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>