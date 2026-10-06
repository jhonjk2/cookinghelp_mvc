<?php
require_once __DIR__ . '/../model/Receita.php';

class UtilizadorController {
    private $receita;

    public function __construct() {
        $this->proteger();
        $this->receita = new Receita();
    }

    private function proteger() {
        if (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['tipo'] !== 'utilizador') {
            header('Location: index.php?pagina=login');
            exit;
        }
    }

    public function index() {
        $utilizadorId = $_SESSION['utilizador']['id'];
        $receitas = $this->receita->listarPorUtilizador($utilizadorId);
        require __DIR__ . '/../view/utilizador/dashboard.php';
    }

    public function criar() {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagem = $this->guardarImagem();

            if ($imagem === false) {
                $erro = 'A imagem é inválida. Use JPG, JPEG, PNG ou WEBP até 3 MB.';
            } else {
                $this->receita->inserir([
                    ':titulo' => trim($_POST['titulo'] ?? ''),
                    ':categoria' => trim($_POST['categoria'] ?? ''),
                    ':ingredientes' => trim($_POST['ingredientes'] ?? ''),
                    ':preparacao' => trim($_POST['preparacao'] ?? ''),
                    ':tempo' => trim($_POST['tempo'] ?? ''),
                    ':dificuldade' => trim($_POST['dificuldade'] ?? 'Fácil'),
                    ':imagem' => $imagem,
                    ':utilizador_id' => $_SESSION['utilizador']['id']
                ]);

                header('Location: index.php?pagina=utilizador');
                exit;
            }
        }

        $receita = null;
        require __DIR__ . '/../view/utilizador/formulario.php';
    }

    public function apagar($id) {
        $this->receita->apagarDoUtilizador(
            $id,
            $_SESSION['utilizador']['id']
        );

        header('Location: index.php?pagina=utilizador');
        exit;
    }

    private function guardarImagem() {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if ($_FILES['imagem']['size'] > 3 * 1024 * 1024) {
            return false;
        }

        $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        if (!in_array($extensao, $permitidos, true)) {
            return false;
        }

        $nome = uniqid('receita_', true) . '.' . $extensao;
        $destino = __DIR__ . '/../imagem/' . $nome;

        return move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)
            ? $nome
            : false;
    }
}
?>
