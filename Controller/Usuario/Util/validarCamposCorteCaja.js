$(document).ready(function () {
    const efectivo = $("#total_efectivo").val();
    const tdc = $("#total_tdc").val();
    const tdd = $("#total_tdd").val();
    const transferencia = $("#total_transferencia").val();
    const deposito = $("#total_deposito").val();


    $("#efectivo_a_entregar").val(efectivo);

    if (efectivo == '0' && tdc == '0' && tdd == '0' && transferencia == '0' && deposito == '0') {
        $('#importante').show();
    } else {
        $('#importante').hide();
    }


});

$(document).on("keydown", ":input:not(textarea)", function(event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});

$("body").on('click', '#botonAgregarGasto', function () {
    const count = $('#gastosdiv').children('div').length + 1;
    const front_metodo_pago = '<div><label class="col-sm-2 col-form-label">Gasto #' + count + '</label><input class="form-control" type="text" id="nombreGasto[]" name="nombreGasto[]" placeholder="Nombre"><input class="form-control" type="number" id="totalGasto[]" name="totalGasto[]" placeholder="Total"></div>';
    $('#gastosdiv').append(front_metodo_pago);
    // verificarCantidadesMetodoPago();
});

$("body").on('keyup', '#efectivo_entregado', function () {
    let efectivo_a_entregar = $('#efectivo_a_entregar').val();
    let diferencia = $(this).val() - efectivo_a_entregar;

    $('#efectivo_pendiente').val(diferencia);
    // verificarCantidadesMetodoPago();
});

$(document).on('keyup', '*[id*=totalGasto]:visible', function () {
    const esteValor = verificarEfectivoAentregar();
    const efectivo_a_entregar = parseFloat($('#total_efectivo').val());

    const nuevo = efectivo_a_entregar - esteValor;

    $('#efectivo_a_entregar').val(nuevo);
});


function verificarEfectivoAentregar() {
    let suma_gastos = 0;
    $('*[id*=totalGasto]:visible').each(function () {
        let esteValor = $(this).val();
        if (esteValor == '') {
            esteValor = 0;
        } else {
            esteValor = parseFloat(esteValor);
        }
        suma_gastos += esteValor;
    });
    return suma_gastos;
    // $("#efectivo_a_entregar").val(efectivo);
}