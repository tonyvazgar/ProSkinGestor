$(document).ready(function () {
    let start_date;
    let end_date;
    if($("#fifteen-days-cortecaja-widgets").length != 0) {
        getWidgetsFifteenDaysCorteCaja();
    }
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

        drawChartDiasvsNumventas(dataChartDiasvsNumventas, `Número de ventas por dia entre ${start_date} y ${end_date}`);
        drawChartDiasvsIngresos(dataChartDiasvsIngresos, `Ingresos por día entre ${start_date} y ${end_date}`);
        drawChartDiasvsGastos(dataChartDiasvsGastos, `Gastos por día entre ${start_date} y ${end_date}`);
        drawChartDiasvsCaja(dataChartDiasvsCaja, `Corte de caja por día entre ${start_date} y ${end_date}`);
    });

    $("#data").on("click", "#exportExcelCorteCaja", function() {
        var downloadLink = document.createElement("a");
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        const data = { start_date, end_date, type: 'exportExcelCorteCaja' };
        
        
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
                downloadLink.download = `resultados_CorteCaja_${todaysDate}.csv`;
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

            // apiChart = new FusionCharts({
            //     type: "mscolumn2d",
            //     renderAt: "div-grafica-diasvsingresos",
            //     width: "500",
            //     height: "300",
            //     dataFormat: "json",
            //     dataSource: {
            //         chart: {
            //             caption: "Comparison of Quarterly Revenue",
            //             subCaption: "Harry's SuperMart",
            //             xAxisname: "Quarter",
            //             yAxisName: "Revenues (In USD)",
            //             numberPrefix: "$",
            //             theme: "fusion",
            //         },
            //         categories: [
            //             {
            //                 category: [
            //                     {
            //                         label: "Q1",
            //                     },
            //                     {
            //                         label: "Q2",
            //                     },
            //                     {
            //                         label: "Q3",
            //                     },
            //                     {
            //                         label: "Q4",
            //                     },
            //                 ],
            //             },
            //         ],
            //         dataset: [
            //             {
            //                 seriesname: "Previous Year",
            //                 data: [
            //                     {
            //                         value: "1",
            //                     },
            //                     {
            //                         value: "5",
            //                     },
            //                     {
            //                         value: "9",
            //                     },
            //                     {
            //                         value: "10",
            //                     },
            //                 ],
            //             },
            //             {
            //                 seriesname: "Current Year",
            //                 data: [
            //                     {
            //                         value: "5",
            //                     },
            //                     {
            //                         value: "6",
            //                     },
            //                     {
            //                         value: "7",
            //                     },
            //                     {
            //                         value: "8",
            //                     },
            //                 ],
            //             },
            //             {
            //                 seriesname: "Previous Year",
            //                 data: [
            //                     {
            //                         value: "9",
            //                     },
            //                     {
            //                         value: "10",
            //                     },
            //                     {
            //                         value: "11",
            //                     },
            //                     {
            //                         value: "12",
            //                     },
            //                 ],
            //             },
            //             {
            //                 seriesname: "Previous Year",
            //                 data: [
            //                     {
            //                         value: "10000",
            //                     },
            //                     {
            //                         value: "11500",
            //                     },
            //                     {
            //                         value: "12500",
            //                     },
            //                     {
            //                         value: "15000",
            //                     },
            //                 ],
            //             },
            //         ],
            //     },
            // });

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


const getWidgetsFifteenDaysCorteCaja = function () {
    
    const dates = getDatesFromToday(15);

    const dataWidgets  = {
        start_date: dates.decreasedDays,
        end_date: dates.today,
        opcion: 'widgets15days'
    };

    $.ajax({
        url: '/admin/bd/Reportes/Caja.php',
        type: "POST",
        dataType: "html",
        data: dataWidgets,
        success: function (data) {
            $("#fifteen-days-cortecaja-widgets").append(data);
        }
    });
}