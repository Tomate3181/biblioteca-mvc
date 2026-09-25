<?php

require_once __DIR__ . '/../models/Livro.php';

class LivroController {

    public function index() {
        $busca = $_GET['busca'] ?? '';
        if ($busca) {
            $livros = Livro::buscar($busca);
        } else {
            $livros = Livro::listarTodos();
        }
        include __DIR__ . '/../views/livro/index.php';
    }

    public function criar() {
        include __DIR__ . '/../views/livro/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $livro = null;
        
        if ($id) {
            $livro = Livro::buscarPorId($id);
        }
        
        include __DIR__ . '/../views/livro/form.php';
    }

    public function salvar() {
        $livro = new Livro();
        
        if (!empty($_POST['id'])) {
            $livro->setId($_POST['id']);
        }
        
        $livro->setTitulo($_POST['titulo'] ?? '');
        $livro->setAutor($_POST['autor'] ?? '');
        $livro->setGenero($_POST['genero'] ?? '');
        $livro->setAnoPublicacao((int) ($_POST['ano_publicacao'] ?? 0));
        $livro->setQuantidade((int) ($_POST['quantidade'] ?? 0));

        if ($livro->validar()) {
            $livro->salvar();
            header('Location: index.php');
            exit;
        }

        $errors = $livro->getErrors();
        include __DIR__ . '/../views/livro/form.php';
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        $livro = null;
        
        if ($id) {
            $livro = Livro::buscarPorId($id);
        }
        
        include __DIR__ . '/../views/livro/confirmar_exclusao.php';
    }

    public function confirmarExclusao() {
        $id = $_POST['id'] ?? null;
        
        if ($id) {
            Livro::excluir($id);
        }
        
        header('Location: index.php');
        exit;
    }
}