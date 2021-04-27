$(document).ready(function () {
    $("#linea").attr('disabled', true);
    
    
});

$(document).on('change','#marca',function () {
    if($(this).val() == 'AINHOA'){
        $("#linea").attr('disabled', false);
    }else{
        $("#linea").val("");
        $("#linea").attr('disabled', true);
    }
});