$(document).ready(function () {
    $("#comenzarTratamiento").hide();
    $("#tratamiento").change(function () {
        if (verificarSiHayFirma()) {
            $(".pregunta").show();
            $("#comenzarTratamiento").hide();
        } else {
            $(".pregunta").hide();
            $("#aviso").attr("disabled", "disabled");
            $("#comenzarTratamiento").show();
        }
    });
    $("#aviso").change(function () {
        buttonState();
    });
});

function verificarSiHayFirma() {
    var opt = $('select[name="tratamiento"] :selected').attr('class');
    if (opt === "signature"){   //si si se necesita firma se muestra la pregunta ¿Ya se firmó?
        return true;
    }else{                      //si no se necesita firma solo se muestra el botón
        return false;
    }
}

function validarFirma() {
    var opt = $("#aviso").val();
    if(opt == "1"){
        console.log("ya se firmo")
        return true;
    }else{
        console.log("no se ha firmo")
        return false;
    }
}

function buttonState() {
    if (verificarSiHayFirma() && validarFirma()) {
        $("#comenzarTratamiento").show();
    } else {
        $("#comenzarTratamiento").hide();
    }
}

$(document).ready(function(){
    // $('#tratamiento').val(1);
    recargarLista();

    $('#tratamiento').change(function(){
        recargarLista();
        console.log("hola");
    });
})

function recargarLista(){
    $.ajax({
        type:"POST",
        url:"datos.php",
        data:"continente=" + $('#tratamiento').val() + "&id_cliente=" + $('#id').val(),
        success:function(r){
            $('#otro').html(r);
        }
    });
}