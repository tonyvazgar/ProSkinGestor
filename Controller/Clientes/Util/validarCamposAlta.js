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
});

$("#editarCliente").on("click", function() {
    console.log("Vamos a editar el cliente");
});
//Funciones

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