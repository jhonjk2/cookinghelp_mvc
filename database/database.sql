CREATE DATABASE cooking_help; 

CREATE TABLE utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100) NOT NULL,
    email varchar(150) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    tipo ENUM('utilizador','admin') NOT NULL DEFAULT 'utilizador',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE receitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo varchar(150) NOT NULL,
    categoria varchar(100) NOT NULL,
    ingredientes TEXT NOT NULL,
    preparacao TEXT NOT NULL,
    tempo varchar(50) NOT NULL,
    dificuldade varchar(50) NOT NULL,
    imagem varchar(255) DEFAULT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO utilizadores (nome, email, password, tipo) VALUES
('Administrador', 'admin@cookinghelp.local', '$2y$12$I9rth.pa5u/nlZEzFwovM.ReRskAYpY7elKzDD38b/T/3W7sY2as.', 'admin');

INSERT INTO receitas (titulo, categoria, ingredientes, preparacao, tempo, dificuldade, imagem) VALUES
('Frango no forno', 'Almoço', 'Frango, alho, limão, azeite, sal e pimenta.', 'Temperar o frango. Levar ao forno até ficar dourado e bem cozinhado.', '50 min', 'Fácil', NULL),
('Massa com tomate', 'Jantar', 'Massa, tomate, alho, azeite e queijo.', 'Cozer a massa. Preparar o molho de tomate e misturar.', '25 min', 'Fácil', NULL),
('Bolo de chocolate', 'Sobremesa', 'Farinha, ovos, açúcar, chocolate e manteiga.', 'Misturar os ingredientes e levar ao forno até estar cozido.', '45 min', 'Média', NULL);
USE cooking_help;

ALTER TABLE receitas
    ADD COLUMN utilizador_id INT DEFAULT NULL AFTER imagem;

ALTER TABLE receitas
    ADD CONSTRAINT fk_receita_utilizador
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;
