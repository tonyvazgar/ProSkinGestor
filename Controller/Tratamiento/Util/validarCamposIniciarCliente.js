$('body').on('change','#aviso',function () {
    var opt = $("#aviso").val();
    if(opt == "1"){
        $("#botonComenzar").show();
    }else{
        $("#botonComenzar").hide();
    }
    var n = $("#tratamientos .col-xs-4").length;
    console.log("Hay " + n + " plantillas");
    $("#otro .zonasCheckbox").each(function(i, obj) {
        $(this).find('input.check').attr('name', "zonas_cuerpo["+i+"][]");
    });

    var numProductos = $("#productos .productoIndividual").length;
    console.log("Hay " + numProductos + " productos");
    // $("#otro .zonasCheckbox").each(function(i, obj) {
    //     $(this).find('input.check').attr('name', "zonas_cuerpo["+i+"][]");
    // });
});

$(document).ready(function () {
    $("#botonComenzar").hide();
    
    var formulario_alumno = '<div class="col-xs-4"><h3 class="numTratamientos">Tratamiento #1</h3><div class="well well-sm"><div class="form-group"><label>Tratamiento a empezar</label><select name="tratamiento[]" id="tratamiento" class="last form-control"><option>*** SELECCIONA ***</option><option value="1">Depilación</option><option value="2">Cavitación</option><option value="3">Otros tratamientos</option></select></div><div class="last form-group" id="otro" name="otro"></div><div class="form-group"><label>Comentarios</label><textarea name="comentarios[]" id="comentarios" cols="30" rows="5" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento"></textarea></div></div></div>';
    $("#div-agregarTratamiento").on('click', '.btn-agregar-tratamiento', function(){
        // Agregamos el formulario
        var n = $("#tratamientos .col-xs-4").length + 1;
        $("#tratamientos .last").removeClass('last');
        $("#tratamientos").append(formulario_alumno);
        $("#tratamientos .col-xs-4:last .numTratamientos").html("Tratamiento #" + n);

       

        console.log("Vamos a agregar otro tratamiento");
        $("#tratamientos .col-xs-4:last .well").append('<button class="btn-danger btn btn-block btn-retirar-alumno" type="button">Retirar</button>');
        
        // // Hacemos focus en el primer input del formulario
        // $("#alumnos .col-xs-4:first .well input:first").focus();
        $("#aviso").val("");
        $("#botonComenzar").hide();
        alert("Se agregó otro tratamiento");
    });

    $("#div-agregarTratamiento").on('click', '.btn-agregar-producto', function(){
        var num_producto = $("#productos .productoIndividual").length + 1;
        var front_producto = "<div class='last productoIndividual'><h3 class='numProductos'>Producto #"+num_producto+"</h3><div class='form-group'><table class='table table-borderless'><thead><tr><td scope='col'>Marca a buscar*</td><td scope='col'>Linea a buscar*</td></tr></thead><tbody><tr><td><select name='marca' id='marca' class='last form-control'><option value=''>** SELECCIONA **</option><option value='MIGUETT'>MIGUETT</option><option value='AINHOA'>AINHOA</option><option value='GERMAINE'>GERMAINE</option></select></td><td><select name='linea' id='linea' class='last form-control'><option value=''>** SELECCIONA **</option><option value='PURITY'>PURITY</option><option value='WHITESS'>WHITESS</option><option value='OXYGEN'>OXYGEN</option><option value='SENSKIN'>SENSKIN</option><option value='COLLAGEN%2B'>COLLAGEN +</option><option value='MULTIVIT'>MULTIVIT</option><option value='BIOME CARE'>BIOME CARE</option><option value='OLIVE'>OLIVE</option><option value='SPECIFIC'>SPECIFIC</option><option value='HYALURONIC'>HYALURONIC</option><option value='SKIN PRIMES'>SKIN PRIMES</option><option value='BODY LINE UP'>BODY LINE UP</option><option value='CANNABI7'>CANNABI7</option><option value='SPA LUXURY'>SPA LUXURY</option><option value='OTRO'>OTRO</option><option value='PACKS'>PACKS</option></select></td></tr></tbody></table><div class='last form-group' id='otroProducto' name='otroProducto'></div><div class='last form-group' id='productos' name='productos'></div><div class='form-group'><label for='exampleInputEmail1'>ID</label><input type='text' class='last form-control' id='id_producto_seleccionado' name='id_producto_seleccionado[]' readonly></div><div class='form-group'><label for='exampleInputEmail1'>Descripción</label><input type='text' class='last form-control' id='desc_producto_seleccionado' name='desc_producto_seleccionado' readonly></div><div class='form-group'><label for='exampleInputEmail1'>Unidades disponibles</label><input type='text' class='last form-control' id='stock_producto_seleccionado' name='stock_producto_seleccionado[]' readonly></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><label for='exampleInputEmail1'>Precio por pieza</label><input type='number' class='last form-control' id='precioUnitario_producto_seleccionado' name='precioUnitario_producto_seleccionado[]'></td><td><label for='exampleInputEmail1'>Cantidad</label><input type='number' class='last form-control' id='cantidad_producto_seleccionado' name='cantidad_producto_seleccionado[]' placeholder='Unidades a verder' required></td></tr></tbody></table></div><div class='form-group'><table class='table table-borderless'><tbody><tr><td><label for='exampleInputEmail1'>Precio de venta</label><input type='text' class='last form-control' id='total_producto_seleccionado' name='total_producto_seleccionado[]' readonly></td></tr></tbody></table></div></div></div>";
        
        $("#productos .last").removeClass('last');
        $("#productos").append(front_producto);
        $("#productos .productoIndividual:last").append('<button class="btn-danger btn btn-block btn-retirar-producto" type="button">Quitar producto</button>');

        alert("Se agregó un producto");
    });

    $("#tratamientos").on('click', '.btn-retirar-alumno', function(){
        $(this).closest('.col-xs-4').remove();
        $("#aviso").val("");
        $("#botonComenzar").hide();
        alert("Se quitó un tratamiento");
    });

    $("#productos").on('click', '.btn-retirar-producto', function(){
        $(this).closest('.productoIndividual').remove();
        alert("Se eliminó un producto");
    });
    
    $("#linea").attr('disabled', true);
});


$('body').on('change','#marca',function () {
    if($('#marca.last').val() == 'AINHOA'){
        $("#linea").attr('disabled', false);
    }else{
        $("#linea").val("");
        $("#linea").attr('disabled', true);
    }
    recargarListaMarca();
});
$(document).on('change','#linea',function () {
    recargarListaLinea();
});

$('body').on('click','#selecionarProductoBtn',function () {
    let id = $("#productos .productoIndividual:last #selectOptionIdProducto").val();
    if(id != ""){
        buscarInfoProducto(id);
        $('#total_producto_seleccionado.last').val(0.0);
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
        });
        $('#precioUnitario_producto_seleccionado.last').keyup(function() {
            let unidadesDisponibles = parseInt($('#stock_producto_seleccionado.last').val());
            let precioUnitario      = parseFloat($('#precioUnitario_producto_seleccionado.last').val());
            let cantidad            = parseInt($('#cantidad_producto_seleccionado.last').val());
    
            var total               = parseFloat(precioUnitario * cantidad);
            total                   = isNaN(total) ? 0 : total.toFixed(2);
            $('#total_producto_seleccionado.last').val(total);
        });
    }else{
        alert("Selecciona un producto");
    }
    console.log(id);
});

$(document).ready(function(){
    recargarLista();
})

$(document).on('change','#tratamiento',function () {
    recargarLista();
});

$(document).on('change','#detalleZona',function () {
    var num = $('#detalleZona.last').val();
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
    if($('#tratamiento.last').val() == 1){
        $('#precioTratamiento.last').val(precio);
        console.log(num + ' --> ' + precio);
    }
});

$(document).on('change','#nombreTratamiento',function () {
    recargarListaNombreTratamiento();
});

//------------------------------------------------------------------------------------------
//********************************* FUNCIONES **********************************************/
//------------------------------------------------------------------------------------------

function buscarInfoProducto(id){
    $.ajax({
        type:"POST",
        url:"AJAXBucarProducto.php",
        data:"id_producto=" + id,
        success:function(info){
            var json = JSON.parse(info);
            $('#id_producto_seleccionado.last').attr('value', json.id_producto);
            $('#desc_producto_seleccionado.last').attr('value', json.descripcion_producto);
            $('#stock_producto_seleccionado.last').attr('value', json.stock_disponible_producto);
            $('#precioUnitario_producto_seleccionado.last').attr('value', json.costo_unitario_producto);
            
        }
    });   
}

function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"marca=" + $('#marca.last').val() + "&id_centro=" + $('#id_centro').val(),
        success:function(r){
            $('#otroProducto.last').html(r);
        }
    });
}

function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"linea=" + $('#linea.last').val() + "&id_centro=" + $('#id_centro').val(),
        success:function(r){
            $('#otroProducto.last').html(r);
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
        data:"continente=" + $('#tratamiento.last').val() + "&id_cliente=" + $('#idCliente').val(),
        success:function(r){
            $('#tratamientos:last .last').closest('#otro').html(r);
        }
    });
}

function recargarListaNombreTratamiento(){
    $.ajax({
        type:"POST",
        url:"precioTatamiento.php",
        data:"idTratamiento=" + $('#nombreTratamiento.last').val(),
        success:function(r){
            $('#precioTratamiento.last').val(r);
        }
    });
}