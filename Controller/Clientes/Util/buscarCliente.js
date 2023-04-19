$(document).ready(function () {
    $(document).on('keyup',"#nombre", function () {
        const input =  $(this).val();
        var upper = input.toUpperCase();
        const noAccents = RemoveAccents(upper);
        $(this).val(noAccents);

        if(input != ""){
          $("#searchResult").css("display", "flex");
          $.ajax({
            url: "busquedaCliente.php",
            method: "POST",
            data: { nombre: noAccents },
            success: function(data) {
              $("#searchResult").html(data);
            }
          });
        } else {
          $("#searchResult").css("display", "none");
        }
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