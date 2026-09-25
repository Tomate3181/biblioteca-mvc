<?php

require_once __DIR__ . '/../config/database.php';

/**
 * Model Livro — contém toda a lógica de validação e acesso a dados.
 * Todas as consultas usam PDO com prepared statements.
 */
class Livro
{
    // ─── Atributos ──────────────────────────────────────────────
    private ?int $id = null;
    private string $titulo = '';
    private string $autor = '';
    private string $genero = '';
    private int $ano = 0;
    private int $quantidade = 0;

    /** @var string[] Erros de validação acumulados */
    private array $erros = [];

    // ─── Getters / Setters ──────────────────────────────────────
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function getAutor(): string
    {
        return $this->autor;
    }
    public function getGenero(): string
    {
        return $this->genero;
    }
    public function getAno(): int
    {
        return $this->ano;
    }
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
    public function getErros(): array
    {
        return $this->erros;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function setTitulo(string $v): void
    {
        $this->titulo = trim($v);
    }
    public function setAutor(string $v): void
    {
        $this->autor = trim($v);
    }
    public function setGenero(string $v): void
    {
        $this->genero = trim($v);
    }
    public function setAno(int $v): void
    {
        $this->ano = $v;
    }
    public function setQuantidade(int $v): void
    {
        $this->quantidade = $v;
    }

    /**
     * Verifica se o livro está disponível (quantidade > 0).
     */
    public function estaDisponivel(): bool
    {
        return $this->quantidade > 0;
    }

    // ─── Validação (no Model, conforme requisito) ───────────────
    /**
     * Valida os dados do livro. Retorna true se válido, false caso contrário.
     * Os erros ficam em $this->erros.
     */
    public function validar(): bool
    {
        $this->erros = [];

        if ($this->titulo === '') {
            $this->erros[] = 'O título não pode ficar em branco.';
        }

        if ($this->autor === '') {
            $this->erros[] = 'O autor não pode ficar em branco.';
        }

        $anoAtual = (int) date('Y');
        if ($this->ano > $anoAtual) {
            $this->erros[] = "O ano não pode ser maior que {$anoAtual}.";
        }
        if ($this->ano < 0) {
            $this->erros[] = 'O ano não pode ser negativo.';
        }

        if ($this->quantidade < 0) {
            $this->erros[] = 'A quantidade de exemplares não pode ser negativa.';
        }

        return empty($this->erros);
    }

    // ─── CRUD — Prepared Statements ─────────────────────────────

    /**
     * Lista todos os livros ordenados pelo título.
     * @return array<array>
     */
    public static function listarTodos(): array
    {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT * FROM livros ORDER BY titulo ASC");
        return $stmt->fetchAll();
    }

    /**
     * Busca livros pelo título ou autor (LIKE).
     * @return array<array>
     */
    public static function buscar(string $termo): array
    {
        $pdo = getConnection();
        $sql = "SELECT * FROM livros WHERE titulo LIKE :termo1 OR autor LIKE :termo2 ORDER BY titulo ASC";
        $stmt = $pdo->prepare($sql);
        $like = '%' . $termo . '%';
        $stmt->execute([':termo1' => $like, ':termo2' => $like]);
        return $stmt->fetchAll();
    }

    /**
     * Busca um livro pelo ID.
     * @return array|false
     */
    public static function buscarPorId(int $id): array|false
    {
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Insere um novo livro no banco.
     */
    public function inserir(): bool
    {
        if (!$this->validar()) {
            return false;
        }

        $pdo = getConnection();
        $sql = "INSERT INTO livros (titulo, autor, genero, ano, quantidade)
                VALUES (:titulo, :autor, :genero, :ano, :quantidade)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $this->titulo,
            ':autor' => $this->autor,
            ':genero' => $this->genero,
            ':ano' => $this->ano,
            ':quantidade' => $this->quantidade,
        ]);
    }

    /**
     * Atualiza um livro existente.
     */
    public function atualizar(): bool
    {
        if (!$this->validar()) {
            return false;
        }

        $pdo = getConnection();
        $sql = "UPDATE livros
                SET titulo = :titulo, autor = :autor, genero = :genero,
                    ano = :ano, quantidade = :quantidade
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $this->titulo,
            ':autor' => $this->autor,
            ':genero' => $this->genero,
            ':ano' => $this->ano,
            ':quantidade' => $this->quantidade,
            ':id' => $this->id,
        ]);
    }

    /**
     * Exclui um livro pelo ID.
     */
    public static function excluir(int $id): bool
    {
        $pdo = getConnection();
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Conta o total de livros no acervo.
     */
    public static function contarTotal(): int
    {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM livros");
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }

    /**
     * Conta o total de exemplares disponíveis.
     */
    public static function contarExemplares(): int
    {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT COALESCE(SUM(quantidade), 0) AS total FROM livros");
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }

    /**
     * Conta quantos livros estão indisponíveis (quantidade = 0).
     */
    public static function contarIndisponiveis(): int
    {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM livros WHERE quantidade = 0");
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }
}
