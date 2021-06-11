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
    });
    $("#tratamientos").on('click', '.btn-retirar-alumno', function(){
        $(this).closest('.col-xs-4').remove();
        $("#aviso").val("");
        $("#botonComenzar").hide();
    })
});

function buttonState() {
    var opt = $("#aviso").val();
    if(opt == "1"){
        $("#botonComenzar").show();
    }else{
        $("#botonComenzar").hide();
    }
}
//------------------------------------------------------------------------------------------


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