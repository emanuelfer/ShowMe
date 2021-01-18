-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Set-2020 às 19:05
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `showme`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE `publicacao` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `descricao_curta` varchar(100) NOT NULL,
  `resenha` text NOT NULL,
  `categoria` varchar(15) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publicacao`
--

INSERT INTO `publicacao` (`id`, `id_usuario`, `titulo`, `autor`, `descricao_curta`, `resenha`, `categoria`, `imagem`) VALUES
(1, 1, 'bitdlkfjs', 'ksjflsd', 'skdjflskdj', 'sdlfjls', 'Filme', 'images/15995794085f57a51046e2c.jpg'),
(2, 1, 'Mid90s', 'Jonah Hill', 'Filme sobre a adolescência nos anos 90.', 'Aos 13 anos, Stevie (Sunny Suljic) é um garoto de Los Angeles tentando curtir o início da adolescência enquanto tenta relevar o relacionamento abusivo com o irmão mais velho. Em plena década de 1990, ele descobre o skate e aprende lições de vida com o seu novo grupo de amigos.', 'Filme', 'images/15995971595f57ea670238f.jpg'),
(3, 2, 'Mercedes', 'Carro', 'É um carro.', 'É um carro muito bom.', 'Filme', 'images/15996637185f58ee66d4a35.jpg'),
(4, 5, 'Os Afro-sambas', 'Baden Powell', 'Os Afro-sambas é um álbum do violonista Baden Powell e do compositor e cantor Vinicius de Moraes, de', 'Considerado por muitos críticos como um divisor de águas na MPB por fundir vários elementos da sonoridade africana ao samba, \"Os Afro-sambas\" é o segundo LP lançado pela parceria Baden Powell e Vínicius de Moraes. Segundo relata Vinicius, numa crônica escrita em 1965 e disponível no livro \"Samba Falado\" (Editora Beco do Azougue), o poeta recebera de Carlos Coqueijo um disco com sambas-de-roda da Bahia, pontos de candomblé e toques de berimbau que encantaram Vinicius de Moraes. Baden Powell também fora à Bahia e conferira pessoalmente os cantos do candomblé baiano. Desse mútuo encantamento pelo samba e religiosidade encontrada na Bahia, surgiu o projeto dos Afro-sambas, que se tornou um álbum gravado em 1966.\r\n\r\nAs oito canções apresentam uma rica e singular musicalidade, que traz uma mistura de instrumentos do candomblé e da umbanda (como atabaques e afoxés) com timbres mais comuns à música brasileira (agogôs, saxofones e pandeiros).\r\n\r\nO grande destaque do álbum é a faixa de abertura \"Canto de Ossanha\", futuro clássico da MPB, que conta com a participação nos vocais da atriz Betty Faria e na flauta de Copinha. ', 'Música', 'images/15997444115f5a299b967b6.jpg'),
(5, 1, 'Kind of Blue', 'Miles Davis', 'Kind of Blue é um álbum de estúdio do músico estadunidense de jazz Miles Davis, lançado em 17 de ago', 'Kind of Blue é um álbum de estúdio do músico estadunidense de jazz Miles Davis, lançado em 17 de agosto de 1959 pela Columbia Records, tanto em mono como em estéreo. As sessões de gravação para o disco foram realizadas no 30th Street Studio, na cidade de Nova Iorque, em 2 de março e 22 de abril daquele ano. Os encontros contaram com o conjunto sexteto de Davis, constituído pelo pianista Bill Evans, o baterista Jimmy Cobb, o baixista Paul Chambers e os saxofonistas John Coltrane e Julian \"Cannonball\" Adderley. Após o ingresso de Bill Evans no grupo, Miles deu continuidade às experimentações modais de Milestones, baseando o LP inteiramente em modalidade e colocando-o em contraste com seus trabalhos anteriores, de estilo hard bop. ', 'Album', 'images/15997702055f5a8e5dcb1d5.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `imagem`) VALUES
(1, 'emanuel', 'emanuel@gmail.com', 'a80e1c212420901edde8bbeb64037593', 'images/me.jpeg'),
(2, 'ferreira', 'ferreira@lindoso.com', '8d13ed81f15ff53688df90dd38cbd6d6', 'images/15996633955f58ed23412cc.jpg'),
(3, 'Emanuel Ferrreira', 'emanuel.ferreira@gmail.com', 'd946490c9cdbcc1a27b9950a869f8b7a', 'images/15996640665f58efc2ceb7d.jpg'),
(4, 'Miles Davis', 'miles@gmail.com', '6a81060b83b919bc115112bf840eca63', 'images/15996790575f592a51cf3d5.jpg'),
(5, 'Thelonious Monk', 'monk@gmail.com', '171b6ba14aeefeb08caf15065042a4c2', 'images/15996791525f592ab0a621a.jpg'),
(6, 'John Coltrane', 'coltrane@gmail.com', 'daa60d28287ab4a24ec74bd37dff8dad', 'images/15996792695f592b259e06c.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_seguidor`
--

CREATE TABLE `usuario_seguidor` (
  `id_usuario` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_seguidor`
--

INSERT INTO `usuario_seguidor` (`id_usuario`, `id_seguidor`) VALUES
(5, 1),
(1, 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario_seguidor`
--
ALTER TABLE `usuario_seguidor`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_seguidor` (`id_seguidor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `usuario_seguidor`
--
ALTER TABLE `usuario_seguidor`
  ADD CONSTRAINT `usuario_seguidor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `usuario_seguidor_ibfk_2` FOREIGN KEY (`id_seguidor`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
