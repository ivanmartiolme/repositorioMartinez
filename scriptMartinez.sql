-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 20:31:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smartorder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('smartorder_cache_ivab@gmail.com|127.0.0.1', 'i:1;', 1749485174),
('smartorder_cache_ivab@gmail.com|127.0.0.1:timer', 'i:1749485174;', 1749485174),
('smartorder_cache_ivanmartiolme@gmail.com|127.0.0.1', 'i:1;', 1746132331),
('smartorder_cache_ivanmartiolme@gmail.com|127.0.0.1:timer', 'i:1746132331;', 1746132331);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 2.75, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(2, 1, 1, 1, 4.00, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(3, 1, 1, 1, 4.00, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(4, 1, 3, 1, 5.00, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(5, 1, 2, 1, 3.50, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(6, 1, 2, 1, 3.50, '2025-05-01 09:15:19', '2025-05-01 09:15:19'),
(7, 2, 1, 1, 4.00, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(8, 2, 1, 1, 4.00, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(9, 2, 4, 1, 2.75, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(10, 2, 4, 1, 2.75, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(11, 2, 2, 1, 3.50, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(12, 2, 2, 1, 3.50, '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(13, 3, 5, 1, 7.00, '2025-05-01 09:41:00', '2025-05-01 09:41:00'),
(14, 3, 2, 1, 3.50, '2025-05-01 09:41:00', '2025-05-01 09:41:00'),
(15, 4, 1, 1, 4.00, '2025-05-01 09:43:07', '2025-05-01 09:43:07'),
(16, 4, 2, 1, 3.50, '2025-05-01 09:43:07', '2025-05-01 09:43:07'),
(17, 4, 4, 1, 2.75, '2025-05-01 09:43:07', '2025-05-01 09:43:07'),
(18, 5, 1, 1, 4.00, '2025-05-01 09:44:32', '2025-05-01 09:44:32'),
(19, 5, 1, 1, 4.00, '2025-05-01 09:44:32', '2025-05-01 09:44:32'),
(20, 5, 5, 1, 7.00, '2025-05-01 09:44:32', '2025-05-01 09:44:32'),
(21, 5, 4, 1, 2.75, '2025-05-01 09:44:32', '2025-05-01 09:44:32'),
(22, 6, 1, 1, 4.00, '2025-05-01 09:52:13', '2025-05-01 09:52:13'),
(23, 6, 5, 1, 7.00, '2025-05-01 09:52:13', '2025-05-01 09:52:13'),
(24, 6, 5, 1, 7.00, '2025-05-01 09:52:13', '2025-05-01 09:52:13'),
(25, 7, 1, 1, 4.00, '2025-05-01 09:53:03', '2025-05-01 09:53:03'),
(26, 7, 1, 1, 4.00, '2025-05-01 09:53:03', '2025-05-01 09:53:03'),
(27, 7, 4, 1, 2.75, '2025-05-01 09:53:03', '2025-05-01 09:53:03'),
(28, 7, 4, 1, 2.75, '2025-05-01 09:53:03', '2025-05-01 09:53:03'),
(29, 8, 4, 1, 2.75, '2025-05-01 20:36:31', '2025-05-01 20:36:31'),
(30, 8, 1, 1, 4.25, '2025-05-01 20:36:31', '2025-05-01 20:36:31'),
(31, 8, 2, 1, 3.50, '2025-05-01 20:36:31', '2025-05-01 20:36:31'),
(32, 8, 3, 1, 5.00, '2025-05-01 20:36:31', '2025-05-01 20:36:31'),
(33, 8, 1, 1, 4.25, '2025-05-01 20:36:31', '2025-05-01 20:36:31'),
(34, 9, 1, 1, 4.25, '2025-05-01 20:40:08', '2025-05-01 20:40:08'),
(35, 9, 6, 1, 12.50, '2025-05-01 20:40:08', '2025-05-01 20:40:08'),
(36, 10, 6, 1, 12.50, '2025-05-01 21:07:58', '2025-05-01 21:07:58'),
(37, 10, 4, 1, 2.75, '2025-05-01 21:07:58', '2025-05-01 21:07:58'),
(38, 10, 6, 1, 12.50, '2025-05-01 21:07:58', '2025-05-01 21:07:58'),
(39, 11, 1, 1, 4.25, '2025-05-01 21:09:25', '2025-05-01 21:09:25'),
(40, 11, 4, 1, 2.75, '2025-05-01 21:09:25', '2025-05-01 21:09:25'),
(41, 11, 6, 1, 12.50, '2025-05-01 21:09:25', '2025-05-01 21:09:25'),
(42, 12, 6, 1, 12.50, '2025-05-01 21:10:41', '2025-05-01 21:10:41'),
(43, 12, 1, 1, 4.25, '2025-05-01 21:10:41', '2025-05-01 21:10:41'),
(44, 13, 6, 1, 12.50, '2025-05-06 09:43:43', '2025-05-06 09:43:43'),
(45, 13, 4, 1, 2.75, '2025-05-06 09:43:43', '2025-05-06 09:43:43'),
(46, 13, 5, 1, 7.00, '2025-05-06 09:43:43', '2025-05-06 09:43:43'),
(47, 14, 6, 1, 12.50, '2025-05-06 10:00:38', '2025-05-06 10:00:38'),
(48, 14, 4, 1, 2.75, '2025-05-06 10:00:38', '2025-05-06 10:00:38'),
(49, 14, 1, 1, 4.25, '2025-05-06 10:00:38', '2025-05-06 10:00:38'),
(50, 15, 6, 1, 12.50, '2025-05-23 16:27:34', '2025-05-23 16:27:34'),
(51, 15, 1, 1, 4.25, '2025-05-23 16:27:34', '2025-05-23 16:27:34'),
(52, 15, 5, 1, 7.00, '2025-05-23 16:27:34', '2025-05-23 16:27:34'),
(53, 16, 1, 1, 4.25, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(54, 16, 1, 1, 4.25, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(55, 16, 1, 1, 4.25, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(56, 16, 2, 1, 3.50, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(57, 16, 6, 1, 12.50, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(58, 16, 3, 1, 5.00, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(59, 16, 3, 1, 5.00, '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(60, 17, 1, 1, 4.25, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(61, 17, 1, 1, 4.25, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(62, 17, 1, 1, 4.25, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(63, 17, 2, 1, 3.50, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(64, 17, 6, 1, 12.50, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(65, 17, 3, 1, 5.00, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(66, 17, 3, 1, 5.00, '2025-05-24 18:13:05', '2025-05-24 18:13:05'),
(67, 18, 6, 1, 12.50, '2025-05-24 18:16:20', '2025-05-24 18:16:20'),
(68, 18, 1, 1, 4.25, '2025-05-24 18:16:20', '2025-05-24 18:16:20'),
(69, 18, 5, 1, 7.00, '2025-05-24 18:16:20', '2025-05-24 18:16:20'),
(70, 18, 4, 1, 2.75, '2025-05-24 18:16:20', '2025-05-24 18:16:20'),
(71, 19, 6, 1, 12.50, '2025-05-24 18:20:54', '2025-05-24 18:20:54'),
(72, 19, 1, 1, 4.25, '2025-05-24 18:20:54', '2025-05-24 18:20:54'),
(73, 19, 5, 1, 7.00, '2025-05-24 18:20:54', '2025-05-24 18:20:54'),
(74, 19, 5, 1, 7.00, '2025-05-24 18:20:54', '2025-05-24 18:20:54'),
(75, 19, 5, 1, 7.00, '2025-05-24 18:20:54', '2025-05-24 18:20:54'),
(76, 20, 6, 1, 12.50, '2025-05-24 18:21:45', '2025-05-24 18:21:45'),
(77, 20, 1, 1, 4.25, '2025-05-24 18:21:45', '2025-05-24 18:21:45'),
(78, 21, 7, 1, 3.65, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(79, 21, 5, 1, 7.00, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(80, 21, 1, 1, 4.25, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(81, 21, 9, 1, 3.50, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(82, 21, 2, 1, 3.50, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(83, 21, 3, 1, 5.00, '2025-06-09 15:42:26', '2025-06-09 15:42:26'),
(84, 22, 5, 1, 7.00, '2025-06-09 15:47:04', '2025-06-09 15:47:04'),
(85, 22, 1, 1, 4.25, '2025-06-09 15:47:04', '2025-06-09 15:47:04'),
(86, 23, 6, 1, 12.50, '2025-06-09 15:48:41', '2025-06-09 15:48:41'),
(87, 24, 6, 1, 12.50, '2025-06-09 15:58:12', '2025-06-09 15:58:12'),
(88, 24, 7, 1, 3.65, '2025-06-09 15:58:12', '2025-06-09 15:58:12'),
(89, 24, 5, 1, 7.00, '2025-06-09 15:58:12', '2025-06-09 15:58:12'),
(90, 24, 8, 1, 5.25, '2025-06-09 15:58:12', '2025-06-09 15:58:12'),
(91, 24, 9, 1, 3.50, '2025-06-09 15:58:12', '2025-06-09 15:58:12'),
(92, 25, 4, 1, 2.75, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(93, 25, 5, 1, 7.00, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(94, 25, 6, 1, 12.50, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(95, 25, 1, 1, 4.25, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(96, 25, 1, 1, 4.25, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(97, 25, 7, 1, 3.65, '2025-06-09 16:00:09', '2025-06-09 16:00:09'),
(98, 26, 5, 1, 7.00, '2025-06-09 16:01:12', '2025-06-09 16:01:12'),
(99, 26, 4, 1, 2.75, '2025-06-09 16:01:12', '2025-06-09 16:01:12'),
(100, 26, 6, 1, 12.50, '2025-06-09 16:01:12', '2025-06-09 16:01:12'),
(101, 26, 7, 1, 3.65, '2025-06-09 16:01:12', '2025-06-09 16:01:12'),
(102, 27, 7, 1, 3.65, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(103, 27, 1, 1, 4.25, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(104, 27, 5, 1, 7.00, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(105, 27, 6, 1, 12.50, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(106, 27, 8, 1, 5.25, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(107, 27, 3, 1, 5.00, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(108, 27, 2, 1, 3.50, '2025-06-09 16:12:56', '2025-06-09 16:12:56'),
(109, 27, 9, 1, 3.50, '2025-06-09 16:12:56', '2025-06-09 16:12:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('Disponible','Ocupada') NOT NULL DEFAULT 'Disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Mesa 1', 'Disponible', '2025-05-01 09:12:44', '2025-06-09 15:40:21'),
(2, 'Mesa 2', 'Disponible', '2025-05-01 09:39:38', '2025-06-09 15:46:03'),
(3, 'Mesa 3', 'Disponible', '2025-06-09 15:40:31', '2025-06-09 16:04:42'),
(4, 'Mesa 4', 'Disponible', '2025-06-09 15:40:37', '2025-06-09 15:59:18'),
(5, 'Mesa 5', 'Disponible', '2025-06-09 15:45:35', '2025-06-09 16:14:43'),
(6, 'Mesa 6', 'Disponible', '2025-06-09 16:17:40', '2025-06-09 16:18:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_28_161738_create_mesas_table', 1),
(5, '2025_03_28_161738_create_pedidos_table', 1),
(6, '2025_03_28_161738_create_productos_table', 1),
(7, '2025_03_28_161957_create_detalle_pedidos_table', 1),
(8, '2025_05_07_092814_add_tipo_to_users_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mesa_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `estado` enum('Pendiente','Pagado') NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `mesa_id`, `user_id`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 22.75, 'Pagado', '2025-05-01 09:15:19', '2025-05-01 09:15:52'),
(2, 1, 1, 20.50, 'Pendiente', '2025-05-01 09:24:17', '2025-05-01 09:24:17'),
(3, 2, 2, 10.50, 'Pagado', '2025-05-01 09:41:00', '2025-05-01 09:41:09'),
(4, 2, 2, 10.25, 'Pagado', '2025-05-01 09:43:07', '2025-05-01 09:44:01'),
(5, 2, 2, 17.75, 'Pagado', '2025-05-01 09:44:32', '2025-05-01 09:45:13'),
(6, 2, 2, 18.00, 'Pagado', '2025-05-01 09:52:13', '2025-05-01 09:52:21'),
(7, 2, 2, 13.50, 'Pagado', '2025-05-01 09:53:03', '2025-05-01 09:53:40'),
(8, 1, 3, 19.75, 'Pagado', '2025-05-01 20:36:31', '2025-05-01 20:37:38'),
(9, 1, 3, 16.75, 'Pagado', '2025-05-01 20:40:08', '2025-05-01 20:40:10'),
(10, 2, 3, 27.75, 'Pagado', '2025-05-01 21:07:58', '2025-05-01 21:08:00'),
(11, 2, 3, 19.50, 'Pagado', '2025-05-01 21:09:25', '2025-05-01 21:09:30'),
(12, 2, 3, 16.75, 'Pagado', '2025-05-01 21:10:41', '2025-05-01 21:10:43'),
(13, 2, 2, 22.25, 'Pagado', '2025-05-06 09:43:42', '2025-05-06 09:43:50'),
(14, 1, 2, 19.50, 'Pagado', '2025-05-06 10:00:38', '2025-05-06 10:01:10'),
(15, 1, 2, 23.75, 'Pagado', '2025-05-23 16:27:34', '2025-05-23 16:27:44'),
(16, 1, 2, 38.75, 'Pendiente', '2025-05-24 18:11:44', '2025-05-24 18:11:44'),
(17, 1, 2, 38.75, 'Pagado', '2025-05-24 18:13:05', '2025-05-24 18:14:07'),
(18, 1, 2, 26.50, 'Pagado', '2025-05-24 18:16:20', '2025-05-24 18:17:12'),
(19, 1, 2, 37.75, 'Pagado', '2025-05-24 18:20:54', '2025-05-24 18:21:00'),
(20, 1, 2, 16.75, 'Pagado', '2025-05-24 18:21:45', '2025-05-24 18:22:28'),
(21, 3, 4, 26.90, 'Pagado', '2025-06-09 15:42:26', '2025-06-09 15:43:52'),
(22, 2, 4, 11.25, 'Pagado', '2025-06-09 15:47:04', '2025-06-09 15:47:06'),
(23, 5, 4, 12.50, 'Pagado', '2025-06-09 15:48:41', '2025-06-09 15:48:42'),
(24, 4, 2, 31.90, 'Pagado', '2025-06-09 15:58:12', '2025-06-09 15:59:18'),
(25, 3, 2, 34.40, 'Pagado', '2025-06-09 16:00:09', '2025-06-09 16:00:16'),
(26, 3, 2, 25.90, 'Pagado', '2025-06-09 16:01:12', '2025-06-09 16:02:55'),
(27, 5, 2, 44.65, 'Pagado', '2025-06-09 16:12:56', '2025-06-09 16:14:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `categoria`, `created_at`, `updated_at`) VALUES
(1, 'bocadillo jamon', 4.25, 'bocadillos', '2025-05-01 09:10:02', '2025-05-01 20:32:48'),
(2, 'refrescos', 3.50, 'bebidas', '2025-05-01 09:11:20', '2025-05-01 09:11:20'),
(3, 'hamburguesa', 5.00, 'hamburguesas', '2025-05-01 09:11:46', '2025-05-01 09:11:46'),
(4, 'tarta de la abuela', 2.75, 'postres', '2025-05-01 09:12:11', '2025-05-01 09:12:11'),
(5, 'Sandwich Especial', 7.00, 'sandwiches', '2025-05-01 09:38:47', '2025-05-01 09:38:47'),
(6, 'bocadillo especial', 12.50, 'bocadillos', '2025-05-01 20:33:19', '2025-06-09 15:38:07'),
(7, 'Croisant a la plancha', 3.65, 'desayunos', '2025-06-09 15:38:34', '2025-06-09 15:38:34'),
(8, 'Tarta de queso', 5.25, 'postres', '2025-06-09 15:39:01', '2025-06-09 15:44:32'),
(9, 'Cerveza', 3.50, 'bebidas', '2025-06-09 15:39:45', '2025-06-09 15:39:45'),
(10, 'Hamburguesa de bacon', 6.35, 'hamburguesas', '2025-06-09 15:45:04', '2025-06-09 15:45:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QrqTaSf88aSYr7zWMxaeo9HRjqi6f0ac6i0rvoyt', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkRrNW1xc1c3QVpuTWY1ZGRqRWJTNUhKSUp3VDVmTXZvbk55QkFZaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1749488371);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` varchar(255) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `tipo`) VALUES
(1, 'rocio', 'rocio@gmail.com', NULL, '$2y$12$iMBrVUuPNwhXf2h/V9bIWOLvZwaiCWHBgMFVJQd9JiNc5D/u8decC', NULL, '2025-05-01 09:07:49', '2025-05-01 09:07:49', 'cliente'),
(2, 'Alicia', 'aliolme@gmail.com', NULL, '$2y$12$INMbvok6X.UQsyxQzvFmIOy2dHMSSmhjewivrwi/VMEWfDY4qn2OC', NULL, '2025-05-01 09:36:00', '2025-05-01 09:36:00', 'cliente'),
(3, 'jose', 'morenogomezjose48@gmail.com', NULL, '$2y$12$BXYTw87fRNYHRiGS8Vgbkuavx/3QxXbvkaz8NlDk8HxciBP3jnkQm', NULL, '2025-05-01 20:30:55', '2025-05-01 20:30:55', 'cliente'),
(4, 'Ivan', 'ivan@gmail.com', NULL, '$2y$12$mlT7r69YBwU4kK4QyZSHQ.LLSvQjsTNndVlvgM4QQ.JYfwIvuaZvu', NULL, '2025-06-09 15:35:48', '2025-06-09 15:35:48', 'admin'),
(5, 'Aitor', 'aitor@gmail.com', NULL, '$2y$12$SnQxBY356G2aF1EX2qztKOMujK2ug/0GOzYx68X4tu8VkrHf2pZMu', NULL, '2025-06-09 16:59:31', '2025-06-09 16:59:31', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `detalle_pedidos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_mesa_id_foreign` (`mesa_id`),
  ADD KEY `pedidos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedidos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_mesa_id_foreign` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`),
  ADD CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
