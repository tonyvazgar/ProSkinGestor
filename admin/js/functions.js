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