-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 04 jan. 2022 à 07:41
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cooking_time`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `IdCategorie` int(11) NOT NULL,
  `NomCategorie` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`IdCategorie`, `NomCategorie`) VALUES
(1, 'plat'),
(2, 'entrée'),
(3, 'dessert'),
(4, 'chaud'),
(5, 'froid'),
(6, 'végétarien'),
(7, 'sans gluten'),
(8, 'healthy'),
(9, 'frais'),
(10, 'grande quantité'),
(11, 'noël');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_recette`
--

CREATE TABLE `categorie_recette` (
  `IdCategorie` int(11) NOT NULL,
  `IdRecette` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_recette`
--

INSERT INTO `categorie_recette` (`IdCategorie`, `IdRecette`) VALUES
(1, 4),
(1, 3),
(3, 1),
(3, 2),
(6, 89),
(1, 90);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `IdCommentaire` int(11) NOT NULL,
  `TexteCommentaire` text NOT NULL,
  `DateCommentaire` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`IdCommentaire`, `TexteCommentaire`, `DateCommentaire`) VALUES
(1, 'Test', '2021-12-31'),
(4, 'test1', '2022-01-03'),
(5, 't\'abuse c\'est de la merde ta recette', '2022-01-03'),
(6, 'eclaté', '2022-01-03'),
(7, 'wsh', '2022-01-03'),
(8, 'salut les reuf', '2022-01-03'),
(9, 'non', '2022-01-03'),
(10, 'ca marche ', '2022-01-03'),
(11, 'ptn', '2022-01-03');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_recette`
--

CREATE TABLE `commentaire_recette` (
  `IdCommentaire` int(11) NOT NULL,
  `IdRecette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire_recette`
--

INSERT INTO `commentaire_recette` (`IdCommentaire`, `IdRecette`) VALUES
(1, 1),
(4, 3),
(5, 3),
(6, 3),
(7, 90),
(8, 90),
(9, 2),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_utilisateur`
--

CREATE TABLE `commentaire_utilisateur` (
  `IdCommentaire` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire_utilisateur`
--

INSERT INTO `commentaire_utilisateur` (`IdCommentaire`, `IdUtilisateur`) VALUES
(1, 1),
(4, 6),
(5, 6),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `IdIngredient` int(11) NOT NULL,
  `NomIngredient` varchar(20) NOT NULL,
  `TypeIngredient` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`IdIngredient`, `NomIngredient`, `TypeIngredient`) VALUES
(1, 'basilic', 'herbe'),
(2, 'romarin', 'herbe'),
(3, 'estragon', 'herbe'),
(4, 'coriandre', 'herbe'),
(5, 'menthe', 'herbe'),
(6, 'ciboulette', 'herbe'),
(7, 'aneth', 'herbe'),
(8, 'thyn', 'herbe'),
(9, 'persil', 'herbe'),
(10, 'origan', 'herbe'),
(11, 'laurier', 'herbe'),
(12, 'sauge', 'herbe'),
(13, 'sariette', 'herbe'),
(14, 'boeuf', 'viande'),
(15, 'langue de boeuf', 'viande'),
(16, 'mouton', 'viande'),
(17, 'agneau', 'viande'),
(18, 'cheval', 'viande'),
(19, 'porc', 'viande'),
(20, 'jambon', 'viande'),
(21, 'lapin', 'viande'),
(22, 'dinde', 'viande'),
(23, 'caille', 'viande'),
(24, 'canard', 'viande'),
(25, 'chevreuil', 'viande'),
(26, 'pintade', 'viande'),
(27, 'poulet', 'viande'),
(28, 'sanglier', 'viande'),
(29, 'veau', 'viande'),
(30, 'steak haché', 'viande'),
(31, 'cochon de lait', 'viande'),
(32, 'cuisse de grenouille', 'viande'),
(33, 'diots', 'viande'),
(34, 'épaule d\'agneau', 'viande'),
(35, 'faon', 'viande'),
(36, 'filet mignon de porc', 'viande'),
(37, 'foie de veau', 'viande'),
(38, 'foie de volaille', 'viande'),
(39, 'foie gras', 'viande'),
(40, 'gésier', 'viande'),
(41, 'lièvre', 'viande'),
(42, 'saucisse', 'viande'),
(43, 'magret de canard', 'viande'),
(44, 'merguez', 'viande'),
(45, 'pavé de cerf', 'viande'),
(46, 'rognon de veau', 'viande'),
(47, 'rôtit de biche', 'viande'),
(48, 'rôtit de cerf', 'viande'),
(49, 'rôti de dinde', 'viande'),
(50, 'saindoux', 'viande'),
(51, 'sanglier', 'viande'),
(52, 'taureau', 'viande'),
(53, 'tête de veau', 'viande'),
(54, 'tripes', 'viande'),
(55, 'veau', 'viande'),
(56, 'viande de grison', 'viande'),
(57, 'jambon de pays', 'viande'),
(58, 'anchois', 'poisson'),
(59, 'bar', 'poisson'),
(60, 'cabillaud', 'poisson'),
(61, 'congre', 'poisson'),
(62, 'dorade', 'poisson'),
(63, 'églefin', 'poisson'),
(64, 'éperlan', 'poisson'),
(65, 'hareng', 'poisson'),
(66, 'lieu', 'poisson'),
(67, 'lotte', 'poisson'),
(68, 'maquereau', 'poisson'),
(69, 'merlan', 'poisson'),
(70, 'colin', 'poisson'),
(71, 'mulet', 'poisson'),
(72, 'raie', 'poisson'),
(73, 'saint-pierre', 'poisson'),
(74, 'sardine', 'poisson'),
(75, 'saumon', 'poisson'),
(76, 'sole', 'poisson'),
(77, 'colin', 'poisson'),
(78, 'thon', 'poisson'),
(79, 'turbot', 'poisson'),
(80, 'requin', 'poisson'),
(81, 'ail', 'légume'),
(82, 'artichaut', 'légume'),
(83, 'asperge', 'légume'),
(84, 'aubergine', 'légume'),
(85, 'avocat', 'légume'),
(86, 'bette', 'légume'),
(87, 'bettrave', 'légume'),
(88, 'brocoli', 'légume'),
(89, 'carotte', 'légume'),
(90, 'catalonia', 'légume'),
(91, 'céleri', 'légume'),
(92, 'champignon', 'légume'),
(93, 'chou-fleur', 'légume'),
(94, 'choux', 'légume'),
(95, 'citrouille', 'légume'),
(96, 'concombre', 'légume'),
(97, 'courge', 'légume'),
(98, 'courgette', 'légume'),
(99, 'cresson', 'légume'),
(100, 'crosne', 'légume'),
(101, 'échalote', 'légume'),
(102, 'endive', 'légume'),
(103, 'épinard', 'légume'),
(104, 'fenouil', 'légume'),
(105, 'fève', 'légume'),
(106, 'flageolet', 'légume'),
(107, 'haricot', 'légume'),
(108, 'laitue', 'légume'),
(109, 'lentille', 'légume'),
(110, 'mâche', 'légume'),
(111, 'maïs', 'légume'),
(112, 'ail', 'légume'),
(113, 'manioc', 'légume'),
(114, 'navet', 'légume'),
(115, 'oignon', 'légume'),
(116, 'olive', 'légume'),
(117, 'oseille', 'légume'),
(118, 'patate', 'légume'),
(119, 'petit pois', 'légume'),
(120, 'poireau', 'légume'),
(121, 'poivron', 'légume'),
(122, 'pomme de terre', 'légume'),
(123, 'potimarron', 'légume'),
(124, 'potiron', 'légume'),
(125, 'radis', 'légume'),
(126, 'rhubarbe', 'légume'),
(127, 'salade', 'légume'),
(128, 'salsifi', 'légume'),
(129, 'tomate', 'légume'),
(130, 'rhum', 'alcool'),
(131, 'cognac', 'alcool'),
(132, 'vodka', 'alcool'),
(133, 'whisky', 'alcool'),
(134, 'pastis', 'alcool'),
(135, 'kirsch', 'alcool'),
(136, 'calvados', 'alcool'),
(137, 'bière', 'alcool'),
(138, 'gin', 'alcool'),
(139, 'tequila', 'alcool'),
(140, 'vin rouge', 'alcool'),
(141, 'vin blanc', 'alcool'),
(142, 'champagne', 'alcool'),
(143, 'chocolat noir', 'chocolat'),
(144, 'chocolat blanc', 'chocolat'),
(145, 'chocolat au lait', 'chocolat'),
(146, 'pâtes', 'pâtes'),
(147, 'spaghetti', 'pâtes'),
(148, 'avoine', 'céréales'),
(149, 'blé', 'céréales'),
(150, 'céréales', 'céréales'),
(151, 'épeautre', 'céréales'),
(152, 'farine', 'céréales'),
(153, 'flocons d\'avoine', 'céréales'),
(154, 'graines de chia', 'céréales'),
(156, 'levain', 'céréales'),
(157, 'maïzena', 'céréales'),
(158, 'millet', 'céréales'),
(159, 'muesli', 'céréales'),
(160, 'orge', 'céréales'),
(161, 'sarrasin', 'céréales'),
(162, 'seigle', 'céréales'),
(163, 'sésame', 'céréales'),
(164, 'son d\'avoine', 'céréales'),
(165, 'sorgho', 'céréales'),
(155, 'froment', 'céréales'),
(166, 'biscottes', 'féculent'),
(167, 'boulghour', 'féculent'),
(168, 'chapelure', 'féculent'),
(169, 'chips', 'féculent'),
(170, 'crozet', 'féculent'),
(171, 'feuille de riz', 'féculent'),
(172, 'galette de riz', 'féculent'),
(173, 'gnocchi', 'féculent'),
(174, 'pain', 'féculent'),
(175, 'patate douce', 'féculent'),
(176, 'polenta', 'féculent'),
(177, 'quinoa', 'féculent'),
(178, 'ravioles', 'féculent'),
(179, 'riz', 'féculent'),
(180, 'semoule', 'féculent'),
(181, 'tapioca', 'féculent'),
(182, 'vermicelle', 'féculent'),
(183, 'arachide', 'légumineuse'),
(184, 'cacahuète', 'légumineuse'),
(185, 'fève', 'légumineuse'),
(186, 'flageolet', 'légumineuse'),
(187, 'haricot blanc', 'légumineuse'),
(188, 'haricot coco', 'légumineuse'),
(189, 'harcot mungo', 'légumineuse'),
(190, 'haricot rouge', 'légumineuse'),
(191, 'lentille', 'légumineuse'),
(192, 'petit pois', 'légumineuse'),
(193, 'pois cassés', 'légumineuse'),
(194, 'pois gourmand', 'légumineuse'),
(195, 'pois chiche', 'légumineuse'),
(196, 'soja', 'légumineuse'),
(197, 'lait en poudre', 'produits laitier'),
(198, 'lait demi-écrémé', 'produits laitier'),
(199, 'lait entier', 'produits laitier'),
(200, 'lait écrémé', 'produits laitier'),
(201, 'lait concentré', 'produits laitier'),
(202, 'lait fermenté', 'produits laitier'),
(203, 'crème', 'produits laitier'),
(204, 'beurre', 'produits laitier'),
(205, 'yaourts', 'produits laitier'),
(206, 'fromage', 'produits laitier'),
(207, 'caséine', 'produits laitier'),
(208, 'chantilly', 'produits laitier'),
(209, 'mascarpone', 'produits laitier'),
(210, 'sucre', 'sucrer'),
(211, 'cacao', 'chocolat');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_recette`
--

CREATE TABLE `ingredient_recette` (
  `IdIngredient` int(11) NOT NULL,
  `IdRecette` int(11) NOT NULL,
  `QteIngredient` double NOT NULL,
  `UniteIngredient` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient_recette`
--

INSERT INTO `ingredient_recette` (`IdIngredient`, `IdRecette`, `QteIngredient`, `UniteIngredient`) VALUES
(1, 86, 23, 'grammes'),
(1, 83, 23, 'ij'),
(1, 82, 12, '34'),
(1, 81, 23, 'hg'),
(1, 80, 34, 'rt'),
(3, 79, 23, 'trf'),
(2, 79, 34, 'tg'),
(3, 1, 12, 'rt'),
(2, 1, 45, 'fr'),
(1, 1, 23, 'gt'),
(2, 1, 35, 'tg'),
(10, 86, 35, 'grammes'),
(1, 89, 34, 'grammes'),
(120, 89, 2, 'unités'),
(44, 90, 2, 'unité'),
(122, 90, 200, 'grammes');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `IdRecette` int(11) NOT NULL,
  `TitreRecette` varchar(200) NOT NULL,
  `DescriptionRecette` text NOT NULL,
  `TempsRecette` float NOT NULL,
  `DateRecette` date NOT NULL,
  `NiveauRecette` int(11) NOT NULL,
  `TexteRecette` text NOT NULL,
  `ExtImgRecette` text NOT NULL,
  `StatusRecette` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`IdRecette`, `TitreRecette`, `DescriptionRecette`, `TempsRecette`, `DateRecette`, `NiveauRecette`, `TexteRecette`, `ExtImgRecette`, `StatusRecette`) VALUES
(1, 'Fondant au chocolat', 'La fameuse recette du fondant au chocolat !', 20, '2021-12-14', 1, 'Commencer par battre les œufs dans un saladier puis les mettre dans le four', 'jpg', 1),
(2, 'Chausson aux pommes', 'petite recette du chausson au pommes', 60, '2021-12-14', 1, 'mettre les pommes dans la pâte', 'jpg', 2),
(3, 'Pates au fromage et jambon', 'petite recette rapide pour ce midi', 10, '2021-12-20', 2, 'voici comment faire la recette', 'jpg', 1),
(4, 'Pates au fromage et jambon', 'petite recette rapide pour ce midi', 10, '2021-12-20', 3, 'voici comment faire la recette', 'jpg', 2),
(90, 'Merguez et frites', 'petite recette rapide', 30, '2022-01-03', 2, 'faire cuire les merguez et les frites et servir', 'jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ustensiles`
--

CREATE TABLE `ustensiles` (
  `IdUstensile` int(11) NOT NULL,
  `NomUstensile` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ustensiles`
--

INSERT INTO `ustensiles` (`IdUstensile`, `NomUstensile`) VALUES
(1, 'fouet'),
(2, 'fouet électrique'),
(3, 'plat à tarte'),
(4, 'plat à gâteau'),
(5, 'fourchette'),
(6, 'couteau'),
(7, 'petite cuillère'),
(8, 'grande cuillère');

-- --------------------------------------------------------

--
-- Structure de la table `ustensile_recette`
--

CREATE TABLE `ustensile_recette` (
  `IdUstensile` int(11) NOT NULL,
  `IdRecette` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ustensile_recette`
--

INSERT INTO `ustensile_recette` (`IdUstensile`, `IdRecette`) VALUES
(4, 1),
(5, 1),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(5, 86),
(6, 86),
(7, 86),
(3, 89),
(5, 90);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdUtilisateur` int(11) NOT NULL,
  `PseudoUtilisateur` varchar(255) NOT NULL,
  `MailUtilisateur` text NOT NULL,
  `MdpUtilisateur` text NOT NULL,
  `RoleUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUtilisateur`, `PseudoUtilisateur`, `MailUtilisateur`, `MdpUtilisateur`, `RoleUtilisateur`) VALUES
(1, 'axel94', 'axelv271@hotmail.fr', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 2),
(6, 'lolo', 'laura94120@icloud.com', '910d810b429dcbfe283764127031d61803f6d9ca', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_recette`
--

CREATE TABLE `utilisateur_recette` (
  `IdUtilisateur` int(11) NOT NULL,
  `IdRecette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_recette`
--

INSERT INTO `utilisateur_recette` (`IdUtilisateur`, `IdRecette`) VALUES
(6, 86),
(6, 87),
(6, 88),
(6, 89),
(1, 90);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCategorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`IdCommentaire`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IdIngredient`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`IdRecette`);

--
-- Index pour la table `ustensiles`
--
ALTER TABLE `ustensiles`
  ADD PRIMARY KEY (`IdUstensile`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `IdCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `IdCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IdIngredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `IdRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `ustensiles`
--
ALTER TABLE `ustensiles`
  MODIFY `IdUstensile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
