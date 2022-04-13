
$(document).ready(function () {
    //set initially button state hidden
    $("#login").hide();
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
    //use keyup event on password
    $("#password").keyup(function () {
        if (validatePassword()) {
            //if the password is valid set input email border green
            $("#password").css("border", "2px solid green");
        } else {
            //if the password is invalid set input email border red
            $("#password").css("border", "2px solid red");
        }
        buttonState();
    });

    //Click button login
    $("#login").on('click', function (event) {
        $(this).hide();
        $("#cargandoLoader").show();
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

function validatePassword() {
    var pass = $("#password").val();
    if (pass.length >= 5 && pass.length <= 8) {
        return true;
    } else {
        return false;
    }
}

function buttonState() {
    if (validateEmail() && validatePassword()) {
        $("#login").show();
    } else {
        $("#login").hide();
    }
}