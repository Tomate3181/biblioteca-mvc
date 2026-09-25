<?php
/**
 * Ponto de entrada da aplicação (Front Controller).
 * Redireciona as ações para o LivroController.
 */

session_start();

require_once __DIR__ . '/controllers/LivroController.php';

$controller = new LivroController();

// Ação solicitada via query string (?acao=...)
$acao = $_GET['acao'] ?? 'index';

match ($acao) {
    'criar' => $controller->criar(),
    'salvar' => $controller->salvar(),
    'editar' => $controller->editar(),
    'atualizar' => $controller->atualizar(),
    'excluir' => $controller->excluir(),
    default => $controller->index(),
};
