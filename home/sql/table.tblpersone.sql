-- 
-- Editor SQL for DB table tblpersone
-- Created by http://editor.datatables.net/generator
-- 

CREATE TABLE IF NOT EXISTS `tblpersone` (
	`Idpersona` int(10) NOT NULL auto_increment,
	`Nome` varchar(255),
	`Cognome` varchar(255),
	`DataNascita` date,
	`Reddito` varchar(255),
	`Sesso` varchar(255),
	PRIMARY KEY( `Idpersona` )
);