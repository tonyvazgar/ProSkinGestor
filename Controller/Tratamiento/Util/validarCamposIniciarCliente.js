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
    
    // El formulario que queremos replicar
    var formulario_alumno = $("#lo-que-vamos-a-copiar").html();
    $("#div-agregarTratamiento").on('click', '.btn-agregar-tratamiento', function(){
        // Agregamos el formulario
        var n = $("#tratamientos .col-xs-4").length + 1;
        console.log(n);
        $("#tratamientos").prepend(formulario_alumno);
        $("#tratamientos .col-xs-4:first .numTratamientos").html("Tratamiento #" + n);

       

        console.log("Vamos a agregar otro tratamiento");
        $("#tratamientos .col-xs-4:first .well").append('<button class="btn-danger btn btn-block btn-retirar-alumno" type="button">Retirar</button>');
        
        // // Hacemos focus en el primer input del formulario
        // $("#alumnos .col-xs-4:first .well input:first").focus();
    });
    $("#tratamientos").on('click', '.btn-retirar-alumno', function(){
        $(this).closest('.col-xs-4').remove();
    })
});

// function verificarSiHayFirma() {
//     var opt = $('select[name="tratamiento"] :selected').attr('class');
//     if (opt === "signature"){   //si si se necesita firma se muestra la pregunta ¿Ya se firmó?
//         return true;
//     }else{                      //si no se necesita firma solo se muestra el botón
//         return false;
//     }
// }

// function validarFirma() {
    // var opt = $("#aviso").val();
    // if(opt == "1"){
    //     console.log("ya se firmo")
    //     return true;
    // }else{
    //     console.log("no se ha firmo")
    //     return false;
    // }
// }

function buttonState() {
    var opt = $("#aviso").val();
    if(opt == "1"){
        $("#botonComenzar").show();
    }else{
        $("#botonComenzar").hide();
    }
}
//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------


// $(document).ready(function () {
//     // $("#comenzarTratamiento").hide();
//     $("#tratamiento").change(function () {
//         var opt = $("#tratamiento").val();
//         if(opt == "1"){
//             $('#botonComenzar').html("<button type='submit' id='comenzarTratamientoDepilacion' name='comenzarTratamientoDepilacion' class='btn btn-success'>Registrar Depilación</button>");
//         }if(opt == "2"){
//             $('#botonComenzar').html("<button type='submit' id='comenzarTratamientoCavitacion' name='comenzarTratamientoCavitacion' class='btn btn-success'>Registrar Cavitación</button>");
//         }if(opt == "3"){
//             $('#botonComenzar').html("<button type='submit' id='comenzarTratamiento' name='comenzarTratamiento' class='btn btn-success'>Registrar Tratamiento</button>");
//         }
//     });
// });




//------------------------------------------------------------------------------------------
$(document).ready(function(){
    // $('#tratamiento').val(1);
    recargarLista();

    
})

$(document).on('change','#tratamiento',function () {
    recargarLista();
    console.log("hola");
});

$(document).on('change','#detalleZona',function () {
    var num = $('#detalleZona').val();
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
    
    $('#precioTratamiento').val(precio);
    console.log(num);
});

$(document).on('change','#nombreTratamiento',function () {
    recargarListaNombreTratamiento();
    console.log("holasss");
});

function recargarLista(){
    $.ajax({
        type:"POST",
        url:"datos.php",
        data:"continente=" + $('#tratamiento').val() + "&id_cliente=" + $('#idCliente').val(),
        success:function(r){
            $('#otro').closest('#otro').html(r);
        }
    });
}

function recargarListaNombreTratamiento(){
    $.ajax({
        type:"POST",
        url:"precioTatamiento.php",
        data:"idTratamiento=" + $('#nombreTratamiento').val(),
        success:function(r){
            $('#precioTratamiento').val(r);
        }
    });
}