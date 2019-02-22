<?php

/*
 * Editor server script for DB table tblpersone
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
$db->sql( "CREATE TABLE IF NOT EXISTS `tblpersone` (
	`Idpersona` int(10) NOT NULL auto_increment,
	`Nome` varchar(255),
	`Cognome` varchar(255),
	`DataNascita` date,
	`Reddito` varchar(255),
	`Sesso` varchar(255),
	PRIMARY KEY( `Idpersona` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tblpersone', 'Idpersona' )
	->fields(
		Field::inst( 'Nome' ),
		Field::inst( 'Cognome' ),
		Field::inst( 'DataNascita' )
			->validator( Validate::dateFormat( 'd/m/y' ) )
			->getFormatter( Format::dateSqlToFormat( 'd/m/y' ) )
			->setFormatter( Format::dateFormatToSql( 'd/m/y' ) ),
		Field::inst( 'Reddito' ),
		Field::inst( 'Sesso' )
	)
	->process( $_POST )
	->json();
