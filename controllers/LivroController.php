<?php

require_once __DIR__ . '/../models/Livro.php';

/**
 * Controller de Livros — recebe as ações da rota e coordena Model ↔ View.
 */
class LivroController
{
    /**
     * Lista todos os livros (com suporte a busca).
     */
    public function index(): void
    {
        $busca = trim($_GET['busca'] ?? '');

        if ($busca !== '') {
            $livros = Livro::buscar($busca);
        } else {
            $livros = Livro::listarTodos();
        }

        // Estatísticas para o painel
        $totalLivros = Livro::contarTotal();
        $totalExemplares = Livro::contarExemplares();
        $totalIndisponiveis = Livro::contarIndisponiveis();

        require __DIR__ . '/../views/livro/index.php';
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function criar(): void
    {
        $erros = $_SESSION['erros'] ?? [];
        $dados = $_SESSION['dados'] ?? [];
        unset($_SESSION['erros'], $_SESSION['dados']);

        require __DIR__ . '/../views/livro/criar.php';
    }

    /**
     * Processa o cadastro de um novo livro.
     */
    public function salvar(): void
    {
        $livro = new Livro();
        $livro->setTitulo($_POST['titulo'] ?? '');
        $livro->setAutor($_POST['autor'] ?? '');
        $livro->setGenero($_POST['genero'] ?? '');
        $livro->setAno((int) ($_POST['ano'] ?? 0));
        $livro->setQuantidade((int) ($_POST['quantidade'] ?? 0));

        if ($livro->inserir()) {
            $_SESSION['mensagem'] = 'Livro cadastrado com sucesso!';
            $_SESSION['tipo_mensagem'] = 'sucesso';
            header('Location: index.php');
        } else {
            $_SESSION['erros'] = $livro->getErros();
            $_SESSION['dados'] = $_POST;
            header('Location: index.php?acao=criar');
        }
        exit;
    }

    /**
     * Exibe o formulário de edição.
     */
    public function editar(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $livro = Livro::buscarPorId($id);

        if (!$livro) {
            $_SESSION['mensagem'] = 'Livro não encontrado.';
            $_SESSION['tipo_mensagem'] = 'erro';
            header('Location: index.php');
            exit;
        }

        $erros = $_SESSION['erros'] ?? [];
        $dados = $_SESSION['dados'] ?? $livro;
        unset($_SESSION['erros'], $_SESSION['dados']);

        require __DIR__ . '/../views/livro/editar.php';
    }

    /**
     * Processa a atualização de um livro.
     */
    public function atualizar(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        $livro = new Livro();
        $livro->setId($id);
        $livro->setTitulo($_POST['titulo'] ?? '');
        $livro->setAutor($_POST['autor'] ?? '');
        $livro->setGenero($_POST['genero'] ?? '');
        $livro->setAno((int) ($_POST['ano'] ?? 0));
        $livro->setQuantidade((int) ($_POST['quantidade'] ?? 0));

        if ($livro->atualizar()) {
            $_SESSION['mensagem'] = 'Livro atualizado com sucesso!';
            $_SESSION['tipo_mensagem'] = 'sucesso';
            header('Location: index.php');
        } else {
            $_SESSION['erros'] = $livro->getErros();
            $_SESSION['dados'] = $_POST;
            header('Location: index.php?acao=editar&id=' . $id);
        }
        exit;
    }

    /**
     * Exclui um livro (a confirmação é feita via JS no front-end).
     */
    public function excluir(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0 && Livro::excluir($id)) {
            $_SESSION['mensagem'] = 'Livro excluído com sucesso!';
            $_SESSION['tipo_mensagem'] = 'sucesso';
        } else {
            $_SESSION['mensagem'] = 'Erro ao excluir o livro.';
            $_SESSION['tipo_mensagem'] = 'erro';
        }

        header('Location: index.php');
        exit;
    }
}
