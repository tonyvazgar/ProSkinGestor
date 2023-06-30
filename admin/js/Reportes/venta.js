$(document).ready(function () {
    var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>";

    var fila; //capturar la fila para editar o borrar el registro


    $("#formVentas").submit(function (e) {
        opcion = 1; //alta
        e.preventDefault();
        start_date = $("#startDate").val();
        end_date = $("#endDate").val();
        sucursal = $("#endDate").val();

        const data = { start_date, end_date, sucursal, opcion };

        $.ajax({
            url: "/admin/bd/Reportes/Venta.php",
            type: "POST",
            dataType: "html",
            data,
            success: function (datas) {
                $("#data").html(datas);

                productsTable = $("#tablaPersonas").DataTable({
                    "columnDefs": [{
                        "targets": -1,
                        "data": null,
                        "defaultContent": actionButtons
                    }],

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

    $("#formVentasInventario").submit(function (e) {
        opcion = 2; //alta
        e.preventDefault();
        start_date = $("#startDate").val();
        end_date = $("#endDate").val();
        sucursal = $("#endDate").val();

        const data = { start_date, end_date, sucursal, opcion };

        $.ajax({
            url: "/admin/bd/Reportes/Venta.php",
            type: "POST",
            dataType: "html",
            data,
            success: function (datas) {
                $("#data").html(datas);

                productsTable = $("#tablaPersonas").DataTable({
                    "columnDefs": [{
                        "targets": -1,
                        "data": null,
                        "defaultContent": actionButtons
                    }],

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

    $("#formTratamientosAplicados").submit(function (e) {
        opcion = 3; //alta
        e.preventDefault();
        start_date = $("#startDate").val();
        end_date = $("#endDate").val();
        sucursal = $("#endDate").val();

        const data = { start_date, end_date, sucursal, opcion };

        const dataChartVentasDiarias = {
            start_date,
            end_date,
            sucursal,
            type : 'ventas_diarias'
        };

        $.ajax({
            url: "/admin/bd/Reportes/Venta.php",
            type: "POST",
            dataType: "html",
            data,
            success: function (datas) {
                $("#data").html(datas);

                productsTable = $("#tablaPersonas").DataTable({
                    "columnDefs": [{
                        "targets": -1,
                        "data": null,
                        "defaultContent": actionButtons
                    }],

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


        drawChartVentasDiarias(dataChartVentasDiarias, `Corte de caja por día entre ${start_date} y ${end_date}`);
    });

});

const drawChartVentasDiarias = function (data, caption) {
    $.ajax({
        url: '/admin/charts/Ventas.php',
        type: "POST",
        dataType: "json",
        data,
        success: function (data) {
            chartData = data;
            xAxisName = "Días";
            yAxisName = "$ Caja";
            var chartProperties = {
                "caption": caption,
                "xAxisName": xAxisName,
                "yAxisName": yAxisName,
                "rotatevalues": "1",
                "theme": "carbon"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'div-grafica-ventasdiarias',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
}