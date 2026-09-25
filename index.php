<?php

require_once __DIR__ . '/controllers/LivroController.php';

$acao = $_GET['acao'] ?? 'index';
$controller = new LivroController();

switch ($acao) {
    case 'index':
        $controller->index();
        break;
    case 'criar':
        $controller->criar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    case 'confirmarExclusao':
        $controller->confirmarExclusao();
        break;
    default:
        $controller->index();
        break;
}