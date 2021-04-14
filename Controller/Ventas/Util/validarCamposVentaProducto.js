$(document).ready(function () {
    $("#venderProducto").hide();
    $('#cantidad').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock').val());
        let precioUnitario      = parseInt($('#precioUnitario').val());
        let cantidad            = parseInt($('#cantidad').val());

        if(cantidad <= unidadesDisponibles){
            $("#cantidad").css("border", "2px solid green");
            $("#venderProducto").show();
        }else{
            $("#cantidad").css("border", "2px solid red");
            $("#venderProducto").hide();
        }
        $('#total').val(precioUnitario * cantidad);
    });

});