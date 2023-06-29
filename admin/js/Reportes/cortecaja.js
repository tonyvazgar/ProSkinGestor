$(document).ready(function () {
    var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>";

    $("#formFechasCorteCaja").submit(function (e) {
        opcion = 1; //alta
        e.preventDefault();
        start_date = $("#startDate").val();
        end_date = $("#endDate").val();
        sucursal = $("#endDate").val();

        const data = { start_date, end_date, sucursal, opcion };

        // Data to send to get charts
        const dataChartDiasvsNumventas = { 
            start_date,
            end_date,
            sucursal,
            type: 'numventas'
        };

        const dataChartDiasvsIngresos  = {
            start_date,
            end_date,
            sucursal,
            type: 'ingresos'
        };

        const dataChartDiasvsGastos  = {
            start_date,
            end_date,
            sucursal,
            type: 'gastos'
        };
        
        const dataChartDiasvsCaja  = {
            start_date,
            end_date,
            sucursal,
            type: 'caja'
        };

        $.ajax({
            url: "/admin/bd/Reportes/Caja.php",
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

        drawChartDiasvsNumventas(dataChartDiasvsNumventas, `Número de ventas por dia entre ${start_date} y ${end_date}`);
        drawChartDiasvsIngresos(dataChartDiasvsIngresos, `Ingresos por día entre ${start_date} y ${end_date}`);
        drawChartDiasvsGastos(dataChartDiasvsGastos, `Gastos por día entre ${start_date} y ${end_date}`);
        drawChartDiasvsCaja(dataChartDiasvsCaja, `Corte de caja por día entre ${start_date} y ${end_date}`);
    });
});


const drawChartDiasvsNumventas = function (data, caption) {
    $.ajax({
        url: '/admin/charts/CorteCaja/chartData.php',
        type: "POST",
        dataType: "json",
        data,
        success: function (data) {
            chartData = data;
            xAxisName = "Días";
            yAxisName = "# ventas";
            var chartProperties = {
                "caption": caption,
                "xAxisName": xAxisName,
                "yAxisName": yAxisName,
                "rotatevalues": "1",
                "theme": "ocean"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'div-grafica-diasvsnumventas',
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

const drawChartDiasvsIngresos = function (data, caption) {
    $.ajax({
        url: '/admin/charts/CorteCaja/chartData.php',
        type: "POST",
        dataType: "json",
        data,
        success: function (data) {
            chartData = data;
            xAxisName = "Días";
            yAxisName = "$ Ingresos";
            var chartProperties = {
                "caption": caption,
                "xAxisName": xAxisName,
                "yAxisName": yAxisName,
                "rotatevalues": "1",
                "theme": "fint"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'div-grafica-diasvsingresos',
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

const drawChartDiasvsGastos = function (data, caption) {
    $.ajax({
        url: '/admin/charts/CorteCaja/chartData.php',
        type: "POST",
        dataType: "json",
        data,
        success: function (data) {
            chartData = data;
            xAxisName = "Días";
            yAxisName = "$ Gastos";
            var chartProperties = {
                "caption": caption,
                "xAxisName": xAxisName,
                "yAxisName": yAxisName,
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'div-grafica-diasvsgastos',
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

const drawChartDiasvsCaja = function (data, caption) {
    $.ajax({
        url: '/admin/charts/CorteCaja/chartData.php',
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
                renderAt: 'div-grafica-diasvscaja',
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