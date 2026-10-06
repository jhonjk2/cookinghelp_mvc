<?php
require_once __DIR__ . '/../model/Receita.php';
require_once __DIR__ . '/../model/Utilizador.php';

class AdminController {
    private $receita;
    private $utilizador;

    public function __construct() {
        $this->proteger();
        $this->receita = new Receita();
        $this->utilizador = new Utilizador();
    }

    private function proteger() {
        if (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['tipo'] !== 'admin') {
            header('Location: index.php?pagina=login');
            exit;
        }
    }

    public function index() {
        $receitas = $this->receita->listar();
        $utilizadores = $this->utilizador->listar();
        require __DIR__ . '/../view/admin/dashboard.php';
    }

    public function criar() {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagem = $this->guardarImagem();

            if ($imagem === false) {
                $erro = 'A imagem é inválida. Use JPG, JPEG, PNG ou WEBP até 3 MB.';
            } else {
                $this->receita->inserir([
                    ':titulo' => trim($_POST['titulo']),
                    ':categoria' => trim($_POST['categoria']),
                    ':ingredientes' => trim($_POST['ingredientes']),
                    ':preparacao' => trim($_POST['preparacao']),
                    ':tempo' => trim($_POST['tempo']),
                    ':dificuldade' => trim($_POST['dificuldade']),
                    ':imagem' => $imagem,
                    ':utilizador_id' => $_SESSION['utilizador']['id']
                ]);

                header('Location: index.php?pagina=admin');
                exit;
            }
        }

        $receita = null;
        require __DIR__ . '/../view/admin/formulario.php';
    }

    public function editar($id) {
        $receita = $this->receita->procurar($id);

        if (!$receita) {
            die('Receita não encontrada.');
        }

        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagem = $receita['imagem'];

            if (!empty($_FILES['imagem']['name'])) {
                $novaImagem = $this->guardarImagem();

                if ($novaImagem === false) {
                    $erro = 'A nova imagem é inválida. Use JPG, JPEG, PNG ou WEBP até 3 MB.';
                    require __DIR__ . '/../view/admin/formulario.php';
                    return;
                }

                $imagem = $novaImagem;
            }

            $this->receita->atualizar([
                ':titulo' => trim($_POST['titulo']),
                ':categoria' => trim($_POST['categoria']),
                ':ingredientes' => trim($_POST['ingredientes']),
                ':preparacao' => trim($_POST['preparacao']),
                ':tempo' => trim($_POST['tempo']),
                ':dificuldade' => trim($_POST['dificuldade']),
                ':imagem' => $imagem,
                ':id' => $id
            ]);

            header('Location: index.php?pagina=admin');
            exit;
        }

        require __DIR__ . '/../view/admin/formulario.php';
    }

    public function apagar($id) {
        $this->receita->apagar($id);
        header('Location: index.php?pagina=admin');
        exit;
    }

    public function apagarUtilizador($id) {
        // O administrador não pode apagar a própria conta por este botão.
        if ((int)$id === (int)$_SESSION['utilizador']['id']) {
            header('Location: index.php?pagina=admin');
            exit;
        }

        $this->utilizador->apagar($id);
        header('Location: index.php?pagina=admin');
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
