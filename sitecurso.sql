-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 05:37 PM
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
-- Database: `sitecurso`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id`, `id_usuario`, `nome`, `sobrenome`, `email`, `telefone`) VALUES
(1, 3, 'Maria', 'Silva', 'maria@example.com', '85997752571'),
(3, 7, 'Eduardo ', 'Lima', 'gabrielcordeirobarroso@gmail.com', '(85) 99775-2571');

-- --------------------------------------------------------

--
-- Table structure for table `aula`
--

CREATE TABLE `aula` (
  `id` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `drive_link` varchar(255) DEFAULT NULL,
  `duracao` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aula`
--

INSERT INTO `aula` (`id`, `id_modulo`, `titulo`, `conteudo`, `ordem`, `drive_link`, `duracao`) VALUES
(1, 1, 'Instalação do Ambiente', 'Como configurar o ambiente de desenvolvimento.', 1, NULL, '00:00:00'),
(2, 1, 'Seu Primeiro Programa', 'Criação e execução do primeiro programa.', 3, NULL, '00:00:00'),
(3, 2, 'Vetores', 'Conceitos e manipulação de vetores.', 1, NULL, '00:00:00'),
(4, 2, 'Listas Ligadas', 'Conceitos e implementações de listas ligadas.', 2, NULL, '00:00:00'),
(5, 3, 'Instalação do MySQL', 'Passo a passo para instalar o MySQL.', 1, NULL, '00:00:00'),
(6, 1, 'rubi', 'rubi', 2, 'https://drive.google.com/file/d/1O21xlS1UdH8PkYwmSR75lsEs8TwbPNnY/preview', '00:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `categoria` varchar(100) NOT NULL,
  `imagem_capa` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id`, `id_prof`, `titulo`, `descricao`, `data_criacao`, `categoria`, `imagem_capa`, `valor`) VALUES
(1, 2, 'Curso de Programação', 'Aprenda programação do básico ao avançado.', '2025-02-14 14:45:42', 'Programação', 'python.png', 851.75),
(2, 1, 'Banco de Dados', 'Banco de Dados', '2025-02-14 14:45:42', 'Banco de Dados', 'bd.jfif', 225.52);

-- --------------------------------------------------------

--
-- Table structure for table `matricula`
--

CREATE TABLE `matricula` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `data_matricula` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matricula`
--

INSERT INTO `matricula` (`id`, `id_aluno`, `id_curso`, `data_matricula`) VALUES
(1, 1, 1, '2025-02-14 14:46:41'),
(2, 1, 2, '2025-02-14 14:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `duracao` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`id`, `id_curso`, `titulo`, `descricao`, `ordem`, `imagem`, `duracao`) VALUES
(1, 1, 'Introdução à Programação', 'Conceitos iniciais e ambiente de desenvolvimento.', 3, '', 0),
(2, 1, 'Estruturas de Dados', 'Estudo das principais estruturas de dados.', 4, '', 0),
(3, 2, 'Introdução a Bancos de Dados', 'Noções básicas e conceitos fundamentais.', 1, '', 0),
(4, 1, 'testedfbgdfsg', 'test desc', 2, 'vasco-vasco-da-gama-cross-soccer-hd-wallpaper-preview.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `id_usuario`, `nome`, `sobrenome`, `email`) VALUES
(1, 2, 'Gabriel', 'Cordeiro', 'gabriel@gmail.com'),
(2, 4, 'Carlos', 'Henrique', 'chbv1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `tipo_usuario`) VALUES
(1, 'adm', '$2y$10$iCJTPLRXH3mwy9sLUyd/tORDhMPtXOMeI40AygJjAsvmoSzqlGGWy', 'adm'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(3, 'maria', 'e7d80ffeefa212b7c5c55700e4f7193e', 'aluno'),
(4, 'aluno.maria', 'c323d55e3042ae39303b2f106ca10b11', 'aluno'),
(5, 'prof.carlos', '9ad48828b0955513f7cf0f7f6510c8f8', 'professor'),
(6, 'edu', '$2y$10$NcCRwOf14WHD.rldF0C1mu7jgC9ZFo/mKlIqa7CY04Yp97fdqIpfK', 'aluno'),
(7, 'edu', '$2y$10$AcfaSiiZSSlxRMrrw9PTMePUrT33cGeuJjvCDXt3YWhbBa/9VSOZ.', 'aluno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id`);

--
-- Constraints for table `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);

--
-- Constraints for table `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
