const getDatesFromToday = function (daysToDecrease) {
    // Crear una nueva instancia de fecha
    var fechaActual = new Date();

    // Obtener los componentes de la fecha
    var año = fechaActual.getFullYear();
    var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript son base 0, por lo que se suma 1
    var día = fechaActual.getDate();

    // Formatear los componentes en el formato Y-m-d
    var fechaActualFormateada = año + '-' + mes.toString().padStart(2, '0') + '-' + día.toString().padStart(2, '0');

    // Restar 15 días
    fechaActual.setDate(fechaActual.getDate() - daysToDecrease);

    // Obtener los componentes de la fecha
    var año = fechaActual.getFullYear();
    var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript son base 0, por lo que se suma 1
    var día = fechaActual.getDate();

    // Formatear los componentes en el formato Y-m-d
    var fechaAnteriorFormateada = año + '-' + mes.toString().padStart(2, '0') + '-' + día.toString().padStart(2, '0');

    const dates = {
        today: fechaActualFormateada,
        decreasedDays: fechaAnteriorFormateada
    };

    return dates;
}

const donwloadExcelFile = function (data, filename) {

    var downloadLink = document.createElement("a");
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);

    $.ajax({
        url: "/admin/vendor/files/excelMaker.php",
        type: "POST",
        data,
        success: function (datas) {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const hours = String(today.getHours()).padStart(2, '0');
            const minutes = String(today.getMinutes()).padStart(2, '0');
            const seconds = String(today.getSeconds()).padStart(2, '0');
            const fullDate = `${year}-${month}-${day}_${hours}.${minutes}.${seconds}`;

            var blob = new Blob([datas], { type: "text/csv" });
            var url = URL.createObjectURL(blob);

            downloadLink.href = url;
            downloadLink.download = `${filename}_${fullDate}.csv`;
            downloadLink.click();

            URL.revokeObjectURL(url);

            alert("Descarga completa 😃");
        },
        error: function () {
            alert("Error al descargar el archivo Excel 😢");
        },
    });
};