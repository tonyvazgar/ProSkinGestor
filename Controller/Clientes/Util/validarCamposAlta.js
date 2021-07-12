$(document).ready(function () {
    //set initially button state hidden
    $("#altaCliente").hide();
    
    //use keyup event on email field
    $(document).on('keyup',"#nombre", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));  
    });

    $(document).on('keyup',"#apellidos", function () {
        var i = $(this).val().toUpperCase();
        $(this).val(RemoveAccents(i));
    });

    //use keyup event on email field
    $(document).on('keyup',"#email", function () {
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
    $(document).on('keyup',"#numero", function () {
        var i = $(this).val();
        $(this).val(i.trim());  
        if (validatenumero()) {
            //if the numero is valid set input email border green
            $("#numero").css("border", "2px solid green");
        } else {
            //if the numero is invalid set input email border red
            $("#numero").css("border", "2px solid red");
        }
        buttonState();
    });
    $(document).on('keyup',"#cp", function () {
        if (validatecp()) {
            //if the numero is valid set input email border green
            $("#cp").css("border", "2px solid green");
        } else {
            //if the numero is invalid set input email border red
            $("#cp").css("border", "2px solid red");
        }
    });

    $("#aviso").change(function () {
        var i = $("#nombre").val();
        $("#nombre").val(i.trim());  

        var i = $("#apellidos").val();
        $("#apellidos").val(i.trim()); 

        //AJAX A ARCHIVO DE BUSCARCLIENTE
        //MANDANDO TELEFONO Y APELLIDO
        //SI EL TELEFONO EXISTE
        //CONSOLE.LOG 

        let numero = $("#numero").val();
        verificarClienteExistente(numero);

        if (validateAvisoPrivacidad()) {
            $("#altaCliente").css("border", "2px solid green");
        } else {
            $("#altaCliente").css("border", "2px solid red");
        }
        buttonState();
    });


    $("#editarCliente").on("click", function() {
        //*************** READONLY ***************
        $("#id").replaceWith( function() {
            //<input type="text" class="form-control" id="id" name="id" value=<?php echo $infoCliente['id_cliente'];?> readonly>
            return "<input type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" readonly/>";
        });
        $("#status").replaceWith( function() {
            return "<input type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" readonly/>";
        });
        $("#fecha_registro").replaceWith( function() {
            return "<input type=\"date\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" readonly/>";
        });
        $("#fecha_visita").replaceWith( function() {
            return "<input type=\"date\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" readonly/>";
        });
        //********************************************
        console.log("Vamos a editar el cliente");
        $('#nombre').replaceWith( function() {
            return "<input type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" required/>";
        });
        $('#apellidos').replaceWith( function() {
            return "<input type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" required/>";
        });
        $('#email').replaceWith( function() {
            return "<input type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" required/>";
        });
        $('#numero').replaceWith( function() {
            console.log("<input oninput=\"numberOnly(this.id);\" type=\"text\" pattern=\"\d*\" maxlength=\"10\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" required/>");
            return "<input oninput=\"numberOnly(this.id);\" type=\"text\" pattern=\"\\d*\" maxlength=\"10\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\'" + $( this ).html() + "\' required/>";
        });
        $('#tipo').show();
        $('#tipo').removeAttr('readonly');
        $('#centro').show(); $('#centrolLbl').hide();
        $('#centro').removeAttr('readonly');
        $('#fecha').replaceWith( function() {
            return "<input type=\"date\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" />";
        });
        $('#cp').replaceWith( function() {
            return "<input oninput=\"javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);\"  maxlength = \"5\"  type=\"text\" class=\"form-control\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\" value=\"" + $( this ).html() + "\" />";
        });
        $(this).hide();
        $('#cancelarEdicion').removeAttr('hidden');
        $('#cancelarEdicion').show();
        $('#editarClienteButton').removeAttr('hidden');
        $('#editarClienteButton').show();
    });


    $("#cancelarEdicion").on("click", function() {
        //*************** READONLY ***************
        $("#id").replaceWith( function() {
            //<p class="lead" id="id" name="id">OEP9902289</p>
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $("#status").replaceWith( function() {
            //<p class="lead" id="status" name="status">ACTIVO</p>
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $("#fecha_registro").replaceWith( function() {
            //<p class="lead" id="fecha_registro" name="fecha_registro">2021-03-24</p>
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $("#fecha_visita").replaceWith( function() {
            //<p class="lead" id="fecha_visita" name="fecha_visita">2021-04-14</p>
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        //********************************************
        console.log("Vamos a cancelar la edicion del cliente");
        $('#nombre').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $('#apellidos').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $('#email').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $('#numero').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $('#tipo').hide();
        $('#centro').hide(); $('#centrolLbl').show();
        $('#centro').removeAttr('readonly');
        $('#fecha').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
        $('#cp').replaceWith( function() {
            return "<p class=\"lead\" id=\"" + $( this ).attr('id') + "\" name=\"" + $( this ).attr('name') + "\">" + $( this ).val() + "</p>";
        });
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
    if (validatenumero() && validateAvisoPrivacidad()) {
        $("#altaCliente").show();
    } else {
        $("#altaCliente").hide();
    }
}
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
    console.log(strAccents);
    return strAccentsOut;
}

function verificarClienteExistente(numero){
    $.ajax({
        type:"POST",
        url:"../../Controller/Clientes/verificarClienteExistente.php",
        data:"numero=" + numero,
        success:function(r){
            let data = JSON.parse(r);
            let stringData = "";
            if(Object.entries(data).length !== 0){
                data.forEach(element => {
                    stringData += "*" + element.nombre_cliente + " " + element.apellidos_cliente +  " [" + element.email_cliente + "]\n";
                });
                console.log(stringData);
                alert("YA EXISTEN CLIENTES CON ESTE NUMERO: \n\n" + stringData);
            }
        }
    });
}

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}