<?php
require_once __DIR__ . '/../model/Receita.php';

class ReceitaController {
    private $receita;

    public function __construct() {
        $this->receita = new Receita();
    }

    public function index() {
        $pesquisa = $_GET['pesquisa'] ?? '';
        $receitas = $this->receita->listar($pesquisa);
        require __DIR__ . '/../view/publica/receitas.php';
    }

    public function ver($id) {
        $receita = $this->receita->procurar($id);
        if (!$receita) {
            die('Receita não encontrada.');
        }
        require __DIR__ . '/../view/publica/receita.php';
    }
}
?>
