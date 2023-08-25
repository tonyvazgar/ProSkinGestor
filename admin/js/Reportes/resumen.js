$(document).ready(function () {

    getWidgetsVentasTotales();

    getWidgetsClientes();
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


const getWidgetsVentasTotales = function () {

    const dates = getDatesFromToday(15);

    const dataWidgets  = {
        start_date: dates.decreasedDays,
        end_date: dates.today,
        opcion: 'widgetsVentasTotales'
    };

    $.ajax({
        url: '/admin/bd/Reportes/Resumen.php',
        type: "POST",
        dataType: "html",
        data: dataWidgets,
        success: function (data) {
            $("#widgetsVentasTotales").append(data);
        }
    });

}

const getWidgetsClientes = function () {
    const dates = getDatesFromToday(15);

    const dataWidgets  = {
        start_date: dates.decreasedDays,
        end_date: dates.today,
        opcion: 'widgetsClientes'
    };

    $.ajax({
        url: '/admin/bd/Reportes/Resumen.php',
        type: "POST",
        dataType: "html",
        data: dataWidgets,
        success: function (data) {
            $("#widgetsClientes").append(data);
        }
    });
}