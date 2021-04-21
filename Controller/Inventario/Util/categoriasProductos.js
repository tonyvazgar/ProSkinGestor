$(document).on('change','#marca',function () {
    recargarListaNombreTratamiento();
});

function recargarListaNombreTratamiento(){
    $.ajax({
        type:"POST",
        url:"AJAXproductos.php",
        data:"marca=" + $('#marca').val(),
        success:function(r){
            $('#otro').closest('#otro').html(r);
        }
    });
}