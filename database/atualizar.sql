USE cooking_help;

ALTER TABLE receitas
    ADD COLUMN utilizador_id INT DEFAULT NULL AFTER imagem;

ALTER TABLE receitas
    ADD CONSTRAINT fk_receita_utilizador
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;
