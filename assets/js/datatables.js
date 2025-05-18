// Archivo para la configuración de los DataTables
if (document.querySelector('#tablaOrdenar')) {
    $(document).ready(function () {
        $('#tablaOrdenar').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": -1 } // Desactivar el ordenamiento en la columna de acciones
            ],
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ trabajos",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "zeroRecords": "No se encontraron resultados",
                "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
                "infoFiltered": "(filtrado de _MAX_ trabajos totales)"
            }
        });

        // Evento de clic en la fila para redirigir
        $('#tablaOrdenar tbody').on('click', 'tr', function () {
            const url = $(this).data('href');
            if (url) {
                window.location.href = url;
            }
        });
    });
}
