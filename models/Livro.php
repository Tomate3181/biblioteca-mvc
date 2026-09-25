<?php

require_once __DIR__ . '/../config/Database.php';

class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $genero;
    private $ano_publicacao;
    private $quantidade;
    private $errors = [];

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getGenero() { return $this->genero; }
    public function getAnoPublicacao() { return $this->ano_publicacao; }
    public function getQuantidade() { return $this->quantidade; }
    public function getErrors() { return $this->errors; }

    public function setId($id) { $this->id = $id; }
    public function setTitulo($titulo) { $this->titulo = trim($titulo); }
    public function setAutor($autor) { $this->autor = trim($autor); }
    public function setGenero($genero) { $this->genero = trim($genero); }
    public function setAnoPublicacao($ano) { $this->ano_publicacao = $ano; }
    public function setQuantidade($qtd) { $this->quantidade = $qtd; }

    public function validar() {
        $this->errors = [];
        $anoAtual = date('Y');

        if (empty($this->titulo)) {
            $this->errors['titulo'] = 'O título é obrigatório.';
        }

        if (empty($this->autor)) {
            $this->errors['autor'] = 'O autor é obrigatório.';
        }

        if ($this->ano_publicacao > $anoAtual) {
            $this->errors['ano'] = "O ano não pode ser maior que $anoAtual.";
        }

        if ($this->quantidade < 0) {
            $this->errors['quantidade'] = 'A quantidade não pode ser negativa.';
        }

        return empty($this->errors);
    }

    public static function listarTodos() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM livros ORDER BY titulo ASC");
        return $stmt->fetchAll();
    }

    public static function buscarPorId($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM livros WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function buscar($termo) {
        $conn = Database::getConnection();
        $termo = "%$termo%";
        $stmt = $conn->prepare("SELECT * FROM livros WHERE titulo LIKE :termo OR autor LIKE :termo ORDER BY titulo ASC");
        $stmt->execute(['termo' => $termo]);
        return $stmt->fetchAll();
    }

    public function salvar() {
        if (!$this->validar()) {
            return false;
        }

        $conn = Database::getConnection();

        if ($this->id) {
            $stmt = $conn->prepare("UPDATE livros SET titulo = :titulo, autor = :autor, genero = :genero, ano_publicacao = :ano, quantidade = :quantidade WHERE id = :id");
            return $stmt->execute([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'genero' => $this->genero,
                'ano' => $this->ano_publicacao,
                'quantidade' => $this->quantidade,
                'id' => $this->id
            ]);
        } else {
            $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, genero, ano_publicacao, quantidade) VALUES (:titulo, :autor, :genero, :ano, :quantidade)");
            return $stmt->execute([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'genero' => $this->genero,
                'ano' => $this->ano_publicacao,
                'quantidade' => $this->quantidade
            ]);
        }
    }

    public static function excluir($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM livros WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}