<?php
require_once __DIR__ . '/../conexao/Conexao.php';

class Utilizador {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Conexao())->ligar();
    }

    public function procurarPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilizadores WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $email, $password, $tipo = 'utilizador') {
        $stmt = $this->pdo->prepare(
            "INSERT INTO utilizadores (nome, email, password, tipo)
             VALUES (:nome, :email, :password, :tipo)"
        );

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':tipo' => $tipo
        ]);
    }

    public function listar() {
        $stmt = $this->pdo->query(
            "SELECT id, nome, email, tipo FROM utilizadores ORDER BY id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function apagar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM utilizadores WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
