<?php
class Conexao {
    private $host = 'localhost';
    private $db = 'cooking_help';
    private $utilizador = 'root';
    private $password = '';
    public $pdo;

    public function ligar() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->utilizador,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die('Erro na ligação à base de dados: ' . $e->getMessage());
        }
    }
}
?>
