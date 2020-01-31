-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: trainning_ecom_oficial
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Formas de Pagamento do Sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Informática'),(2,'Papelaria'),(3,'Livraria'),(4,'teste'),(5,'teste 2'),(6,'teste 2');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `cpf` varchar(15) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Anne','Caroline','anne@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,'12312312311','2000-01-01');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente_contato`
--

DROP TABLE IF EXISTS `cliente_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente_contato` (
  `id_contato` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_contato` int(11) NOT NULL,
  `contato` varchar(200) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_contato`),
  KEY `cliente_contato_fk` (`id_cliente`),
  KEY `cliente_contato_fk_1` (`id_tipo_contato`),
  CONSTRAINT `cliente_contato_fk` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `cliente_contato_fk_1` FOREIGN KEY (`id_tipo_contato`) REFERENCES `tipo_contato` (`id_tipo_contato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente_contato`
--

LOCK TABLES `cliente_contato` WRITE;
/*!40000 ALTER TABLE `cliente_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente_endereco`
--

DROP TABLE IF EXISTS `cliente_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente_endereco` (
  `id_cliente_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente_endereco`),
  KEY `cliente_endereco_fk` (`id_cliente`),
  CONSTRAINT `cliente_endereco_fk` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente_endereco`
--

LOCK TABLES `cliente_endereco` WRITE;
/*!40000 ALTER TABLE `cliente_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forma_pagamento` (
  `id_forma_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id_forma_pagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Formas de Pagamento do Sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento`
--

LOCK TABLES `forma_pagamento` WRITE;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` VALUES (1,'Dinheiro'),(2,'Boleto'),(3,'Cartão Débito'),(4,'Cartão Crédito'),(5,'Vale Presente');
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `nascimento` datetime NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuarios_fk` (`id_perfil`),
  CONSTRAINT `usuarios_fk` FOREIGN KEY (`id_perfil`) REFERENCES `funcionario_perfil` (`id_usuario_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela de Usuários';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario_perfil`
--

DROP TABLE IF EXISTS `funcionario_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario_perfil` (
  `id_usuario_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_usuario_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Tab do perfil dos usuários';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario_perfil`
--

LOCK TABLES `funcionario_perfil` WRITE;
/*!40000 ALTER TABLE `funcionario_perfil` DISABLE KEYS */;
INSERT INTO `funcionario_perfil` VALUES (1,'Administrador'),(3,'Vendedor'),(4,'Gerente'),(5,'Estoquista'),(6,'Estagiario');
/*!40000 ALTER TABLE `funcionario_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `valor_total` float NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_tipo_entrega` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `pedido_fk` (`id_tipo_entrega`),
  KEY `pedido_fk_1` (`id_cliente`),
  KEY `pedido_fk_2` (`id_vendedor`),
  CONSTRAINT `pedido_fk` FOREIGN KEY (`id_tipo_entrega`) REFERENCES `tipo_entrega` (`id_tipo_entrega`),
  CONSTRAINT `pedido_fk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `pedido_fk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `funcionario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_forma_pagamento`
--

DROP TABLE IF EXISTS `pedido_forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_forma_pagamento` (
  `id_pedido_forma_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_forma_pagamento` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido_forma_pagamento`),
  KEY `pedido_forma_pagamento_fk` (`id_pedido`),
  KEY `pedido_forma_pagamento_fk_1` (`id_forma_pagamento`),
  CONSTRAINT `pedido_forma_pagamento_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  CONSTRAINT `pedido_forma_pagamento_fk_1` FOREIGN KEY (`id_forma_pagamento`) REFERENCES `forma_pagamento` (`id_forma_pagamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Formas de Pagamento do Pedido.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_forma_pagamento`
--

LOCK TABLES `pedido_forma_pagamento` WRITE;
/*!40000 ALTER TABLE `pedido_forma_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_item`
--

DROP TABLE IF EXISTS `pedido_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_item` (
  `id_pedido_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor_unitario` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` float NOT NULL,
  `id_pedido_item_status` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido_item`),
  KEY `pedido_item_fk` (`id_pedido`),
  KEY `pedido_item_fk_1` (`id_pedido_item_status`),
  KEY `pedido_item_fk_2` (`id_produto`),
  CONSTRAINT `pedido_item_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  CONSTRAINT `pedido_item_fk_1` FOREIGN KEY (`id_pedido_item_status`) REFERENCES `pedido_item_status` (`id_pedido_item_status`),
  CONSTRAINT `pedido_item_fk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_item`
--

LOCK TABLES `pedido_item` WRITE;
/*!40000 ALTER TABLE `pedido_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_item_status`
--

DROP TABLE IF EXISTS `pedido_item_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_item_status` (
  `id_pedido_item_status` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pedido_item_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela com status dos pedidos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_item_status`
--

LOCK TABLES `pedido_item_status` WRITE;
/*!40000 ALTER TABLE `pedido_item_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_item_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `foto_vitrine` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `produto_fk` (`id_categoria`),
  CONSTRAINT `produto_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tab de produtos comercializados.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Notebook','Lorem',1999,1,1,'media/produtos/notebook.jpg');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_foto`
--

DROP TABLE IF EXISTS `produto_foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_foto` (
  `id_produto_foto` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_produto_foto`),
  KEY `produto_foto_fk` (`id_produto`),
  CONSTRAINT `produto_foto_fk` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_foto`
--

LOCK TABLES `produto_foto` WRITE;
/*!40000 ALTER TABLE `produto_foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocao`
--

DROP TABLE IF EXISTS `promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promocao` (
  `id_promocao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `id_responsavel_criacao` int(11) NOT NULL,
  `id_responsavel_alteracao` int(11) DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_promocao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocao`
--

LOCK TABLES `promocao` WRITE;
/*!40000 ALTER TABLE `promocao` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_contato`
--

DROP TABLE IF EXISTS `tipo_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_contato` (
  `id_tipo_contato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_contato`
--

LOCK TABLES `tipo_contato` WRITE;
/*!40000 ALTER TABLE `tipo_contato` DISABLE KEYS */;
INSERT INTO `tipo_contato` VALUES (1,'Celular'),(2,'Residencial'),(3,'Comercial'),(4,'Recado'),(5,'Email');
/*!40000 ALTER TABLE `tipo_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_entrega`
--

DROP TABLE IF EXISTS `tipo_entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_entrega` (
  `id_tipo_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `preco_frete` float DEFAULT NULL,
  `prazo_entrega` int(11) DEFAULT NULL COMMENT 'Prazo de entrega em dias úteis',
  PRIMARY KEY (`id_tipo_entrega`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Formas de Pagamento do Sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_entrega`
--

LOCK TABLES `tipo_entrega` WRITE;
/*!40000 ALTER TABLE `tipo_entrega` DISABLE KEYS */;
INSERT INTO `tipo_entrega` VALUES (1,'Mais econômica',6.5,4),(2,'Mais rápida',12,1),(3,'Agendada',21,25);
/*!40000 ALTER TABLE `tipo_entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'trainning_ecom_oficial'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-31 16:59:12
