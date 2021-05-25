$(document).ready(function () {
    //set initially button state hidden
    $("#altaCliente").hide();
    if (validatenumero()) {
        //if the numero is valid set input email border green
        $("#numero").css("border", "2px solid green");
    } else {
        //if the numero is invalid set input email border red
        $("#numero").css("border", "2px solid red");
    }
    //use keyup event on email field
    $("#email").keyup(function () {
        if (validateEmail()) {
            //if the email is valid set input email border green
            $("#email").css("border", "2px solid green");
        } else {
            //if the email is invalid set input email border red
            $("#email").css("border", "2px solid red");
        }
        buttonState();
    });
    //use keyup event on numero
    $("#numero").keyup(function () {
        if (validatenumero()) {
            //if the numero is valid set input email border green
            $("#numero").css("border", "2px solid green");
        } else {
            //if the numero is invalid set input email border red
            $("#numero").css("border", "2px solid red");
        }
        buttonState();
    });
    $("#cp").keyup(function () {
        if (validatecp()) {
            //if the numero is valid set input email border green
            $("#cp").css("border", "2px solid green");
        } else {
            //if the numero is invalid set input email border red
            $("#cp").css("border", "2px solid red");
        }
    });

    $("#aviso").change(function () {
        if (validateAvisoPrivacidad()) {
            $("#altaCliente").css("border", "2px solid green");
        } else {
            $("#altaCliente").css("border", "2px solid red");
        }
        buttonState();
    });


    $("#editarCliente").on("click", function() {
        console.log("Vamos a editar el cliente");
        $('#nombre').removeAttr('readonly');
        $('#apellidos').removeAttr('readonly');
        $('#email').removeAttr('readonly');
        $('#numero').removeAttr('readonly');
        $('#tipo').removeAttr('readonly');
        $('#centro').removeAttr('readonly');
        $('#fecha').removeAttr('readonly');
        $('#cp').removeAttr('readonly');
        $(this).hide();
        $('#cancelarEdicion').removeAttr('hidden');
        $('#cancelarEdicion').show();
        $('#editarClienteButton').removeAttr('hidden');
        $('#editarClienteButton').show();
    });


    $("#cancelarEdicion").on("click", function() {
        console.log("Vamos a cancelar la edicion del cliente");
        $('#nombre').prop('readonly', true);
        $('#apellidos').prop('readonly', true);
        $('#email').prop('readonly', true);
        $('#numero').prop('readonly', true);
        $('#tipo').prop('disabled', true);
        $('#centro').prop('disabled', true);
        $('#fecha').prop('readonly', true);
        $('#cp').prop('readonly', true);
        $(this).hide();
        $('#editarCliente').show();
        $('#editarClienteButton').hide();
    });
    $("#tratamiento").on("change", function() {
        $.ajax({
            type:"POST",
            url:"../../Controller/Clientes/tratamientoClienteSelect.php",
            data:"tipo=" + $(this).val() + "&id_cliente=" + $('#id').val(),
            success:function(r){
                $('#otro').closest('#otro').html(r);
            }
        });
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
    });
});

//Funciones

function numberOnly(id) {
    // Get element by id which passed as parameter within HTML element event
    var element = document.getElementById(id);
    // This removes any other character but numbers as entered by user
    element.value = element.value.replace(/[^0-9]/gi, "");
}

function validateAvisoPrivacidad() {
    var opt = $("#aviso").val();
    if(opt == "1"){
        return true;
    }else{
        return false;
    }
}

function validateEmail() {
    var email = $("#email").val();
    let regExp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (regExp.test(email)) {
        return true;
    } else {
        return false;
    }
}

function validatenumero() {
    var numero = $("#numero").val();
    if (numero.length == 7 || numero.length == 10) {
        return true;
    } else {
        return false;
    }
}

function validatecp() {
    var cp = $("#cp").val();
    if (cp.length == 0 || cp.length == 5) {
        return true;
    } else {
        return false;
    }
}

function buttonState() {
    if (validateEmail() && validatenumero() && validateAvisoPrivacidad()) {
        $("#altaCliente").show();
    } else {
        $("#altaCliente").hide();
    }
}