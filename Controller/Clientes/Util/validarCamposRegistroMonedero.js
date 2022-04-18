$(document).ready(function () {
    $("#altaMonederoCliente").hide();
    $("#btn-agregar-tratamiento").hide();

    $(document).on('keyup', "#dineroTotal", function () {
        verificarDatos();
    });
    $(document).on('keyup', "#idMonedero", function () {
        verificarDatos();
    });
    $(document).on('keyup', '#cantidadTratamiento',function(){
        if (parseInt($(this).val()) < 1){
            $(this).val(1);
        }
    });

    $(document).on('click', '.btn-agregar-tratamiento', function () {

        switch(parseInt($('#tratamiento.last_tratamiento').val())){
            case 1:
                var idTratamiento = "DEP01";
                var nombreTratamiento = "DEPILACION";
                let numDeZonas    = $('#detalleZona').val();
                let precioTratamiento = $('#precioTratamiento').val();
                let cantidadSesiones = $('#cantidadTratamiento').val();


                var zonasSeleccionadas = [];
                var zonasText = [];
                $.each($("input:checkbox[name='zonas_cuerpo[0][]']:checked"), function () {
                    zonasSeleccionadas.push($(this).val());
                    zonasText.push($(this).parent().text().trim());
                });



                agregarFilaTabla(idTratamiento, nombreTratamiento, cantidadSesiones, numDeZonas, precioTratamiento, zonasSeleccionadas, zonasText);
                limpiarFormulario();
                break;
            case 2:
                var idTratamientoc = "CAV01";
                var nombreTratamientoc = "CAVITACION";
                let precioTratamientoc = $('#precioTratamiento').val();
                let cantidadSesionesc = $('#cantidadTratamiento').val();


                var zonasSeleccionadas = [];
                var zonasText = [];
                $.each($("input:checkbox[name='zonas_cuerpo[0][]']:checked"), function () {
                    zonasSeleccionadas.push($(this).val());
                    zonasText.push($(this).parent().text().trim());
                });



                agregarFilaTabla(idTratamientoc, nombreTratamientoc, cantidadSesionesc, 'N/A', precioTratamientoc, zonasSeleccionadas, zonasText);
                limpiarFormulario();
                break;
            case 3:
                var idTratamientoo = $('#nombreTratamiento').val();
                var nombreTratamientoo = $("#nombreTratamiento option:selected" ).text();
                let precioTratamientoo = $('#precioTratamiento').val();
                let cantidadSesioneso = $('#cantidadTratamiento').val();
                agregarFilaTabla(idTratamientoo, nombreTratamientoo, cantidadSesioneso, 'N/A', precioTratamientoo, '', '');
                limpiarFormulario();
                break;
            default:
                $('.last_tratamiento').closest('#otro').html("");
        }
        verificarDatos();
    });
    $(document).on('change', '#tratamiento.last_tratamiento', function () {
        let camposDepilacion = '<div><p>Llena los siguientes datos para Depilación:</p><div class="form-group form-inline"><label>Número de zonas</label><select name="detalleZona[]" id="detalleZona" class="last_tratamiento form-control"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option></select><label>Precio:</label><input type="number" class="last_tratamiento form-control" id="precioTratamiento" name="precioTratamiento[]" step=".01" required=""><label>¿Cuantas sesiones?:</label><input type="number" class="last_tratamiento form-control" id="cantidadTratamiento" name="cantidadTratamiento[]" step="1" required=""></div><div class="form-group"><label for="exampleInputEmail1">Zona del cuerpo</label><table class="table table-borderless zonasCheckbox" id="zonasCheckbox"><tbody><tr><td><div class="form-check"><input class="form-check-input check" type="checkbox" value="23" name="zonas_cuerpo[0][]" id="flexCheckDefault23"><label class="form-check-label" for="flexCheckDefault23">**TODO EL CUERPO**</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="17" name="zonas_cuerpo[0][]" id="flexCheckDefault17"><label class="form-check-label" for="flexCheckDefault17">Abdomen</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="3" name="zonas_cuerpo[0][]" id="flexCheckDefault3"><label class="form-check-label" for="flexCheckDefault3">Antebrazos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="2" name="zonas_cuerpo[0][]" id="flexCheckDefault2"><label class="form-check-label" for="flexCheckDefault2">Axilas</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="4" name="zonas_cuerpo[0][]" id="flexCheckDefault4"><label class="form-check-label" for="flexCheckDefault4">Brazos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="12" name="zonas_cuerpo[0][]" id="flexCheckDefault12"><label class="form-check-label" for="flexCheckDefault12">Entrecejo</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="18" name="zonas_cuerpo[0][]" id="flexCheckDefault18"><label class="form-check-label" for="flexCheckDefault18">Espalda</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="13" name="zonas_cuerpo[0][]" id="flexCheckDefault13"><label class="form-check-label" for="flexCheckDefault13">Frente</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="10" name="zonas_cuerpo[0][]" id="flexCheckDefault10"><label class="form-check-label" for="flexCheckDefault10">Glúteos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="19" name="zonas_cuerpo[0][]" id="flexCheckDefault19"><label class="form-check-label" for="flexCheckDefault19">Hombro</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="7" name="zonas_cuerpo[0][]" id="flexCheckDefault7"><label class="form-check-label" for="flexCheckDefault7">Ingles</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="24" name="zonas_cuerpo[0][]" id="flexCheckDefault24"><label class="form-check-label" for="flexCheckDefault24">LSMP</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="14" name="zonas_cuerpo[0][]" id="flexCheckDefault14"><label class="form-check-label" for="flexCheckDefault14">Labio Superior</label></div></td><td><div class="form-check"><input class="form-check-input check" type="checkbox" value="21" name="zonas_cuerpo[0][]" id="flexCheckDefault21"><label class="form-check-label" for="flexCheckDefault21">Lumbares</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="5" name="zonas_cuerpo[0][]" id="flexCheckDefault5"><label class="form-check-label" for="flexCheckDefault5">Manos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="16" name="zonas_cuerpo[0][]" id="flexCheckDefault16"><label class="form-check-label" for="flexCheckDefault16">Mentón</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="8" name="zonas_cuerpo[0][]" id="flexCheckDefault8"><label class="form-check-label" for="flexCheckDefault8">Muslo</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="20" name="zonas_cuerpo[0][]" id="flexCheckDefault20"><label class="form-check-label" for="flexCheckDefault20">Nuca</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="22" name="zonas_cuerpo[0][]" id="flexCheckDefault22"><label class="form-check-label" for="flexCheckDefault22">Orejas</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="15" name="zonas_cuerpo[0][]" id="flexCheckDefault15"><label class="form-check-label" for="flexCheckDefault15">Patillas</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="1" name="zonas_cuerpo[0][]" id="flexCheckDefault1"><label class="form-check-label" for="flexCheckDefault1">Pecho</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="9" name="zonas_cuerpo[0][]" id="flexCheckDefault9"><label class="form-check-label" for="flexCheckDefault9">Pierna</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="6" name="zonas_cuerpo[0][]" id="flexCheckDefault6"><label class="form-check-label" for="flexCheckDefault6">Pubis</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="11" name="zonas_cuerpo[0][]" id="flexCheckDefault11"><label class="form-check-label" for="flexCheckDefault11">Zona Alba</label></div></td></tr></tbody></table></div></div>';
        let camposCavitacion = '<div><p>Llena los siguientes datos para Cavitación:</p><div class="form-group form-inline"><label>Precio:</label><input type="number" class="last_tratamiento form-control" id="precioTratamiento" name="precioTratamiento[]" step=".01" required=""><label>¿Cuantas sesiones?:</label><input type="number" class="last_tratamiento form-control" id="cantidadTratamiento" name="cantidadTratamiento[]" step="1" required=""></div><div class="form-group"><label for="exampleInputEmail1">Zonas del cuerpo</label><table class="table table-borderless zonasCheckbox" id="zonasCheckbox"><tbody><tr><td><div class="form-check"><input class="form-check-input check" type="checkbox" value="17" name="zonas_cuerpo[0][]" id="flexCheckDefault17"><label class="form-check-label" for="flexCheckDefault17">Abdomen</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="4" name="zonas_cuerpo[0][]" id="flexCheckDefault4"><label class="form-check-label" for="flexCheckDefault4">Brazos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="18" name="zonas_cuerpo[0][]" id="flexCheckDefault18"><label class="form-check-label" for="flexCheckDefault18">Espalda</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="10" name="zonas_cuerpo[0][]" id="flexCheckDefault10"><label class="form-check-label" for="flexCheckDefault10">Glúteos</label></div><div class="form-check"><input class="form-check-input check" type="checkbox" value="9" name="zonas_cuerpo[0][]" id="flexCheckDefault9"><label class="form-check-label" for="flexCheckDefault9">Pierna</label></div></td></tr></tbody></table></div></div>';
        switch(parseInt($(this).val())){
            case 1:
                $('.last_tratamiento').closest('#otro').html(camposDepilacion);
                $('#cantidadTratamiento').val(1);
                $("#btn-agregar-tratamiento").hide();
                break;
            case 2:
                $('.last_tratamiento').closest('#otro').html(camposCavitacion);
                $('#cantidadTratamiento').val(1);
                $("#btn-agregar-tratamiento").hide();
                break;
            case 3:
                cargarListaTratamientos('3');
                $("#btn-agregar-tratamiento").hide();
                break;
            default:
                $('.last_tratamiento').closest('#otro').html("");
        }
    });

    $(document).on("keydown", ":input:not(textarea)", function(event) {
        if (event.key == "Enter") {
            event.preventDefault();
        }
    });

    $('#otro').on('change', '#detalleZona', function(){
        var num    = parseInt($(this).val());
        var precio = 0;
        switch(num){
            case 1:
                // precio = 400; PRECIO 2021
                precio = 400;
                break;
            case 2:
                // precio = 640; PRECIO 2021
                precio = 680;
                break;
            case 3:
                // precio = 960; PRECIO 2021
                precio = 1020;
                break;
            case 4:
                // precio = 1264; PRECIO 2021
                precio = 1344;
                break;
            case 5:
                // precio = 1580; PRECIO 2021
                precio = 1660;
                break;
            case 6:
                // precio = 1872; PRECIO 2021
                precio = 1968;
                break;
            case 7:
                // precio = 2184; PRECIO 2021
                precio = 2296;
                break;
            case 8:
                // precio = 2464; PRECIO 2021
                precio = 2592;
                break;
            case 9:
                // precio = 2772; PRECIO 2021
                precio = 2880;
                break;
            case 10:
                // precio = 3040; PRECIO 2021
                precio = 3160;
                break;
            case 11:
                // precio = 3344; PRECIO 2021
                precio = 3476;
                break;
            case 12:
                // precio = 3600; PRECIO 2021
                precio = 3744;
                break;
            case 13:
                // precio = 3900; PRECIO 2021
                precio = 4056;
                break;
            case 14:
                // precio = 4144; PRECIO 2021
                precio = 4312;
                break;
            case 15:
                // precio = 4440; PRECIO 2021
                precio = 4620;
                break;
            case 16:
                // precio = 4672; PRECIO 2021
                precio = 4864;
                break;
            case 17:
                // precio = 4964; PRECIO 2021
                precio = 5168;
                break;
            case 18:
                // precio = 5184; PRECIO 2021
                precio = 5400;
                break;
            case 19:
                // precio = 5396; PRECIO 2021
                precio = 5548;
                break;
            case 20:
                // precio = 5600; PRECIO 2021
                precio = 5600;
                break;
            default:
                precio = '';
        }
        
        $('#precioTratamiento').val(precio);
        $("#btn-agregar-tratamiento").show();
    });

    $('#otro').on('change', '#nombreTratamiento', function(){
        cargarPrecioTratamiento($(this).val());
    });

    $('#otro').on('keyup', '#precioTratamiento', function(){
        if(parseFloat($('#precioTratamiento').val()) > 0){
            $("#btn-agregar-tratamiento").show();
        }else{
            $("#btn-agregar-tratamiento").hide();
        }
    });
    
    $("body").on('click', '#botonAgregarMetodoPago', function(){
        $(this).prop( "disabled", true );
        const count = $(".metodosPagoDiv").children('div').length + 1;
        const front_metodo_pago = "<br><div class='form-inline div_metodo" + count + "'><h4>Método "+count+":</h4><div><select name='metodoPago[]' id='metodoPago' class='form-control select_metodo" + count + "'><option value=''>*** Selecciona ***</option><option value='6'>Depósito</option><option value='1'>Efectivo</option><option value='2'>[TDD]Tarjeta de débito</option><option value='3'>[TDC]Tarjeta de crédito</option><option value='4'>Transferencia</option><option value='5'>Cheque de regalo</option></select><input type='text' class='form-control referencia_metodo" + count + "' id='referencia' name='referencia[]' placeholder='Número de referencia del pago' style='display: none;'><input type='number' class='form-control totalMetodoPago" + count + "' id='totalMetodoPago' name='totalMetodoPago[]' placeholder='Cantidad de este método de pago' step='any' style='display: none;'></div><button class='btn btn-danger metodo" + count + "' id='botonEliminarMetodoPago' type='button'><i class='far fa-trash-alt'></i></button></div>";
        $('#metodosPagoDiv').append(front_metodo_pago);
        // verificarCantidadesMetodoPago();
    });

    $(document).on('click', '#botonEliminarMetodoPago', function(){
        const clase = $(this).attr('class').replace('btn btn-danger metodo', '');
        $(this).closest('.div_metodo' + clase).remove();
        $('#botonAgregarMetodoPago').prop( "disabled", false );
        verificarCantidadesMetodoPago();
        verificarDatos();
    });

    $(document).on('keyup',"#totalMetodoPago", function () {
        verificarCantidadesMetodoPago();
        verificarDatos();
    });

    $('body').on('change','#metodoPago',function () {
        const num_clase = $(this).attr('class').replace('form-control select_metodo', '');
        const valor_a_agregar = preciosEnCascada();
        if($(this).val() != ''){
            $('.totalMetodoPago' + num_clase).show();
            $('.totalMetodoPago' + num_clase).val(valor_a_agregar);
            // $('.btn-agregar-pagoCompleto').show();
            let total = $('#sumaTotalPrecios').val();
            $('#pagoCompleto').text("$" + total);
            $('.referencia_metodo' + num_clase).val('');
        }
        if($(this).val() == ''){
            $('.totalMetodoPago' + num_clase).hide();
        }
        if($(this).val() == 6){
            $('.referencia_metodo' + num_clase).show();
        }else{
            $('.referencia_metodo' + num_clase).hide();
            $('.referencia_metodo' + num_clase).val('');
        }
        verificarCantidadesMetodoPago();
        verificarDatos();
        $('#botonAgregarMetodoPago').prop( "disabled", false );
    });


    $(document).on('click', '#eliminarTratamientoLista', function(){
        const clase = $(this).attr('class').replace('btn btn-danger eliminar', '');
        $(this).closest('.tratamiento' + clase).remove();

        actualizarSumaMonederoLista();
    });
    $(document).on('click', '#editarTratamientoLista', function(){
        const clase = $(this).attr('class').replace('btn btn-warning editar', '');

        $("#cantidadTratamientoLista.form-control."+clase).removeAttr('hidden');
        $("#cantidadTratamientoLista.form-control."+clase).show();
        $("#precioIndividual.form-control."+clase).removeAttr('hidden');
        $("#precioIndividual.form-control."+clase).show();
        $("#cantidadLabel."+clase).removeAttr('hidden');
        $("#cantidadLabel."+clase).show();
        $("#precioLabel."+clase).removeAttr('hidden');
        $("#precioLabel."+clase).show();
        $(this).hide();
        $("#cancelarTratamientoLista.btn.btn-warning.cancelar"+clase).removeAttr('hidden');
        $("#cancelarTratamientoLista.btn.btn-warning.cancelar"+clase).show();
        
    });
    $(document).on('click', '#cancelarTratamientoLista', function(){
        const clase = $(this).attr('class').replace('btn btn-warning cancelar', '');

        $("#cantidadTratamientoLista.form-control."+clase).hide();
        $("#precioIndividual.form-control."+clase).hide();
        $("#cantidadLabel."+clase).hide();
        $("#precioLabel."+clase).hide();
        $(this).hide();
        $("#editarTratamientoLista.btn.btn-warning.editar"+clase).removeAttr('hidden');
        $("#editarTratamientoLista.btn.btn-warning.editar"+clase).show();

        actualizarSumaMonederoLista();
        
    });
    $(document).on('keyup', "#cantidadTratamientoLista", function () {
        const clase = $(this).attr('class').replace('form-control ', '');
        var valor_actual = $(this).val();
        var valor_precio = $('#precioIndividual.form-control.' + clase).val();
        $("#textoCantidad" + clase).text(valor_actual + 'x$' + valor_precio);
        $("#precio" + clase).text("$"+(valor_actual * valor_precio));
        $("#precioTratamientoLista." + clase).val(valor_actual * valor_precio);
    });
    $(document).on('keyup', "#precioIndividual", function () {
        const clase = $(this).attr('class').replace('form-control ', '');
        var valor_actual = $(this).val();
        var valor_cantidad = $('#cantidadTratamientoLista.form-control.' + clase).val();
        $("#textoCantidad" + clase).text(valor_cantidad + 'x$' + valor_actual);

        $("#precio" + clase).text("$"+(valor_actual * valor_cantidad));
        $("#precioTratamientoLista." + clase).val(valor_actual * valor_cantidad);
    });

    $(window).on("beforeunload", function() { 
        $("#cargandoLoader").show();
        // <div class="modal-backdrop fade show"></div>
        let background = '<div class="modal-backdrop fade show"></div>';
        $("body").append(background);
    });

});

let verificarDatos = () => {
    let monto       = $("#dineroTotal").val();
    let id_monedero = $("#idMonedero").val(); 
    // let verificarExistenciaMondedero = verificarExistenciaMondedero($('#idCliente').val());
    let sumaTotalMetodos = $('#sumaTotalMetodosPago').val();
    if (monto > 0 && id_monedero !== "" && sumaTotalMetodos == monto) {
        $("#altaMonederoCliente").show();
    } else {
        if (monto < 0) {
            $("#dineroTotal").val(0);
        }
        $("#altaMonederoCliente").hide();
    }
};

function cargarListaTratamientos(tratamiento) {
    $.ajax({
        type: "POST",
        url: "listaTratamientosMondedero.php",
        data: "tipoTratamiento=" + tratamiento,
        success: function (r) {
            $('.last_tratamiento').closest('#otro').html(r);
            $('#cantidadTratamiento').val(1);
        }
    });
}

function cargarPrecioTratamiento(precioTratamiento) {
    $.ajax({
        type: "POST",
        url: "listaTratamientosMondedero.php",
        data: "IDtratamiento=" + precioTratamiento,
        success: function (r) {
            $('#precioTratamiento').val(r);
            $("#btn-agregar-tratamiento").show();
        }
    });
}

function limpiarFormulario(){
    $('.last_tratamiento').closest('#otro').html("");
    $("#btn-agregar-tratamiento").hide();
    $('#tratamiento').val('');
}

function agregarFilaTabla(idTratamiento, nombre, cantidadTratamiento, numZonas, precio, zonas, zonasText) {

    let parseoPrecio = isNaN(parseInt(precio)) ? 0 : parseInt(precio);
    let parseoCantidad = isNaN(parseFloat(cantidadTratamiento)) ? 0 : parseFloat(cantidadTratamiento);
    let precioFinal = parseoCantidad * parseoPrecio;


    var numero = $(".table >tbody >tr").length;
    let front = '<tr class="tratamiento' + idTratamiento + numero + '"><td>' + nombre + '<input type="text" class="form-control ' + idTratamiento + numero + '" id="nombreTratamientoLista" name="nombreTratamientoLista[]" value="' + idTratamiento + '" hidden></td><td><label id="textoCantidad' + idTratamiento + numero + '">' + cantidadTratamiento + 'x$' + precio + '</label><div class="form-group form-inline"><label class="' + idTratamiento + numero + '" id="cantidadLabel" hidden>Cantidad:</label><input type="text" class="form-control ' + idTratamiento + numero + '" id="cantidadTratamientoLista" name="cantidadTratamientoLista[]" value="' + cantidadTratamiento + '" hidden></div><div class="form-group form-inline"><label class="' + idTratamiento + numero + '" id="precioLabel" hidden>Precio:</label><input type="text" class="form-control ' + idTratamiento + numero + '" id="precioIndividual" name="precioIndividual[]" value="' + precio + '" hidden></div></td><td>' + numZonas + '<input type="number" class="form-control ' + idTratamiento + numero + '" id="numDeZonas" name="numDeZonas[]" value="' + numZonas + '" hidden></td><td><label id="precio' + idTratamiento + numero + '">$' + precioFinal + '</label><input type="number" class="precioTratamiento last_tratamiento form-control ' + idTratamiento + numero + '" id="precioTratamientoLista" name="precioTratamientoLista[]" step=".01" required="" value="' + precioFinal + '" hidden></td><td>' + zonasText + '<input type="text" class="form-control ' + idTratamiento + numero + '" id="numZonas" name="numZonas[]" value="' + zonas + '" hidden></td><td><button class="btn btn-warning cancelar' + idTratamiento + numero + '" id="cancelarTratamientoLista" type="button" hidden><i class="far fa-window-close"></i></button><button class="btn btn-warning editar' + idTratamiento + numero + '" id="editarTratamientoLista" type="button"><i class="fas fa-edit"></i></button><button class="btn btn-danger eliminar' + idTratamiento + numero + '" id="eliminarTratamientoLista" type="button" ><i class="far fa-trash-alt"></i></button></td></tr>';
    $(".table").find('tbody').append(front);
    actualizarSumaMonedero(precio, cantidadTratamiento);
}

function actualizarSumaMonedero(valor, cantidad) {
    let parseoCantidad = isNaN(parseInt(cantidad)) ? 0 : parseInt(cantidad);
    let parseoValor = isNaN(parseFloat(valor)) ? 0 : parseFloat(valor);
    let actual = isNaN(parseFloat($('#dineroTotal').val())) ? 0 : parseFloat($('#dineroTotal').val());
    let modificado = actual + (parseoValor * parseoCantidad);
    $('#dineroTotal').val(modificado);
}

function verificarExistenciaMondedero(id_cliente) {
    $.ajax({
        type: "POST",
        url: "listaTratamientosMondedero.php",
        data: "id_cliente=" + id_cliente,
        success: function (r) {
            
        }
    });
}

function verificarCantidadesMetodoPago(){
    var formElements = new Array();
    $("form #totalMetodoPago").each(function(){
        formElements.push(parseFloat($(this).val()));
    });
    var sum = formElements.reduce(function(a, b) { return a + b; }, 0);

    $('#sumaTotalMetodosPago').val(sum);
    $('#sumaTotalMetodosPagoLabel').text(" $" + sum);

    if(sum == $('#dineroTotal').val()){
        $('#sumaTotalMetodosPago').css("border", "2px solid green");
        $('#dineroTotal').css("border", "2px solid green");
        // $("#firma_div").show();
    }else{
        $('#sumaTotalMetodosPago').css("border", "2px solid red");
        $('#dineroTotal').css("border", "2px solid red");
        // $("#firma_div").hide();
    }
}

function preciosEnCascada() {
    let totalGeneral = $('#dineroTotal').val();

    var formElements = new Array();
    $("form #totalMetodoPago").each(function () {
        formElements.push(parseFloat($(this).val()));
    });
    formElements.pop();

    var suma = formElements.reduce(function (a, b) { return a + b; }, 0);
    var diferencia = totalGeneral - suma;
    return diferencia;
}

function actualizarSumaMonederoLista() {

    var formElements = new Array();
    $("form #precioTratamientoLista").each(function () {
        formElements.push(parseFloat($(this).val()));
    });
    // formElements.pop();

    var suma = formElements.reduce(function (a, b) { return a + b; }, 0);
    // let modificado = actual + (parseoValor * parseoCantidad);
    $('#dineroTotal').val(suma);

    verificarDatos();
}