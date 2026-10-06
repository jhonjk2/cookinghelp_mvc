<?php
require_once __DIR__ . '/../conexao/Conexao.php';

class Receita {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Conexao())->ligar();
    }

    public function listar($pesquisa = '') {
        if ($pesquisa !== '') {
            $sql = "SELECT * FROM receitas
                    WHERE titulo LIKE :pesquisa OR categoria LIKE :pesquisa
                    ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':pesquisa' => '%' . $pesquisa . '%']);
        } else {
            $stmt = $this->pdo->query("SELECT * FROM receitas ORDER BY id DESC");
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function procurar($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM receitas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarPorUtilizador($utilizadorId) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM receitas WHERE utilizador_id = :utilizador_id ORDER BY id DESC"
        );
        $stmt->execute([':utilizador_id' => $utilizadorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir($dados) {
        $sql = "INSERT INTO receitas
                (titulo, categoria, ingredientes, preparacao, tempo, dificuldade, imagem, utilizador_id)
                VALUES (:titulo, :categoria, :ingredientes, :preparacao, :tempo, :dificuldade, :imagem, :utilizador_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    public function atualizar($dados) {
        $sql = "UPDATE receitas SET
                titulo = :titulo,
                categoria = :categoria,
                ingredientes = :ingredientes,
                preparacao = :preparacao,
                tempo = :tempo,
                dificuldade = :dificuldade,
                imagem = :imagem
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    public function apagar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM receitas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function apagarDoUtilizador($id, $utilizadorId) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM receitas
             WHERE id = :id AND utilizador_id = :utilizador_id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':utilizador_id' => $utilizadorId
        ]);
    }
}
?>
