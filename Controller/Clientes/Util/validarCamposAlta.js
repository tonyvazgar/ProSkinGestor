$(document).ready(function () {
    //set initially button state hidden
    $("#altaCliente").hide();
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
});

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
    if (numero.length >= 7 && numero.length <= 10) {
        return true;
    } else {
        return false;
    }
}

function buttonState() {
    if (validateEmail() && validatenumero()) {
        $("#altaCliente").show();
    } else {
        $("#altaCliente").hide();
    }
}