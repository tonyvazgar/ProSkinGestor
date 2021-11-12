$( document ).ready(function() {
    const efectivo = $("#total_efectivo").val();
    const tdc = $("#total_tdc").val();
    const tdd = $("#total_tdd").val();
    const transferencia = $("#total_transferencia").val();
    const deposito = $("#total_deposito").val();

    if(efectivo == '0' && tdc== '0' && tdd == '0' && transferencia == '0' && deposito == '0'){
        $('#importante').show();
    }else{
        $('#importante').hide();
    }
});

$("body").on('click', '#botonAgregarGasto', function(){
    const count = $('#gastosdiv').children('div').length + 1;
    const front_metodo_pago = '<div><label class="col-sm-2 col-form-label">Gasto #'+count+'</label><input class="form-control" type="text" id="nombreGasto[]" name="nombreGasto[]" placeholder="Nombre"><input class="form-control" type="number" id="totalGasto[]" name="totalGasto[]" placeholder="Total"></div>';
    $('#gastosdiv').append(front_metodo_pago);
    // verificarCantidadesMetodoPago();
});