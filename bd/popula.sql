INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `end_avatar`, `login_diario`, `niveldeacesso`) VALUES
(1, 'Túlio', 'tuliosjardim@gmail.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 1),
(2, 'xxxMatadorxxx', 'm1851780@nwytg.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(3, 'Zé Doidin', 'm184vg3780@nwytg.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(4, 'Tulinho Gueimes', 'vs6451780@ngftg.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(5, 'Marquin87', '9a45dsf0@nvntg.comm', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(6, 'jeeh.santos.56', 'h4321f@asty.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(7, '20matar70fugir', 'fg1vf@ahty.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(8, 'ocara12', 'b1g1f@efcb.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0),
(9, 'ocara13', 'av42vrf@asne.com', 'AD4C8D84FA26E440A290F58C8F4E4E8ECCC8D7FA', 'img/default.jpg', 0, 0);

INSERT INTO `raca` (`id`, `nome`) VALUES
(1, 'Hobbit'),
(2, 'Anão'),
(3, 'Elfo'),
(5, 'Orc'),
(6, 'Northman'),
(7, 'Maiar');

INSERT INTO `personagem` (`id`, `usuario_id`, `raca_id`, `nome`, `hp`, `mana`, `nivel`, `experiencia`, `forca`, `inteligencia`, `constituicao`, `pontos_de_atributo`, `ativo`) VALUES
(2, 1, 2, 'Threnor', 300, 100, 1, 35, 5, 5, 5, 0, -1),
(7, 1, 1, 'Crispus Baggins', 350, 130, 3, 19, 8, 5, 7, 5, 0),
(8, 1, 5, 'Acheropito', 350, 130, 3, 50, 10, 6, 9, 0, 1),
(9, 3, 2, 'Doido', 316, 129, 9, 217, 35, 15, 5, 0, 0),
(10, 2, 2, 'Nome', 278, 67, 4, 93, 10, 15, 5, 0, 1),
(11, 3, 7, 'Matador', 310, 105, 7, 198, 30, 5, 15, 0, 1);

INSERT INTO `inimigo` (`id`, `nome`, `hp_maximo`, `dano`, `mult_magico`, `mult_fisico`, `exp_concedida`) VALUES
(1, 'Draug', 125, 19, 1, 1, 33),
(2, 'Smeagle', 100, 15, 1, 1, 27),
(3, 'Kael', 150, 17, 1.2, 1.3, 33),
(4, 'Tiron da Selva Abrasada', 175, 15, 2, 1.2, 35),
(5, 'Assora o Destruidor ', 175, 23, 1, 1.2, 46),
(6, 'Rei Bruxo', 225, 29, 0.8, 1.7, 49),
(7, 'Aela a Precussora', 100, 35, 2, 2, 42),
(8, 'Vrim Martelo Esmagador', 100, 35, 1.4, 1.6, 47),
(9, 'Draktar', 200, 35, 1.5, 0.9, 52),
(10, 'Arquimedes Rei Mago', 200, 31, 0.9, 1.3, 57),
(11, 'Abalon da Caçada Selvagem', 250, 36, 1.4, 0.95, 71),
(12, 'Godim o Ogro', 300, 39, 1.35, 0.8, 73),
(13, 'Troll Selvagem', 280, 27, 1.4, 1.1, 68),
(14, 'Espírito da Escuridão', 300, 42, 2.1, 1.7, 79),
(15, 'Teth Arranca Ossos', 315, 38, 0.89, 1.4, 83),
(16, 'Anabel Olho Voraz', 425, 50, 1.8, 0.8, 95),
(17, 'Aurelien Lua', 425, 50, 0.8, 1.8, 95),
(18, 'Armin Menestral da Morte', 900, 50, 4, 4, 95),
(19, 'Atchim o Espirro', 900, 25, 1, 1, 95),
(20, 'Aranstin Deus da Perdição', 225, 50, 0.5, 0.5, 95),
(21, 'Urubu Faminto', 50, 10, 1, 1, 16),
(22, 'Libélula Mutante', 10, 15, 1, 1, 20),
(23, 'Smaug', 500, 75, 0.8, 0.8, 150),
(24, 'Goblin Lanceiro', 80, 16, 0.8, 1, 30);

INSERT INTO `habilidade` (`id`, `nome`, `custo`, `nivel_min`, `dano_base`, `dano_fisico`, `dano_magico`, `cura`, `raca_id`) VALUES
(1, 'Atirar pedra', 0, 0, 15, 0.6, 0.2, 0, NULL),
(2, 'Realocar ossos', 60, 0, 0, 0, 0, 15, NULL),
(3, 'Atacar por baixo', 0, 2, 10, 1.2, 0, 0, 1),
(4, 'Atirar pedras enfeitiçadas', 0, 0, 15, 0.1, 0.7, 0, NULL),
(5, 'Cura Ancestral', 15, 4, 0, 0, 1.75, 20, 3),
(6, 'Primeiros Socorros', 20, 3, 0, 0, 1.3, 20, 6),
(7, 'Cura Avançada', 25, 4, 0, 0, 1.6, 30, 7),
(8, 'Rugido de Batalha', 25, 4, 0, 0, 1, 25, 5),
(9, 'Benção do Anel de Sauron', 25, 3, 0, 0, 1.5, 20, 1),
(10, 'Estocada Luminosa', 20, 3, 20, 1.5, 0, 0, 3),
(11, 'Destruir Mentes', 15, 2, 15, 0, 1, 0, 7),
(12, 'Ataque com Presas', 10, 2, 15, 1, 0, 0, 5),
(13, 'Flecha Perfurante', 60, 6, 70, 1.5, 1, 0, 3),
(14, 'Sugar alma', 60, 6, 70, 0, 1.5, 20, 7);

INSERT INTO `cenario` (`id`, `nome`, `dificuldade`) VALUES
(1, 'Jardins de Rohan', 3),
(2, 'Acampamentos Haradrim', 46),
(3, 'Minas de Uglúk', 60),
(4, 'Cavernas de Smaug', 99),
(5, 'Rhovanion', 28),
(6, 'Entrada de Harad', 43),
(7, 'Templo de Mirkwood', 54),
(8, 'Subterrâneo das Minas de Uglúk', 61),
(9, 'Os AAAAA', 80),
(10, 'Fortaleza de Thangorodrim', 71);

INSERT INTO `inimigo_em_cenario` (`cenario_id`, `inimigo_id`, `probabilidade`) VALUES
(1, 1, 15),
(1, 2, 100),
(1, 21, 65),
(1, 22, 20),
(1, 24, 80),
(2, 5, 100),
(2, 7, 40),
(2, 8, 90),
(2, 9, 50),
(3, 11, 60),
(3, 12, 20),
(3, 13, 100),
(4, 23, 100),
(5, 1, 60),
(5, 3, 30),
(5, 4, 100),
(6, 4, 20),
(6, 5, 100),
(6, 7, 65),
(7, 6, 100),
(7, 9, 40),
(7, 10, 70),
(8, 12, 30),
(8, 14, 60),
(8, 15, 100),
(9, 16, 80),
(9, 17, 40),
(9, 18, 20),
(9, 19, 60),
(9, 20, 100),
(10, 6, 80),
(10, 14, 10),
(10, 15, 100),
(10, 18, 50),
(10, 19, 73),
(10, 20, 35);

INSERT INTO `versus` (`inimigo_id`, `usuario_id`, `hp_atual`) VALUES
(1, 1, 125),
(2, 1, 100),
(3, 1, 150),
(4, 1, 175),
(5, 1, 118),
(7, 1, 81),
(12, 1, 300),
(14, 1, 300),
(18, 1, 248),
(19, 1, 281),
(21, 1, 50),
(22, 1, 10),
(23, 1, 500);
