-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 11:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyber_gest`
--

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Tipo` varchar(45) DEFAULT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `Descricao`, `Estado`, `Tipo`, `Data`) VALUES
(29, 'adsdsadd', 'inativo', 'Computadores', '2025-12-21 15:03:45'),
(30, 'sdfdsfsf', 'ativo', 'avicultura', '2025-12-21 15:04:51'),
(31, 'sdfdfdfds', 'inativo', 'Agricultura', '2025-12-21 15:04:55'),
(32, 'dsffsfd', 'inativo', 'aaaaa', '2025-12-21 15:05:02'),
(34, 'dfgdggd', 'ativo', 'bbbb', '2025-12-21 15:05:12'),
(35, '', 'ativo', 'dsd', '2025-12-23 14:56:51'),
(36, '', 'inativo', 'material de construcao', '2025-12-23 14:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `imposto`
--

CREATE TABLE `imposto` (
  `idImposto` int(11) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL,
  `Taxa` decimal(10,0) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `Descricao` varchar(50) DEFAULT NULL,
  `Produto` varchar(45) DEFAULT NULL,
  `Barcod` varchar(45) DEFAULT NULL,
  `preco_custo_total` double DEFAULT NULL,
  `unidade_medida` varchar(50) DEFAULT NULL,
  `imposto_custo` double DEFAULT NULL,
  `preco_custo_sem_imposto` double DEFAULT NULL,
  `preco_venda_total` decimal(10,0) DEFAULT NULL,
  `venda_sem_imposto` decimal(10,0) DEFAULT NULL,
  `desconto` decimal(10,0) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `data` datetime NOT NULL,
  `fk_group` int(11) DEFAULT NULL,
  `fk_imposto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `Descricao`, `Produto`, `Barcod`, `preco_custo_total`, `unidade_medida`, `imposto_custo`, `preco_custo_sem_imposto`, `preco_venda_total`, `venda_sem_imposto`, `desconto`, `estado`, `data`, `fk_group`, `fk_imposto`) VALUES
(26, 'mouse sem fio', 'mouse', '121212', 100, '', 16, 84, 300, 284, NULL, 'Ativo', '2025-12-23 21:17:16', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `imposto`
--
ALTER TABLE `imposto`
  ADD PRIMARY KEY (`idImposto`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`),
  ADD KEY `fk_group_id` (`fk_group`),
  ADD KEY `fk_imposto_id` (`fk_imposto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `imposto`
--
ALTER TABLE `imposto`
  MODIFY `idImposto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_group_id` FOREIGN KEY (`fk_group`) REFERENCES `grupo` (`idGrupo`),
  ADD CONSTRAINT `fk_imposto_id` FOREIGN KEY (`fk_imposto`) REFERENCES `imposto` (`idImposto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
