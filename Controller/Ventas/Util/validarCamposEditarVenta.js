$(document).ready(function () {
    var cssId = 'myCss';  // you could encode the css path itself to generate id..
    if (!document.getElementById(cssId))
    {
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.id   = cssId;
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = './css/styleEditarVenta.css';
        link.media = 'all';
        head.appendChild(link);
    }
});
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
    var front_producto = '<hr><div class="plantilla"><div class="form-group"><table class="table table-borderless"><thead><tr><td scope="col"><h4>Marca a buscar*</h4></td><td scope="col"><h4>Linea a buscar*</h4></td></tr></thead><tbody><tr><td><select name="marca" id="marca" class="last_producto form-control"><option value="">** SELECCIONA **</option><option value="MIGUETT">MIGUETT</option><option value="AINHOA">AINHOA</option><option value="GERMAINE">GERMAINE</option></select></td><td><select name="linea" id="linea" class="last_producto form-control"><option value="">** SELECCIONA **</option><option value="PURITY">PURITY</option><option value="WHITESS">WHITESS</option><option value="OXYGEN">OXYGEN</option><option value="SENSKIN">SENSKIN</option><option value="COLLAGEN%2B">COLLAGEN +</option><option value="MULTIVIT">MULTIVIT</option><option value="BIOME CARE">BIOME CARE</option><option value="OLIVE">OLIVE</option><option value="SPECIFIC">SPECIFIC</option><option value="HYALURONIC">HYALURONIC</option><option value="SKIN PRIMERS">SKIN PRIMERS</option><option value="BODY LINE UP">BODY LINE UP</option><option value="CANNABI">CANNABI</option><option value="SPA LUXURY">SPA LUXURY</option><option value="OTRO">OTRO</option><option value="PACKS">PACKS</option></select></td></tr></tbody></table><div class="last_producto form-group" id="otroProducto" name="otroProducto"></div><div class="last_producto form-group" id="productos" name="productos"></div><div class="form-group"><table class="table table-borderless" style="table-layout:fixed"><tbody><tr><td><h4>ID producto:</h4><p class="last_producto lead id_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="id_producto_seleccionado" name="id_producto_seleccionado[]" hidden readonly="readonly"></td><td><h4>Unidades disponibles</h4><p class="last_producto lead stock_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="stock_producto_seleccionado" name="stock_producto_seleccionado[]" hidden readonly="readonly"></td></tr></tbody></table></div><div class="form-group"><h4>Descripción:</h4><p class="last_producto lead desc_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="desc_producto_seleccionado" name="desc_producto_seleccionado" hidden readonly="readonly"></div><div class="form-group"><table class="table table-borderless"><tbody><tr><td><h4>Precio por pieza</h4><input type="number" class="last_producto form-control" id="precioUnitario_producto_seleccionado" name="precioUnitario_producto_seleccionado[]" style="display: none;"></td><td><h4>Cantidad</h4><input type="number" class="last_producto form-control" id="cantidad_producto_seleccionado" name="cantidad_producto_seleccionado[]" placeholder="Unidades a verder" style="display: none;" required></td></tr></tbody></table></div><div class="form-group"><table class="table table-borderless"><tbody><tr><td><h4>Precio de venta</h4><p class="last_producto lead total_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="total_producto_seleccionado" name="total_producto_seleccionado[]" hidden readonly="readonly"></td></tr></tbody></table></div></div></div>';
        


    $("#nuevoProducto").append(front_producto);

    alert('Agregaremos otro producto');
    // $('.totalText').hide();
    // $('#totalForm').show();
    // $(this).hide();
});

//---------------- eliminarProductoButton BUTTON
$(document).on('click', "#eliminarProductoButton", function () {
    var result = confirm("¿Estás seguro de eliminar este producto?\nEsta acción ya no se puede deshacer!");
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
    var front_tratamiento = '<hr><div class="col-xs-4"><h3 class="numTratamientos">Tratamiento #1</h3><div class="well well-sm"><div class="form-group"><label>Tratamiento a empezar</label><select name="tratamiento[]" id="tratamiento" class="last_tratamiento form-control"><option>*** SELECCIONA ***</option><option value="1">Depilación</option><option value="2">Cavitación</option><option value="3">Otros tratamientos</option></select></div><div class="last_tratamiento form-group" id="otro" name="otro"></div><div class="form-group" hidden><label>Calificación</label><select name="calificacion[]" id="calificacion" class="form-control" hidden><option value="1">☆</option><option value="2">☆☆</option><option value="3">☆☆☆</option><option value="4">☆☆☆☆</option><option value="5">☆☆☆☆☆</option></select></div><div class="form-group"><label>Comentarios</label><textarea name="comentarios[]" id="comentarios" cols="30" rows="5" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento"></textarea></div></div></div>';
    
    $("#nuevoTratamiento").append(front_tratamiento);
    // $('.totalText').hide();
    // $('#totalForm').show();
    // $(this).hide();
});

//---------------- eliminarTratamientoButton BUTTON
$(document).on('click', "#eliminarTratamientoButton", function () {
    var result = confirm("¿Estás seguro de eliminar este tratamiento?\nEsta acción ya no se puede deshacer!");
    if (result) {
        const clase = '.' + $(this).attr('class');

        //FALTA AGREGAR

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
                // alert(r);
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
