SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";

CREATE TABLE IF NOT EXISTS `IPLogs` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `IP` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Hostname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Port` int(8) NOT NULL,
  `UserAgent` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;