-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/10/2024 às 03:14
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
-- Banco de dados: `farmaexpress`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `usuario_id`, `produto_id`, `quantidade`) VALUES
(53, 9, 2, 1),
(54, 9, 31, 1),
(57, 9, 2, 1),
(63, 3, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_pedido`
--

CREATE TABLE `detalhes_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `detalhes_pedido`
--

INSERT INTO `detalhes_pedido` (`id`, `pedido_id`, `produto_id`, `quantidade`, `preco`, `subtotal`) VALUES
(1, 16, 2, 1, 0.00, 0.00),
(2, 17, 1, 1, 0.00, 0.00),
(3, 18, 2, 1, 0.00, 0.00),
(4, 19, 2, 1, 0.00, 0.00),
(5, 20, 17, 1, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_compras`
--

CREATE TABLE `historico_compras` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `data_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `lida` tinyint(1) NOT NULL DEFAULT 0,
  `data_notificacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(50) NOT NULL,
  `data_pagamento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `usuario_id`, `produto_id`, `quantidade`, `preco`, `metodo_pagamento`, `data_pagamento`) VALUES
(1, 3, 1, 2, 14.99, 'boleto', '2024-09-15 15:39:27'),
(2, 3, 2, 1, 12.99, 'boleto', '2024-09-15 15:39:27'),
(3, 3, 1, 2, 14.99, 'boleto', '2024-09-15 15:39:31'),
(4, 3, 2, 1, 12.99, 'boleto', '2024-09-15 15:39:31'),
(5, 3, 1, 2, 14.99, 'pix', '2024-09-15 15:48:57'),
(6, 3, 2, 1, 12.99, 'pix', '2024-09-15 15:48:57'),
(7, 3, 1, 2, 14.99, 'pix', '2024-09-15 15:49:31'),
(8, 3, 2, 1, 12.99, 'pix', '2024-09-15 15:49:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `forma_pagamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `data_pedido`, `total`, `status`, `forma_pagamento`) VALUES
(6, 1, '2024-09-14 20:51:33', 12.99, 'Pendente', ''),
(7, 1, '2024-09-14 20:59:48', 12.99, 'Pendente', ''),
(8, 1, '2024-09-14 21:00:28', 14.99, 'Pendente', ''),
(9, 1, '2024-09-14 21:12:21', 51.96, 'Pendente', ''),
(10, 1, '2024-09-14 21:31:12', 10.99, 'Pendente', ''),
(11, 1, '2024-09-14 21:34:06', 19.99, 'Pendente', ''),
(12, 1, '2024-09-15 10:25:54', 14.99, 'Pendente', ''),
(13, 1, '2024-09-15 10:33:33', 12.99, 'Pendente', ''),
(14, 3, '2024-10-08 15:09:40', 82.96, 'Em andamento', 'Dinheiro'),
(15, 3, '2024-10-08 15:11:09', 82.96, 'Em andamento', 'Dinheiro'),
(16, 3, '2024-10-08 15:16:06', 12.99, 'Em andamento', 'Dinheiro'),
(17, 3, '2024-10-12 15:38:39', 14.99, 'Em andamento', 'Dinheiro'),
(18, 3, '2024-10-19 17:32:06', 12.99, 'Em andamento', 'Dinheiro'),
(19, 4, '2024-10-24 21:21:55', 12.99, 'Em andamento', 'Dinheiro'),
(20, 6, '2024-10-24 21:36:21', 18.99, 'Em andamento', 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`, `categoria`) VALUES
(1, 'Cetirizina', 'Medicamento indicado para alívio de sintomas alérgicos.', 14.99, 'imagens/ceti.jpg', NULL),
(2, 'Clear Shampoo', 'Shampoo anticaspa que promove uma limpeza profunda.', 12.99, 'imagens/clear.jpg', NULL),
(3, 'Clonazepam', 'Medicamento para tratamento de transtornos de ansiedade.', 19.99, 'imagens/clona.jpg', NULL),
(4, 'Cloridrato de Sertralina', 'Medicamento indicado para depressão e ansiedade.', 25.99, 'imagens/cloridrato.jpg', NULL),
(6, 'Dipirona', 'Analgésico e antitérmico para febre e dores.', 8.99, 'imagens/dipirona.jpg', NULL),
(7, 'Dorflex', 'Relaxante muscular indicado para dores musculares.', 15.50, 'imagens/dorflex.jpg', NULL),
(8, 'Doril', 'Medicamento para alívio rápido de dores de cabeça.', 6.99, 'imagens/doril.jpg', NULL),
(9, 'Dove Sabonete', 'Sabonete hidratante para pele sensível.', 4.50, 'imagens/dove.jpg', NULL),
(11, 'Eve', 'Medicamento indicado para cólicas menstruais.', 22.99, 'imagens/eve.jpg', NULL),
(12, 'Exgg', 'Suplemento energético para performance.', 10.99, 'imagens/exgg.jpg', NULL),
(13, 'Head&Shoulders', 'Shampoo anticaspa para couro cabeludo saudável.', 16.99, 'imagens/heads.jpg', NULL),
(14, 'Herbíssimo', 'Desodorante natural com fragrância suave.', 11.99, 'imagens/herbissimo.jpg', NULL),
(15, 'Inciclo', 'Coletor menstrual para fluxo leve a moderado.', 35.99, 'imagens/inciclo.jpg', NULL),
(16, 'Intimus', 'Absorvente íntimo com cobertura suave.', 7.50, 'imagens/intimus.jpg', NULL),
(17, 'Kitty Shampoo', 'Shampoo especial para higienização de gatos.', 18.99, 'imagens/kitty.jpg', NULL),
(18, 'Libresse', 'Absorvente feminino com proteção extra.', 8.50, 'imagens/libresse.jpg', NULL),
(19, 'Lorazepam', 'Ansiolítico para tratamento de ansiedade.', 21.99, 'imagens/lorezam.jpg', NULL),
(20, 'Loratadina', 'Medicamento para tratamento de alergias.', 9.99, 'imagens/lorsatana.jpg', NULL),
(21, 'Mata', 'Inseticida eficaz para eliminação de pragas.', 14.99, 'imagens/mata.jpg', NULL),
(22, 'Melato', 'Suplemento de melatonina para melhorar o sono.', 29.99, 'imagens/melato.jpg', NULL),
(23, 'Neon', 'Suplemento vitamínico completo para a saúde.', 17.99, 'imagens/neon.jpg', NULL),
(24, 'Omeprasol', 'Medicamento para alívio da azia e gastrite.', 12.99, 'imagens/ome.jpg', NULL),
(25, 'Pantene Condicionador', 'Condicionador para hidratação profunda dos cabelos.', 13.99, 'imagens/pantene.jpg', NULL),
(26, 'Paracetamol', 'Analgésico indicado para dores e febre.', 5.99, 'imagens/paracetamol.jpg', NULL),
(27, 'Plenitud', 'Fralda geriátrica para proteção total.', 29.99, 'imagens/plenitud.jpg', NULL),
(28, 'Prednisona', 'Anti-inflamatório indicado para várias condições.', 12.99, 'imagens/pred.jpg', NULL),
(29, 'TRESemmé Shampoo', 'Shampoo hidratante para cabelos ressecados.', 15.99, 'imagens/tres.jpg', NULL),
(30, 'Tutti', 'Preservativos para proteção.', 9.99, 'imagens/tuti.jpg', NULL),
(31, 'Usens Sabonete', 'Sabonete íntimo feminino com pH balanceado.', 7.99, 'imagens/usens.jpg', NULL),
(32, 'Whats', 'Preservativos com maior conforto.', 5.99, 'imagens/whats.jpg', NULL),
(2113, '', '', 0.00, '', 'Nenhuma categoria selecionada'),
(2114, '', '', 0.00, '', 'Nenhuma categoria selecionada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `endereco`, `cep`, `cpf`) VALUES
(1, 'Pitoco', 'pitas@gmail.com', '$2y$10$iGgWOUwL481f4O.iXCX/BeoqTUVI2BcJef2gOottyiU2vmcqDpPQK', '', '', NULL),
(2, 'pitas', '1@gmail.com', '$2y$10$SmPNeIJg9zvnA5omnsjFseLL3cMNV8o/z8K/1wkMLP7wjyfez/9Pe', '', '', NULL),
(3, 'lucas', 'mat@gmail.com', '$2y$10$7ys5Kr7pgHp2IQlZDHRYn.2vX7sbKzBGt4nhil4fn.pUxFv8xJYd2', '', '', NULL),
(4, 'matheus', 'matheus.sa.ca@gmail.com', '$2y$10$VQaU8ev99XgLrZB.9msyyejy5lgJlXoB5MG1QhycFya.5XHdrx3F.', '', '', NULL),
(6, 'matheus', 'matheus.msc.ca@gmail.com', '$2y$10$3o8ueX22jIEKkk8DjonDu.7jsALTCbokdjOFB.wltpAk.wG2kU8fi', '', '', NULL),
(7, 'matheus', 'yubr0203@gmail.com', '$2y$10$h0DHq4ikgmZrGphLzYW8YO33cTmTBpjdrbEPKWKbmjxGjqon9wwEG', '', '', NULL),
(8, 'matheus', 'aldijeane@hotmail.com', '$2y$10$3WUa9wx.DExu8nl2FnTiMeV78ovkATJfNrtfJdfk2/cny34TrYume', '', '', NULL),
(9, 'farma2024', 'farmaexpress2024@gmail.com', '$2y$10$3cdhdmjYx8DmzQgprxhl1OPTAwMGg0wv6lVy7wcCmCcn.if2bcKh2', '', '', NULL),
(10, 'farma mobile', 'farma2024mobi@gmail.com', '$2y$10$scFz6hXXwwfzhaX5MVK61usisoJnCGEZ4UIkHnHW1T.a4MChdQZ36', '', '', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `historico_compras`
--
ALTER TABLE `historico_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `historico_compras`
--
ALTER TABLE `historico_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2115;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD CONSTRAINT `detalhes_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalhes_pedido_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `historico_compras`
--
ALTER TABLE `historico_compras`
  ADD CONSTRAINT `historico_compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historico_compras_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
