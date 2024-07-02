-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 00:27:06
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preguntados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`) VALUES
(1, 'Crimenes famosos'),
(2, 'Metodologías de investigación'),
(3, 'Ciencias forenses'),
(4, 'Personajes de ficcion'),
(5, 'Casos sin resolver'),
(6, 'Procedimientos legales'),
(7, 'Psicología criminal'),
(8, 'Motivos y coartadas'),
(9, 'Escenas del crimen'),
(10, 'Tecnologías en la investigación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dificultad`
--

CREATE TABLE `dificultad` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dificultad`
--

INSERT INTO `dificultad` (`id`, `descripcion`) VALUES
(1, 'fácil'),
(2, 'media'),
(3, 'difícil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `numero` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `puntaje` int(11) DEFAULT 0,
  `finalizada` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`numero`, `usuario`, `puntaje`, `finalizada`, `fecha`) VALUES
(1, 'mari', 25, 1, '2024-06-15'),
(2, 'Lucas', 15, 1, '2024-06-15'),
(3, 'Lucas', 10, 1, '2024-06-15'),
(4, 'mariel', 20, 1, '2024-06-15'),
(5, 'mariel', 10, 1, '2024-06-15'),
(6, 'mari', 10, 1, '2024-06-15'),
(7, 'mari', 10, 1, '2024-06-15'),
(8, 'mari', 10, 1, '2024-06-15'),
(9, 'mari', 5, 1, '2024-06-15'),
(10, 'mari', 5, 1, '2024-06-15'),
(11, 'mari', 5, 1, '2024-06-15'),
(12, 'mari', 5, 1, '2024-06-15'),
(13, 'mari', 0, 0, '2024-06-15'),
(14, 'celes', 45, 1, '2024-06-16'),
(23, 'Lucas', 10, 1, '2024-06-16'),
(34, 'Lucas', 5, 1, '2024-06-16'),
(36, 'Lucas', 20, 1, '2024-06-16'),
(37, 'LL', 0, 1, '2024-06-16'),
(38, 'LL', 10, 1, '2024-06-16'),
(39, 'LL', 0, 1, '2024-06-16'),
(40, 'LL', 0, 1, '2024-06-16'),
(52, 'Lucas', 25, 1, '2024-06-19'),
(53, 'Lucas', 25, 1, '2024-06-19'),
(56, 'Lucas', 30, 1, '2024-06-19'),
(57, 'Lucas', 10, 1, '2024-06-19'),
(68, 'Lucas', 0, 1, '2024-06-20'),
(69, 'Lucas', 5, 1, '2024-06-20'),
(70, 'Lucas', 0, 1, '2024-06-20'),
(71, 'Lucas', 0, 1, '2024-06-20'),
(72, 'Lucas', 5, 1, '2024-06-20'),
(73, 'Lucas', 0, 1, '2024-06-20'),
(74, 'Lucas', 15, 1, '2024-06-20'),
(75, 'Lucas', 0, 1, '2024-06-20'),
(76, 'Lucas', 15, 1, '2024-06-20'),
(77, 'Lucas', 5, 1, '2024-06-20'),
(78, 'Lucas', 0, 1, '2024-06-20'),
(79, 'Lucas', 10, 1, '2024-06-20'),
(80, 'Lucas', 20, 1, '2024-06-20'),
(81, 'Lucas', 10, 1, '2024-06-20'),
(82, 'Lucas', 0, 1, '2024-06-20'),
(83, 'Lucas', 50, 1, '2024-06-20'),
(84, 'Lucas', 0, 1, '2024-06-20'),
(85, 'Lucas', 0, 1, '2024-06-20'),
(86, 'Lucas', 5, 1, '2024-06-20'),
(87, 'Lucas', 0, 1, '2024-06-20'),
(88, 'Lucas', 0, 1, '2024-06-20'),
(89, 'Lucas', 55, 1, '2024-06-20'),
(90, 'Lucas', 0, 1, '2024-06-20'),
(91, 'Lucas', 0, 1, '2024-06-20'),
(92, 'Lucas', 0, 1, '2024-06-20'),
(93, 'Lucas', 5, 1, '2024-06-20'),
(94, 'Lucas', 10, 1, '2024-06-20'),
(95, 'Lucas', 5, 1, '2024-06-20'),
(96, 'Lucas', 10, 1, '2024-06-20'),
(97, 'Lucas', 15, 1, '2024-06-20'),
(98, 'Lucas', 0, 1, '2024-06-20'),
(99, 'Lucas', 35, 1, '2024-06-20'),
(100, 'Lucas', 5, 1, '2024-06-20'),
(101, 'Lucas', 0, 1, '2024-06-20'),
(102, 'Lucas', 5, 1, '2024-06-20'),
(103, 'Lucas', 5, 1, '2024-06-20'),
(104, 'Lucas', 10, 1, '2024-06-21'),
(105, 'Lucas', 0, 1, '2024-06-23'),
(106, 'Lucas', 0, 1, '2024-06-23'),
(107, 'Lucas', 0, 1, '2024-06-23'),
(108, 'Lucas', 5, 1, '2024-06-23'),
(109, 'Lucas', 0, 1, '2024-06-23'),
(110, 'Lucas', 0, 1, '2024-06-23'),
(111, 'Lucas', 0, 1, '2024-06-23'),
(112, 'Lucas', 0, 1, '2024-06-23'),
(113, 'Lucas', 0, 1, '2024-06-23'),
(114, 'Lucas', 5, 1, '2024-06-23'),
(115, 'Lucas', 0, 1, '2024-06-23'),
(116, 'Lucas', 0, 1, '2024-06-23'),
(117, 'Lucas', 0, 1, '2024-06-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` int(11) NOT NULL,
  `dificultad` int(11) NOT NULL,
  `cant_aciertos` int(11) NOT NULL,
  `cant_entregadas` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `categoria`, `dificultad`, `cant_aciertos`, `cant_entregadas`, `fecha_creacion`) VALUES
(1, '¿Cuál es el nombre del asesino conocido como \"Jack el Destripador\"?', 1, 1, 80, 100, '2024-06-19'),
(2, '¿Cuál fue el motivo del asesinato de John Lennon?', 1, 1, 80, 100, '2024-06-19'),
(3, '¿Cuál es la primera etapa en el método científico aplicado a investigaciones criminales?', 2, 1, 80, 100, '2024-06-19'),
(4, '¿Cuál es una técnica común en la investigación cualitativa?', 2, 1, 80, 100, '2024-06-19'),
(5, '¿Qué analiza la balística forense?', 3, 1, 80, 100, '2024-06-19'),
(6, '¿Cuál es la función principal de un médico forense?', 3, 1, 80, 100, '2024-06-19'),
(7, '¿Quién es el detective protagonista en las novelas de Arthur Conan Doyle?', 4, 1, 80, 100, '2024-06-19'),
(8, '¿En qué serie aparece el personaje de Dexter Morgan?', 4, 1, 80, 100, '2024-06-19'),
(9, '¿Qué caso sin resolver involucra un secuestro de un avión en 1971?', 5, 1, 80, 100, '2024-06-19'),
(10, '¿Qué famoso asesino en serie nunca fue capturado?', 5, 1, 80, 100, '2024-06-19'),
(11, '¿Qué es una orden de registro?', 6, 1, 80, 100, '2024-06-19'),
(12, '¿Qué es la fianza?', 6, 1, 80, 100, '2024-06-19'),
(13, '¿Qué estudia la psicología criminal?', 7, 3, 20, 100, '2024-06-19'),
(14, '¿Qué es un perfil criminal?', 7, 1, 80, 100, '2024-06-19'),
(15, '¿Cuál es un motivo común en los crímenes pasionales?', 8, 1, 80, 100, '2024-06-19'),
(16, '¿Qué es una coartada?', 8, 1, 80, 100, '2024-06-19'),
(17, '¿Qué se debe hacer primero al llegar a una escena del crimen?', 9, 2, 50, 100, '2024-06-19'),
(18, '¿Qué se utiliza para detectar huellas dactilares?', 9, 3, 20, 100, '2024-06-19'),
(19, '¿Qué tecnología se utiliza para analizar el ADN en una investigación criminal?', 10, 3, 20, 100, '2024-06-19'),
(20, '¿Cuál es el uso principal del software de reconocimiento facial en investigaciones?', 10, 3, 20, 100, '2024-06-19'),
(21, '¿Quién fue conocido como \"El asesino del zodiaco\"?', 1, 3, 20, 100, '2024-06-19'),
(22, '¿Qué criminal era apodado \"El Carnicero de Milwaukee\"?', 1, 3, 20, 100, '2024-06-19'),
(23, '¿Cuál fue el nombre real del asesino conocido como \"Son of Sam\"?', 1, 3, 20, 100, '2024-06-19'),
(24, '¿Quién fue condenado por el asesinato de Laci Peterson?', 1, 1, 80, 100, '2024-06-19'),
(25, '¿Qué miembro de \"The Manson Family\" fue responsable de la mayoría de los asesinatos?', 1, 1, 80, 100, '2024-06-19'),
(26, '¿Quién fue apodado \"El asesino de la caja de juguetes\"?', 1, 1, 80, 100, '2024-06-19'),
(27, '¿En qué ciudad fueron asesinados los niños por el \"Asesino del Río Verde\"?', 1, 2, 50, 100, '2024-06-19'),
(28, '¿Qué famoso ladrón y criminal fue apodado \"El Enemigo Público Número Uno\"?', 1, 1, 80, 100, '2024-06-19'),
(29, '¿Quién fue el asesino conocido como \"BTK\" (Bind, Torture, Kill)?', 1, 1, 80, 100, '2024-06-19'),
(30, '¿Qué famoso caso de secuestro involucró a Patty Hearst?', 1, 1, 80, 100, '2024-06-19'),
(31, '¿Qué criminal estadounidense fue conocido por sus robos a bancos durante la Gran Depresión?', 1, 1, 80, 100, '2024-06-19'),
(32, '¿Quién fue el asesino serial conocido como \"El estrangulador de Boston\"?', 1, 1, 80, 100, '2024-06-19'),
(33, '¿Quién fue el responsable del atentado de Oklahoma City en 1995?', 1, 2, 50, 100, '2024-06-19'),
(34, '¿Qué asesino en serie fue también conocido como \"The Night Stalker\"?', 1, 2, 50, 100, '2024-06-19'),

(36, '¿Qué asesino en serie fue apodado \"El Payaso Asesino\"?', 1, 1, 80, 100, '2024-06-19'),
(37, '¿Qué famoso crimen ocurrió en la mansión de Sharon Tate en 1969?', 1, 1, 80, 100, '2024-06-19'),
(38, '¿Qué asesino en serie estadounidense era conocido por disfrazarse de payaso en fiestas infantiles?', 1, 1, 80, 100, '2024-06-19'),
(39, '¿Quién fue el responsable del atentado con bomba en los Juegos Olímpicos de Atlanta en 1996?', 1, 1, 80, 100, '2024-06-19'),
(40, '¿Qué tipo de muestreo se utiliza cuando cada miembro de la población tiene la misma probabilidad de ser seleccionado?', 2, 2, 50, 100, '2024-06-19'),
(41, '¿Qué tipo de investigación se centra en la comprensión de fenómenos complejos a través de la recopilación de datos no numéricos?', 2, 2, 50, 100, '2024-06-19'),
(42, '¿Cuál es el propósito principal de una revisión de literatura en un proyecto de investigación?', 2, 2, 50, 100, '2024-06-19'),
(43, '¿Cuál es la diferencia principal entre un estudio experimental y un estudio correlacional?', 2, 3, 20, 100, '2024-06-19'),
(44, '¿Qué diseño de investigación se utiliza para determinar la relación entre dos o más variables sin manipularlas?', 2, 1, 80, 100, '2024-06-19'),
(45, '¿Qué tipo de investigación se caracteriza por su enfoque en la práctica y la aplicación de resultados para resolver problemas específicos?', 2, 1, 80, 100, '2024-06-19'),
(46, '¿Qué técnica de recopilación de datos implica la observación directa del comportamiento en su entorno natural?', 2, 1, 80, 100, '2024-06-19'),
(47, '¿Qué tipo de investigación se lleva a cabo con el propósito de ampliar el conocimiento general sin una aplicación inmediata?', 2, 2, 50, 100, '2024-06-19'),
(48, '¿Cuál es el objetivo principal de la triangulación en la investigación?', 2, 1, 80, 100, '2024-06-19'),
(49, '¿Qué técnica forense se utiliza para determinar la edad de un cadáver?', 3, 1, 80, 100, '2024-06-19'),
(50, '¿Qué componente de la sangre es utilizado comúnmente para la identificación de personas en escenas de crimen?', 3, 3, 20, 100, '2024-06-19'),
(51, '¿Cuál de los siguientes tipos de evidencia es más útil para determinar la causa de un incendio?', 3, 3, 20, 100, '2024-06-19'),
(52, '¿Cuál de las siguientes opciones se utiliza para determinar la hora de la muerte en ausencia de un médico forense?', 3, 3, 20, 100, '2024-06-19'),
(53, '¿Qué técnica se utiliza para identificar la composición química de una sustancia desconocida en el laboratorio forense?', 3, 1, 80, 100, '2024-06-19'),
(54, '¿Qué tipo de evidencia se puede recolectar a partir de la descomposición de un cuerpo en el agua?', 3, 2, 50, 100, '2024-06-19'),
(55, '¿Cuál es el término utilizado para la comparación de marcas de mordeduras con la dentadura de un sospechoso?', 3, 2, 50, 100, '2024-06-19'),
(56, '¿Qué tipo de evidencia es crucial en la investigación de delitos sexuales?', 3, 2, 50, 100, '2024-06-19'),
(57, '¿Cuál es el término para la reconstrucción de la escena de un crimen basada en la evidencia física?', 3, 1, 80, 100, '2024-06-19'),
(58, '¿Qué secciones de un cabello se pueden utilizar para el análisis de ADN?', 3, 1, 80, 100, '2024-06-19'),

(60, '¿Qué personaje ficticio es un detective privado creado por Raymond Chandler, conocido por su cinismo y su narración en primera persona?', 4, 3, 20, 100, '2024-06-19'),
(61, '¿Quién es el protagonista de las novelas de Agatha Christie, un detective belga conocido por su meticulosidad y sus \"células grises\"?', 4, 3, 20, 100, '2024-06-19'),
(62, '¿Qué personaje ficticio es un famoso detective creado por Edgar Allan Poe, conocido por su brillantez mental y su enfoque deductivo?', 4, 3, 20, 100, '2024-06-19'),
(63, '¿Quién es el protagonista de las novelas de Sue Grafton, una detective privada conocida por su ingenio y su determinación?', 4, 1, 80, 100, '2024-06-19'),
(64, '¿Qué personaje ficticio es conocido como el \"Doctor de la Muerte\" en las historias de misterio de Sir Arthur Conan Doyle?', 4, 2, 50, 100, '2024-06-19'),
(65, '¿Quién es el famoso asesino en serie ficticio creado por Thomas Harris, conocido por su inteligencia y su gusto por la carne humana?', 4, 2, 50, 100, '2024-06-19'),
(66, '¿Qué personaje ficticio es conocido como \"El Caballero Oscuro\" y lucha contra el crimen en Gotham City?', 4, 1, 80, 100, '2024-06-19'),
(67, '¿Quién es el protagonista de las novelas de Dan Brown, un simbólogo que resuelve misteriosos enigmas históricos?', 4, 1, 80, 100, '2024-06-19'),
(68, '¿Qué personaje ficticio es un famoso investigador paranormal creado por H.P. Lovecraft, conocido por su interés en lo oculto y lo sobrenatural?', 4, 1, 80, 100, '2024-06-19'),
(69, '¿Cuál de los siguientes casos sin resolver involucra la misteriosa desaparición de un avión con 239 personas a bordo en 2014?', 5, 3, 20, 100, '2024-06-19'),
(70, '¿Qué caso sin resolver implica el asesinato de una joven estadounidense en su casa en Boulder, Colorado, en 1996?', 5, 3, 20, 100, '2024-06-19'),
(71, '¿Qué caso sin resolver involucra el secuestro y asesinato de una niña de seis años en Australia en 1972?', 5, 1, 80, 100, '2024-06-19'),
(72, '¿Qué misterioso caso sin resolver implica la desaparición de un vuelo militar de entrenamiento en 1945 en el Triángulo de las Bermudas?', 5, 3, 20, 100, '2024-06-19'),
(73, '¿Qué caso sin resolver implica la muerte de una actriz de Hollywood en 1921, cuya causa aún se desconoce?', 5, 1, 80, 100, '2024-06-19'),
(74, '¿Cuál es el nombre del asesino en serie desconocido que aterrorizó a San Francisco en la década de 1960, dejando mensajes crípticos en códigos', 5, 2, 50, 100, '2024-06-19'),
(75, '¿Qué caso sin resolver implica la desaparición de tres niños en el estado de Misuri en 1992, después de ser vistos por última vez en un parque?', 5, 1, 80, 100, '2024-06-19'),
(76, '¿Qué misterioso caso sin resolver implica la desaparición de una mujer y su hija en la región de los Apalaches en 1943?', 5, 1, 80, 100, '2024-06-19'),
(77, '¿Cuál es el nombre del hombre no identificado que secuestró y asesinó a varias niñas en Los Ángeles en la década de 1920?', 5, 2, 50, 100, '2024-06-19'),
(78, '¿Qué caso sin resolver involucra la desaparición de un joven en Nueva York en 1979, cuyo paradero sigue siendo desconocido?', 5, 1, 80, 100, '2024-06-19'),
(79, '¿Qué término legal se utiliza para describir el acto de matar a alguien intencionalmente y con premeditación?', 6, 3, 20, 100, '2024-06-19'),
(80, '¿Cuál es el término legal para el acto de privar ilegalmente a una persona de su libertad, a menudo exigiendo un rescate a cambio de su liberación?', 6, 3, 20, 100, '2024-06-19'),
(81, '¿Qué tipo de abuso implica el uso de la fuerza física, la intimidación o la negligencia para causar daño o sufrimiento a un niño?', 6, 3, 20, 100, '2024-06-19'),
(82, '¿Cuál es el término legal para la desaparición inexplicada y sospechosa de una persona, a menudo asociada con un posible delito?', 6, 2, 50, 100, '2024-06-19'),
(83, '¿Qué término legal se refiere al acto de negar a alguien el derecho a un juicio justo al influir indebidamente en el proceso judicial?', 6, 2, 50, 100, '2024-06-19'),
(84, '¿Qué tipo de abuso implica el comportamiento sexual no deseado o inapropiado hacia otra persona?', 6, 2, 50, 100, '2024-06-19'),
(85, '¿Qué término legal se utiliza para describir la conducta abusiva que causa daño emocional o psicológico a una persona?', 6, 1, 5, 16, '2024-06-19'),
(86, '¿Qué término legal se refiere a la retención indebida o ilegal de propiedad perteneciente a otra persona con la intención de privarla permanentemente de ella?', 6, 3, 20, 100, '2024-06-19'),
(87, '¿Qué término legal se utiliza para describir la conducta abusiva que causa daño físico o lesiones a una persona?', 6, 1, 80, 100, '2024-06-19'),

(89, '¿Cuál de los siguientes no es un motivo común para cometer un crimen?', 8, 1, 80, 100, '2024-06-19'),
(90, '¿Qué coartada es más difícil de verificar?', 8, 3, 20, 100, '2024-06-19'),
(91, '¿Qué tipo de coartada podría ser más fácilmente refutada?', 8, 1, 80, 100, '2024-06-19'),

(93, '¿Qué tipo de coartada sería más difícil de demostrar en un juicio?', 8, 1, 80, 100, '2024-06-19'),
(94, '¿Cuál de los siguientes es un posible motivo para cometer fraude?', 8, 1, 80, 100, '2024-06-19'),
(95, '¿Qué tipo de coartada podría ser más fácilmente fabricada?', 8, 2, 50, 100, '2024-06-19'),
(96, '¿Cuál de los siguientes no suele ser un motivo en un crimen organizado?', 8, 2, 50, 100, '2024-06-19'),
(97, '¿Cuál de las siguientes coartadas es más difícil de refutar?', 8, 2, 50, 100, '2024-06-19'),
(98, '¿Qué suele ser un motivo en crímenes políticos?', 8, 1, 80, 100, '2024-06-19'),
(99, '¿Qué tipo de coartada sería más difícil de corroborar?', 8, 1, 80, 100, '2024-06-19'),
(100, '¿Qué podría ser un motivo común en crímenes de odio?', 8, 1, 80, 100, '2024-06-19'),


(103, '¿Qué tipo de coartada sería más difícil de desmontar si se trata de un crimen premeditado?', 8, 1, 80, 100, '2024-06-19'),
(104, '¿Qué suele ser un motivo en crímenes de terrorismo?', 8, 1, 80, 100, '2024-06-19'),
(105, '¿Qué tipo de coartada sería más fácilmente refutable si se deja un rastro digital?', 8, 1, 80, 100, '2024-06-19'),
(106, '¿Qué podría ser un motivo en crímenes de narcotráfico?', 8, 1, 80, 100, '2024-06-19'),
(107, '¿Qué tipo de coartada sería más difícil de refutar si se cuenta con cómplices dispuestos a mentir?', 8, 1, 80, 100, '2024-06-19'),
(108, '¿Cuál de los siguientes es un posible motivo en crímenes por crimen organizado?', 8, 1, 80, 100, '2024-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_de_usuario`
--

CREATE TABLE `preguntas_de_usuario` (
  `id` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuestas` text NOT NULL,
  `respuesta_correcta` text NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_de_usuario`
--

INSERT INTO `preguntas_de_usuario` (`id`, `pregunta`, `respuestas`, `respuesta_correcta`, `usuario`, `fecha`, `categoria`) VALUES
(3, 'Como me llamo?', '[\"Celeste\",\"Mariel\",\"Lucas\",\"Otro\"]', '4', 'Lucas', '2024-06-23', 1),
(4, 'Una pregunta random', '[\"algo\",\"otra cosa\",\"otra cosa mas\",\"ya no se que poner\"]', '1', 'Lucas', '2024-06-23', 2),
(5, 'Pregunta', '[\"Respuesta\",\"Respuesta\",\"Respuesta\",\"Respuesta\"]', '3', 'Lucas', '2024-06-23', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_reportada`
--

CREATE TABLE `pregunta_reportada` (
  `id` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `reporte` text NOT NULL,
  `resuelto` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta_reportada`
--

INSERT INTO `pregunta_reportada` (`id`, `id_pregunta`, `reporte`, `resuelto`, `fecha_creacion`) VALUES
(4, 42, 'la pregunta no es clara ', 0, '2024-06-21'),
(5, 81, 'creo que la respuesta marcada como correcta no lo es ', 0, '2024-06-21'),
(6, 17, 'hay mas de una respuesta correcta ', 0, '2024-06-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `es_correcta` tinyint(1) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `descripcion`, `es_correcta`, `id_pregunta`) VALUES
(1, 'A) John Wayne Gacy', 0, 1),
(2, 'B) Ted Bundy', 0, 1),
(3, 'C) H.H. Holmes', 0, 1),
(4, 'D) Se desconoce', 1, 1),
(5, 'A)Robo', 0, 2),
(6, 'B) Fan obsesionado', 1, 2),
(7, 'C) Venganza', 0, 2),
(8, 'D) Disputa familiar', 0, 2),
(9, 'A) Formulación de hipótesis', 0, 3),
(10, 'B) Observación', 1, 3),
(11, 'C) Análisis de datos', 0, 3),
(12, 'D) Publicación de resultados', 0, 3),
(13, 'A) Análisis estadístico', 0, 4),
(14, 'B) Entrevistas en profundidad', 1, 4),
(15, 'C) Ensayo clínico', 0, 4),
(16, 'D) Encuestas masivas', 0, 4),
(17, 'A) Huellas dactilares', 0, 5),
(18, 'B) Armas de fuego', 1, 5),
(19, 'C) Toxinas', 0, 5),
(20, 'D) ADN', 0, 5),
(21, 'A) Interrogar testigos', 0, 6),
(22, 'B) Determinar la causa de muerte', 1, 6),
(23, 'C) Realizar arrestos', 0, 6),
(24, 'D) Investigar incendios', 0, 6),
(25, 'A) Hercule Poirot', 0, 7),
(26, 'B) Philip Marlowe', 0, 7),
(27, 'C) Sam Spade', 0, 7),
(28, 'D) Sherlock Holmes', 1, 7),
(29, 'A) Breaking Bad', 0, 8),
(30, 'B) The Sopranos', 0, 8),
(31, 'C) Dexter', 1, 8),
(32, 'D) True Detective', 0, 8),
(33, 'A) Caso Zodiac', 0, 9),
(34, 'B) Caso D.B. Cooper', 1, 9),
(35, 'C) Caso Black Dahlia', 0, 9),
(36, 'D) Caso Jack el Destripador', 0, 9),
(37, 'A) Ted Bundy', 0, 10),
(38, 'B) Jeffrey Dahmer', 0, 10),
(39, 'C) Zodiac', 1, 10),
(40, 'D) Richard Ramirez', 0, 10),
(41, 'A) Permiso para arrestar a alguien', 0, 11),
(42, 'B) Permiso para revisar una propiedad', 1, 11),
(43, 'C) Permiso para interrogar a un sospechoso', 0, 11),
(44, 'D) Permiso para obtener registros telefónicos', 0, 11),
(45, 'A) Pago para salir de prisión temporalmente', 1, 12),
(46, 'B) Monto de dinero confiscado', 0, 12),
(47, 'C) Multa por mal comportamiento', 0, 12),
(48, 'D) Pago por daños y perjuicios', 0, 12),
(49, 'A) Comportamiento de los testigos', 0, 13),
(50, 'B) Personalidad de los criminales', 1, 13),
(51, 'C) Efectos de las drogas', 0, 13),
(52, 'D) Técnicas de interrogación', 0, 13),
(53, 'A) Descripción física del sospechoso', 0, 14),
(54, 'B) Análisis de la escena del crimen', 0, 14),
(55, 'C) Evaluación psicológica del delincuente', 1, 14),
(56, 'D) Interrogatorio de testigos', 0, 14),
(57, 'A) Venganza', 0, 15),
(58, 'B) Celos', 1, 15),
(59, 'C) Robo', 0, 15),
(60, 'D) Poder', 0, 15),
(61, 'A) Prueba de inocencia', 1, 16),
(62, 'B) Prueba de culpabilidad', 0, 16),
(63, 'C) Método de asesinato', 0, 16),
(64, 'D) Motivo del crimen', 0, 16),
(65, 'A) Aislar la zona', 1, 17),
(66, 'B) Interrogar testigos', 0, 17),
(67, 'C) Arrestar sospechosos', 0, 17),
(68, 'D) Analizar evidencia', 0, 17),
(69, 'A) Ultrasonido', 0, 18),
(70, 'B) Rayos X', 0, 18),
(71, 'C) Reactivos químicos', 1, 18),
(72, 'D) Cámara térmica', 0, 18),
(73, 'A) Espectroscopia', 0, 19),
(74, 'B) Rayos UV', 0, 19),
(75, 'C) PCR', 1, 19),
(76, 'D) Análisis de suelos', 0, 19),
(77, 'A) Interrogar sospechosos', 0, 20),
(78, 'B) Identificar personas', 1, 20),
(79, 'C) Analizar armas', 0, 20),
(80, 'D) Investigar incendios', 0, 20),
(81, 'A) Ted Bundy', 0, 21),
(82, 'B) Richard Ramirez', 0, 21),
(83, 'C) Jack el Destripador', 0, 21),
(84, 'D) Se desconoce su identidad', 1, 21),
(85, 'A) John Wayne Gacy', 0, 22),
(86, 'B) Jeffrey Dahmer', 1, 22),
(87, 'C) David Berkowitz', 0, 22),
(88, 'D) Charles Manson', 0, 22),
(89, 'A) Charles Manson', 0, 23),
(90, 'B) Ted Bundy', 0, 23),
(91, 'C) David Berkowitz', 1, 23),
(92, 'D) Richard Ramirez', 0, 23),
(93, 'A) Scott Peterson', 1, 24),
(94, 'B) Drew Peterson', 0, 24),
(95, 'C) Michael Peterson', 0, 24),
(96, 'D) John Peterson', 0, 24),
(97, 'A) Leslie Van Houten', 0, 25),
(98, 'B) Patricia Krenwinkel', 0, 25),
(99, 'C) Susan Atkins', 0, 25),
(100, 'D) Charles \"Tex\" Watson', 1, 25),
(101, 'A) Ed Gein', 0, 26),
(102, 'B) David Parker Ray', 1, 26),
(103, 'C) Albert Fish', 0, 26),
(104, 'D) Dennis Rader', 0, 26),
(105, 'A)Nueva York', 0, 27),
(106, 'B) Seattle', 1, 27),
(107, 'C) Chicago', 0, 27),
(108, 'D) Los Ángeles', 0, 27),
(109, 'A) Jesse James', 0, 28),
(110, 'B) John Dillinger', 1, 28),
(111, 'C) Al Capone', 0, 28),
(112, 'D) Pretty Boy Floyd', 0, 28),
(113, 'A) Ted Kaczynski', 0, 29),
(114, 'B) Ed Kemper', 0, 29),
(115, 'C) Dennis Rader', 1, 29),
(116, 'D) Gary Ridgway', 0, 29),
(117, 'A) El secuestro de Lindbergh', 0, 30),
(118, 'B) El secuestro de Jaycee Dugard', 0, 30),
(119, 'C) El secuestro de Elizabeth Smart', 0, 30),
(120, 'D) El secuestro de Patty Hearst por el SLA', 1, 30),
(121, 'A) Bonnie y Clyde', 0, 31),
(122, 'B) Machine Gun Kelly', 0, 31),
(123, 'C) Baby Face Nelson', 0, 31),
(124, 'D) John Dillinger', 1, 31),
(125, 'A) Albert DeSalvo', 1, 32),
(126, 'B) Richard Speck', 0, 32),
(127, 'C) Ted Bundy', 0, 32),
(128, 'D) John Wayne Gacy', 0, 32),
(129, 'A) Terry Nichols', 0, 33),
(130, 'B) Timothy McVeigh', 1, 33),
(131, 'C) Eric Harris', 0, 33),
(132, 'D) Dylan Klebold', 0, 33),
(133, 'A) Ted Bundy', 0, 34),
(134, 'B) Richard Ramirez', 1, 34),
(135, 'C) David Berkowitz', 0, 34),
(136, 'D) Jeffrey Dahmer', 0, 34),

(141, 'A) Richard Speck', 0, 36),
(142, 'B) Ed Kemper', 0, 36),
(143, 'C) John Wayne Gacy', 1, 36),
(144, 'D) Ted Bundy', 0, 36),
(145, 'A) El asesinato de Leno y Rosemary LaBianca', 0, 37),
(146, 'B) El asesinato de la actriz Sharon Tate y sus amigos', 1, 37),
(147, 'C) El asesinato de Nicole Brown Simpson', 0, 37),
(148, 'D) El asesinato de Lana Turner', 0, 37),
(149, 'A) Ted Bundy', 0, 38),
(150, 'B) Richard Ramirez', 0, 38),
(151, 'C) John Wayne Gacy', 1, 38),
(152, 'D) Jeffrey Dahmer', 0, 38),
(153, 'A) Timothy McVeigh', 0, 39),
(154, 'B) Terry Nichols', 0, 39),
(155, 'C) Eric Robert Rudolph', 1, 39),
(156, 'D) Ted Kaczynski', 0, 39),
(165, 'A) Muestreo por conveniencia', 0, 40),
(166, 'B) Muestreo intencional', 0, 40),
(167, 'C) Muestreo aleatorio simple', 1, 40),
(168, 'D) Muestreo por cuotas', 0, 40),
(169, 'A) Investigación cuantitativa', 0, 41),
(170, 'B) Investigación experimental', 0, 41),
(171, 'C) Investigación cualitativa', 1, 41),
(172, 'D) Investigación correlacional', 0, 41),
(173, 'A) Recopilar datos primarios', 0, 42),
(174, 'B) Formular hipótesis', 0, 42),
(175, 'C) Analizar resultados', 0, 42),
(176, 'D) Revisar estudios previos sobre el tema', 1, 42),
(177, 'A) El uso de encuestas', 0, 43),
(178, 'B) La manipulación de variables', 1, 43),
(179, 'C) El análisis de datos cualitativos', 0, 43),
(180, 'D) La revisión de literatura', 0, 43),
(181, 'A) Diseño experimental', 0, 44),
(182, 'B) Diseño cuasi-experimental', 0, 44),
(183, 'C) Diseño correlacional', 1, 44),
(184, 'D) Diseño exploratorio', 0, 44),
(185, 'A) Investigación teórica', 0, 45),
(186, 'B) Investigación aplicada', 1, 45),
(187, 'C) Investigación básica', 0, 45),
(188, 'D) Investigación exploratoria', 0, 45),
(189, 'A) Entrevista estructurada\r\n', 0, 46),
(190, 'B) Encuesta', 0, 46),
(191, 'C) Observación participante', 1, 46),
(192, 'D) Revisión documental', 0, 46),
(193, 'A) Investigación aplicada', 0, 47),
(194, 'B) Investigación básica', 1, 47),
(195, 'C) Investigación correlacional', 0, 47),
(196, 'D) Investigación descriptiva', 0, 47),
(197, 'A) Aumentar el tamaño de la muestra', 0, 48),
(198, 'B) Reducir el sesgo del investigador', 0, 48),
(199, 'C) Utilizar múltiples métodos para corroborar los resultados', 1, 48),
(200, 'D) Simplificar el análisis de datos', 0, 48),
(201, 'A) Radiografía', 0, 49),
(202, 'B) Autopsia', 0, 49),
(203, 'C) Análisis de ADN', 0, 49),
(204, 'D) Entomología forense', 1, 49),
(205, 'A) Hemoglobina', 0, 50),
(206, 'B) Glóbulos rojos', 0, 50),
(207, 'C) ADN', 1, 50),
(208, 'D) Plaquetas', 0, 50),
(209, 'A) Testimonios de testigos', 0, 51),
(210, 'B) Análisis de residuos de acelerante', 1, 51),
(211, 'C) Huellas dactilares', 0, 51),
(212, 'D) Análisis de teléfono celular', 0, 51),
(217, 'A) Rigor mortis', 0, 52),
(218, 'B) Temperatura corporal', 0, 52),
(219, 'C) Livideces cadavéricas', 0, 52),
(220, 'D) Todas las anteriores', 1, 52),
(221, 'A) Cromatografía', 1, 53),
(222, 'B) Análisis de huellas dactilares', 0, 53),
(223, 'C) Fotografía forense', 0, 53),
(224, 'D) Radiografía', 0, 53),
(225, 'A) Fibra de vidrio', 0, 54),
(226, 'B) Plantas acuáticas', 0, 54),
(227, 'C) Diatomeas', 1, 54),
(228, 'D) Perlas', 0, 54),
(229, 'A) Entomología forense', 0, 55),
(230, 'B) Odontología forense', 1, 55),
(231, 'C) Toxicología', 0, 55),
(232, 'D) Antropología forense', 0, 55),
(233, 'A) Fibra de vidrio', 0, 56),
(234, 'B) Análisis de telefonía móvil', 0, 56),
(235, 'C) ADN', 1, 56),
(236, 'D) Análisis de escritura', 0, 56),
(237, 'A) Perfilación criminal', 0, 57),
(238, 'B) Reconstrucción forense', 1, 57),
(239, 'C) Entomología forense', 0, 57),
(240, 'D) Análisis de fibras', 0, 57),
(241, 'A) Cutícula', 0, 58),
(242, 'B) Médula', 0, 58),
(243, 'C) Folículo piloso', 1, 58),
(244, 'D) Todas las anteriores', 0, 58),

(249, 'A) Sam Spade', 0, 60),
(250, 'B) Miss Marple', 0, 60),
(251, 'C) Philip Marlowe', 1, 60),
(252, 'D) Nero Wolfe', 0, 60),
(253, 'A) Lord Peter Wimsey\r\n', 0, 61),
(254, 'B) Jessica Fletcher', 0, 61),
(255, 'C) Hercule Poirot', 1, 61),
(256, 'D) Ellery Queen', 0, 61),
(257, 'A) Hercule Poirot', 0, 62),
(258, 'B) Sherlock Holmes', 0, 62),
(259, 'C) C. Auguste Dupin', 1, 62),
(260, 'D) Father Brown', 0, 62),
(261, 'A) Kinsey Millhone', 1, 63),
(262, 'B) Stephanie Plum', 0, 63),
(263, 'C) V.I. Warshawski', 0, 63),
(264, 'D) Tess Monaghan', 0, 63),
(265, 'A) Profesor Moriarty', 1, 64),
(266, 'B) Dr. Jekyll', 0, 64),
(267, 'C) Dr. Watson', 0, 64),
(268, 'D) Dr. Fu Manchú', 0, 64),
(269, 'A) Hannibal Lecter', 1, 65),
(270, 'B) Dexter Morgan', 0, 65),
(271, 'C) Norman Bates', 0, 65),
(272, 'D) Patrick Bateman', 0, 65),
(273, 'A) Spider-Man', 0, 66),
(274, 'B) Iron Man', 0, 66),
(275, 'C) Batman', 1, 66),
(276, 'D) Superman', 0, 66),
(277, 'A) Robert Langdon', 1, 67),
(278, 'B) Jack Reacher', 0, 67),
(279, 'C) Harry Bosch', 0, 67),
(280, 'D) Alex Cross', 0, 67),
(281, 'A) Sherlock Holmes', 0, 68),
(282, 'B) Hercule Poirot', 0, 68),
(283, 'C) Cthulhu', 1, 68),
(284, 'D) John Constantine', 0, 68),
(285, 'A) Caso Zodiac', 0, 69),
(286, 'B) Vuelo 19', 0, 69),
(287, 'C) Vuelo MH370', 1, 69),
(288, 'D) El caso de la Isla de Pascua', 0, 69),
(289, 'A) El caso del asesinato de JonBenét Ramsey', 1, 70),
(290, 'B) El caso de Jack el Destripador', 0, 70),
(291, 'C) El caso de la Dalia Negra', 0, 70),
(292, 'D) El caso de la Viuda Negra', 0, 70),
(293, 'A) El caso de Madeleine McCann', 0, 71),
(294, 'B) El caso de Etan Patz', 0, 71),
(295, 'C) El caso de Beaumont', 0, 71),
(296, 'D) El caso de la desaparición de la niña Azaria Chamberlain', 1, 71),
(297, 'A) Caso de los niños del bosque', 0, 72),
(298, 'B) Vuelo 19', 1, 72),
(299, 'C) El caso de D.B. Cooper', 0, 72),
(300, 'D) Caso de la aeronave de Frederick Valentich', 0, 72),
(301, 'A) El caso de la Viuda Negra', 0, 73),
(302, 'B) El caso de la Dalia Negra', 0, 73),
(303, 'C) El caso de Marilyn Monroe', 0, 73),
(304, 'D) El caso de Olive Thomas', 1, 73),
(305, 'A) El asesino del Zodiaco', 1, 74),
(306, 'B) El estrangulador de Boston', 0, 74),
(307, 'C) El destripador de Yorkshire', 0, 74),
(308, 'D) El asesino del Golden State', 0, 74),
(309, 'A) El caso de los niños del bosque', 1, 75),
(310, 'B) El caso de la Isla de Pascua', 0, 75),
(311, 'C) El caso de los Boy Scouts perdidos', 0, 75),
(312, 'D) El caso de los tres hermanos desaparecidos', 0, 75),
(313, 'A) El caso de la Viuda Negra', 1, 76),
(314, 'B) El caso de la Dalia Negra', 0, 76),
(315, 'C) El caso de la desaparición de la niña Azaria Chamberlain', 0, 76),
(316, 'D) El caso de la mujer perdida en las montañas', 0, 76),
(317, 'A) El asesino del Golden State', 0, 77),
(318, 'B) El estrangulador de Boston', 1, 77),
(319, 'C) El asesino del Zodiaco', 0, 77),
(320, 'D) El asesino del niño negro', 0, 77),
(321, 'A) El caso de Madeleine McCann', 0, 78),
(322, 'B) El caso de Etan Patz', 1, 78),
(323, 'C) El caso de la Isla de Pascua', 0, 78),
(324, 'D) El caso de los Boy Scouts perdidos', 0, 78),
(325, 'A) Homicidio', 0, 79),
(326, 'B) Asesinato', 1, 79),
(327, 'C) Involuntario', 0, 79),
(328, 'D) Legítima defensa', 0, 79),
(329, 'A) Abuso', 0, 80),
(330, 'B) Secuestro', 1, 80),
(331, 'C) Extorsión', 0, 80),
(332, 'D) Coacción', 0, 80),
(333, 'A) Abuso emocional', 0, 81),
(334, 'B) Abuso sexual', 0, 81),
(335, 'C) Maltrato infantil', 1, 81),
(336, 'D) Abandono', 0, 81),
(337, 'A) Extravío', 0, 82),
(338, 'B) Fuga', 0, 82),
(339, 'C) Desaparición forzada', 0, 82),
(340, 'D) Secuestro', 1, 82),
(341, 'A) Soborno', 0, 83),
(342, 'B) Obstrucción de la justicia', 1, 83),
(343, 'C) Manipulación de pruebas', 0, 83),
(344, 'D) Cohecho', 0, 83),
(345, 'A) Abuso emocional', 0, 84),
(346, 'B) Abuso físico', 0, 84),
(347, 'C) Abuso sexual', 1, 84),
(348, 'D) Acoso', 0, 84),
(349, 'A) Abuso verbal', 0, 85),
(350, 'B) Abuso mental', 0, 85),
(351, 'C) Acoso', 0, 85),
(352, 'D) Abuso emocional', 1, 85),
(353, 'A) Robo', 0, 86),
(354, 'B) Fraude', 0, 86),
(355, 'C) Extorsión', 0, 86),
(356, 'D) Apropiación indebida', 1, 86),
(357, 'A) Maltrato', 0, 87),
(358, 'B) Acoso', 0, 87),
(359, 'C) Agresión', 0, 87),
(360, 'D) Abuso físico', 1, 87),

(365, 'A) Venganza', 0, 89),
(366, 'B) Codicia', 0, 89),
(367, 'C) Aburrimiento', 0, 89),
(368, 'D) Amor', 1, 89),
(369, 'A) Estaba en casa durmiendo', 0, 90),
(370, 'B) Estaba en el trabajo', 0, 90),
(371, 'C) Estaba en un restaurante', 0, 90),
(372, 'D) Estaba de vacaciones en otro país', 1, 90),
(373, 'A) Testigos presenciales', 0, 91),
(374, 'B) Video de seguridad', 0, 91),
(375, 'C) Fotos en redes sociales', 0, 91),
(376, 'D) Documento falsificado', 1, 91),

(381, 'A) Testigos presenciales', 0, 93),
(382, 'B) Registro de tarjeta de crédito', 0, 93),
(383, 'C) Registro telefónico\r\n', 0, 93),
(384, 'D) Coartada sin verificación ', 1, 93),
(385, 'A) Necesidad económica', 0, 94),
(386, 'B) Desafío personal', 0, 94),
(387, 'C) Justicia social', 0, 94),
(388, 'D) Beneficio financiero ', 1, 94),
(389, 'A) Testigos presenciales', 0, 95),
(390, 'B) Huellas digitales', 0, 95),
(391, 'C) Documentos falsificados', 1, 95),
(392, 'D) Registro telefónico', 0, 95),
(393, 'A) Lealtad', 0, 96),
(394, 'B) Odio', 0, 96),
(395, 'C) Dinero rápido', 1, 96),
(396, 'D) Poder', 0, 96),
(397, 'A) Estaba en una reunión', 0, 97),
(398, 'B) Testigos alibi', 0, 97),
(399, 'C) Prueba de ADN', 0, 97),
(400, 'D) Coartada con co-conspiradores', 1, 97),
(401, 'A) Venganza', 0, 98),
(402, 'B) Ideología', 1, 98),
(403, 'C) Envidia', 0, 98),
(404, 'D) Pasión', 0, 98),
(405, 'A) Registro telefónico', 0, 99),
(406, 'B) Testigos presenciales', 0, 99),
(407, 'C) Coartada digital', 1, 99),
(408, 'D) Documentos legales', 0, 99),
(409, 'A) Amor', 0, 100),
(410, 'B) Prejuicio', 1, 100),
(411, 'C) Codicia', 0, 100),
(412, 'D) Desafío personal', 0, 100),


(421, 'A) Coartada con co-conspiradores', 0, 103),
(422, 'B) Documentos falsificados', 0, 103),
(423, 'C) Testigos presenciales', 0, 103),
(424, 'D) Coartada cuidadosamente planeada', 1, 103),
(425, 'A) Justicia social', 0, 104),
(426, 'B) Venganza', 0, 104),
(427, 'C) Ideología ', 1, 104),
(428, 'D) Ambición', 0, 104),
(429, 'A) Testigos alibi', 0, 105),
(430, 'B) Registro telefónico', 0, 105),
(431, 'C) Coartada digital ', 1, 105),
(432, 'D) Coartada sin verificación', 0, 105),
(433, 'A) Pasión', 0, 106),
(434, 'B) Codicia ', 1, 106),
(435, 'C) Ideología', 0, 106),
(436, 'D) Desafío personal', 0, 106),
(437, 'A) Coartada digital', 0, 107),
(438, 'B) Testigos presenciales', 0, 107),
(439, 'C) Coartada con co-conspiradores', 1, 107),
(440, 'D) Coartada sin verificación', 0, 107),
(445, 'A) Pasión', 0, 108),
(446, 'B) Poder', 0, 108),
(447, 'C) Dinero', 1, 108),
(448, 'D) Ideología', 0, 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `sexo` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `ubicacion` varchar(200) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT 1,
  `cant_correctas` int(11) NOT NULL DEFAULT 0,
  `cant_respondidas` int(11) NOT NULL DEFAULT 0,
  `rol` varchar(5) NOT NULL DEFAULT 'J',
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `password`, `nombre`, `fecha`, `sexo`, `email`, `imagen`, `ubicacion`, `hash`, `activo`, `nivel`, `cant_correctas`, `cant_respondidas`, `rol`, `fecha_creacion`) VALUES
('admin', '123', 'admin', '2000-01-01', '', 'admin@gmail.com', '', 'Argentina', '', 1, 1, 0, 0, 'A', '2024-06-16'),
('celes', '12', 'celeste gomez', '2024-05-29', 'Femenino', 'mm@gmail.com', '/preguntados/public/imagenesPerfil/snorlax.png', 'Isidro Casanova, Provincia de Buenos Aires, Argentina', '039443f09aeee6b6de524ff49c75aba8', 1, 3, 9, 12, 'J', '2024-06-16'),
('editor', '123', 'editor', '2000-01-01', '', 'admin@gmail.com', '', 'Argentina', '', 1, 1, 0, 0, 'E', '2024-06-16'),
('LL', '123', 'LL', '0011-11-11', 'Masculino', 'a@gmail.com', '', 'Chile', '42397ecd785b4d66b60474ce0a4bc315', 1, 1, 2, 14, 'J', '2024-06-16'),
('Lucas', '123', 'Lucas', '0001-01-01', 'Masculino', 'a@gmail.com', '', 'Rusia', '34fe5e22aab7a0a8567f6d577ae4b649', 1, 2, 17, 40, 'J', '2024-06-16'),
('mari', '123', 'mariela', '1985-10-24', 'Femenino', 'mari@aglo.com', '', 'San Justo, Provincia de Buenos Aires, Argentina', '4f470f1c3b929da2e48f058222595ae9', 1, 1, 2, 23, 'J', '2024-06-16'),
('mariel', '123', 'marie', '1900-01-24', 'Femenino', 'm@gmail.com', '', 'San Justo, Provincia de Buenos Aires, Argentina', '81b98d8c545497703fb159db6629d6e5', 1, 1, 5, 11, 'J', '2024-06-16'),
('q', '123', 'q', '0011-11-11', 'Prefiero no decirlo', 's@gmail.com', '', 'Australia', '83d3680a9eb7d1234ff3045adf05c793', 1, 1, 0, 0, 'J', '2024-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_pregunta`
--

CREATE TABLE `usuario_pregunta` (
  `id_usuario` varchar(200) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_pregunta`
--

INSERT INTO `usuario_pregunta` (`id_usuario`, `id_pregunta`) VALUES
('Lucas', 17);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dificultad`
--
ALTER TABLE `dificultad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `dificultad` (`dificultad`);

--
-- Indices de la tabla `preguntas_de_usuario`
--
ALTER TABLE `preguntas_de_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `pregunta_reportada`
--
ALTER TABLE `pregunta_reportada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  ADD PRIMARY KEY (`id_usuario`,`id_pregunta`),
  ADD KEY `usuario_pregunta_ibfk_2` (`id_pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dificultad`
--
ALTER TABLE `dificultad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `preguntas_de_usuario`
--
ALTER TABLE `preguntas_de_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pregunta_reportada`
--
ALTER TABLE `pregunta_reportada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`dificultad`) REFERENCES `dificultad` (`id`);

--
-- Filtros para la tabla `preguntas_de_usuario`
--
ALTER TABLE `preguntas_de_usuario`
  ADD CONSTRAINT `preguntas_de_usuario_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `pregunta_reportada`
--
ALTER TABLE `pregunta_reportada`
  ADD CONSTRAINT `pregunta_reportada_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  ADD CONSTRAINT `usuario_pregunta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `usuario_pregunta_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
