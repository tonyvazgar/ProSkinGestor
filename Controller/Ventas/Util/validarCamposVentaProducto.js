$('body').on('click', '#btn-agregar-producto', function(){
    var num_producto = $(".productos .plantilla").length + 1;
    var plantilla_producto = "<hr/><div class='plantilla'><h2 class='numProductos'>Producto #"+num_producto+"</h2><div class='form-group'><table class='table table-borderless'><thead><tr><td scope='col'><h4>Marca a buscar*</h4></td><td scope='col'><h4>Linea a buscar*</h4></td></tr></thead><tbody><tr><td><select name='marca' id='marca' class='last form-control'><option value=''>** SELECCIONA **</option><option value='MIGUETT'>MIGUETT</option><option value='AINHOA'>AINHOA</option><option value='GERMAINE'>GERMAINE</option></select></td><td><select name='linea' id='linea' class='last form-control'><option value=''>** SELECCIONA **</option><option value='PURITY'>PURITY</option><option value='WHITESS'>WHITESS</option><option value='OXYGEN'>OXYGEN</option><option value='SENSKIN'>SENSKIN</option><option value='COLLAGEN%2B'>COLLAGEN +</option><option value='MULTIVIT'>MULTIVIT</option><option value='BIOME CARE'>BIOME CARE</option><option value='OLIVE'>OLIVE</option><option value='SPECIFIC'>SPECIFIC</option><option value='HYALURONIC'>HYALURONIC</option><option value='SKIN PRIMES'>SKIN PRIMES</option><option value='BODY LINE UP'>BODY LINE UP</option><option value='CANNABI7'>CANNABI7</option><option value='SPA LUXURY'>SPA LUXURY</option><option value='OTRO'>OTRO</option><option value='PACKS'>PACKS</option></select></td></tr></tbody></table><div class='last form-group' id='otroProducto' name='otroProducto'></div><div class='last form-group' id='productos' name='productos'></div><div class='form-group'><table class='table table-borderless' style='table-layout: fixed;''><tbody><tr><td><h4>ID producto:</h4><p class='last lead id_producto_seleccionado_label'></p><input type='text' class='last form-control' id='id_producto_seleccionado' name='id_producto_seleccionado[]' hidden readonly></td><td><h4>Unidades disponibles</h4><p class='last lead stock_producto_seleccionado_label'></p><input type='text' class='last form-control' id='stock_producto_seleccionado' name='stock_producto_seleccionado[]' hidden readonly></td></tr></tbody></table></div><div class='form-group'><h4>Descripción:</h4><p class='last lead desc_producto_seleccionado_label'></p><input type='text' class='last form-control' id='desc_producto_seleccionado' name='desc_producto_seleccionado' hidden readonly></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><h4>Precio por pieza</h4><input type='number' class='last form-control' id='precioUnitario_producto_seleccionado' name='precioUnitario_producto_seleccionado[]'></td><td><h4>Cantidad</h4><input type='number' class='last form-control' id='cantidad_producto_seleccionado' name='cantidad_producto_seleccionado[]' placeholder='Unidades a verder' required></td></tr></tbody></table></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><h4>Precio de venta</h4><p class='last lead total_producto_seleccionado_label'></p><input type='text' class='last form-control' id='total_producto_seleccionado' name='total_producto_seleccionado[]' hidden readonly></td></tr></tbody></table></div></div></div>";
    console.log(plantilla_producto);
    $('.id_producto_seleccionado_label').removeClass('id_producto_seleccionado_label');
    $('.desc_producto_seleccionado_label').removeClass('desc_producto_seleccionado_label');
    $('.stock_producto_seleccionado_label').removeClass('stock_producto_seleccionado_label');

    $(".plantilla .last").removeClass('last');
    $(".productos").append(plantilla_producto);

    $(".productos .plantilla:last").append('<button class="btn-danger btn btn-block btn-quitar-producto" type="button">Quitar producto #'+num_producto+'</button>');
    alert("Se agregó un nuevo producto a la lista");
});

$("body").on('click', '.btn-quitar-producto', function(){
    $(this).closest('.plantilla').remove();
    alert("Se quitó un producto de la lista");
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
$('body').on('click','#selecionarProductoBtn.last',function () {
    let id = $(".productos .plantilla #selectOptionIdProducto.last").val();
    if(id != ""){
        buscarInfoProducto(id);
        $('#total_producto_seleccionado.last').val(0.0);
        $('.total_producto_seleccionado_label.last').html("$" + new Intl.NumberFormat().format(0));
        $('#cantidad_producto_seleccionado.last').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last').val());

            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);

            if(cantidad <= unidadesDisponibles && cantidad > 0){
                $("#cantidad_producto_seleccionado.last").css("border", "2px solid green");
            }else{
                $("#cantidad_producto_seleccionado.last").css("border", "2px solid red");
            }
            $('#total_producto_seleccionado.last').val(total);
            $('.total_producto_seleccionado_label.last').html("$" + new Intl.NumberFormat().format(total));
        });
        $('#precioUnitario_producto_seleccionado.last').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last').val());
    
            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);
            $('#total_producto_seleccionado.last').val(total);
            $('.total_producto_seleccionado_label.last').html("$" + new Intl.NumberFormat().format(total));
        });
    }else{
        alert("Selecciona un producto");
    }
    console.log(id);
});

$(document).ready(function () {
    $("#venderProducto").hide();
    $('#total').val(0.0);
    $('#cantidad_producto_seleccionado.last').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado.last').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);

        if(cantidad <= unidadesDisponibles && cantidad > 0){
            $("#cantidad_producto_seleccionado.last").css("border", "2px solid green");
            $("#venderProducto").show();
        }else{
            $("#cantidad_producto_seleccionado.last").css("border", "2px solid red");
            $("#venderProducto").hide();
        }
        $('#total_producto_seleccionado.last').val(total);
        $('.total_producto_seleccionado_label.last').html("$" + new Intl.NumberFormat().format(total));
    });
    $('#precioUnitario_producto_seleccionado.last').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado.last').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);
        $('#total_producto_seleccionado.last').val(total);
        $('.total_producto_seleccionado_label.last').html("$" + new Intl.NumberFormat().format(total));
    });
});

//------------------------------------------------------------------------------------------
//********************************* FUNCIONES **********************************************/
//------------------------------------------------------------------------------------------
function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"marca=" + $('#marca.last').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto.last').html(r);
        }
    });
}

function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"linea=" + $('#linea.last').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto.last').html(r);
        }
    });
}

function buscarInfoProducto(id){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXBucarProducto.php",
        data:"id_producto=" + id,
        success:function(info){
            var json = JSON.parse(info);
            $('#id_producto_seleccionado.last').attr('value', json.id_producto);
            $('.id_producto_seleccionado_label.last').html(json.id_producto);
            $('#desc_producto_seleccionado.last').attr('value', json.descripcion_producto);
            $('.desc_producto_seleccionado_label.last').html(json.descripcion_producto);
            $('#stock_producto_seleccionado.last').attr('value', json.stock_disponible_producto);
            $('.stock_producto_seleccionado_label.last').html(json.stock_disponible_producto);
            $('#precioUnitario_producto_seleccionado.last').attr('value', json.costo_unitario_producto);
            
        }
    });   
}