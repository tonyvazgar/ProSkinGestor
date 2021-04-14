$(document).ready(function () {
    $("#venderProducto").hide();
    $('#total').val(0.0);
    $('#cantidad').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock').val());
        let precioUnitario      = parseFloat($('#precioUnitario').val());
        let cantidad            = parseInt($('#cantidad').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);

        if(cantidad <= unidadesDisponibles){
            $("#cantidad").css("border", "2px solid green");
            $("#venderProducto").show();
        }else{
            $("#cantidad").css("border", "2px solid red");
            $("#venderProducto").hide();
        }
        $('#total').val(total);
    });

});