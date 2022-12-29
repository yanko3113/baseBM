-- MySQL dump 10.13  Distrib 5.7.40, for Linux (x86_64)
--
-- Host: mysql.linco.com.py    Database: linco_bmgroup
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `title` longtext,
  `short_body` longtext,
  `body` longtext,
  `user_id` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand_images`
--

DROP TABLE IF EXISTS `brand_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `order` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand_images`
--

LOCK TABLES `brand_images` WRITE;
/*!40000 ALTER TABLE `brand_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `brand_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` longtext,
  `company_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `lft` int DEFAULT NULL,
  `rght` int DEFAULT NULL,
  `body` longtext,
  `user_id` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `featured` tinyint DEFAULT '0',
  `pdf_file` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `free` tinyint DEFAULT '0',
  `promo_category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`parent_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_packs`
--

DROP TABLE IF EXISTS `categories_packs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_packs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` decimal(10,0) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_packs`
--

LOCK TABLES `categories_packs` WRITE;
/*!40000 ALTER TABLE `categories_packs` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_packs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_images`
--

DROP TABLE IF EXISTS `category_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `order` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_images`
--

LOCK TABLES `category_images` WRITE;
/*!40000 ALTER TABLE `category_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `us` longtext,
  `count_countries` decimal(10,0) DEFAULT NULL,
  `count_customers` decimal(10,0) DEFAULT NULL,
  `count_jobs` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'py','Paraguay','\n                    <h3 class=\"mt-sm-5 aos-init aos-animate\" data-aos=\"fade-in\" data-aos-duration=\"2000\">Por ese motivo, hace más de 13 años nos dedicamos a <span>unir a las personas con lo que aman hacer,</span> creando confianza y sinergia entre empresarios éticos y trabajadores comprometidos, para que ambas partes puedan seguir creciendo.</h3>\n                    <h3 data-aos=\"fade-in\" data-aos-duration=\"2000\" class=\"aos-init aos-animate\">Si estás buscando impulsar tu carrera, en BM Group <span>somos especialistas en brindarte oportunidades laborales que te harán avanzar junto a las mejores empresas del país. </span></h3>\n                    <h3 data-aos=\"fade-in\" data-aos-duration=\"2000\" class=\"aos-init\"><span>En BM Group ofrecemos servicios de outsourcing </span> para que las empresas puedan dedicarse a lo que mejor saben hacer: su negocio.\n                    </h3>\n                ',2,100,2000),(2,'bo','Bolivia','\n                    <h3 class=\"mt-sm-5 aos-init aos-animate\" data-aos=\"fade-in\" data-aos-duration=\"2000\">Por ese motivo, hace más de 13 años nos dedicamos a <span>unir a las personas con lo que aman hacer,</span> creando confianza y sinergia entre empresarios éticos y trabajadores comprometidos, para que ambas partes puedan seguir creciendo.</h3>\n                    <h3 data-aos=\"fade-in\" data-aos-duration=\"2000\" class=\"aos-init aos-animate\">Si estás buscando impulsar tu carrera, en BM Group <span>somos especialistas en brindarte oportunidades laborales que te harán avanzar junto a las mejores empresas del país. </span></h3>\n                    <h3 data-aos=\"fade-in\" data-aos-duration=\"2000\" class=\"aos-init\"><span>En BM Group ofrecemos servicios de outsourcing </span> para que las empresas puedan dedicarse a lo que mejor saben hacer: su negocio.\n                    </h3>\n                ',2,100,2000);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_entries`
--

DROP TABLE IF EXISTS `form_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_entries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(1024) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `notes` longtext,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `form_entries_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_entries`
--

LOCK TABLES `form_entries` WRITE;
/*!40000 ALTER TABLE `form_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `full` tinyint DEFAULT '0',
  `perms` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Admin',1,NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `response_description` varchar(255) DEFAULT NULL,
  `ticket_number` varchar(255) DEFAULT NULL,
  `authorization_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(1024) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `order` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `description` longtext,
  `short_description` longtext,
  `user_id` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `enabled` tinyint DEFAULT '1',
  `brand_id` int DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `video1` varchar(1024) DEFAULT NULL,
  `video2` varchar(1024) DEFAULT NULL,
  `year` varchar(1024) DEFAULT NULL,
  `month` int DEFAULT NULL,
  `lang` varchar(255) DEFAULT 'esp',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_packs`
--

DROP TABLE IF EXISTS `products_packs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_packs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `promo_product_id` int DEFAULT NULL,
  `quantity` decimal(10,0) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `promo_product_id` (`promo_product_id`),
  CONSTRAINT `products_packs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_packs`
--

LOCK TABLES `products_packs` WRITE;
/*!40000 ALTER TABLE `products_packs` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_packs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `order` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` longtext,
  `company_id` int DEFAULT NULL,
  `services` longtext,
  `advantages` longtext,
  `image` varchar(255) DEFAULT NULL,
  `mainsubtitle` varchar(255) DEFAULT NULL,
  `color_title` varchar(255) DEFAULT NULL,
  `css_interna` varchar(255) DEFAULT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `linea` varchar(255) DEFAULT NULL,
  `fondo_servicio` varchar(255) DEFAULT NULL,
  `fondo_ventaja` varchar(255) DEFAULT NULL,
  `fondo_imagen` varchar(255) DEFAULT NULL,
  `fondo_linea` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'BM People','fondo-verde-claro','bmpeople','Nos enfocamos en las personas. ','Te ayuda a identificar el talento adecuado, ofreciéndote también servicios complementarios de desarrollo organizacional orientados a potenciar la salud, cultura y desempeño de tu organización.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li>Atracción y selección de personal.</li>\n                    <li>Evaluación de potencial.</li>\n                    <li>Verificación laboral.</li>\n                    <li>Headhunting.</li>\n                    <li>Assessment Center. </li>\n                    <li>Outplacement.</li>\n                    <li>Desarrollo organizacional:</li>\n                    <p>- Descripción de puestos.</p>\n                    <p>- Evaluación de desempeño.</p>\n                    <p>- Medición de clima laboral.</p>\n                    <p>- Diseño de estructura salarial.</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-verde\">Adecuación garantizada del perfil al puesto requerido y a la cultura de la empresa.</li>\n                    <li class=\"color-verde\">Confidencialidad en cada proceso, para tanto clientes como postulantes.</li>\n                    <li class=\"color-verde\">Asesoramiento personalizado.</li>\n                    <li class=\"color-verde\">Informes de resultados detallados.</li>\n                </ul>',NULL,'Servicios de Head Hunting y selección de talentos.','Servicios de Head Hunting y selección de talentos.','bmpeople-interna','bmpeople-fondo-verde.png','linea-naranja_animated.svg','fondo-naranja','fondo-verde','fondo-verde-claro','fondo-verde-claro'),(2,'BM Outsourcing','fondo-rojo','bmoutsourcing','Proveemos\r\nStaffing Service','Incluye asesoramiento continuo e integral para construir estrategias que serán efecivas a largo plazo.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li>Selección y evaluación de talento para cada puesto.</li>\n                    <li>Administración del personal: </li>\n                    <p>- Contratación en el marco de la LGT.</p>\n                    <p>- Afiliaciones inmediatas al seguro social de corto y largo plazo.</p>\n                    <p>- Procesos de desvinculación de personal.</p>\n                    <p>- Pago puntual de salarios.</p>\n                    <p>- Programas de seguridad y salud en el trabajo.</p>\n                    <li>Desarrollo de planes de Bienestar Social.</li>\n                    <li>Gestión y desarrollo del talento.</li>\n                    <li>Medición y Evaluación de resultados.</li>\n                    <li>Servicios adicionales como dotación de uniformes, transporte, refrigerios.</li>\n                    <li>Asesoramiento legal - laboral.</li>\n                    <li>Plan de Capacitaciones trimestral.</li>\n                    <li>Talleres de formación de competencias.</li>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rojo\">Administración de personal en alianza estratégica con la organización.</li>\n                    <li class=\"color-rojo\">Tercerización de personal responsable, eficaz y eficiente.</li>\n                    <li class=\"color-rojo\">Desarrollo del talento de colaboradores.</li>\n                    <li class=\"color-rojo\">Asesoramiento personalizado en cada etapa del servicio.</li>\n                </ul>',NULL,'Procesos especializados con personal calificado para el cumplimento de KPIs del cliente.','Procesos especializados con personal calificado para el cumplimento de KPIs del cliente.','bmoutsourcing-interna','bmoutsourcing-fondo-bordo.png','linea-celeste_animated.svg','fondo-celeste','fondo-rojo','fondo-rojo','fondo-rojo'),(3,'BM Trade','fondo-amarillo','bmtrade','Implementamos\r\ncampañas de\r\nbranding','Campañas de branding de imagen e identidad de marca de productos en PDV, contribuyendo así a construir marcas e incrementar ventas.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-verde-agua\">Implementación de estrategias en PDV:</li>\n                    <p>- Reposición de producto en góndolas.</p>\n                    <p>- Manejo de inventarios.</p>\n                    <p>- Ejecución de estrategias de merchandising.</p>\n                    <p>- Instalación de material POP.</p>\n                    <p>- Armado de exhibiciones.</p>\n                    <p>- Armado de eventos.</p>\n                    <p>- Impulsación de marca.</p>\n                    <p>- Impulsación de ventas.</p>\n                    <p>- Degustaciones.</p>\n                    <p>- Volanteo.</p>\n                    <p>- Encuestas. </p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-amarillo\">Posicionamiento estratégico de productos en el punto de venta.</li>\n                    <li class=\"color-amarillo\">Relevamiento de información en tiempo real.</li>\n                    <li class=\"color-amarillo\">Feedback al cliente a través de informes.</li>\n                    <li class=\"color-amarillo\">Uso de plataformas de Trade MKT especializados y a medida p/ cada cliente.</li>\n                    <li class=\"color-amarillo\">Contacto directo con el consumidor final.</li>\n                    <li class=\"color-amarillo\">Ejecución de estrategias según los lineamientos de cada campaña.</li>\n                    <li class=\"color-amarillo\">Supervisión permanente de la ejecución en cada una de las etapas del servicio.</li>\n                    <li class=\"color-amarillo\">Amplio conocimiento del movimiento que se genera en los diferentes canales de ventas a nivel nacional.</li>\n                </ul>',NULL,'Gestión comercial en PDV para aumento de ventas y construcción de marca.','Gestión comercial en PDV para aumento de ventas y construcción de marca.','bmtrade-interna','bmtrade-fondo-naranja.png','linea-verde-agua_animated.svg','fondo-verde-agua','fondo-amarillo','fondo-amarillo','fondo-amarillo'),(4,'BM BTL','fondo-bmbtl','bmbtl','Hacemos uso\r\nde la creatividad','Desarrollo de acciones en canales novedosos que transmitan los principales beneficios y características de tu marca, relacionándonos directamente con el consumidor, mediante las emociones, los sentidos y la sorpresa.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-naranja-claro\">Marketing promocional, en canales ON/OFF.</li>\n                    <li class=\"color-naranja-claro\">Mystery Shopper.</li>\n                    <li class=\"color-naranja-claro\">Sampling.</li>\n                    <li class=\"color-naranja-claro\">Canjes.</li>\n                    <li class=\"color-naranja-claro\">Sorteos / Concursos.</li>\n                    <li class=\"color-naranja-claro\">Exhibiciones / Pruebas.</li>\n                    <li class=\"color-naranja-claro\">Demostraciones / Retos.</li>\n                    <li class=\"color-naranja-claro\">Lanzamientos.</li>\n                    <li class=\"color-naranja-claro\">Stands en ferias.</li>\n                    <li class=\"color-naranja-claro\">Azafatas.</li>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rojo-claro\">Relacionamiento con el consumidor de manera creativa.</li>\n                    <li class=\"color-rojo-claro\">Promoción del producto en canales novedosos.</li>\n                    <li class=\"color-rojo-claro\">Desarrollo, implementación, ejecución y supervisión de las campañas BTL.</li>\n                    <li class=\"color-rojo-claro\">Asesoramiento personalizado en cada etapa del servicio.</li>\n                    <li class=\"color-rojo-claro\">Inmediatez tanto en el efecto de atracción de los consumidores como en los resultados económicos.</li>\n                    <li class=\"color-rojo-claro\">Versatilidad para los diferentes canales y/o productos.</li>\n                </ul>',NULL,'Actividades para conectar los productos de los clientes con sus consumidores.','Actividades para conectar los productos de los clientes con sus consumidores.','bmbtl-interna','bmbtl-fondo-verde-agua.png','linea-naranja-claro_animated.svg','fondo-naranja-claro','fondo-rojo','fondo-bmbtl','bmbtl-fondo-verde-agua'),(5,'BM Implant','fondo-bmimplant-interna','bmimplant','Ofrecemos\r\nun servicio de\r\ntercerización','Un servicio de tercerización de los procesos operativos de esta área a sus clientes.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-bmimplant\">Formalización del proceso de contratación.</li>\n                    <li class=\"color-bmimplant\">Afiliación al seguro social a corto y largo plazo.</li>\n                    <li class=\"color-bmimplant\">Administración de información del personal.</li>\n                    <li class=\"color-bmimplant\">Visado de documentación en diferentes entidades.</li>\n                    <li class=\"color-bmimplant\">Registro y control de asistencia / ausencias / vacaciones.</li>\n                    <li class=\"color-bmimplant\">Revisión de formularios 110.</li>\n                    <li class=\"color-bmimplant\">Gestión de bajas del personal.</li>\n                    <li class=\"color-bmimplant\">Entrega de EPP.</li>\n                    <li class=\"color-bmimplant\">Otros procesos relacionados.</li>\n                </ul>','<ul class=\"bmimplant-interna2 aos-init aos-animate\" data-aos=\"fade-in\" data-aos-duration=\"3000\">\n                    <li class=\"color-naranja-oscuro\">Gestión de trámites en las distintas entidades regulatorias como ser Ministerio de Trabajo, AFP, etc.</li>\n                    <li class=\"color-naranja-oscuro\">Manejo de información y de documentación de manera segura, ordenada y confidencial.</li>\n                    <li class=\"color-naranja-oscuro\">Elaboración de procesos adecuados a las necesidades de cada cliente.</li>\n                    <li class=\"color-naranja-oscuro\">Asesoramiento personalizado.</li>\n                </ul>',NULL,'Gestión administrativa In House del personal del cliente.','Gestión administrativa In House del personal del cliente.','bmimplant-interna','bmimplant-fondo-celeste-claro.png','linea-verde-agua-claro','fondo-bmimplant','fondo-naranja','fondo-bmimplant-interna','bmimplant-fondo-celeste-claro'),(6,'BM Payroll','fondo-celeste-oscuro','bmpayroll','Administramos\r\nla nómina de\r\ntu empresa','Minimizamos los riesgos, asegurando el cumplimiento de la normativa laboral. Esto permite que el cliente pueda enfocarse en aumentar su eficiencia y productividad en otras áreas.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rosado\">Procesamiento de nómina</li>\n                    <p>- Novedades.</p>\n                    <p>- Revisión de Formularios RC IVA.</p>\n                    <p>- Elaboración de planillas.</p>\n                    <p>- Reportes de planilla de salarios.</p>\n                    <p>- Llenado de formularios MT / Caja / AFP.</p>\n                    <p>- Elaboración y presentación de libros laborales ante el MTESS.</p>\n                    <p>- Comunicaciones del movimiento del personal al MTESS e IPS según requiera.</p>\n                    <p>- Elaboración de Finiquitos.</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-celeste-oscuro font-regular\">Gestión de planillas de sueldos.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Seguridad, confidencialidad y puntualidad en el cumplimiento de obligaciones relacionadas al manejo de planillas.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Asesoramiento personalizado.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Apoyo permanente de un equipo altamente especializado y actualizado en las distintas áreas vinculadas a la gestión de liquidación de haberes (laboral, impositiva, contable, etc.).</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Propuesta desarrollada a medida para cada cliente, teniendo en cuenta la estructura, procesos, metodología de trabajo, circuitos de información, cultura y cualquier otro factor relevante. </li>\n                    <li class=\"color-celeste-oscuro font-regular\">Excelente relación costo / beneficio.</li>\n                </ul>',NULL,'Gestión de todas las actividades relacionadas a planillas de sueldos de los clientes.','Gestión de todas las actividades relacionadas a planillas de sueldos de los clientes.','bmpayroll-interna','bmpayroll-fondo-azul-marino.png','linea-rosada_animated.svg','fondo-rosado','fondo-celeste-oscuro','fondo-celeste-oscuro','bmpayroll-fondo-azul-marino.png'),(7,'BM Academy','fondo-marron','bmacademy','Objetivo difundir\r\nconocimiento','Este servicio utiliza la plataforma Moodle para ayudar a las empresas, sus áreas y colaboradores a lograr un rendimiento superior. Este nuevo paradigma de educación anuncia una evolución acelerada de nuestra oferta. Para una rápida y exitosa transformación hemos desarrollado una Nueva Estrategia de Educación. Los profesionales están requiriendo maximizar su capacitación y hacer lo mejor de ella.',1,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-celeste-oscuro2\">Capacitaciones</li>\n                    <p>- Talleres</p>\n                    <p>- Webinars</p>\n                    <p>- Entrevistas</p>\n                    <p>- Testimonios</p>\n                    <p>- Casos de éxito.</p>\n                    <p>- Reels, Videos, Lives, IGTV.</p>\n                    <p>- Sugerencia / Programas individuales de empleabilidad (completos o diseñados a medida).</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-marron font-regular\">Capacitación y motivación del personal.</li>\n                    <li class=\"color-marron font-regular\">Disminución del ausentismo y la rotación.</li>\n                    <li class=\"color-marron font-regular\">Aumento de la identificación del personal hacia la empresa.</li>\n                    <li class=\"color-marron font-regular\">Productividad mejorada y mayor cumplimiento de objetivos.</li>\n                    <li class=\"color-marron font-regular\">Desempeño laboral, eficiencia y productividad superior.</li>\n                </ul>',NULL,'Gestión del conocimiento a través de programas de capacitación.','Gestión del conocimiento a través de programas de capacitación.','bmacademy-interna','bmacademy-fondo-gris.png','linea-celeste-oscuro_animated.svg','fondo-celeste-oscuro2','fondo-marron','fondo-marron','bmacademy-fondo-gris'),(8,'BM People','fondo-verde-claro','bmpeople','Nos enfocamos en las personas. ','Te ayuda a identificar el talento adecuado, ofreciéndote también servicios complementarios de desarrollo organizacional orientados a potenciar la salud, cultura y desempeño de tu organización.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li>Atracción y selección de personal.</li>\n                    <li>Evaluación de potencial.</li>\n                    <li>Verificación laboral.</li>\n                    <li>Headhunting.</li>\n                    <li>Assessment Center. </li>\n                    <li>Outplacement.</li>\n                    <li>Desarrollo organizacional:</li>\n                    <p>- Descripción de puestos.</p>\n                    <p>- Evaluación de desempeño.</p>\n                    <p>- Medición de clima laboral.</p>\n                    <p>- Diseño de estructura salarial.</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-verde\">Adecuación garantizada del perfil al puesto requerido y a la cultura de la empresa.</li>\n                    <li class=\"color-verde\">Confidencialidad en cada proceso, para tanto clientes como postulantes.</li>\n                    <li class=\"color-verde\">Asesoramiento personalizado.</li>\n                    <li class=\"color-verde\">Informes de resultados detallados.</li>\n                </ul>',NULL,'Servicios de Head Hunting y selección de talentos.','Servicios de Head Hunting y selección de talentos.','bmpeople-interna','bmpeople-fondo-verde.png','linea-naranja_animated.svg','fondo-naranja','fondo-verde','fondo-verde-claro','fondo-verde-claro'),(9,'BM Outsourcing','fondo-rojo','bmoutsourcing','Proveemos\r\nStaffing Service','Incluye asesoramiento continuo e integral para construir estrategias que serán efecivas a largo plazo.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li>Selección y evaluación de talento para cada puesto.</li>\n                    <li>Administración del personal: </li>\n                    <p>- Contratación en el marco de la LGT.</p>\n                    <p>- Afiliaciones inmediatas al seguro social de corto y largo plazo.</p>\n                    <p>- Procesos de desvinculación de personal.</p>\n                    <p>- Pago puntual de salarios.</p>\n                    <p>- Programas de seguridad y salud en el trabajo.</p>\n                    <li>Desarrollo de planes de Bienestar Social.</li>\n                    <li>Gestión y desarrollo del talento.</li>\n                    <li>Medición y Evaluación de resultados.</li>\n                    <li>Servicios adicionales como dotación de uniformes, transporte, refrigerios.</li>\n                    <li>Asesoramiento legal - laboral.</li>\n                    <li>Plan de Capacitaciones trimestral.</li>\n                    <li>Talleres de formación de competencias.</li>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rojo\">Administración de personal en alianza estratégica con la organización.</li>\n                    <li class=\"color-rojo\">Tercerización de personal responsable, eficaz y eficiente.</li>\n                    <li class=\"color-rojo\">Desarrollo del talento de colaboradores.</li>\n                    <li class=\"color-rojo\">Asesoramiento personalizado en cada etapa del servicio.</li>\n                </ul>',NULL,'Procesos especializados con personal calificado para el cumplimento de KPIs del cliente.','Procesos especializados con personal calificado para el cumplimento de KPIs del cliente.','bmoutsourcing-interna','bmoutsourcing-fondo-bordo.png','linea-celeste_animated.svg','fondo-celeste','fondo-rojo','fondo-rojo','fondo-rojo'),(10,'BM Trade','fondo-amarillo','bmtrade','Implementamos\r\ncampañas de\r\nbranding','Campañas de branding de imagen e identidad de marca de productos en PDV, contribuyendo así a construir marcas e incrementar ventas.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-verde-agua\">Implementación de estrategias en PDV:</li>\n                    <p>- Reposición de producto en góndolas.</p>\n                    <p>- Manejo de inventarios.</p>\n                    <p>- Ejecución de estrategias de merchandising.</p>\n                    <p>- Instalación de material POP.</p>\n                    <p>- Armado de exhibiciones.</p>\n                    <p>- Armado de eventos.</p>\n                    <p>- Impulsación de marca.</p>\n                    <p>- Impulsación de ventas.</p>\n                    <p>- Degustaciones.</p>\n                    <p>- Volanteo.</p>\n                    <p>- Encuestas. </p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-amarillo\">Posicionamiento estratégico de productos en el punto de venta.</li>\n                    <li class=\"color-amarillo\">Relevamiento de información en tiempo real.</li>\n                    <li class=\"color-amarillo\">Feedback al cliente a través de informes.</li>\n                    <li class=\"color-amarillo\">Uso de plataformas de Trade MKT especializados y a medida p/ cada cliente.</li>\n                    <li class=\"color-amarillo\">Contacto directo con el consumidor final.</li>\n                    <li class=\"color-amarillo\">Ejecución de estrategias según los lineamientos de cada campaña.</li>\n                    <li class=\"color-amarillo\">Supervisión permanente de la ejecución en cada una de las etapas del servicio.</li>\n                    <li class=\"color-amarillo\">Amplio conocimiento del movimiento que se genera en los diferentes canales de ventas a nivel nacional.</li>\n                </ul>',NULL,'Gestión comercial en PDV para aumento de ventas y construcción de marca.','Gestión comercial en PDV para aumento de ventas y construcción de marca.','bmtrade-interna','bmtrade-fondo-naranja.png','linea-verde-agua_animated.svg','fondo-verde-agua','fondo-amarillo','fondo-amarillo','fondo-amarillo'),(11,'BM BTL','fondo-bmbtl','bmbtl','Hacemos uso\r\nde la creatividad','Desarrollo de acciones en canales novedosos que transmitan los principales beneficios y características de tu marca, relacionándonos directamente con el consumidor, mediante las emociones, los sentidos y la sorpresa.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-naranja-claro\">Marketing promocional, en canales ON/OFF.</li>\n                    <li class=\"color-naranja-claro\">Mystery Shopper.</li>\n                    <li class=\"color-naranja-claro\">Sampling.</li>\n                    <li class=\"color-naranja-claro\">Canjes.</li>\n                    <li class=\"color-naranja-claro\">Sorteos / Concursos.</li>\n                    <li class=\"color-naranja-claro\">Exhibiciones / Pruebas.</li>\n                    <li class=\"color-naranja-claro\">Demostraciones / Retos.</li>\n                    <li class=\"color-naranja-claro\">Lanzamientos.</li>\n                    <li class=\"color-naranja-claro\">Stands en ferias.</li>\n                    <li class=\"color-naranja-claro\">Azafatas.</li>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rojo-claro\">Relacionamiento con el consumidor de manera creativa.</li>\n                    <li class=\"color-rojo-claro\">Promoción del producto en canales novedosos.</li>\n                    <li class=\"color-rojo-claro\">Desarrollo, implementación, ejecución y supervisión de las campañas BTL.</li>\n                    <li class=\"color-rojo-claro\">Asesoramiento personalizado en cada etapa del servicio.</li>\n                    <li class=\"color-rojo-claro\">Inmediatez tanto en el efecto de atracción de los consumidores como en los resultados económicos.</li>\n                    <li class=\"color-rojo-claro\">Versatilidad para los diferentes canales y/o productos.</li>\n                </ul>',NULL,'Actividades para conectar los productos de los clientes con sus consumidores.','Actividades para conectar los productos de los clientes con sus consumidores.','bmbtl-interna','bmbtl-fondo-verde-agua.png','linea-naranja-claro_animated.svg','fondo-naranja-claro','fondo-rojo','fondo-bmbtl','bmbtl-fondo-verde-agua'),(12,'BM Implant','fondo-bmimplant-interna','bmimplant','Ofrecemos\r\nun servicio de\r\ntercerización','Un servicio de tercerización de los procesos operativos de esta área a sus clientes.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-bmimplant\">Formalización del proceso de contratación.</li>\n                    <li class=\"color-bmimplant\">Afiliación al seguro social a corto y largo plazo.</li>\n                    <li class=\"color-bmimplant\">Administración de información del personal.</li>\n                    <li class=\"color-bmimplant\">Visado de documentación en diferentes entidades.</li>\n                    <li class=\"color-bmimplant\">Registro y control de asistencia / ausencias / vacaciones.</li>\n                    <li class=\"color-bmimplant\">Revisión de formularios 110.</li>\n                    <li class=\"color-bmimplant\">Gestión de bajas del personal.</li>\n                    <li class=\"color-bmimplant\">Entrega de EPP.</li>\n                    <li class=\"color-bmimplant\">Otros procesos relacionados.</li>\n                </ul>','<ul class=\"bmimplant-interna2 aos-init aos-animate\" data-aos=\"fade-in\" data-aos-duration=\"3000\">\n                    <li class=\"color-naranja-oscuro\">Gestión de trámites en las distintas entidades regulatorias como ser Ministerio de Trabajo, AFP, etc.</li>\n                    <li class=\"color-naranja-oscuro\">Manejo de información y de documentación de manera segura, ordenada y confidencial.</li>\n                    <li class=\"color-naranja-oscuro\">Elaboración de procesos adecuados a las necesidades de cada cliente.</li>\n                    <li class=\"color-naranja-oscuro\">Asesoramiento personalizado.</li>\n                </ul>',NULL,'Gestión administrativa In House del personal del cliente.','Gestión administrativa In House del personal del cliente.','bmimplant-interna','bmimplant-fondo-celeste-claro.png','linea-verde-agua-claro','fondo-bmimplant','fondo-naranja','fondo-bmimplant-interna','bmimplant-fondo-celeste-claro'),(13,'BM Payroll','fondo-celeste-oscuro','bmpayroll','Administramos\r\nla nómina de\r\ntu empresa','Minimizamos los riesgos, asegurando el cumplimiento de la normativa laboral. Esto permite que el cliente pueda enfocarse en aumentar su eficiencia y productividad en otras áreas.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-rosado\">Procesamiento de nómina</li>\n                    <p>- Novedades.</p>\n                    <p>- Revisión de Formularios RC IVA.</p>\n                    <p>- Elaboración de planillas.</p>\n                    <p>- Reportes de planilla de salarios.</p>\n                    <p>- Llenado de formularios MT / Caja / AFP.</p>\n                    <p>- Elaboración y presentación de libros laborales ante el MTESS.</p>\n                    <p>- Comunicaciones del movimiento del personal al MTESS e IPS según requiera.</p>\n                    <p>- Elaboración de Finiquitos.</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-celeste-oscuro font-regular\">Gestión de planillas de sueldos.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Seguridad, confidencialidad y puntualidad en el cumplimiento de obligaciones relacionadas al manejo de planillas.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Asesoramiento personalizado.</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Apoyo permanente de un equipo altamente especializado y actualizado en las distintas áreas vinculadas a la gestión de liquidación de haberes (laboral, impositiva, contable, etc.).</li>\n                    <li class=\"color-celeste-oscuro font-regular\">Propuesta desarrollada a medida para cada cliente, teniendo en cuenta la estructura, procesos, metodología de trabajo, circuitos de información, cultura y cualquier otro factor relevante. </li>\n                    <li class=\"color-celeste-oscuro font-regular\">Excelente relación costo / beneficio.</li>\n                </ul>',NULL,'Gestión de todas las actividades relacionadas a planillas de sueldos de los clientes.','Gestión de todas las actividades relacionadas a planillas de sueldos de los clientes.','bmpayroll-interna','bmpayroll-fondo-azul-marino.png','linea-rosada_animated.svg','fondo-rosado','fondo-celeste-oscuro','fondo-celeste-oscuro','bmpayroll-fondo-azul-marino.png'),(14,'BM Academy','fondo-marron','bmacademy','Objetivo difundir\r\nconocimiento','Este servicio utiliza la plataforma Moodle para ayudar a las empresas, sus áreas y colaboradores a lograr un rendimiento superior. Este nuevo paradigma de educación anuncia una evolución acelerada de nuestra oferta. Para una rápida y exitosa transformación hemos desarrollado una Nueva Estrategia de Educación. Los profesionales están requiriendo maximizar su capacitación y hacer lo mejor de ella.',2,'<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-celeste-oscuro2\">Capacitaciones</li>\n                    <p>- Talleres</p>\n                    <p>- Webinars</p>\n                    <p>- Entrevistas</p>\n                    <p>- Testimonios</p>\n                    <p>- Casos de éxito.</p>\n                    <p>- Reels, Videos, Lives, IGTV.</p>\n                    <p>- Sugerencia / Programas individuales de empleabilidad (completos o diseñados a medida).</p>\n                </ul>','<ul data-aos=\"fade-in\" data-aos-duration=\"3000\" class=\"aos-init aos-animate\">\n                    <li class=\"color-marron font-regular\">Capacitación y motivación del personal.</li>\n                    <li class=\"color-marron font-regular\">Disminución del ausentismo y la rotación.</li>\n                    <li class=\"color-marron font-regular\">Aumento de la identificación del personal hacia la empresa.</li>\n                    <li class=\"color-marron font-regular\">Productividad mejorada y mayor cumplimiento de objetivos.</li>\n                    <li class=\"color-marron font-regular\">Desempeño laboral, eficiencia y productividad superior.</li>\n                </ul>',NULL,'Gestión del conocimiento a través de programas de capacitación.','Gestión del conocimiento a través de programas de capacitación.','bmacademy-interna','bmacademy-fondo-gris.png','linea-celeste-oscuro_animated.svg','fondo-celeste-oscuro2','fondo-marron','fondo-marron','bmacademy-fondo-gris');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `link` longtext,
  `uuid` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'2022-11-13_1945356371738f41576.png','c_nosotros_1',NULL,'197f1759-6418-49dd-9faf-15aaacf4b255','image/png','forest_drakonin(2).png',966698),(2,'2022-11-13_1945356371738f49bc3.png','c_nosotros_1',NULL,'04a5d4bb-ef34-45df-9b5e-ded44c3cef49','image/png','water_drakonin.png',740464),(8,'2022-11-15_0520176373921150ca8.jpg','py',NULL,'bb1fb0db-c606-4834-952d-49f56e937a57','image/jpeg','slide1.jpg',131750),(9,'2022-11-15_052017637392115e7cc.jpg','py',NULL,'a21401f4-b501-498e-8155-038494312c75','image/jpeg','slide2.jpg',135203),(10,'2022-11-15_05201863739212698ff.jpg','py',NULL,'4f6cb946-d747-406b-9382-fec496dcb9f4','image/jpeg','slide3.jpg',130020),(11,'2022-11-15_052032637392205a85a.jpg','bo',NULL,'50430677-e0c3-4b6c-9c14-1900a5f142e0','image/jpeg','slide1.jpg',131750),(12,'2022-11-15_052032637392206603f.jpg','bo',NULL,'1fd6e47c-242e-458c-bd7e-a41e09cb6c8c','image/jpeg','slide2.jpg',135203),(13,'2022-11-15_0520526373923447634.jpg','bo',NULL,'23313028-db17-47de-9674-4c36ca7a4273','image/jpeg','slide3.jpg',130020);
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscriptions_payments`
--

DROP TABLE IF EXISTS `suscriptions_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscriptions_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_suscription_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `status` enum('pending','paid') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscriptions_payments`
--

LOCK TABLES `suscriptions_payments` WRITE;
/*!40000 ALTER TABLE `suscriptions_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `suscriptions_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `email` varchar(512) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `direccion` longtext,
  `telefono` varchar(255) DEFAULT NULL,
  `razon` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  `ci` varchar(255) DEFAULT NULL,
  `enabled` tinyint DEFAULT '0',
  `auth_hash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','d322a7194e5c8fd78b44a46d2b94cd43','arsenalworld@gmail.com',NULL,'Administrador',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'d2b0a8de1a5d7dd5dd9669a9e019ec45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_cards`
--

DROP TABLE IF EXISTS `users_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `alias_token` varchar(255) DEFAULT NULL,
  `card_masked_number` varchar(255) DEFAULT NULL,
  `card_brand` varchar(255) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `card_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_cards`
--

LOCK TABLES `users_cards` WRITE;
/*!40000 ALTER TABLE `users_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_products`
--

DROP TABLE IF EXISTS `users_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_products`
--

LOCK TABLES `users_products` WRITE;
/*!40000 ALTER TABLE `users_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_suscriptions`
--

DROP TABLE IF EXISTS `users_suscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_suscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `status` enum('pending','active','cancelled','due','') DEFAULT 'pending',
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_suscriptions`
--

LOCK TABLES `users_suscriptions` WRITE;
/*!40000 ALTER TABLE `users_suscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_suscriptions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-27  8:20:39
