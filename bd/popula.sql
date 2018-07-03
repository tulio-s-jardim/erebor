INSERT INTO usuario(nome, email, senha, niveldeacesso) VALUES
('Túlio', 'tuliosjardim@gmail.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 1);

INSERT INTO raca(nome) VALUES
('Hobbit'),
('Anão'),
('Elfo'),
('Mago');

INSERT INTO personagem(usuario_id, raca_id, nome, ativo) VALUES 
(1, 1, 'Crispus Baggins', 1),
(1, 2, 'Threnor', -1),
(1, 4, 'Thelnen', 0);

INSERT INTO inimigo(nome, hp_maximo, dano, mult_magico, mult_fisico, exp_concedida) VALUES
('Draug', 150, 25, 1, 1, 20),
('Smeagle', 100, 15, 1, 1, 15),
('Kael', 150, 20, 1, 2, 8),
('Tiron da Selva Abrasada', 175, 25, 2, 1, 8),
('Assora o Destruidor ', 175, 25, 2, 1, 8),
('Rei Bruxo', 150, 25, 1, 2, 10),
('Aela a Precussora', 100, 35, 1, 3, 10),
('Vrim Martelo Esmagador', 100, 35, 1, 2, 8),
('Draktar', 200, 35, 1, 2, 10),
('Arquimedes Rei Mago', 200, 35, 2, 1, 15),
('Abalon da Caçada Selvagem', 250, 40, 1, 1, 15),
('Godim o Ogro', 250, 30, 1, 1, 17),
('Troll Selvagem', 150, 40, 1, 2, 20),
('Espírito da Escuridão', 200, 25, 2, 1, 17),
('Teth Arranca Ossos', 400, 45, 1, 1, 25),
('Anabel Olho Voraz', 400, 45, 1, 2, 25),
('Aurelien Lua', 350, 40, 2,1 , 25),
('Armin Menestral da Morte', 400, 50, 1, 1, 25),
('Atchim o Espirro', 300, 40, 2, 1, 25),
('Tanael Deus da Perdição', 450, 50, 1, 2, 30);

INSERT INTO habilidade(nome, custo, nivel_min, dano_base, dano_fisico, dano_magico, cura, raca_id) VALUES
('Atirar pedra', 0, 0, 15, 0.6, 0.2, 0, NULL),
('Realocar ossos', 60, 0, 0, 0, 0, 30, NULL),
('Atacar por baixo', 0, 0, 10, 1, 0, 0, 1),
('Atirar pedras enfeitiçadas', 0, 0, 15, 0.1, 0.7, 0, NULL);

INSERT INTO cenario(nome, dificuldade) VALUES
('Jardins de Rohan', 3),
('Acampamentos Haradrim', 32),
('Minas de Uglúk', 57),
('Cavernas de Smaug', 99);

INSERT INTO inimigo_em_cenario(cenario_id, inimigo_id, probabilidade) VALUES
(1, 1, 50),
(1, 2, 100),
(1, 3, 10),
(1, 4, 5),
(2, 4, 50),
(2, 5, 100),
(2, 6, 10),
(2, 7, 40),
(2, 8, 80),
(2, 9, 60),
(2, 10, 5),
(3, 10, 50),
(3, 11, 100),
(3, 12, 10),
(3, 13, 40),
(3, 14, 85),
(3, 15, 60),
(4, 16, 5),
(4, 17, 50),
(4, 18, 80),
(4, 19, 30),
(4, 20, 100),
(4, 11, 60);
