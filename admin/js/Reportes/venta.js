$(document).ready(function () {
    if($("#formTratamientosAplicados").length != 0) {
        getWidgetsFifteenDaysVentas();
    }
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
        $("#fifteen-days-cortecaja-widgets").hide();


        drawChartVentasDiarias(dataChartVentasDiarias, `Corte de caja por día entre ${start_date} y ${end_date}`);
    });

    $("#data").on("click", "#exportExcelVentas", function() {
        var downloadLink = document.createElement("a");
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        const data = { start_date, end_date, type: 'exportExcelVentas' };
        
        
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
                downloadLink.download = `resultados_Ventas_${todaysDate}.csv`;
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

    $("#data").on("click", "#exportExcelTratamientosAplicados", function() {
        var downloadLink = document.createElement("a");
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        const data = { start_date, end_date, type: 'exportExcelTratamientosAplicados' };
        
        
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
                downloadLink.download = `resultados_TratamientosAplicados_${todaysDate}.csv`;
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


const getWidgetsFifteenDaysVentas = function () {

    const dates = getDatesFromToday(15);

    const dataWidgets  = {
        start_date: dates.decreasedDays,
        end_date: dates.today,
        opcion: 'widgets15days'
    };

    $.ajax({
        url: '/admin/bd/Reportes/Venta.php',
        type: "POST",
        dataType: "html",
        data: dataWidgets,
        success: function (data) {
            $("#fifteen-days-cortecaja-widgets").append(data);
        }
    });
}