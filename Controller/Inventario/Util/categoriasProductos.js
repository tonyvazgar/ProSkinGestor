$(document).on('change','#marca',function () {
    recargarListaMarca();
});
$(document).on('change','#linea',function () {
    recargarListaLinea();
});

$(window).on("beforeunload", function() { 
    $("#cargandoLoader").show();
    // <div class="modal-backdrop fade show"></div>
    let background = '<div class="modal-backdrop fade show"></div>';
    $("body").append(background);
});

function recargarListaMarca(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"marca=" + $('#marca').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#otro').closest('#otro').html(r);
        }
    });
}


function recargarListaLinea(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"linea=" + $('#linea').val() + "&id_centro=" + $('#centro').val(),
        success:function(r){
            $('#productos').closest('#productos').html(r);
        }
    });
}