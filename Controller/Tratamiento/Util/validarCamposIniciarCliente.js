var productosVerificados = 0;
var tratamientosVerificados = 0;
$('body').on('change','#aviso',function () {
    var opt = $("#aviso").val();
    if(opt == "1"){
        $("#botonComenzar").show();
    }else{
        $("#botonComenzar").hide();
    }

    $("#otro .zonasCheckbox").each(function(i, obj) {
        $(this).find('input.check').attr('name', "zonas_cuerpo["+i+"][]");
    });
    // verificacionGeneral(verificarAntesNuevoTratamiento(), verificarAntesNuevoProducto());
});

$(document).ready(function () {
    $("#botonComenzar").hide();
    
    var front_tratamiento = '<hr><div class="col-xs-4"><h3 class="numTratamientos">Tratamiento #1</h3><div class="well well-sm"><div class="form-group"><label>Tratamiento a empezar</label><select name="tratamiento[]" id="tratamiento" class="last_tratamiento form-control"><option>*** SELECCIONA ***</option><option value="1">Depilación</option><option value="2">Cavitación</option><option value="3">Otros tratamientos</option></select></div><div class="last_tratamiento form-group" id="otro" name="otro"></div><div class="form-group" hidden><label>Calificación</label><select name="calificacion[]" id="calificacion" class="form-control" hidden><option value="1">☆</option><option value="2">☆☆</option><option value="3">☆☆☆</option><option value="4">☆☆☆☆</option><option value="5">☆☆☆☆☆</option></select></div><div class="form-group"><label>Comentarios</label><textarea name="comentarios[]" id="comentarios" cols="30" rows="5" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento"></textarea></div></div></div>';
    $("#div-agregarTratamiento").on('click', '.btn-agregar-tratamiento', function(){
        actualizarTotalDeVenta();
        $("#metodo_pago_div").hide();
        $("#agregar_boton_pago_div").hide();
        $("#firma_div").hide();
        // Agregamos el formulario
        var n = $("#elementos .col-xs-4").length + 1;
        $("#elementos .last_tratamiento").removeClass('last_tratamiento');
        $("#elementos").append(front_tratamiento);
        $("#elementos .col-xs-4:last .numTratamientos").html("Tratamiento #" + n);

       

        console.log("Vamos a agregar otro tratamiento");
        $("#elementos .col-xs-4:last .well").append('<button class="btn-danger btn btn-block btn-quitar-tratamiento" type="button">Eliminar tratamiento #' + n + '</button>');
        
        $("#aviso").val("");
        alert("Se agregó otro tratamiento.\n\nNota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR F5");
        $("#btn-agregar-tratamiento").attr('disabled', true);
        $("#btn-agregar-producto").attr('disabled', true);
        $("#botonComenzar").hide();
    });

    $("#div-agregarTratamiento").on('click', '.btn-agregar-producto', function(){
        actualizarTotalDeVenta();
        $("#metodo_pago_div").hide();
        $("#agregar_boton_pago_div").hide();
        $("#firma_div").hide();
        var num_producto = $("#elementos .plantilla").length + 1;
        var front_producto = '<hr><div class="plantilla"><h2 class="numProductos">Producto #'+num_producto+'</h2><div class="form-group"><table class="table table-borderless"><thead><tr><td scope="col"><h4>Marca a buscar*</h4></td><td scope="col"><h4>Linea a buscar*</h4></td></tr></thead><tbody><tr><td><select name="marca" id="marca" class="last_producto form-control"><option value="">** SELECCIONA **</option><option value="MIGUETT">MIGUETT</option><option value="AINHOA">AINHOA</option><option value="GERMAINE">GERMAINE</option></select></td><td><select name="linea" id="linea" class="last_producto form-control"><option value="">** SELECCIONA **</option><option value="PURITY">PURITY</option><option value="WHITESS">WHITESS</option><option value="OXYGEN">OXYGEN</option><option value="SENSKIN">SENSKIN</option><option value="COLLAGEN%2B">COLLAGEN +</option><option value="MULTIVIT">MULTIVIT</option><option value="BIOME CARE">BIOME CARE</option><option value="OLIVE">OLIVE</option><option value="SPECIFIC">SPECIFIC</option><option value="HYALURONIC">HYALURONIC</option><option value="SKIN PRIMERS">SKIN PRIMERS</option><option value="BODY LINE UP">BODY LINE UP</option><option value="CANNABI">CANNABI</option><option value="SPA LUXURY">SPA LUXURY</option><option value="OTRO">OTRO</option><option value="PACKS">PACKS</option></select></td></tr></tbody></table><div class="last_producto form-group" id="otroProducto" name="otroProducto"></div><div class="last_producto form-group" id="productos" name="productos"></div><div class="form-group"><table class="table table-borderless" style="table-layout:fixed"><tbody><tr><td><h4>ID producto:</h4><p class="last_producto lead id_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="id_producto_seleccionado" name="id_producto_seleccionado[]" hidden readonly="readonly"></td><td><h4>Unidades disponibles</h4><p class="last_producto lead stock_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="stock_producto_seleccionado" name="stock_producto_seleccionado[]" hidden readonly="readonly"></td></tr></tbody></table></div><div class="form-group"><h4>Descripción:</h4><p class="last_producto lead desc_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="desc_producto_seleccionado" name="desc_producto_seleccionado" hidden readonly="readonly"></div><div class="form-group"><table class="table table-borderless"><tbody><tr><td><h4>Precio por pieza</h4><input type="number" class="last_producto form-control" id="precioUnitario_producto_seleccionado" name="precioUnitario_producto_seleccionado[]" style="display: none;"></td><td><h4>Cantidad</h4><input type="number" class="last_producto form-control" id="cantidad_producto_seleccionado" name="cantidad_producto_seleccionado[]" placeholder="Unidades a verder" style="display: none;" required></td></tr></tbody></table></div><div class="form-group"><table class="table table-borderless"><tbody><tr><td><h4>Precio de venta</h4><p class="last_producto lead total_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="total_producto_seleccionado" name="total_producto_seleccionado[]" hidden readonly="readonly"></td></tr></tbody></table></div></div></div>';
        
        $("#elementos .last_producto").removeClass('last_producto');
        $("#elementos").append(front_producto);
        $("#elementos .plantilla:last").append('<button class="btn-danger btn btn-block btn-quitar-producto" type="button">Eliminar producto #'+num_producto+'</button>');

        alert("Se agregó un producto.\n\nNota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR F5");
        $("#btn-agregar-tratamiento").attr('disabled', true);
        $("#btn-agregar-producto").attr('disabled', true);
        $("#botonComenzar").hide();
    });

    $("#elementos").on('click', '.btn-quitar-tratamiento', function(){
        $(this).closest('.col-xs-4').remove();
        $("#aviso").val("");
        $("#botonComenzar").hide();
        alert("Se quitó un tratamiento");
        verificarAntesNuevoTratamiento();
        verificarAntesNuevoProducto();
        verificarEliminarElemento();
        actualizarTotalDeVenta();
    });

    $("#elementos").on('click', '.btn-quitar-producto', function(){
        $(this).closest('.plantilla').remove();
        alert("Se quitó un producto de la lista");
        verificarAntesNuevoTratamiento();
        verificarAntesNuevoProducto();
        verificarEliminarElemento();
        actualizarTotalDeVenta();
    });
    $("#elementos").on('keyup', '#precioTratamiento.last_tratamiento', function(){
        verificarAntesNuevoTratamiento();
        actualizarTotalDeVenta();
    });    
});


$('body').on('change','#marca.last_producto',function () {
    if($('#marca.last_producto').val() == 'AINHOA'){
        $("#linea.last_producto").attr('disabled', false);
    }else{
        $("#linea.last_producto").val("");
        $("#linea.last_producto").attr('disabled', true);
    }
    recargarListaMarca();
});
$(document).on('change','#linea.last_producto',function () {
    recargarListaLinea();
});

$('body').on('click','#selecionarProductoBtn',function () {
    let id = $("#selectOptionIdProducto.last_producto").val();
    if(id != ""){
        buscarInfoProducto(id);
        $('#cantidad_producto_seleccionado.last_producto').on('keyup',function(){
            v = parseInt($(this).val());
            min = parseInt($(this).attr('min'));
            max = parseInt($(this).attr('max'));
            if (v > max){
                $(this).val(max);
            }
        });
        $('#total_producto_seleccionado.last_producto').val(0.0);
        $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(0));
        $('#cantidad_producto_seleccionado.last_producto').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());

            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);

            if(cantidad <= unidadesDisponibles && cantidad > 0){
                $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid green");
            }else{
                $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid red");
            }
            $('#total_producto_seleccionado.last_producto').val(total);
            $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
            verificacionGeneral(verificarAntesNuevoTratamiento(), verificarAntesNuevoProducto());
            actualizarTotalDeVenta();
        });
        $('#precioUnitario_producto_seleccionado.last_producto').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());
    
            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);
            $('#total_producto_seleccionado.last_producto').val(total);
            $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
            verificacionGeneral(verificarAntesNuevoTratamiento(), verificarAntesNuevoProducto());
            actualizarTotalDeVenta();
        });
        $('#cantidad_producto_seleccionado.last_producto').show();
        $('#precioUnitario_producto_seleccionado.last_producto').show();
        verificarAntesNuevoTratamiento();
        verificarAntesNuevoProducto();
    }else{
        alert("Selecciona un producto");
    }
    console.log(id);
    // verificacionGeneral(verificarAntesNuevoTratamiento(), verificarAntesNuevoProducto());
});

$(document).ready(function(){
    $('#cantidad_producto_seleccionado.last_producto').on('keyup',function(){
        v = parseInt($(this).val());
        min = parseInt($(this).attr('min'));
        max = parseInt($(this).attr('max'));
        if (v > max){
            $(this).val(max);
        }
    });
    recargarLista();
})

$(document).on('change','#tratamiento.last_tratamiento',function () {
    recargarLista();
    // verificacionGeneral(verificarAntesNuevoTratamiento(), verificarAntesNuevoProducto());
});

$(document).on('change','#detalleZona.last_tratamiento',function () {
    var num = $('#detalleZona.last_tratamiento').val();
    var precio = 0;
    if(num == 1){
        precio = 400;
    }else if(num == 2){
        precio = 640;
    }if(num == 3){
        precio = 960;
    }else if(num == 4){
        precio = 1264;
    }if(num == 5){
        precio = 1580;
    }else if(num == 6){
        precio = 1872;
    }if(num == 7){
        precio = 2184;
    }else if(num == 8){
        precio = 2464;
    }if(num == 9){
        precio = 2772;
    }else if(num == 10){
        precio = 3040;
    }if(num == 11){
        precio = 3344;
    }else if(num == 12){
        precio = 3600;
    }if(num == 13){
        precio = 3900;
    }else if(num == 14){
        precio = 4144;
    }if(num == 15){
        precio = 4440;
    }else if(num == 16){
        precio = 4672;
    }if(num == 17){
        precio = 4964;
    }else if(num == 18){
        precio = 5184;
    }if(num == 19){
        precio = 5396;
    }else if(num == 20){
        precio = 5600;
    }
    if($('#tratamiento.last_tratamiento').val() == 1){
        $('#precioTratamiento.last_tratamiento').val(precio);
        console.log(num + ' --> ' + precio);
    }
    verificarAntesNuevoTratamiento();
    actualizarTotalDeVenta();
});

$(document).on('change','#nombreTratamiento.last_tratamiento',function () {
    recargarListaNombreTratamiento();
});

$("body").on('click', '#botonAgregarMetodoPago', function(){
    const count = $("#metodo_pago_div").children('div').length + 1;
    const front_metodo_pago = "<br><div class='form-inline div_metodo" + count + "'><h4>Método "+count+":</h4><div><select name='metodoPago[]' id='metodoPago' class='form-control select_metodo" + count + "'><option value=''>*** Selecciona ***</option><option value='6'>Depósito</option><option value='1'>Efectivo</option><option value='2'>[TDD]Tarjeta de débito</option><option value='3'>[TDC]Tarjeta de crédito</option><option value='4'>Transferencia</option><option value='5'>Cheque de regalo</option></select><input type='text' class='form-control referencia_metodo" + count + "' id='referencia' name='referencia[]' placeholder='Número de referencia del pago' style='display: none;'><input type='number' class='form-control' id='totalMetodoPago' name='totalMetodoPago[]' placeholder='Cantidad de este método de pago' step='any'></div><button class='btn btn-danger metodo" + count + "' id='botonEliminarMetodoPago' type='button'><i class='far fa-trash-alt'></i></button></div>";
    $('#metodo_pago_div').append(front_metodo_pago);
    verificarCantidadesMetodoPago();
});
$(document).on('keyup',"#totalMetodoPago", function () {
    verificarCantidadesMetodoPago();
});

$("body").on('click', '#botonEliminarMetodoPago', function(){
    // $(this).closest('.plantilla').remove();
    const clase = $(this).attr('class').replace('btn btn-danger ', '');
    $(this).closest('.div_' + clase).remove();
});

$('body').on('change','#metodoPago',function () {
    const num_clase = $(this).attr('class').replace('form-control select_metodo', '');
    if($(this).val() == 6){
        $('.referencia_metodo' + num_clase).show();
    }else{
        $('.referencia_metodo' + num_clase).hide();
    }
});

//------------------------------------------------------------------------------------------
//********************************* FUNCIONES **********************************************/
//------------------------------------------------------------------------------------------

function buscarInfoProducto(id){
    $.ajax({
        type:"POST",
        url:"AJAXBucarProducto.php",
        data:"id_producto=" + id + "&id_centro=" + $('#id_centro').val(),
        success:function(info){
            var json = JSON.parse(info);
            $('#id_producto_seleccionado.last_producto').attr('value', json.id_producto);
            $('.id_producto_seleccionado_label.last_producto').html(json.id_producto);
            $('#desc_producto_seleccionado.last_producto').attr('value', json.descripcion_producto);
            $('.desc_producto_seleccionado_label.last_producto').html(json.descripcion_producto);
            $('#stock_producto_seleccionado.last_producto').attr('value', json.stock_disponible_producto);
            $('.stock_producto_seleccionado_label.last_producto').html(json.stock_disponible_producto);
            $('#precioUnitario_producto_seleccionado.last_producto').attr('value', json.costo_unitario_producto);

            $('#cantidad_producto_seleccionado.last_producto').attr({
                "max" : parseInt(json.stock_disponible_producto),
                "min" : 0,
                "step": 1,
                "oninput": "this.value=(parseInt(this.value)||0)"
             });
        }
    });   
}

function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"marca=" + $('#marca.last_producto').val() + "&id_centro=" + $('#id_centro').val(),
        success:function(r){
            $('#otroProducto.last_producto').html(r);
        }
    });
}

function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"linea=" + $('#linea.last_producto').val() + "&id_centro=" + $('#id_centro').val(),
        success:function(r){
            $('#otroProducto.last_producto').html(r);
        }
    });
}

function buttonState() {
    var opt = $("#aviso").val();
    if(opt == "1"){
        $("#botonComenzar").show();
    }else{
        $("#botonComenzar").hide();
    }
}

function recargarLista(){
    $.ajax({
        type:"POST",
        url:"datos.php",
        data:"continente=" + $('#tratamiento.last_tratamiento').val() + "&id_cliente=" + $('#idCliente').val(),
        success:function(r){
            $('#elementos .last_tratamiento').closest('#otro').html(r);
        }
    });
}

function recargarListaNombreTratamiento(){
    $.ajax({
        type:"POST",
        url:"precioTatamiento.php",
        data:"idTratamiento=" + $('#nombreTratamiento.last_tratamiento').val(),
        success:function(r){
            $('#precioTratamiento.last_tratamiento').val(r);
            verificarAntesNuevoTratamiento();
            actualizarTotalDeVenta();
        }
    });
}

function verificarAntesNuevoTratamiento(){
    var precio = $('#precioTratamiento.last_tratamiento').val();

    console.log("EL PRECIOO QUE ES ES: " + precio);
    if(precio >= 0){
        $("#btn-agregar-tratamiento").attr('disabled', false);
        $("#btn-agregar-producto").attr('disabled', false);
        $("#metodo_pago_div").show();
        $("#agregar_boton_pago_div").show();
    }else{
        $("#btn-agregar-tratamiento").attr('disabled', true);
        $("#btn-agregar-producto").attr('disabled', true);
        $("#metodo_pago_div").hide();
        $("#agregar_boton_pago_div").hide();
        $("#firma_div").hide();
    }
}

function verificarAntesNuevoProducto(){

    var precioUnitario = $('#precioUnitario_producto_seleccionado.last_producto').val();
    var cantidad       = $('#cantidad_producto_seleccionado.last_producto').val();

    console.log("El precio uniitario: " + precioUnitario + " y cantidad: " + cantidad);
    
    if(precioUnitario > 0 && cantidad > 0){
        $("#btn-agregar-tratamiento").attr('disabled', false);
        $("#btn-agregar-producto").attr('disabled', false);
        $("#metodo_pago_div").show();
        $("#agregar_boton_pago_div").show();
    }else{
        $("#btn-agregar-tratamiento").attr('disabled', true);
        $("#btn-agregar-producto").attr('disabled', true);
        $("#metodo_pago_div").hide();
        $("#agregar_boton_pago_div").hide();
        $("#firma_div").hide();
    }
}

function verificacionGeneral(tratamientos, productos){
    
}

function verificarEliminarElemento() {
    var num_tratamiento = $("#elementos .col-xs-4").length;
    var num_producto    = $("#elementos .plantilla").length;
    console.log("EXISTEN " + num_tratamiento + "tratamientos y " + num_producto + " productos");
    if($('#elementos').html() != ''){
        $("#btn-agregar-tratamiento").attr('disabled', false);
        $("#btn-agregar-producto").attr('disabled', false);
    }
    if(num_producto > num_tratamiento || num_producto < num_tratamiento){
        $("#btn-agregar-tratamiento").attr('disabled', false);
        $("#btn-agregar-producto").attr('disabled', false);
        $("#metodo_pago_div").show();
        $("#agregar_boton_pago_div").show();
    }
}

function actualizarTotalDeVenta(){

    var formElements = new Array();
    //----------------------------------------------------
    $("form #precioTratamiento").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    $("form #total_producto_seleccionado").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    //----------------------------------------------------
    $('#sumaTotalPrecios').val(formElements.reduce(function(a, b) { return a + b; }, 0));
    console.log(formElements);
}

function verificarCantidadesMetodoPago(){
    var formElements = new Array();
    $("form #totalMetodoPago").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    var sum = formElements.reduce(function(a, b) { return a + b; }, 0);

    if(sum == $('#sumaTotalPrecios').val()){
        $("#firma_div").show();
    }else{
        $("#firma_div").hide();
    }
}