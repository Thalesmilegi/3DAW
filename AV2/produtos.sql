-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jul-2021 às 22:52
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `cod_barra` varchar(12) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fabricante` varchar(255) CHARACTER SET utf8 NOT NULL,
  `categoria` int(11) NOT NULL,
  `tipo_prod` varchar(255) CHARACTER SET utf8 NOT NULL,
  `preco_venda` double NOT NULL,
  `qtd_estoque` int(11) NOT NULL,
  `peso_gramas` int(11) NOT NULL,
  `descricao` text CHARACTER SET utf8 NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data_inclusao` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ativo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `cod_barra`, `nome`, `fabricante`, `categoria`, `tipo_prod`, `preco_venda`, `qtd_estoque`, `peso_gramas`, `descricao`, `foto`, `data_inclusao`, `ativo`) VALUES
(1, '00000000001', 'Samsung Galaxy M21s', 'Samsung', 1, '1', 1306.5, 25, 191, 'Dispositivo desbloqueado para que você escolha a companhia telefônica de sua preferência.\r\nTela Super AMOLED de 6.4 \".\r\nTem 3 câmeras traseiras de 64Mpx/8Mpx/5Mpx.\r\nCâmera frontal de 32Mpx.\r\nProcessador Exynos 9611 Octa-Core de 2.3GHz com 4GB de RAM.\r\nBateria de 6000mAh.\r\nMemória interna de 64GB. Adequado para cartão SD de 512GB.\r\nCom reconhecimento facial e sensor de impressão digital.', '00000000001.png', '2021-07-14', 's'),
(2, '00000000002', 'Xiaomi Redmi 9', 'Samsung', 1, '1', 1190, 10, 198, 'Dispositivo desbloqueado para que você escolha a companhia telefônica de sua preferência.\r\n4 câmeras traseiras de 13 MP, 8 MP, 5 MP e 2 MP com inteligência artificial.\r\nLente macro, dupla grande-angular e sensor de profundidade.\r\nCâmera frontal de 8 MP com modo retrato.\r\nTela FHD+ para uma visão mais nítida e imersiva.\r\nBateria de carregamento rápido para que você possa navegar 19 horas e reproduzir vídeos 19 horas.', '00000000002.png', '2021-07-15', 'n'),
(3, '00000000003', 'Samsung Galaxy M12s', 'Samsung', 1, '1', 1099, 10, 221, 'O Samsung Galaxy M12 é um smartphone completo que traz muitas facilidades para o dia a dia! Surpreendente é sua tela Touchscreen de 6.5 polegadas, que coloca esse Samsung no topo de sua categoria. ', '00000000003.png', '2021-07-16', 's'),
(4, '00000000004', 'Moto G9 Play', 'Motorola', 1, '1', 1129.55, 14, 200, 'MOTO G9 PLAY O novo moto g9 play proporciona potência para tudo que importa. Isso significa ter um sistema de câmera tripla de 48 MP¹ para capturar o momento de todas as maneiras possíveis e tecnologia Quad Pixel para fotos nítidas', '00000000004.png', '2021-07-17', 's'),
(5, '00000000005', 'Xiaomi Redmi Note 10', 'Xiaomi', 1, '1', 1725, 24, 179, '6.43 \"AMOLED DotDisplay - FHD + resolução de 1080x2400p - Processador Qualcomm Snapdragon 678 - Octa-core - 4 GB de RAM - Memória interna de 64 GB - Câmera AI Quad - Câmera frontal de 13 MP - Bateria de 5000 mAh - MIUI 12 (baseado em Android 11) A espera acabou! O Xiaomi Redmi Note 10 se junta às fileiras da grande família Xiaomi Redmi. É o primeiro telefone móvel básico da Xiaomi a apresentar um painel AMOLED , emparelhado com alto - falantes duplos para colocar um sistema de conteúdo envolvente em suas mãos. Claro que também oferece excelente desempenho , um conjunto completo de câmeras de alta resolução e uma bateria de longa duração que farão do novo Redmi Note 10 a escolha perfeita para você. Totalmente atualizado com elementos de design clássico A qualidade do Redmi Note 10 já é evidente do lado de fora. Ele incorpora os elementos de design que a Xiaomi tem aprimorado, como o leitor de impressão digital embutido no botão home , oferecendo a capacidade de desbloquear seu telefone celular e aplicativos de maneira conveniente, rápida e segura . Desta vez, o Redmi Note 10 vem com uma parte traseira brilhante e uma forma curva 3D ergonômica , o que tornará mais fácil de segurar e fará com que o Note 10 se encaixe perfeitamente em suas mãos. Finalmente, suas três lindas cores (cinza, branco e verde) permitem que você adapte ao seu estilo. Sistema operacional: MIUI 12 baseado em Android 11 Processador Octa Core, Qualcomm Snapdragon 678 4x 2,2 GHz Kryo 460, 4x 1,8 GHz Kryo 460 Gráfico: Qualcomm Adreno 612 RAM: 4GB Armazenar: 128 GB Cartão SD: Não SIM: DualSim Tipo de cartão: Nano SIM / Nano SIM Linguagem: Multi idioma (inclui espanhol e português) Loja de jogos: sim EXIBIÇÃO Características: 6,43 ”AMOLED Definição:Full HD + Resolução: 1080 x 2400 pixels Densidade: 409 ppi Brilho:1100 nits máx. (tip) Contraste: 4500000: 1 Gama de cores: DCI-P3 Bits de cor: 8 bits CÂMERA Câmera secundária: 13 MP Câmera primária: Câmera grande angular de 48 MP (sensor de 1/2 \",', '00000000005.png', '2021-07-17', 's'),
(6, '00000000006', 'LG K61', 'LG', 1, '1', 1057.71, 20, 188, 'Descubra o seu jeito favorito de fotografar o novo K61 possui 4 câmeras, cada uma com sua particularidade, para que você tire fotos incríveis quando, onde e como quiser. Câmera Inteligente tire as melhores fotos com a Inteligência', '00000000006.png', '2021-07-18', 's'),
(7, '00000000007', 'Motorola Moto E7 Power', 'Motorola', 1, '1', 799, 40, 199, 'Desenvolvido com tecnologia de ponta, o Smartphone Motorola Moto E7 Power conta com processador octa-core ultrarrápido. Com câmera de ótima qualidade você pode tirar fotos incríveis', '00000000007.png', '2021-07-18', 's'),
(8, '00000000008', 'Samsung Galaxy M31', 'Samsung', 1, '1', 1712, 10, 191, 'O Display Infinito oferece um mega espaço para você ver e jogar! O Display Infinito de 6.4 polegadas do Galaxy M31 permite que você veja muito mais do que ama. A tecnologia Super AMOLED e a resolução Full HD+ reproduzem detalhes', '00000000008.png', '2021-07-18', 's');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
