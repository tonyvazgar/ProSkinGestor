//---------------- METODO DE PAGO BUTTON
$(document).on('click', "#metodoPagoButton", function () {
    // alert('Hola');
    $('.metodoPagoText').hide();
    $('#metodoPagoForm').show();
    $(this).hide();
});
$(document).on('click', "#cancelarMetodoPagoButton", function () {
    $('.metodoPagoText').show();
    $('#metodoPagoForm').hide();
    $('#metodoPagoButton').show();
});


//---------------- TOTAL BUTTON
$(document).on('click', "#totalButton", function () {
    // alert('Hola');
    $('.totalText').hide();
    $('#totalForm').show();
    $(this).hide();
});
$(document).on('click', "#cancelarTotalButton", function () {
    $('.totalText').show();
    $('#totalForm').hide();
    $('#totalButton').show();
});


/*******************
 *****PRODUCTOS*****
 *******************/

//----------------  agregarProductoButton BUTTON
$(document).on('click', "#agregarProductoButton", function () {
    alert('Agregaremos otro producto');
    // $('.totalText').hide();
    // $('#totalForm').show();
    // $(this).hide();
});

//---------------- eliminarProductoButton BUTTON
$(document).on('click', "#eliminarProductoButton", function () {
    var result = confirm("¿Est@s segur@ de eliminar este producto?");
    if (result) {
        const clase = '.' + $(this).attr('class');

        $.ajax({
            type: "POST",
            url: "../../Controller/Ventas/AJAX_elminar_producto.php",
            data: "id_producto=" + $('#idProducto.form-control' + clase).val() + "&id_venta=" + $('#idCliente.form-control' + clase).val() + "&stock=" + $('#cantidadProducto.form-control' + clase).val(),
            success: function (r) {
                if (r == '1') {
                    location.reload();
                } else {
                    alert('no se hizo');
                }
            }
        });
        alert("Ya se eliminó!");
    }
});

//---------------- editarProductoButton BUTTON
$(document).on('click', "#editarProductoButton", function () {
    // confirm('eliminarProductoButton otro tratamiento');
    const clase = '.' + $(this).attr('class');
    console.log('.' + clase);
    $(clase).closest('.infoProductoText').hide();
    $('#infoProductoForm.card-body' + clase).show();
    // $(this).hide();
});

$(document).on('click', "#cancelarProductoButton", function () {
    const clase = '.' + $(this).attr('name');
    console.log('.' + clase);
    $(clase).closest('.infoProductoText').show();
    $('#infoProductoForm.card-body' + clase).hide();
    // $(this).hide();
});

$(document).on('keyup', '#precioUnitarioProducto', function () {
    // alert($(this).val());

    // $(this).parent().closest('#cantidadProducto').hide();
    // let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
    // let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
    // let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());

    // var total               = parseFloat(precioUnitario * cantidad);
    // total                   = isNaN(total) ? 0 : total.toFixed(2);

    // if(cantidad <= unidadesDisponibles && cantidad > 0){
    //     $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid green");
    //     $("#venderProducto").show();
    //     $("#btn-apartar-producto.last_producto").attr('disabled', false);
    // }else{
    //     $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid red");
    //     $("#venderProducto").hide();
    //     $("#btn-apartar-producto.last_producto").attr('disabled', true);
    // }
    // $('#total_producto_seleccionado.last_producto').val(total);
    // $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
});

$(document).on('keyup', '#cantidadProducto', function () {
    // alert($(this).val());

    // $(this).closest('#precioTotalProducto').hide();
});

$(document).on('keyup', '#precioTotalProducto', function () {
    // alert($(this).val());

    // $(this).closest('#precioUnitarioProducto').hide();

});





/**********************
 *****TRATAMIENTOS*****
 **********************/

//---------------- agregarTratamientoButton BUTTON
$(document).on('click', "#agregarTratamientoButton", function () {
    alert('Agregaremos otro tratamiento');
    // $('.totalText').hide();
    // $('#totalForm').show();
    // $(this).hide();
});

//---------------- eliminarTratamientoButton BUTTON
$(document).on('click', "#eliminarTratamientoButton", function () {
    var result = confirm("¿Est@s segur@ de eliminar este traramiento?");
    if (result) {
        const clase = '.' + $(this).attr('class');

        //FALTA ELIMINAR TRATAMIENTOS Y EDITAR LOS ESPECIALES Y AGREGAR

        $.ajax({
            type: "POST",
            url: "../../Controller/Ventas/AJAX_elminar_tratamiento.php",
            data: "id_tratamiento=" + $('#idTratamiento.form-control' + clase).val() + "&id_venta=" + $('#idVenta.form-control' + clase).val() + "&timeStamp=" + $('#timeStamp.form-control' + clase).val(),
            success: function (r) {
                if (r == '1') {
                    location.reload();
                } else {
                    alert('no se hizo');
                }
            }
        });
        // alert("Ya se eliminó!");
    }
});

//---------------- editarTratamientoButton BUTTON
$(document).on('click', "#editarTratamientoButton", function () {
    const clase = '.' + $(this).attr('class');
    console.log('.' + clase);
    $(clase).closest('.infoTratamientoText').hide();
    $('#infoTratamientoForm.card-body' + clase).show();
    // $(this).hide();
});

$(document).on('click', "#cancelarTratamientoButton", function () {
    const clase = '.' + $(this).attr('name');
    console.log('.' + clase);
    $(clase).closest('.infoTratamientoText').show();
    $('#infoTratamientoForm.card-body' + clase).hide();
    // $(this).hide();
});
