$(document).ready(function () {
    $("#botonComenzar").hide();
    $("#aviso").change(function () {
        var opt = $("#aviso").val();
        if(opt == "1"){
            $("#botonComenzar").show();
        }else{
            $("#botonComenzar").hide();
        }
    });
    // El formulario que queremos replicar
    var formulario_alumno = $("#lo-que-vamos-a-copiar").html();
    $("#btn-agregar-tratamiento").click(function(){
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