$('body').on('click', '#btn-agregar-producto', function(){
    var num_producto = $(".productos .plantilla").length + 1;
    var plantilla_producto = "<hr/><div class='plantilla'><h2 class='numProductos'>Producto #"+num_producto+"</h2><div class='form-group'><table class='table table-borderless'><thead><tr><td scope='col'><h4>Marca a buscar*</h4></td><td scope='col'><h4>Linea a buscar*</h4></td></tr></thead><tbody><tr><td><select name='marca' id='marca' class='last_producto form-control'><option value=''>** SELECCIONA **</option><option value='MIGUETT'>MIGUETT</option><option value='AINHOA'>AINHOA</option><option value='GERMAINE'>GERMAINE</option></select></td><td><select name='linea' id='linea' class='last_producto form-control'><option value=''>** SELECCIONA **</option><option value='PURITY'>PURITY</option><option value='WHITESS'>WHITESS</option><option value='OXYGEN'>OXYGEN</option><option value='SENSKIN'>SENSKIN</option><option value='COLLAGEN%2B'>COLLAGEN +</option><option value='MULTIVIT'>MULTIVIT</option><option value='BIOME CARE'>BIOME CARE</option><option value='OLIVE'>OLIVE</option><option value='SPECIFIC'>SPECIFIC</option><option value='HYALURONIC'>HYALURONIC</option><option value='SKIN PRIMERS'>SKIN PRIMERS</option><option value='BODY LINE UP'>BODY LINE UP</option><option value='CANNABI'>CANNABI</option><option value='SPA LUXURY'>SPA LUXURY</option><option value='OTRO'>OTRO</option><option value='PACKS'>PACKS</option></select></td></tr></tbody></table><div class='last_producto form-group' id='otroProducto' name='otroProducto'></div><div class='last_producto form-group' id='productos' name='productos'></div><div class='form-group'><table class='table table-borderless' style='table-layout: fixed;'><tbody><tr><td><h4>ID producto:</h4><p class='last_producto lead id_producto_seleccionado_label'></p><input type='text' class='last_producto form-control' id='id_producto_seleccionado' name='id_producto_seleccionado[]' hidden readonly></td><td><h4>Unidades disponibles</h4><p class='last_producto lead stock_producto_seleccionado_label'></p><input type='text' class='last_producto form-control' id='stock_producto_seleccionado' name='stock_producto_seleccionado[]' hidden readonly></td></tr></tbody></table></div><div class='form-group'><h4>Descripción:</h4><p class='last_producto lead desc_producto_seleccionado_label'></p><input type='text' class='last_producto form-control' id='desc_producto_seleccionado' name='desc_producto_seleccionado' hidden readonly></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><h4>Precio por pieza</h4><input type='number' class='last_producto form-control' id='precioUnitario_producto_seleccionado' name='precioUnitario_producto_seleccionado[]'></td><td><h4>Cantidad</h4><input type='number' class='last_producto form-control' id='cantidad_producto_seleccionado' name='cantidad_producto_seleccionado[]' placeholder='Unidades a verder' required></td></tr></tbody></table></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><h4>Precio de venta</h4><p class='last_producto lead total_producto_seleccionado_label'></p><input type='text' class='last_producto form-control' id='total_producto_seleccionado' name='total_producto_seleccionado[]' hidden readonly></td><td><h4>&nbsp;</h4><button id='btn-apartar-producto' class='last_producto btn btn-success btn-apartar-producto' type='button' disabled='disabled'>Apartar producto(s)</button></td></tr></tbody></table></div></div></div>";
    console.log(plantilla_producto);
    $('.id_producto_seleccionado_label').removeClass('id_producto_seleccionado_label');
    $('.desc_producto_seleccionado_label').removeClass('desc_producto_seleccionado_label');
    $('.stock_producto_seleccionado_label').removeClass('stock_producto_seleccionado_label');

    $(".plantilla .last_producto").removeClass('last_producto');
    $(".productos").append(plantilla_producto);

    $(".productos .plantilla:last").append('<button class="btn-danger btn btn-block btn-quitar-producto" type="button">Quitar producto #'+num_producto+'</button>');
    alert("Se agregó un nuevo producto a la lista.\n\nNota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR F5");

    $("#btn-agregar-producto").attr('disabled', true);
});

$("body").on('click', '.btn-quitar-producto', function(){
    $(this).closest('.plantilla').remove();
    alert("Se quitó un producto de la lista");
    actualizarTotalDeVenta();
});

$('body').on('change','#marca',function () {
    if($(this).val() == 'AINHOA'){
        $("#linea").attr('disabled', false);
    }else{
        $("#linea").val("");
        $("#linea").attr('disabled', true);
    }
    recargarListaMarca();
});
$('body').on('change','#linea',function () {
    recargarListaLinea();
});
$('body').on('click','#selecionarProductoBtn.last_producto',function () {
    let id = $(".productos .plantilla #selectOptionIdProducto.last_producto").val();
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
                $("#btn-apartar-producto.last_producto").attr('disabled', false);
            }else{
                $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid red");
                $("#btn-apartar-producto.last_producto").attr('disabled', true);
            }
            $('#total_producto_seleccionado.last_producto').val(total);
            $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
        });
        $('#precioUnitario_producto_seleccionado.last_producto').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());
    
            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);
            $('#total_producto_seleccionado.last_producto').val(total);
            $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
        });
    }else{
        alert("Selecciona un producto");
    }
    console.log(id);
});

$(document).ready(function () {
    $('#cantidad_producto_seleccionado.last_producto').attr({
        "max" : parseInt($('#stock_producto_seleccionado.last_producto').val()),
        "min" : 0,
        "step": 1,
        "oninput": "this.value=(parseInt(this.value)||0)"
     });
    $('#cantidad_producto_seleccionado.last_producto').on('keyup',function(){
        v = parseInt($(this).val());
        min = parseInt($(this).attr('min'));
        max = parseInt($(this).attr('max'));
        if (v > max){
            $(this).val(max);
        }
    });
    $("#venderProducto").hide();
    $('#total').val(0.0);
    $('#cantidad_producto_seleccionado.last_producto').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);

        if(cantidad <= unidadesDisponibles && cantidad > 0){
            $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid green");
            $("#venderProducto").show();
            $("#btn-apartar-producto.last_producto").attr('disabled', false);
        }else{
            $("#cantidad_producto_seleccionado.last_producto").css("border", "2px solid red");
            $("#venderProducto").hide();
            $("#btn-apartar-producto.last_producto").attr('disabled', true);
        }
        $('#total_producto_seleccionado.last_producto').val(total);
        $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
    });
    $('#precioUnitario_producto_seleccionado.last_producto').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last_producto').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last_producto').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado.last_producto').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);
        $('#total_producto_seleccionado.last_producto').val(total);
        $('.total_producto_seleccionado_label.last_producto').html("$" + new Intl.NumberFormat().format(total));
    });

    $('body').on('click', '#btn-apartar-producto.last_producto', function(){

        alert("Se apartó este producto, tienes 5 minutos para concluir la venta o se devolverán al inventario.\n\nNota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR F5");

        let id_producto       = $("#id_producto_seleccionado.last_producto").val();
        let cantidad_producto = parseInt($('#cantidad_producto_seleccionado.last_producto').val());
        let stock_original_producto = parseInt($('#stock_producto_seleccionado.last_producto').val());
        let id_cometologa     = $("#idCosmetologa").val();
        let id_centro         = $("#centro").val();
        $.ajax({
            type: "POST",
            url:  "../../Controller/Ventas/apartarProductoAJAX.php",
            data: "id_producto=" + id_producto + "&cantidad_producto=" + cantidad_producto + "&stock_original_producto=" + stock_original_producto + "&id_cosmetologa=" + id_cometologa + "&id_centro=" + id_centro,
            success:function(info){
                // var json = JSON.parse(info);
                $('#btn-apartar-producto.last_producto').html("APARTADO");
                $("#btn-apartar-producto.last_producto").attr('disabled', true);
                console.log(info);
                $("#btn-agregar-producto").attr('disabled', false);
                actualizarTotalDeVenta();
            }
        });
    });


    $("body").on('click', '#botonAgregarMetodoPago', function(){
        const count = $(".metodosPagoDiv").children('div').length + 1;
        const front_metodo_pago = "<br><div class='form-inline div_metodo" + count + "'><h4>Método "+count+":</h4><div><select name='metodoPago[]' id='metodoPago' class='form-control select_metodo" + count + "'><option value=''>*** Selecciona ***</option><option value='6'>Depósito</option><option value='1'>Efectivo</option><option value='2'>[TDD]Tarjeta de débito</option><option value='3'>[TDC]Tarjeta de crédito</option><option value='4'>Transferencia</option><option value='5'>Cheque de regalo</option></select><input type='text' class='form-control referencia_metodo" + count + "' id='referencia' name='referencia[]' placeholder='Número de referencia del pago' style='display: none;'><input type='number' class='form-control' id='totalMetodoPago' name='totalMetodoPago[]' placeholder='Cantidad de este método de pago' step='any'></div><button class='btn btn-danger metodo" + count + "' id='botonEliminarMetodoPago' type='button'><i class='far fa-trash-alt'></i></button></div>";
        $('#metodosPagoDiv').append(front_metodo_pago);
        // verificarCantidadesMetodoPago();
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
});

//------------------------------------------------------------------------------------------
//********************************* FUNCIONES **********************************************/
//------------------------------------------------------------------------------------------
function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"marca=" + $('#marca.last_producto').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto.last_producto').html(r);
        }
    });
}

function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"linea=" + $('#linea.last_producto').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto.last_producto').html(r);
        }
    });
}

function buscarInfoProducto(id){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXBucarProducto.php",
        data:"id_producto=" + id + "&id_centro=" + $("#centro").val(),
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

function actualizarTotalDeVenta(){
    // var total = 0;
    // $("form").each(function(){
    //     total += parseFloat($(this).find('#precioUnitario_producto_seleccionado').val());
    // });
    // alert(total);

    var formElements = new Array();
    $("form #total_producto_seleccionado").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    $('#sumaTotalPrecios').val(formElements.reduce(function(a, b) { return a + b; }, 0));
    console.log(formElements);
}

function verificarCantidadesMetodoPago(){
    var formElements = new Array();
    $("form #totalMetodoPago").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    // alert(formElements);
    var sum = formElements.reduce(function(a, b) { return a + b; }, 0);

    $('#sumaTotalMetodosPago').val(sum);


    if(sum == $('#sumaTotalPrecios').val()){
        $('#sumaTotalMetodosPago').css("border", "2px solid green");
        $('#sumaTotalPrecios').css("border", "2px solid green");
        $("#venderProducto").attr('disabled', false);
    }else{
        $('#sumaTotalMetodosPago').css("border", "2px solid red");
        $('#sumaTotalPrecios').css("border", "2px solid red");
        $("#venderProducto").attr('disabled', true);
    }
}