<?php
require_once __DIR__ . '/../model/Utilizador.php';

class AuthController {
    private $utilizador;

    public function __construct() {
        $this->utilizador = new Utilizador();
    }

    public function login() {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->utilizador->procurarPorEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);

                $_SESSION['utilizador'] = [
                    'id' => $user['id'],
                    'nome' => $user['nome'],
                    'email' => $user['email'],
                    'tipo' => $user['tipo']
                ];

                // O mesmo formulário serve para utilizadores e administradores.
                if ($user['tipo'] === 'admin') {
                    header('Location: index.php?pagina=admin');
                } else {
                    header('Location: index.php?pagina=utilizador');
                }
                exit;
            }

            $erro = 'Email ou palavra-passe incorretos.';
        }

        require __DIR__ . '/../view/auth/login.php';
    }

    public function registar() {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($nome === '' || $email === '' || $password === '') {
                $erro = 'Preencha todos os campos.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro = 'Indique um email válido.';
            } elseif ($this->utilizador->procurarPorEmail($email)) {
                $erro = 'Este email já está registado.';
            } else {
                $this->utilizador->inserir($nome, $email, $password);
                header('Location: index.php?pagina=login');
                exit;
            }
        }

        require __DIR__ . '/../view/auth/registo.php';
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?pagina=receitas');
        exit;
    }
}
?>
