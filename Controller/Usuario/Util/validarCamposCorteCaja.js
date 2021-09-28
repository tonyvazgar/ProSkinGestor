$( document ).ready(function() {
    const efectivo = $("#total_efectivo").val();
    const tdc = $("#total_tdc").val();
    const tdd = $("#total_tdd").val();
    const transferencia = $("#total_transferencia").val();
    const deposito = $("#total_deposito").val();

    if(efectivo == '0' && tdc== '0' && tdd == '0' && transferencia == '0' && deposito == '0'){
        $('#confirmarCorteCaja').hide();
    }else{
        $('#confirmarCorteCaja').show();
    }
});