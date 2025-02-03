-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/02/2025 às 00:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_academia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `aluno_cod` int(11) NOT NULL,
  `aluno_nome` varchar(256) NOT NULL,
  `aluno_email` varchar(256) NOT NULL,
  `aluno_senha` varchar(64) NOT NULL,
  `aluno_cpf` varchar(24) NOT NULL,
  `aluno_endereco` varchar(512) NOT NULL,
  `aluno_telefone` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`aluno_cod`, `aluno_nome`, `aluno_email`, `aluno_senha`, `aluno_cpf`, `aluno_endereco`, `aluno_telefone`) VALUES
(2, 'Lin', 'lin@gmail.com', '$2y$10$.fpDHq/nNvdfqmuRCRn2VOP3mZzhmP4hMaYKFRbCXxlLFfPzmRz..', '54374276890', 'Rua Aqui do Longe', '12 997108249'),
(3, 'Roberto', 'gabrito343@gmail.com', '$2y$10$NlToBXbw.ipFdqB.VpylNOa/8oOeD3aKzMEZykwTTAjSJUOHIFBTu', '22345676543', 'Rua das Calopsitas', '99 99999 9999'),
(4, 'Ana Luiza', 'ana@gmail.com', '$2y$10$pftQLaptK85k3rNpQNtK2.3sIDEg89ZZQ71fQGs0I2u9KT.CUPXIG', '37920103843', 'Rua das Araras', '12 981463945'),
(7, 'Lucas', 'lucas@gmail.com', '$2y$10$7QmnQXDmMpC6k8iaJZoGh.YbjRolUwjRQ7FjZSLlBfTEZsXraa2ye', '22345676543', 'Rua das Aves', '12 8990462820'),
(8, 'Luis Felipe', 'luis@gmail.com', '$2y$10$7KgwAa69KyLTaK/iXHZOgecxukuPxiduSAEcoEZx0b6LizRTwnqSW', '23488654221', 'Rua do Bem-ti-vi', '12 981463945'),
(9, 'Wesley', 'wesley@gmail.com', '$2y$10$D/2oi8MnF7KoHrHHCGRJH.AvFWynbZE1HL7fBcxVCn1nh5Vz.D5ym', '37920103841', 'Rua das Aves', '12 981463945'),
(10, 'Roberto', 'roberto@gmail.com', '$2y$10$eYpptBn6wipj8brVg.50CuACXRCmt4YGXWF6rw62A0R9m5rT18ieO', '12342134111', 'Lálálálá', '12 88888 8888');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `aula_cod` int(11) NOT NULL,
  `aula_tipo` enum('Pilates','Crossfit','Musculação','Yoga','Aeróbica','Ginástica','Alongamento','Luta') NOT NULL,
  `aula_data` enum('Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado','Domingo') NOT NULL,
  `fk_instrutor_cod` int(11) NOT NULL,
  `fk_aluno_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas`
--

INSERT INTO `aulas` (`aula_cod`, `aula_tipo`, `aula_data`, `fk_instrutor_cod`, `fk_aluno_cod`) VALUES
(2, 'Aeróbica', 'Terça-feira', 1, 2),
(3, 'Musculação', 'Domingo', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `instrutores`
--

CREATE TABLE `instrutores` (
  `instrutor_cod` int(11) NOT NULL,
  `instrutor_nome` varchar(256) NOT NULL,
  `instrutor_email` varchar(256) NOT NULL,
  `instrutor_senha` varchar(64) NOT NULL,
  `instrutor_especialidade` enum('Pilates','Crossfit','Musculação','Yoga','Aeróbica','Ginástica','Alongamento','Luta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `instrutores`
--

INSERT INTO `instrutores` (`instrutor_cod`, `instrutor_nome`, `instrutor_email`, `instrutor_senha`, `instrutor_especialidade`) VALUES
(1, 'Liliv', 'liliv@gmail.com', '$2y$10$edy.Q2kFR/ajBvcDEyG8ee1qYYZzH932l68HQE7FhYB.tAPHITzMG', 'Luta'),
(2, 'Isadora ', 'isagomes@gmail.com', '$2y$10$ajv6k5Kc4v4jrWqBsqsDrOfJpcW9KVhyJMZuxN/pwzCN4uYar9EzW', 'Yoga'),
(3, 'Bruna', 'brucpv@gmail.com', '$2y$10$LEleNRUmgfEzqlBJH7a36.LCn4GoQ2r4cCa86tvGRaqfD/toQ/ENW', 'Pilates'),
(4, 'João Paulo', 'jp@gmail.com', '$2y$10$Fza/JS/ejbNnMqY/e3rpcumcgN..jX6HbFAjDsykqSXCPkU6/9X1O', 'Crossfit'),
(5, 'Barbara', 'ba@gmail.com', '$2y$10$qPc6Z9ogw0p/XE7EbfMHJ.cG/GhCyvoZL/8trobVVL4uPVt83tXqK', 'Musculação'),
(6, 'Priscilalalala', 'pri@gmail.com', '$2y$10$wHhO7eIOit2vlDIY5jziu.hq/er2TXGA.gEIxLd6c3Cn1I2wOhKwK', 'Pilates'),
(7, 'Peter', 'peter@gmail.com', '$2y$10$30TS6n8kNTBGFFrRT/pC4eWofhXuruXcNKrZ/rgDyY9a.WTq8BNgu', 'Musculação'),
(9, 'Fábio', 'fabio@gmail.com', '$2y$10$.foiC1y4ZODS7iLTxqaQjOeVW00HcnK6kB2buNh4qDr46u1Vt6bXq', 'Alongamento'),
(10, 'Linberto', 'linberto@gmail.com', '$2y$10$iY8u98faqkzQk061oygYneu38rDZ3miYZ0vsFN0AvqXut4Wz2UVvK', 'Ginástica');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`aluno_cod`),
  ADD UNIQUE KEY `aluno_email` (`aluno_email`);

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_cod`),
  ADD KEY `fk_instrutor_cod` (`fk_instrutor_cod`),
  ADD KEY `fk_aluno_cod` (`fk_aluno_cod`);

--
-- Índices de tabela `instrutores`
--
ALTER TABLE `instrutores`
  ADD PRIMARY KEY (`instrutor_cod`),
  ADD UNIQUE KEY `instrutor_email` (`instrutor_email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `aluno_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `instrutores`
--
ALTER TABLE `instrutores`
  MODIFY `instrutor_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`fk_instrutor_cod`) REFERENCES `instrutores` (`instrutor_cod`),
  ADD CONSTRAINT `aulas_ibfk_2` FOREIGN KEY (`fk_aluno_cod`) REFERENCES `alunos` (`aluno_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
