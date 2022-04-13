$(document).ready(function () {
    $(document).on('keyup',"#nombre", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));  
    });


    //Click button login
    $("#buscarCliente").on('click', function (event) {
      $(this).hide();
      $("#cargandoLoader").show();
  });
});

function RemoveAccents(strAccents) {
    var strAccents    = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents       = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
    var accentsOut    = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
    for (var y = 0; y < strAccentsLen; y++) {
      if (accents.indexOf(strAccents[y]) != -1) {
        strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
      } else {
        strAccentsOut[y] = strAccents[y];
      }
    }
    strAccentsOut = strAccentsOut.join('');
    console.log(strAccentsOut);
    return strAccentsOut;
}