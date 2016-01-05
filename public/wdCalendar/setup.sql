SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `jqcalendar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `IsAllDayEvent` smallint(6) NOT NULL,
  `Color` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RecurringRule` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
