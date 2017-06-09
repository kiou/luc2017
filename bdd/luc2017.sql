-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Juin 2017 à 13:22
-- Version du serveur :  5.7.14
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `luc2017`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE `actualite` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resume` longtext COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `metatitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metadescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `poid` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `avant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`id`, `categorie_id`, `created`, `changed`, `titre`, `slug`, `resume`, `contenu`, `metatitle`, `metadescription`, `image`, `poid`, `isActive`, `avant`) VALUES
(4, 2, '2017-06-09 12:46:20', '2017-06-09 13:19:53', 'J’ai enfin pris le temps de faire mon site', 'j-ai-enfin-pris-le-temps-de-faire-mon-site', '2017 et une nouvelle version vois le jour, j’en suis assez content je vais enfin pouvoir faire des articles pour raconter tout un tas de bêtise.', '<p><img src="/luc2017/web//img/wysiwyg/593a989ce22bf.jpg?1497013237913" alt="" width="1920" height="660" /></p>\r\n<p> </p>\r\n<p>Voilà maintenant 6 ans que je fais du développement et j’essaie tous les 2ans ans (si je trouve la force et le temps) de mettre à jour mon site et mon Cv.</p>\r\n<p>2017 et une nouvelle version vois le jour, j’en suis assez content je vais enfin pouvoir faire des articles pour raconter tout un tas de bêtise.</p>\r\n<p>Pour le petit paragraphe technique, j’ai utilisé symfony 3 pour réaliser ce site, je suis resté sur un navigation dite « classique » j’aurais voulu en faire plus à ce niveau mais il ne faut pas oublier que la réalisation est faite en plus du travail quotidien et qu’il faut rester sur quelque chose de réaliste pour pas qu’il reste à 50% terminé toute sa vie.</p>\r\n<p>J’ai profité de ce développement pour tester particle.js (les animations en background) plutôt cool in ? j’ai aussi testé les obliques en SVG ce qui permet d’avoir des lignes un peu différentes de ce que l’on voie en général. Pour terminer je persiste dans l’animation de SVG pour faire des loaders super sympas avec vivus.js</p>\r\n<p>Pour résumé rapidement le contenu de mon site tu trouveras la liste de mes références, la liste de mes compétences en tous cas celles que j’ai voulu mettre en avant, et du coup quelques actualités.</p>\r\n<p>Si tu souhaites me contacter pour me faire un petit coucou ou pour discuter d’un éventuel projet en commun n’hésite pas le formulaire de contact est fait pour ça, tu peux aussi me retrouver assez souvent sur discord avec le pseudo « kiou » ou sur le Channel de Grafikart.</p>', 'qdss', 'dqsdq', '593a989ce22bf.jpg', 3, 1, 1),
(5, 3, '2017-06-09 12:55:12', '2017-06-09 13:19:39', 'Du développement et des wysiwyg', 'du-developpement-et-des-wysiwyg', 'Parlons du sujet qui fâche (ou pas) l’intégration et l’utilisation des wysiwyg dans le développement.', '<p><img src="/luc2017/web//img/wysiwyg/Sans-titre-4.png?1497013312048" alt="" width="1045" height="418" /></p>\r\n<p> </p>\r\n<p>Parlons du sujet qui fâche (ou pas) l’intégration et l’utilisation des wysiwyg dans le développement.</p>\r\n<p>Pour résumé rapidement le wysiwyg et un outil qui s’ajoute à un champ de contenu pour permettre à un administrateur de mettre en page son texte. En tout cas dans un premier temps c’était ça.</p>\r\n<p>Avec le temps les choses ont évolué et on à vue cette outil s’agrémenter avec de l’import d’image, de l’insertion de tableau, d’iframe en tous genre ainsi que des options de mise en page de type float, alignement ect.</p>\r\n<p>Alors c’est beau me direz-vous, oui mais pas que !</p>\r\n<p>En tant que développeur je dois intégrer l’outil en administration <br /> Je dois également faire en sorte que les options disponibles soit stylisé et cadré cotés client<br /> Et pour terminer le rendu dans le wysiwyg (que j’appellerais W à partir de maintenant parce que c’est plus cool) en administration doit être synchronisé avec l’affichage client « WHAT YOU SEE IS WHAT YOU GET », partie trop souvent oublié car chronophage.</p>\r\n<p>Alors s’il s’agit juste de mise en page de type texte (soulignement, gras, italique) c’est relativement simple et ça fonctionnement parfaitement.</p>\r\n<p>Mais on arrive assez rapidement à :<br /> « Mr le développeur j’aimerais également pouvoir mettre des images dans mon texte (les unes à côtés des autres si possible) et j’ai également besoin de mettre des tableaux »</p>\r\n<p>Il suffit donc d’ajouter ces options et encore une fois de synchroniser les rendus.</p>\r\n<p>Mais voilà, avec autant de possibilité on se retrouve avec des mises en page exotique qui risque de donner un cotés « amateur » à votre site.</p>\r\n<p>Il n’est pas rare de se retrouver avec des images en float dans la colonne d’un tableau, ou avec un mélange image texte sans aucune marge, gênant la lecture d’un article.</p>\r\n<p>Avec l’augmentation de la personnalisation des sites internet, on voit arriver les administrations avec un seul type de contenu « contenu » avec un W full option permettant de faire un peut tout est n’importe quoi. (fuillez pauvre fou !)</p>\r\n<p>Alors oui ces sites sont plus rapides à mettre en place, oui il suffit de le développer une fois et d’adapter le thème cotés client, oui on peut les vendre moins cher, mais on reste avec une solution global adapté à tout le monde et donc à personne.</p>\r\n<p>Pour garder un aspect professionnel avec des contenus cadré un site se doit d’avoir des types de contenus plus conventionnels avec une liste de champs cadrés qui permettent un affichage clair cotés client, le W ne doit être qu’un complément.</p>\r\n<p>Pour conclure le W est un excellent outil, mais il doit être cadré et utilisé intelligemment, e complément d’autres champs avec une liste d’option triés sur le volet.</p>\r\n<p>Et vous, vous vivez comment le W ?</p>', 'qsd', 'sqdqs', '593a9ab0c8f2f.png', 2, 1, 1),
(6, 1, '2017-06-09 13:04:28', '2017-06-09 13:19:28', 'Concentration sonore', 'concentration-sonore', 'Alors on n’est pas sur un article mais juste sur une petite liste des playlists que j’utilise ces derniers temps pour m’aider à me concentrer pendant le boulot', '<p>Alors on n’est pas sur un article mais juste sur une petite liste des playlists que j’utilise ces derniers temps pour m’aider à me concentrer pendant le boulot</p>\r\n<p>Je travaille en open space et j’ai besoin de m’isoler de temps en temps pour travailler correctement.</p>\r\n<p>Et vous vouez écoutez quoi pour développer ?</p>\r\n<p><iframe src="https://www.youtube.com/embed/imtPF2b2Q4M" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p><iframe src="https://www.youtube.com/embed/pmxYePDPV6M" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p><iframe src="https://www.youtube.com/embed/Jmv5pTyz--I" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p><iframe src="https://www.youtube.com/embed/cr8KRsfCNNI" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', 'qsdqs', 'dqs', '593a9e0c64e00.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `actualite_categorie`
--

CREATE TABLE `actualite_categorie` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `actualite_categorie`
--

INSERT INTO `actualite_categorie` (`id`, `created`, `changed`, `nom`) VALUES
(1, '2017-05-21 13:08:14', '2017-06-09 12:46:57', 'Musique'),
(2, '2017-05-21 13:08:17', '2017-06-09 12:48:21', 'Projet'),
(3, '2017-06-09 12:47:49', NULL, 'Générale');

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `poid` int(11) NOT NULL,
  `image` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id`, `created`, `changed`, `titre`, `contenu`, `isActive`, `poid`, `image`) VALUES
(2, '2017-05-21 11:39:52', '2017-06-09 12:18:22', 'HTML5', 'utilisation des derniers standards du HTML5 pour faciliter le référencement et l’accessibilité', 1, 1, '59216093e14b8.png'),
(3, '2017-05-21 11:41:17', '2017-06-09 12:35:27', 'CSS3', 'Au dela de l’intégration le CSS3 permet de faire la plus grande partie des animations, je l’utilise avec compass qui me permet d’avoir un bonne organisation des fichiers et de facilité la maintenabilité.', 1, 1, '593a960f18162.png'),
(4, '2017-05-21 11:42:10', '2017-06-09 12:18:03', 'Drupal', 'CMS complet qui permet de mutualiser certains développements, il dispose de nombreux modules qui permettent de gagner du temps en revanche l’intégration est plus longue et plus difficile.', 1, 1, '592160f2a3f2a.png'),
(5, '2017-05-21 11:45:17', '2017-06-09 12:17:53', 'Symfony', 'Excellent framworks que j’utilise dès que possible, il dispose de très bonnes fonctionnalités, permet de ne pas réinventer les choses et de professionnaliser le développement. (j’ai aussi testé laravel et cake php, mon choix c’est arrêté sur symfony)', 1, 1, '592161ad7bec3.png'),
(8, '2017-05-21 11:47:21', '2017-06-09 12:17:41', 'Prestashop', 'Prestashop est une compétence récente qui me permet de créer des solutions e-commerce sans avoir à prendre en charge la partie administration (j’ai essayé de faire ma propre solution une fois …)', 1, 1, '5921622980bd8.png'),
(9, '2017-06-09 12:29:48', '2017-06-09 12:30:09', 'Javascript', 'Jquery / javascript me permet de compléter des fonctionnalités ou de créer des animation / navigation plus complexe que ce que propose CSS3 (j’ai testé angular js, pas convaincu je commence à m’interesser à react js)', 1, 1, '593a94d181dc1.png'),
(10, '2017-06-09 12:31:34', NULL, 'Github', 'Github me sert à enregistrer mes sites et à récupérer / mettre à jour mes repos quand je change de machine, je l’utilise également pour migrer mes sites en production en SSH', 1, 1, '593a9526b727a.png'),
(11, '2017-06-09 12:33:42', NULL, 'Grunt', 'Au même niveau que j’utilise compass j’utilise Grunt pour organiser mes fichiers JS et avoir qu’un seul fichier minimifier en production', 1, 1, '593a95a62979f.png'),
(12, '2017-06-09 12:40:25', NULL, 'PhpStorm', 'J’ai pendant longtemps utilisé sublimtext mais Phpstorm arrive avec de nombreuses fonctionnalités bien pratique, comme la gestion de base de donnée ou le parcours d’objet très pratique quand on utilise un framwork ou une API', 1, 1, '593a9739c3f85.png');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `created`, `email`, `contenu`, `nom`) VALUES
(1, '2017-05-23 11:17:50', 'aa@aa.fr', 'dqsdqsdqs', 'dqsdqsd'),
(2, '2017-05-23 11:18:30', 'aa@aa.fr', 'dsqdsqd', 'sqdqs'),
(3, '2017-05-23 11:18:43', 'bb@bb.fr', 'qsdsq', 'dqsdqsdqs'),
(4, '2017-05-23 11:44:38', 'aa@aa.fr', 'dqsd', 'dqsdqsd'),
(5, '2017-05-23 11:45:07', 'aa@aa.fr', 'dqsdqs', 'dqsd'),
(6, '2017-05-23 11:45:22', 'bb@bb.fr', 'qsdqsdqsdqsd', 'dsqdqsd'),
(7, '2017-05-23 11:46:54', 'aa@aa.fr', 'dqs', 'dqsdqsdq'),
(8, '2017-05-23 14:51:02', 'dqs@aa.fr', 'sqdqsdsqdq', 'dsqd'),
(9, '2017-06-03 13:36:57', 'aa@aa.fr', 'qsdsqdq', 'qsdsqdq');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `poid` int(11) NOT NULL,
  `avant` tinyint(1) NOT NULL,
  `image` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageavant` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id`, `categorie_id`, `created`, `changed`, `titre`, `contenu`, `isActive`, `poid`, `avant`, `image`, `lien`, `imageavant`) VALUES
(9, 2, '2017-06-09 09:37:09', '2017-06-09 11:37:42', 'Saint-etienne', '<p>Développé sur Drupal 7, le challenge principal de ce site était d’avoir un intégration graphique avancée ainsi qu’une gestion clair et ergonomique pour les administrateurs. Disponible également sur mobile</p>', 1, 10, 1, '593a8645106a5.jpg', 'http://www.saint-etienne-attractivite.fr/fr', '593a760250ed9.jpg'),
(11, 1, '2017-06-09 09:41:42', '2017-06-09 11:37:34', 'ColocArts', '<p>Développé sur Symfony 3, le site de colocarts à été un véritable chalenge. Il devait avoir une navigation complète en AJAX mais également via URL, respecter les normes SEO et l\'historique de navigation<br /> Chalenge réussie.</p>', 1, 11, 1, '593a860ad4db3.jpg', 'https://colocarts.com/', '593a723173acf.jpg'),
(12, 1, '2017-06-09 11:33:19', NULL, 'Luc Pinelli', '<p>Développé sur Symfony 3, mon portfolio à été et sera l’occasion de tester différentes technologies, il dispose d’une administration complète avec un module de statistique et d’une version responsive.</p>', 1, 9, 0, '593a877fb2119.jpg', 'http://pinelli-luc.fr/', NULL),
(13, 1, '2017-06-09 11:35:38', NULL, 'Hôtel Terminus', '<p>Développé sur Symfony 3, Hôtel terminus est un site « single page » qui dispose d’une petite administration et d’une version responsive.</p>', 1, 1, 0, '593a880a652e6.jpg', 'http://www.bestwesternterminus.fr/fr/', NULL),
(14, 1, '2017-06-09 11:41:50', '2017-06-09 11:49:00', 'Véronique Françaix', '<p>Développé sur Symfony 3, avec administration et version responsive.</p>', 1, 1, 0, '593a897ec67e3.jpg', 'http://lestableauxdeveroniquefrancaix.com/', NULL),
(15, 3, '2017-06-09 11:48:21', NULL, 'IPPA', '<p>Organisation de conférence de science-politique dans le monde, IPPA est un outil complet avec une interface d’administration qui comprend de nombreux modules.<br /> Développé sur une solution propriétaire permettant une total maitrise.</p>', 1, 1, 0, '593a8b05a892f.jpg', 'http://www.ippapublicpolicy.org/', NULL),
(16, 3, '2017-06-09 11:50:15', '2017-06-09 11:50:21', 'Miss Mandarine', '<p>Développement d’un site administrable pour présenter l’outil « e-learning » de Miss mandarine, avec administration et version responsive.</p>', 1, 1, 0, '593a8b77ad4fb.jpg', 'http://mandarine.coloc-dev.net/', NULL),
(17, 2, '2017-06-09 11:51:57', NULL, 'Minalogic', '<p>Développé sur Drupal 7, Minalogic et un outil complet de gestion d’adhérant / références avec une interface d’administration qui comprend de nombreux modules .<br /> Disponible sur mobile</p>', 1, 1, 0, '593a8bde1dd6c.jpg', 'http://www.minalogic.com/', NULL),
(18, 4, '2017-06-09 11:53:59', NULL, 'Critères éditions', '<p>Intégration d’un thème complet sur le CMS prestashop 1.6, critère édition une très bonne expérience pour découvrir le monde de la vente en ligne.</p>', 1, 1, 0, '593a8c5736569.jpg', 'http://criteres-editions.com/', NULL),
(19, 3, '2017-06-09 11:56:10', NULL, 'Brûleurs de loups', '<p>Le site des BDL est un outil disponible sur mobile avec un module de match en live, il est développé sur une solution propriétaire et dispose d’une administration complète.</p>', 1, 8, 0, '593a8cdb1466f.jpg', 'http://www.bruleursdeloups.com/accueil', NULL),
(20, 3, '2017-06-09 11:58:19', NULL, 'Aqua expérience', '<p>Développé sur une solution propriétaire, avec administration.</p>', 1, 1, 0, '593a8d5c1dc8f.jpg', 'http://www.aqua-experience.fr/', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projet_categorie`
--

CREATE TABLE `projet_categorie` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `projet_categorie`
--

INSERT INTO `projet_categorie` (`id`, `created`, `changed`, `nom`) VALUES
(1, '2017-05-20 19:39:48', '2017-05-20 19:39:53', 'Symfony'),
(2, '2017-05-20 19:39:57', NULL, 'Drupal'),
(3, '2017-06-09 00:00:00', NULL, 'Propriétaire'),
(4, '2017-06-09 00:00:00', NULL, 'Prestashop'),
(5, '2017-06-09 11:39:51', NULL, 'Outil');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `changed` datetime DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `avatar` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `created`, `changed`, `username`, `password`, `email`, `isActive`, `roles`, `avatar`) VALUES
(1, '2017-05-20 13:38:37', '2017-05-20 16:28:01', 'admin', '$2y$13$79DX4PI./a2VUAMNfevApuhoUfKuGYXMI2fUXBrsgJYKamsI3fRUq', 'admin@colocarts.com', 1, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_54928197BCF5E72D` (`categorie_id`);

--
-- Index pour la table `actualite_categorie`
--
ALTER TABLE `actualite_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_50159CA9BCF5E72D` (`categorie_id`);

--
-- Index pour la table `projet_categorie`
--
ALTER TABLE `projet_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actualite`
--
ALTER TABLE `actualite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `actualite_categorie`
--
ALTER TABLE `actualite_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `projet_categorie`
--
ALTER TABLE `projet_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD CONSTRAINT `FK_54928197BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `actualite_categorie` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `FK_50159CA9BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `projet_categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
