$(document).ready(function () {
    $("#linea").attr('disabled', true);
    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('keyup', "#descripcion", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));
    });

    $(document).on('keyup', "#presentacion", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));
    });


    $(document).on('keyup', "#unidades", function () {
        var i = parseInt($(this).val());
        $(this).val(i);
    });

    $(document).on('keyup', "#nombre", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));
    });

$(document).on('change','#marca',function () {
    if($(this).val() == 'AINHOA'){
        $("#linea").attr('disabled', false);
    }else{
        $("#linea").val("");
        $("#linea").attr('disabled', true);
    }
});
});

function RemoveAccents(strAccents) {
    var strAccents = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
    for (var y = 0; y < strAccentsLen; y++) {
        if (accents.indexOf(strAccents[y]) != -1) {
            strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
        } else {
            strAccentsOut[y] = strAccents[y];
        }
    }
    strAccentsOut = strAccentsOut.join('');
    console.log(strAccents);
    return strAccentsOut;
}