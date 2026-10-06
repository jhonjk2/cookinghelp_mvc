<?php
session_start();

require_once __DIR__ . '/controller/ReceitaController.php';
require_once __DIR__ . '/controller/AuthController.php';
require_once __DIR__ . '/controller/AdminController.php';
require_once __DIR__ . '/controller/UtilizadorController.php';

$pagina = $_GET['pagina'] ?? 'receitas';

switch ($pagina) {
    case 'receitas':
        (new ReceitaController())->index();
        break;
    case 'receita':
        (new ReceitaController())->ver((int)($_GET['id'] ?? 0));
        break;
    case 'login':
        (new AuthController())->login();
        break;
    case 'registo':
        (new AuthController())->registar();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'admin':
        (new AdminController())->index();
        break;
    case 'utilizador':
        (new UtilizadorController())->index();
        break;
    case 'utilizador_criar':
        (new UtilizadorController())->criar();
        break;
    case 'utilizador_apagar':
        (new UtilizadorController())->apagar((int)($_GET['id'] ?? 0));
        break;
    case 'criar':
        (new AdminController())->criar();
        break;
    case 'editar':
        (new AdminController())->editar((int)($_GET['id'] ?? 0));
        break;
    case 'apagar':
        (new AdminController())->apagar((int)($_GET['id'] ?? 0));
        break;
    case 'apagar_utilizador':
        (new AdminController())->apagarUtilizador((int)($_GET['id'] ?? 0));
        break;
    default:
        header('Location: index.php?pagina=receitas');
        exit;
}
?>
