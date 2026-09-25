<?php
/**
 * Layout base — cabeçalho e início do HTML.
 * Variáveis esperadas: $pageTitle (opcional)
 */
$pageTitle = $pageTitle ?? 'Biblioteca Arcana';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gerenciamento do acervo da biblioteca escolar — cadastro, edição, busca e controle de livros.">
    <title><?= htmlspecialchars($pageTitle) ?> — Biblioteca Arcana</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar Fixa / Topo -->
<header class="navbar">
    <div class="navbar__container">
        <a href="index.php" class="navbar__brand">
            <i class="fa-solid fa-book-bookmark navbar__brand-icon"></i>
            <span>Biblioteca Arcana</span>
        </a>

        <nav class="navbar__nav">
            <a href="index.php" class="navbar__link <?= (!isset($_GET['acao']) || $_GET['acao'] === 'index') ? 'navbar__link--active' : '' ?>">
                <i class="fa-solid fa-layer-group"></i> Acervo
            </a>
            <a href="index.php?acao=criar" class="navbar__btn">
                <i class="fa-solid fa-plus"></i> Novo Livro
            </a>
        </nav>
    </div>
</header>

<!-- Partículas decorativas -->
<div class="particles" aria-hidden="true">
    <?php for ($i = 0; $i < 20; $i++): ?>
        <div class="particle" style="
            left: <?= rand(0, 100) ?>%;
            --duration: <?= rand(12, 25) ?>s;
            --delay: <?= rand(0, 15) ?>s;
            width: <?= rand(2, 5) ?>px;
            height: <?= rand(2, 5) ?>px;
            opacity: 0.<?= rand(2, 6) ?>;
        "></div>
    <?php endfor; ?>
</div>
