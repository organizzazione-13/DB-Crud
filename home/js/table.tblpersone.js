/*
 * Editor client script for DB table tblpersone
 * Created by http://editor.datatables.net/generator
 */

(function ($) {

	$(document).ready(function () {
		var editor = new $.fn.dataTable.Editor({
			ajax: 'php/table.tblpersone.php',
			table: '#tblpersone',
			fields: [{
					"label": "Nome:",
					"name": "Nome"
				},
				{
					"label": "Cognome:",
					"name": "Cognome"
				},
				{
					"label": "Data di nascita:",
					"name": "DataNascita",
					"type": "datetime",
					"format": "DD\/MM\/YY"
				},
				{
					"label": "Reddito:",
					"name": "Reddito",
					"type": "select",
					"options": [
						"10000",
						" 20000",
						" 30000 ",
						"40000"
					]
				},
				{
					"label": "Sesso:",
					"name": "Sesso",
					"type": "select",
					"options": [
						"Uomo",
						" Donna"
					]
				}
			]
		});

		var table = $('#tblpersone').DataTable({
			ajax: 'php/table.tblpersone.php',
			columns: [{
					"data": "Nome"
				},
				{
					"data": "Cognome"
				},
				{
					"data": "DataNascita"
				},
				{
					"data": "Reddito"
				},
				{
					"data": "Sesso"
				}
			],
			select: true,
			lengthChange: false
		});

		new $.fn.dataTable.Buttons(table, [{
				extend: "create",
				editor: editor
			},
			{
				extend: "edit",
				editor: editor
			},
			{
				extend: "remove",
				editor: editor
			}
		]);

		table.buttons().container()
			.appendTo($('.col-md-6:eq(0)', table.table().container()));
	});
}(jQuery));