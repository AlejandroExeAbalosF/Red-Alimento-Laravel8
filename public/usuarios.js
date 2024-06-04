let configurationDataTable = {
    responsive: true,
	language: {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"search": "_INPUT_",
		"searchPlaceholder": "...",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	},
}

$(function() {

    configurationDataTable['dom'] = 'lfrtip';

    configurationDataTable['order'] = [
        [0, "desc"]
    ];

    configurationDataTable['fnCreatedRow'] = function (row, data, iDataIndex) {
        $(row).attr('id', data.id);
    };

    configurationDataTable['ajax'] = {
        url: 'get_users',
        method: 'GET',
        dataSrc: function (json) {
            return json;
        }
    };

    configurationDataTable['columns'] = [
        { 
            data: function(data, type, dataToSet) {
                return data.id;
            }
        },
        {
            data: function (data, type, dataToSet) {
                return data.name;
            }
        },
        {
            data: function(data, type, dataToSet) {
                return data.email;
            }
        },
        {
            data: function(data, type, dataToSet) {
                let date = new Date(data.created_at);
                return date.toLocaleString('es-AR');
            }
        },
    ];

    let table = $('#usuarios_id').DataTable(configurationDataTable);
    
    /*intervalReload = setInterval( function () {
        table.ajax.reload(null, false);
    }, 15000);*/
});