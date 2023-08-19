$(document).ready(function () {
    var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>";

    var fila; //capturar la fila para editar o borrar el registro


    $("#formFechasRegistroClienteReport").submit(function (e) {
        opcion = 1; //alta
        e.preventDefault();
        start_date = $("#startDate").val();
        end_date = $("#endDate").val();
        sucursal = $("#endDate").val();

        const data = { start_date, end_date, sucursal, opcion };

        $.ajax({
            url: "/admin/bd/Reportes/Cliente.php",
            type: "POST",
            dataType: "html",
            data,
            success: function (datas) {
                $("#data").html(datas);

                productsTable = $("#tablaPersonas").DataTable({
                   
            
                    //Para cambiar el lenguaje a español
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "sProcessing": "Procesando...",
                    }
                });
            }
        });
        $("#modalSucursal").modal("hide");
    });

    $("#data").on("click", "#exportExcelClientesRegistrados", function() {
        var downloadLink = document.createElement("a");
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        const data = { start_date, end_date, type: 'exportExcelClientesRegistrados' };
        
        
        $.ajax({
            url: "/admin/vendor/files/excelMaker.php",
            type: "POST",
            data,
            success: function (datas) {
                const todaysDate = new Date().toLocaleDateString('en-GB');
                // Prepara la respuesta como un Blob para descargar el archivo
                var blob = new Blob([datas], { type: "text/csv" });
                var url = URL.createObjectURL(blob);

                // Configura el enlace para la descarga y simula el clic
                downloadLink.href = url;
                downloadLink.download = `resultados_Clientes_${todaysDate}.csv`;
                downloadLink.click();

                // Limpia la URL del objeto Blob
                URL.revokeObjectURL(url);

                alert("Descarga completa 😃");
            },
            error: function () {
                alert("Error al descargar el archivo Excel 😢");
            }
        });
    });
});