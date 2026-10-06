# Cooking Help — PHP MVC Simples

Projeto para demonstrar HTML, CSS, PHP, POO, MVC e MySQL.

## Estrutura
- `controller/` — controla as ações da aplicação.
- `model/` — comunica com a base de dados e trata os dados.
- `view/` — HTML apresentado ao utilizador.
- `conexao/` — ligação PDO ao MySQL.
- `imagem/` — imagens carregadas das receitas.
- `css/` — estilos CSS.
- `database/` — script SQL.
- `index.php` — ponto de entrada e encaminhamento simples.

## Áreas
### Pública
Qualquer visitante pode consultar e pesquisar receitas.

### Utilizador
Depois de criar conta e fazer login, o utilizador pode criar receitas, adicionar imagens e apagar apenas as suas próprias receitas.

### Administrador
O mesmo formulário de login é usado para administrador. O sistema identifica o tipo de conta pela coluna `tipo` da tabela `utilizadores`.

O administrador pode inserir, listar, alterar e apagar receitas, além de listar e apagar utilizadores, exceto a própria conta.

## Administrador
Email: `admin@cookinghelp.local`
Password: `admin123`


