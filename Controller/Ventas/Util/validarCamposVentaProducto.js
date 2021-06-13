$('body').on('click', '#btn-agregar-producto', function(){
    var plantilla_producto = "<div class='plantilla'><div class='form-group'><table class='table table-borderless'><thead><tr><td scope='col'>Marca a buscar*</td><td scope='col'>Linea a buscar*</td></tr></thead><tbody><tr><td><select name='marca' id='marca' class='form-control'><option value=''>** SELECCIONA **</option><option value='MIGUETT'>MIGUETT</option><option value='AINHOA'>AINHOA</option><option value='GERMAINE'>GERMAINE</option></select></td><td><select name='linea' id='linea' class='form-control'><option value=''>** SELECCIONA **</option><option value='PURITY'>PURITY</option><option value='WHITESS'>WHITESS</option><option value='OXYGEN'>OXYGEN</option><option value='SENSKIN'>SENSKIN</option><option value='COLLAGEN%2B'>COLLAGEN +</option><option value='MULTIVIT'>MULTIVIT</option><option value='BIOME CARE'>BIOME CARE</option><option value='OLIVE'>OLIVE</option><option value='SPECIFIC'>SPECIFIC</option><option value='HYALURONIC'>HYALURONIC</option><option value='SKIN PRIMES'>SKIN PRIMES</option><option value='BODY LINE UP'>BODY LINE UP</option><option value='CANNABI7'>CANNABI7</option><option value='SPA LUXURY'>SPA LUXURY</option><option value='OTRO'>OTRO</option><option value='PACKS'>PACKS</option></select></td></tr></tbody></table><div class='form-group' id='otroProducto' name='otroProducto'></div><div class='form-group' id='productos' name='productos'></div><div class='form-group'><label for='exampleInputEmail1'>ID</label><input type='text' class='form-control' id='id_producto_seleccionado' name='id_producto_seleccionado[]' readonly></div><div class='form-group'><label for='exampleInputEmail1'>Descripción</label><input type='text' class='form-control' id='desc_producto_seleccionado' name='desc_producto_seleccionado' readonly></div><div class='form-group'><label for='exampleInputEmail1'>Unidades disponibles</label><input type='text' class='form-control' id='stock_producto_seleccionado' name='stock_producto_seleccionado[]' readonly></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><label for='exampleInputEmail1'>Precio por pieza</label><input type='number' class='form-control' id='precioUnitario_producto_seleccionado' name='precioUnitario_producto_seleccionado[]'></td><td><label for='exampleInputEmail1'>Cantidad</label><input type='number' class='form-control' id='cantidad_producto_seleccionado' name='cantidad_producto_seleccionado[]' placeholder='Unidades a verder' required></td></tr></tbody></table></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><label for='exampleInputEmail1'>Precio de venta</label><input type='text' class='form-control' id='total_producto_seleccionado' name='total_producto_seleccionado[]' readonly></td></tr></tbody></table></div></div></div>";
    console.log(plantilla_producto);
    $(".productos").prepend(plantilla_producto);

    $(".productos .plantilla:first").append('<button class="btn-danger btn btn-block btn-quitar-producto" type="button">Quitar producto</button>');
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
$('body').on('click','#selecionarProductoBtn',function () {
    let id = $(".productos .plantilla:first #selectOptionIdProducto").val();
    if(id != ""){
        buscarInfoProducto(id);
        $('#total_producto_seleccionado').val(0.0);
        $('#cantidad_producto_seleccionado').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado').val());

            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);

            if(cantidad <= unidadesDisponibles && cantidad > 0){
                $("#cantidad_producto_seleccionado").css("border", "2px solid green");
            }else{
                $("#cantidad_producto_seleccionado").css("border", "2px solid red");
            }
            $('#total_producto_seleccionado').val(total);
        });
        $('#precioUnitario_producto_seleccionado').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado').val());
    
            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);
            $('#total_producto_seleccionado').val(total);
        });
    }else{
        alert("Selecciona un producto");
    }
    console.log(id);
});

$(document).ready(function () {
    $("#venderProducto").hide();
    $('#total').val(0.0);
    $('#cantidad_producto_seleccionado').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);

        if(cantidad <= unidadesDisponibles && cantidad > 0){
            $("#cantidad_producto_seleccionado").css("border", "2px solid green");
            $("#venderProducto").show();
        }else{
            $("#cantidad_producto_seleccionado").css("border", "2px solid red");
            $("#venderProducto").hide();
        }
        $('#total_producto_seleccionado').val(total);
    });
    $('#precioUnitario_producto_seleccionado').keyup(function() {
        let unidadesDisponibles = parseInt($('#stock_producto_seleccionado').val());
        let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado').val());
        let cantidad            = parseInt($('#cantidad_producto_seleccionado').val());

        var total               = parseFloat(precioUnitario * cantidad);
        total                   = isNaN(total) ? 0 : total.toFixed(2);
        $('#total_producto_seleccionado').val(total);
    });
});

//------------------------------------------------------------------------------------------
//********************************* FUNCIONES **********************************************/
//------------------------------------------------------------------------------------------
function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"marca=" + $('#marca').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto').closest('#otroProducto').html(r);
        }
    });
}

function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"../../View/Clientes/AJAXproductos.php",
        data:"linea=" + $('#linea').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otroProducto').closest('#otroProducto').html(r);
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
            $('#id_producto_seleccionado').attr('value', json.id_producto);
            $('#desc_producto_seleccionado').attr('value', json.descripcion_producto);
            $('#stock_producto_seleccionado').attr('value', json.stock_disponible_producto);
            $('#precioUnitario_producto_seleccionado').attr('value', json.costo_unitario_producto);
            
        }
    });   
}