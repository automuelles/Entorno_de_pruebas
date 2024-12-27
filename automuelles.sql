-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2024 a las 19:04:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `automuelles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `Id` int(11) NOT NULL,
  `EstadoActual` varchar(50) NOT NULL,
  `FechaEstadoActual` datetime NOT NULL,
  `NombreUsuario` varchar(100) NOT NULL,
  `IntDocumento` int(11) NOT NULL,
  `IntTransaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`Id`, `EstadoActual`, `FechaEstadoActual`, `NombreUsuario`, `IntDocumento`, `IntTransaccion`) VALUES
(144, 'RevisionComenzada', '2024-12-03 13:02:50', 'Ruben Bayona', 92900, 90),
(145, 'RevisionFinalizada', '2024-12-03 13:34:39', 'Ruben Bayona', 92900, 90),
(146, 'RevisionFinalComenzada', '2024-12-03 13:35:02', 'Ruben Bayona', 92900, 90),
(147, 'RevisionFinalFinalizada', '2024-12-03 13:35:43', 'Ruben Bayona', 92900, 90),
(148, 'RevisionComenzada', '2024-12-03 13:35:52', 'Ruben Bayona', 3183, 42),
(149, 'RevisionFinalizada', '2024-12-03 13:36:29', 'Ruben Bayona', 3183, 42),
(150, 'RevisionComenzadaDespachos', '2024-12-03 13:44:19', 'Ruben Bayona', 92900, 90),
(151, 'RevisionDespachosFinalizada', '2024-12-03 13:44:46', 'Ruben Bayona', 92900, 90),
(152, 'RevisionComenzada', '2024-12-03 14:17:00', 'Ruben Bayona', 3257, 42),
(153, 'RevisionFinalizada', '2024-12-03 14:17:09', 'Ruben Bayona', 3257, 42),
(154, 'RevisionComenzada', '2024-12-03 14:17:14', 'Ruben Bayona', 3258, 42),
(155, 'RevisionFinalizada', '2024-12-03 14:17:30', 'Ruben Bayona', 3258, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `Id` int(11) NOT NULL,
  `StrUsuarioGra` varchar(255) NOT NULL,
  `DatFecha1` datetime NOT NULL,
  `IntTransaccion` int(11) NOT NULL,
  `IntDocumento` varchar(255) NOT NULL,
  `Estado` varchar(50) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`Id`, `StrUsuarioGra`, `DatFecha1`, `IntTransaccion`, `IntDocumento`, `Estado`) VALUES
(1344, 'JROLDAN', '2024-11-21 15:16:29', 90, '92900', 'RevisionDespachosFinalizada'),
(1380, 'RUBEN', '2024-11-26 14:15:03', 42, '3183', 'RevisionFinalizada'),
(1619, 'FARLEY', '2024-12-03 13:02:29', 42, '3257', 'RevisionFinalizada'),
(1620, 'CRISTIAN', '2024-12-03 13:02:29', 42, '3258', 'RevisionFinalizada'),
(1621, 'CRISTIAN', '2024-12-03 13:02:30', 42, '3259', 'Pendiente'),
(1622, 'FARLEY', '2024-12-03 13:02:30', 42, '3260', 'Pendiente'),
(1623, 'FARLEY', '2024-12-03 13:02:30', 88, '9554', 'Pendiente'),
(1624, 'FARLEY', '2024-12-03 13:02:30', 88, '9555', 'Pendiente'),
(1625, 'FARLEY', '2024-12-03 13:02:30', 88, '9556', 'Pendiente'),
(1626, 'FARLEY', '2024-12-03 13:02:30', 88, '9557', 'Pendiente'),
(1627, 'FARLEY', '2024-12-03 13:02:30', 88, '9558', 'Pendiente'),
(1628, 'FARLEY', '2024-12-03 13:02:30', 88, '9559', 'Pendiente'),
(1629, 'CRISTIAN', '2024-12-03 13:02:30', 88, '9560', 'Pendiente'),
(1630, 'FARLEY', '2024-12-03 13:02:30', 88, '9561', 'Pendiente'),
(1631, 'FARLEY', '2024-12-03 13:02:30', 88, '9562', 'Pendiente'),
(1632, 'FARLEY', '2024-12-03 13:02:30', 88, '9563', 'Pendiente'),
(1633, 'FARLEY', '2024-12-03 13:02:30', 88, '9564', 'Pendiente'),
(1634, 'FARLEY', '2024-12-03 13:02:30', 88, '9565', 'Pendiente'),
(1635, 'CRISTIAN', '2024-12-03 13:02:30', 88, '9566', 'Pendiente'),
(1636, 'FARLEY', '2024-12-03 13:02:30', 88, '9567', 'Pendiente'),
(1637, 'FARLEY', '2024-12-03 13:02:30', 88, '9568', 'Pendiente'),
(1638, 'CRISTIAN', '2024-12-03 13:02:30', 88, '9569', 'Pendiente'),
(1639, 'JROLDAN', '2024-12-03 13:02:30', 40, '21648', 'Pendiente'),
(1640, 'JROLDAN', '2024-12-03 13:02:30', 40, '21649', 'Pendiente'),
(1641, 'ROYS', '2024-12-03 13:02:30', 40, '21650', 'Pendiente'),
(1642, 'JROLDAN', '2024-12-03 13:02:30', 40, '21651', 'Pendiente'),
(1643, 'JROLDAN', '2024-12-03 13:02:30', 40, '21652', 'Pendiente'),
(1644, 'JROLDAN', '2024-12-03 13:02:30', 40, '21653', 'Pendiente'),
(1645, 'ROYS', '2024-12-03 13:02:30', 40, '21654', 'Pendiente'),
(1646, 'ROYS', '2024-12-03 13:02:30', 40, '21656', 'Pendiente'),
(1647, 'ROYS', '2024-12-03 13:02:30', 40, '21657', 'Pendiente'),
(1648, 'ROYS', '2024-12-03 13:02:30', 40, '21658', 'Pendiente'),
(1649, 'JROLDAN', '2024-12-03 13:02:30', 40, '21659', 'Pendiente'),
(1650, 'abel', '2024-12-03 13:02:30', 90, '93317', 'Pendiente'),
(1651, 'abel', '2024-12-03 13:02:30', 90, '93318', 'Pendiente'),
(1652, 'ROYS', '2024-12-03 13:02:30', 90, '93319', 'Pendiente'),
(1653, 'ROYS', '2024-12-03 13:02:30', 90, '93320', 'Pendiente'),
(1654, 'abel', '2024-12-03 13:02:30', 90, '93321', 'Pendiente'),
(1655, 'ROYS', '2024-12-03 13:02:30', 90, '93324', 'Pendiente'),
(1656, 'abel', '2024-12-03 13:02:31', 90, '93325', 'Pendiente'),
(1657, 'JROLDAN', '2024-12-03 13:02:31', 90, '93326', 'Pendiente'),
(1658, 'JROLDAN', '2024-12-03 13:02:31', 90, '93327', 'Pendiente'),
(1659, 'JROLDAN', '2024-12-03 13:02:31', 90, '93328', 'Pendiente'),
(1660, 'abel', '2024-12-03 13:02:31', 90, '93329', 'Pendiente'),
(1661, 'abel', '2024-12-03 13:02:31', 90, '93330', 'Pendiente'),
(1662, 'ROYS', '2024-12-03 13:02:31', 90, '93331', 'Pendiente'),
(1663, 'JROLDAN', '2024-12-03 13:02:31', 90, '93332', 'Pendiente'),
(1664, 'ROYS', '2024-12-03 13:02:31', 90, '93333', 'Pendiente'),
(1665, 'JROLDAN', '2024-12-03 13:02:31', 90, '93334', 'Pendiente'),
(1666, 'JROLDAN', '2024-12-03 13:02:31', 90, '93335', 'Pendiente'),
(1667, 'JROLDAN', '2024-12-03 13:02:31', 90, '93336', 'Pendiente'),
(1668, 'JROLDAN', '2024-12-03 13:02:31', 90, '93337', 'Pendiente'),
(1669, 'JROLDAN', '2024-12-03 13:02:31', 90, '93338', 'Pendiente'),
(1670, 'ROYS', '2024-12-03 13:02:31', 90, '93339', 'Pendiente'),
(1671, 'ROYS', '2024-12-03 13:02:31', 90, '93340', 'Pendiente'),
(1672, 'JROLDAN', '2024-12-03 13:02:31', 90, '93341', 'Pendiente'),
(1673, 'abel', '2024-12-03 13:02:31', 90, '93342', 'Pendiente'),
(1674, 'ROYS', '2024-12-03 13:02:31', 90, '93343', 'Pendiente'),
(1675, 'ROYS', '2024-12-03 13:02:31', 90, '93344', 'Pendiente'),
(1676, 'JROLDAN', '2024-12-03 13:02:31', 90, '93345', 'Pendiente'),
(1677, 'CRISTIAN', '2024-12-03 13:34:34', 42, '3261', 'Pendiente'),
(1678, 'CRISTIAN', '2024-12-03 13:34:34', 88, '9570', 'Pendiente'),
(1679, 'FARLEY', '2024-12-03 13:34:34', 88, '9571', 'Pendiente'),
(1680, 'JROLDAN', '2024-12-03 13:34:34', 40, '21661', 'Pendiente'),
(1681, 'abel', '2024-12-03 13:34:34', 40, '21662', 'Pendiente'),
(1682, 'abel', '2024-12-03 13:34:34', 90, '93346', 'Pendiente'),
(1683, 'abel', '2024-12-03 13:44:12', 90, '93347', 'Pendiente'),
(1684, 'CRISTIAN', '2024-12-03 14:07:58', 42, '3262', 'Pendiente'),
(1685, 'ROYS', '2024-12-03 14:07:59', 90, '93348', 'Pendiente'),
(1686, 'ROYS', '2024-12-03 14:07:59', 90, '93349', 'Pendiente'),
(1687, 'ROYS', '2024-12-03 14:16:54', 90, '93350', 'Pendiente'),
(1688, 'ROYS', '2024-12-03 14:16:54', 90, '93351', 'Pendiente'),
(1689, 'CRISTIAN', '2024-12-03 14:19:58', 42, '3263', 'Pendiente'),
(1690, 'CRISTIAN', '2024-12-03 14:19:58', 88, '9572', 'Pendiente'),
(1691, 'abel', '2024-12-03 14:19:58', 90, '93352', 'Pendiente'),
(1692, 'FARLEY', '2024-12-03 15:03:37', 88, '9573', 'Pendiente'),
(1693, 'FARLEY', '2024-12-03 15:03:37', 88, '9574', 'Pendiente'),
(1694, 'ROYS', '2024-12-03 15:03:37', 40, '21663', 'Pendiente'),
(1695, 'juan', '2024-12-03 15:03:37', 40, '21664', 'Pendiente'),
(1696, 'JROLDAN', '2024-12-03 15:03:37', 40, '21665', 'Pendiente'),
(1697, 'abel', '2024-12-03 15:03:37', 40, '21666', 'Pendiente'),
(1698, 'abel', '2024-12-03 15:03:37', 90, '93353', 'Pendiente'),
(1699, 'juan', '2024-12-03 15:03:38', 90, '93354', 'Pendiente'),
(1700, 'abel', '2024-12-03 15:03:38', 90, '93355', 'Pendiente'),
(1701, 'abel', '2024-12-03 15:03:38', 90, '93356', 'Pendiente'),
(1702, 'abel', '2024-12-03 15:03:38', 90, '93357', 'Pendiente'),
(1703, 'JROLDAN', '2024-12-03 15:08:23', 40, '21667', 'Pendiente'),
(1704, 'abel', '2024-12-03 15:08:23', 40, '21668', 'Pendiente'),
(1705, 'RUBEN', '2024-12-03 15:22:12', 42, '3264', 'Pendiente'),
(1706, 'NORMANC', '2024-12-03 15:22:12', 88, '9575', 'Pendiente'),
(1707, 'FARLEY', '2024-12-03 15:22:12', 88, '9576', 'Pendiente'),
(1708, 'ROYS', '2024-12-03 15:22:12', 40, '21669', 'Pendiente'),
(1709, 'abel', '2024-12-03 15:22:12', 90, '93358', 'Pendiente'),
(1710, 'abel', '2024-12-03 15:22:12', 90, '93359', 'Pendiente'),
(1711, 'CRISTIAN', '2024-12-03 15:31:26', 42, '3265', 'Pendiente'),
(1712, 'CRISTIAN', '2024-12-05 10:13:27', 42, '3280', 'Pendiente'),
(1713, 'CRISTIAN', '2024-12-05 10:13:27', 42, '3281', 'Pendiente'),
(1714, 'CRISTIAN', '2024-12-05 10:13:28', 42, '3282', 'Pendiente'),
(1715, 'FARLEY', '2024-12-05 10:13:28', 88, '9613', 'Pendiente'),
(1716, 'FARLEY', '2024-12-05 10:13:28', 88, '9614', 'Pendiente'),
(1717, 'CRISTIAN', '2024-12-05 10:13:28', 88, '9615', 'Pendiente'),
(1718, 'FARLEY', '2024-12-05 10:13:28', 88, '9616', 'Pendiente'),
(1719, 'CRISTIAN', '2024-12-05 10:13:28', 88, '9617', 'Pendiente'),
(1720, 'CRISTIAN', '2024-12-05 10:13:28', 88, '9618', 'Pendiente'),
(1721, 'ROYS', '2024-12-05 10:13:28', 40, '21702', 'Pendiente'),
(1722, 'abel', '2024-12-05 10:13:28', 40, '21704', 'Pendiente'),
(1723, 'JROLDAN', '2024-12-05 10:13:28', 40, '21705', 'Pendiente'),
(1724, 'JROLDAN', '2024-12-05 10:13:28', 40, '21706', 'Pendiente'),
(1725, 'JROLDAN', '2024-12-05 10:13:28', 40, '21707', 'Pendiente'),
(1726, 'abel', '2024-12-05 10:13:28', 90, '93417', 'Pendiente'),
(1727, 'ROYS', '2024-12-05 10:13:28', 90, '93418', 'Pendiente'),
(1728, 'ROYS', '2024-12-05 10:13:28', 90, '93419', 'Pendiente'),
(1729, 'ROYS', '2024-12-05 10:13:28', 90, '93420', 'Pendiente'),
(1730, 'abel', '2024-12-05 10:13:28', 90, '93421', 'Pendiente'),
(1731, 'JROLDAN', '2024-12-05 10:13:28', 90, '93422', 'Pendiente'),
(1732, 'JROLDAN', '2024-12-05 10:13:28', 90, '93423', 'Pendiente'),
(1733, 'JROLDAN', '2024-12-05 10:13:28', 90, '93424', 'Pendiente'),
(1734, 'ROYS', '2024-12-05 10:13:28', 90, '93425', 'Pendiente'),
(1735, 'ROYS', '2024-12-05 10:13:28', 90, '93426', 'Pendiente'),
(1736, 'ROYS', '2024-12-05 10:13:28', 90, '93427', 'Pendiente'),
(1737, 'abel', '2024-12-05 10:13:28', 90, '93428', 'Pendiente'),
(1738, 'abel', '2024-12-05 10:13:28', 90, '93429', 'Pendiente'),
(1739, 'abel', '2024-12-05 10:13:28', 90, '93430', 'Pendiente'),
(1740, 'JROLDAN', '2024-12-05 10:13:28', 90, '93431', 'Pendiente'),
(1741, 'ROYS', '2024-12-05 10:13:28', 90, '93432', 'Pendiente'),
(1742, 'FARLEY', '2024-12-05 11:46:44', 88, '9619', 'Pendiente'),
(1743, 'FARLEY', '2024-12-05 11:46:44', 88, '9620', 'Pendiente'),
(1744, 'FARLEY', '2024-12-05 11:46:44', 88, '9621', 'Pendiente'),
(1745, 'FARLEY', '2024-12-05 11:46:44', 88, '9622', 'Pendiente'),
(1746, 'FARLEY', '2024-12-05 11:46:44', 88, '9623', 'Pendiente'),
(1747, 'FARLEY', '2024-12-05 11:46:44', 88, '9624', 'Pendiente'),
(1748, 'ROYS', '2024-12-05 11:46:44', 40, '21708', 'Pendiente'),
(1749, 'JROLDAN', '2024-12-05 11:46:44', 40, '21709', 'Pendiente'),
(1750, 'ROYS', '2024-12-05 11:46:44', 40, '21710', 'Pendiente'),
(1751, 'ROYS', '2024-12-05 11:46:44', 90, '93433', 'Pendiente'),
(1752, 'abel', '2024-12-05 11:46:44', 90, '93434', 'Pendiente'),
(1753, 'ROYS', '2024-12-05 11:46:44', 90, '93435', 'Pendiente'),
(1754, 'JROLDAN', '2024-12-05 11:46:44', 90, '93436', 'Pendiente'),
(1755, 'ROYS', '2024-12-05 11:46:45', 90, '93437', 'Pendiente'),
(1756, 'JROLDAN', '2024-12-05 11:46:45', 90, '93438', 'Pendiente'),
(1757, 'abel', '2024-12-05 11:46:45', 90, '93439', 'Pendiente'),
(1758, 'JROLDAN', '2024-12-05 11:46:45', 90, '93440', 'Pendiente'),
(1759, 'abel', '2024-12-05 11:46:45', 90, '93441', 'Pendiente'),
(1760, 'ROYS', '2024-12-05 11:46:45', 90, '93442', 'Pendiente'),
(1761, 'FARLEY', '2024-12-06 10:17:50', 42, '3294', 'Pendiente'),
(1762, 'FARLEY', '2024-12-06 10:17:50', 42, '3295', 'Pendiente'),
(1763, 'CRISTIAN', '2024-12-06 10:17:50', 42, '3297', 'Pendiente'),
(1764, 'FARLEY', '2024-12-06 10:17:50', 88, '9645', 'Pendiente'),
(1765, 'FARLEY', '2024-12-06 10:17:50', 88, '9646', 'Pendiente'),
(1766, 'FARLEY', '2024-12-06 10:17:50', 88, '9647', 'Pendiente'),
(1767, 'CRISTIAN', '2024-12-06 10:17:50', 88, '9648', 'Pendiente'),
(1768, 'FARLEY', '2024-12-06 10:17:50', 88, '9649', 'Pendiente'),
(1769, 'NORMANC', '2024-12-06 10:17:50', 88, '9650', 'Pendiente'),
(1770, 'ROYS', '2024-12-06 10:17:50', 40, '21728', 'Pendiente'),
(1771, 'ROYS', '2024-12-06 10:17:50', 40, '21729', 'Pendiente'),
(1772, 'JROLDAN', '2024-12-06 10:17:50', 40, '21730', 'Pendiente'),
(1773, 'ROYS', '2024-12-06 10:17:50', 40, '21731', 'Pendiente'),
(1774, 'JROLDAN', '2024-12-06 10:17:50', 40, '21732', 'Pendiente'),
(1775, 'JROLDAN', '2024-12-06 10:17:50', 40, '21733', 'Pendiente'),
(1776, 'ROYS', '2024-12-06 10:17:50', 40, '21735', 'Pendiente'),
(1777, 'ROYS', '2024-12-06 10:17:50', 40, '21736', 'Pendiente'),
(1778, 'ROYS', '2024-12-06 10:17:50', 90, '93462', 'Pendiente'),
(1779, 'JROLDAN', '2024-12-06 10:17:51', 90, '93463', 'Pendiente'),
(1780, 'JROLDAN', '2024-12-06 10:17:51', 90, '93464', 'Pendiente'),
(1781, 'JROLDAN', '2024-12-06 10:17:51', 90, '93465', 'Pendiente'),
(1782, 'JROLDAN', '2024-12-06 10:17:51', 90, '93466', 'Pendiente'),
(1783, 'ROYS', '2024-12-06 10:17:51', 90, '93467', 'Pendiente'),
(1784, 'ROYS', '2024-12-06 10:17:51', 90, '93468', 'Pendiente'),
(1785, 'FARLEY', '2024-12-06 10:23:22', 88, '9651', 'Pendiente'),
(1786, 'JROLDAN', '2024-12-06 10:23:47', 40, '21737', 'Pendiente'),
(1787, 'JROLDAN', '2024-12-06 10:26:47', 90, '93469', 'Pendiente'),
(1788, 'FARLEY', '2024-12-06 10:28:43', 88, '9652', 'Pendiente'),
(1789, 'abel', '2024-12-06 10:29:12', 90, '93470', 'Pendiente'),
(1790, 'CRISTIAN', '2024-12-06 10:32:33', 88, '9653', 'Pendiente'),
(1791, 'abel', '2024-12-06 10:32:33', 40, '21738', 'Pendiente'),
(1792, 'FARLEY', '2024-12-10 10:56:19', 42, '3320', 'Pendiente'),
(1793, 'CRISTIAN', '2024-12-10 10:56:19', 42, '3321', 'Pendiente'),
(1794, 'FARLEY', '2024-12-10 10:56:19', 42, '3322', 'Pendiente'),
(1795, 'FARLEY', '2024-12-10 10:56:19', 88, '9721', 'Pendiente'),
(1796, 'FARLEY', '2024-12-10 10:56:19', 88, '9722', 'Pendiente'),
(1797, 'FARLEY', '2024-12-10 10:56:19', 88, '9723', 'Pendiente'),
(1798, 'FARLEY', '2024-12-10 10:56:19', 88, '9724', 'Pendiente'),
(1799, 'FARLEY', '2024-12-10 10:56:19', 88, '9725', 'Pendiente'),
(1800, 'FARLEY', '2024-12-10 10:56:20', 88, '9726', 'Pendiente'),
(1801, 'FARLEY', '2024-12-10 10:56:20', 88, '9727', 'Pendiente'),
(1802, 'FARLEY', '2024-12-10 10:56:20', 88, '9728', 'Pendiente'),
(1803, 'FARLEY', '2024-12-10 10:56:20', 88, '9729', 'Pendiente'),
(1804, 'FARLEY', '2024-12-10 10:56:20', 88, '9730', 'Pendiente'),
(1805, 'FARLEY', '2024-12-10 10:56:20', 88, '9731', 'Pendiente'),
(1806, 'FARLEY', '2024-12-10 10:56:20', 88, '9732', 'Pendiente'),
(1807, 'JROLDAN', '2024-12-10 10:56:20', 40, '21809', 'Pendiente'),
(1808, 'ROYS', '2024-12-10 10:56:20', 40, '21810', 'Pendiente'),
(1809, 'abel', '2024-12-10 10:56:20', 40, '21811', 'Pendiente'),
(1810, 'abel', '2024-12-10 10:56:20', 90, '93574', 'Pendiente'),
(1811, 'abel', '2024-12-10 10:56:20', 90, '93575', 'Pendiente'),
(1812, 'abel', '2024-12-10 10:56:20', 90, '93576', 'Pendiente'),
(1813, 'abel', '2024-12-10 10:56:20', 90, '93577', 'Pendiente'),
(1814, 'abel', '2024-12-10 10:56:20', 90, '93578', 'Pendiente'),
(1815, 'ROYS', '2024-12-10 10:56:20', 90, '93579', 'Pendiente'),
(1816, 'ROYS', '2024-12-10 10:56:20', 90, '93580', 'Pendiente'),
(1817, 'ROYS', '2024-12-10 10:56:20', 90, '93581', 'Pendiente'),
(1818, 'ROYS', '2024-12-10 10:56:20', 90, '93582', 'Pendiente'),
(1819, 'abel', '2024-12-10 10:56:20', 90, '93583', 'Pendiente'),
(1820, 'JROLDAN', '2024-12-10 10:56:20', 90, '93584', 'Pendiente'),
(1821, 'ROYS', '2024-12-10 10:56:20', 90, '93585', 'Pendiente'),
(1822, 'ROYS', '2024-12-10 10:56:20', 90, '93586', 'Pendiente'),
(1823, 'ROYS', '2024-12-10 10:56:20', 90, '93587', 'Pendiente'),
(1824, 'ROYS', '2024-12-10 10:56:21', 90, '93588', 'Pendiente'),
(1825, 'JROLDAN', '2024-12-10 10:56:21', 90, '93589', 'Pendiente'),
(1826, 'ROYS', '2024-12-10 10:56:21', 90, '93590', 'Pendiente'),
(1827, 'FARLEY', '2024-12-10 11:08:31', 88, '9733', 'Pendiente'),
(1828, 'JROLDAN', '2024-12-10 11:08:31', 40, '21812', 'Pendiente'),
(1829, 'abel', '2024-12-10 11:34:16', 40, '21813', 'Pendiente'),
(1830, 'ROYS', '2024-12-10 11:34:16', 90, '93591', 'Pendiente'),
(1831, 'FARLEY', '2024-12-10 11:55:43', 88, '9734', 'Pendiente'),
(1832, 'ROYS', '2024-12-10 11:55:43', 40, '21814', 'Pendiente'),
(1833, 'abel', '2024-12-10 11:55:43', 90, '93592', 'Pendiente'),
(1834, 'FARLEY', '2024-12-10 12:09:38', 88, '9735', 'Pendiente'),
(1835, 'CRISTIAN', '2024-12-10 12:09:38', 88, '9736', 'Pendiente'),
(1836, 'CRISTIAN', '2024-12-10 12:54:07', 88, '9737', 'Pendiente'),
(1837, 'abel', '2024-12-10 12:54:07', 90, '93593', 'Pendiente'),
(1838, 'abel', '2024-12-10 12:54:07', 90, '93594', 'Pendiente'),
(1839, 'JROLDAN', '2024-12-10 12:54:07', 90, '93595', 'Pendiente'),
(1840, 'ROYS', '2024-12-10 12:54:08', 90, '93596', 'Pendiente'),
(1841, 'abel', '2024-12-10 12:54:08', 90, '93597', 'Pendiente'),
(1842, 'ROYS', '2024-12-10 12:54:08', 90, '93598', 'Pendiente'),
(1843, 'FARLEY', '2024-12-26 09:53:11', 42, '3482', 'Pendiente'),
(1844, 'CRISTIAN', '2024-12-26 09:53:11', 42, '3483', 'Pendiente'),
(1845, 'CRISTIAN', '2024-12-26 09:53:11', 42, '3484', 'Pendiente'),
(1846, 'FARLEY', '2024-12-26 09:53:11', 42, '3485', 'Pendiente'),
(1847, 'FARLEY', '2024-12-26 09:53:11', 88, '10108', 'Pendiente'),
(1848, 'FARLEY', '2024-12-26 09:53:11', 88, '10109', 'Pendiente'),
(1849, 'CRISTIAN', '2024-12-26 09:53:11', 88, '10110', 'Pendiente'),
(1850, 'FARLEY', '2024-12-26 09:53:11', 88, '10111', 'Pendiente'),
(1851, 'FARLEY', '2024-12-26 09:53:11', 88, '10112', 'Pendiente'),
(1852, 'FARLEY', '2024-12-26 09:53:11', 88, '10113', 'Pendiente'),
(1853, 'abel', '2024-12-26 09:53:11', 40, '22075', 'Pendiente'),
(1854, 'ROYS', '2024-12-26 09:53:12', 40, '22076', 'Pendiente'),
(1855, 'abel', '2024-12-26 09:53:12', 40, '22077', 'Pendiente'),
(1856, 'ROYS', '2024-12-26 09:53:12', 40, '22078', 'Pendiente'),
(1857, 'ROYS', '2024-12-26 09:53:12', 90, '94077', 'Pendiente'),
(1858, 'ROYS', '2024-12-26 09:53:12', 90, '94078', 'Pendiente'),
(1859, 'abel', '2024-12-26 09:53:12', 90, '94079', 'Pendiente'),
(1860, 'ROYS', '2024-12-26 09:53:12', 90, '94080', 'Pendiente'),
(1861, 'ROYS', '2024-12-26 09:53:12', 90, '94081', 'Pendiente'),
(1862, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3486', 'Pendiente'),
(1863, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3487', 'Pendiente'),
(1864, 'FARLEY', '2024-12-26 14:50:46', 42, '3488', 'Pendiente'),
(1865, 'FARLEY', '2024-12-26 14:50:46', 42, '3489', 'Pendiente'),
(1866, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3490', 'Pendiente'),
(1867, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3491', 'Pendiente'),
(1868, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3492', 'Pendiente'),
(1869, 'FARLEY', '2024-12-26 14:50:46', 42, '3493', 'Pendiente'),
(1870, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3494', 'Pendiente'),
(1871, 'FARLEY', '2024-12-26 14:50:46', 42, '3495', 'Pendiente'),
(1872, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3496', 'Pendiente'),
(1873, 'FARLEY', '2024-12-26 14:50:46', 42, '3497', 'Pendiente'),
(1874, 'CRISTIAN', '2024-12-26 14:50:46', 42, '3498', 'Pendiente'),
(1875, 'RUBEN', '2024-12-26 14:50:46', 42, '3499', 'Pendiente'),
(1876, 'RUBEN', '2024-12-26 14:50:46', 42, '3500', 'Pendiente'),
(1877, 'FARLEY', '2024-12-26 14:50:46', 42, '3501', 'Pendiente'),
(1878, 'CRISTIAN', '2024-12-26 14:50:46', 88, '10114', 'Pendiente'),
(1879, 'FARLEY', '2024-12-26 14:50:46', 88, '10115', 'Pendiente'),
(1880, 'CRISTIAN', '2024-12-26 14:50:46', 88, '10116', 'Pendiente'),
(1881, 'CRISTIAN', '2024-12-26 14:50:46', 88, '10117', 'Pendiente'),
(1882, 'FARLEY', '2024-12-26 14:50:46', 88, '10118', 'Pendiente'),
(1883, 'FARLEY', '2024-12-26 14:50:47', 88, '10119', 'Pendiente'),
(1884, 'FARLEY', '2024-12-26 14:50:47', 88, '10120', 'Pendiente'),
(1885, 'CRISTIAN', '2024-12-26 14:50:47', 88, '10121', 'Pendiente'),
(1886, 'FARLEY', '2024-12-26 14:50:47', 88, '10122', 'Pendiente'),
(1887, 'FARLEY', '2024-12-26 14:50:47', 88, '10123', 'Pendiente'),
(1888, 'CRISTIAN', '2024-12-26 14:50:47', 88, '10124', 'Pendiente'),
(1889, 'FARLEY', '2024-12-26 14:50:47', 88, '10125', 'Pendiente'),
(1890, 'FARLEY', '2024-12-26 14:50:47', 88, '10126', 'Pendiente'),
(1891, 'FARLEY', '2024-12-26 14:50:47', 88, '10127', 'Pendiente'),
(1892, 'CRISTIAN', '2024-12-26 14:50:47', 88, '10128', 'Pendiente'),
(1893, 'CRISTIAN', '2024-12-26 14:50:47', 88, '10129', 'Pendiente'),
(1894, 'CRISTIAN', '2024-12-26 14:50:47', 88, '10130', 'Pendiente'),
(1895, 'FARLEY', '2024-12-26 14:50:47', 88, '10131', 'Pendiente'),
(1896, 'FARLEY', '2024-12-26 14:50:47', 88, '10132', 'Pendiente'),
(1897, 'abel', '2024-12-26 14:50:47', 40, '22079', 'Pendiente'),
(1898, 'ROYS', '2024-12-26 14:50:47', 40, '22080', 'Pendiente'),
(1899, 'ROYS', '2024-12-26 14:50:47', 40, '22081', 'Pendiente'),
(1900, 'juan', '2024-12-26 14:50:47', 40, '22082', 'Pendiente'),
(1901, 'ROYS', '2024-12-26 14:50:47', 40, '22083', 'Pendiente'),
(1902, 'ROYS', '2024-12-26 14:50:47', 40, '22084', 'Pendiente'),
(1903, 'abel', '2024-12-26 14:50:47', 40, '22085', 'Pendiente'),
(1904, 'ROYS', '2024-12-26 14:50:47', 90, '94082', 'Pendiente'),
(1905, 'abel', '2024-12-26 14:50:48', 90, '94083', 'Pendiente'),
(1906, 'abel', '2024-12-26 14:50:48', 90, '94084', 'Pendiente'),
(1907, 'ROYS', '2024-12-26 14:50:48', 90, '94085', 'Pendiente'),
(1908, 'abel', '2024-12-26 14:50:48', 90, '94086', 'Pendiente'),
(1909, 'ROYS', '2024-12-26 14:50:49', 90, '94087', 'Pendiente'),
(1910, 'abel', '2024-12-26 14:50:49', 90, '94088', 'Pendiente'),
(1911, 'abel', '2024-12-26 14:50:49', 90, '94089', 'Pendiente'),
(1912, 'ROYS', '2024-12-26 14:50:49', 90, '94090', 'Pendiente'),
(1913, 'abel', '2024-12-26 14:50:49', 90, '94091', 'Pendiente'),
(1914, 'abel', '2024-12-26 14:50:49', 90, '94092', 'Pendiente'),
(1915, 'abel', '2024-12-26 14:50:50', 90, '94093', 'Pendiente'),
(1916, 'abel', '2024-12-26 14:50:50', 90, '94094', 'Pendiente'),
(1917, 'ROYS', '2024-12-26 14:50:50', 90, '94095', 'Pendiente'),
(1918, 'ROYS', '2024-12-26 14:50:50', 90, '94096', 'Pendiente'),
(1919, 'ROYS', '2024-12-26 14:50:50', 90, '94097', 'Pendiente'),
(1920, 'abel', '2024-12-26 14:50:50', 90, '94098', 'Pendiente'),
(1921, 'abel', '2024-12-26 14:50:50', 90, '94099', 'Pendiente'),
(1922, 'ROYS', '2024-12-26 14:50:50', 90, '94100', 'Pendiente'),
(1923, 'ROYS', '2024-12-26 14:50:50', 90, '94101', 'Pendiente'),
(1924, 'abel', '2024-12-26 14:50:50', 90, '94102', 'Pendiente'),
(1925, 'ROYS', '2024-12-26 14:50:50', 90, '94103', 'Pendiente'),
(1926, 'abel', '2024-12-26 14:50:50', 90, '94104', 'Pendiente'),
(1927, 'abel', '2024-12-26 14:50:50', 90, '94105', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `linea` varchar(50) DEFAULT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `especificaciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`especificaciones`)),
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `referencia`, `nombre_producto`, `marca`, `linea`, `descripcion_producto`, `especificaciones`, `imagen`) VALUES
(1, '12R22.5-TR-WON', 'LLANTA 12 R22.5 18PR AL969 WONDERLAND ', 'WONDERLAND', 'LLANTAS', 'LLANTA 12 R22.5 TRACCION MIXTA 50%/50% 18PR AL969 WONDERLAND ', '[{\"titulo\":\"tama\\u00f1o\",\"descripcion\":\"12R22.5\"},{\"titulo\":\"Numero de lonas\",\"descripcion\":\"18\"},{\"titulo\":\"diametro\",\"descripcion\":\"1082\"},{\"titulo\":\"capacidad maxima de carga\",\"descripcion\":\"3550\\/3250\"},{\"titulo\":\"ancho de rin\",\"descripcion\":\"9.00\"},{\"titulo\":\"pr inicial\",\"descripcion\":\"18.5\"}]', 'AL969 WONDERLAND.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `nombre_usuario` varchar(100) DEFAULT '',
  `rol` varchar(50) DEFAULT 'Ninguno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `created_at`, `nombre_usuario`, `rol`) VALUES
(5, 'rbayonagalvis@gmail.com', '$2y$10$A8vkdqqHUmFSw6eVOdB7P.6mMYnshlHpYYpik3WGme2MO8jY0H9by', '2024-10-11 11:07:40', 'Ruben Bayona', 'Admin'),
(6, 'andru1612@gmail.com', '$2y$10$vWcFedkXdID97eKc2SRGKOKsANnN.O.rf1BFgETJFg6iX26Y9IMaG', '2024-11-06 14:21:24', 'Andres Martinez', 'Bodega'),
(7, 'arbeyconeo.34@gmail.com', '$2y$10$FNsbs6nfYf6gKsz8/viLd.Lf5TTs4wlChQ/8xAGtEh6ylPL7Z6s5G', '2024-11-06 14:39:04', 'Arbey Coneo', 'Bodega');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1928;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
