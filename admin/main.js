$(document).ready(function () {
    // var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>";
    var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>";
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": actionButtons
        }],

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });

    $("#btnNuevo").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Cosmelóloga");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        username = fila.find('td:eq(2)').text();
        code = fila.find('td:eq(4)').text();
        myStatus = fila.find('td:eq(5)').text();
        sucursal = fila.find('td:eq(6):hidden').text();

        $("#name").val(nombre);
        $("#username").val(username);
        $("#code").val(code);
        // $(`#code[value='${code}']`).prop("checked", true);
        $("#status").val(myStatus);
        // $(`#status[value='${myStatus}']`).prop("checked", true);
        $("#sucursal").val(sucursal);
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Cosmetologa");
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formPersonas").submit(function (e) {
        e.preventDefault();
        myName = $.trim($("#name").val());
        myUsername = $.trim($("#username").val());
        myPassword = $.trim($("#password").val());
        myCode = $.trim($("#code").val());
        myStatus = $.trim($("#status").val());
        mySucursal = $.trim($("#sucursal").val());
        const data = { name: myName, username: myUsername, password: myPassword, code: myCode, status: myStatus, sucursal: mySucursal, id: id, opcion: opcion };
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data,
            success: function (data) {
                console.log("🚀 ~ file: main.js:110 ~ data:", data)
                
                id = data.id;
                nombre = data.name;
                email = data.email;
                password = data.password;
                code = data.code;
                myStatus = data.status;
                sucursal = data.id_sucursal_usuario;

                // if (opcion == 1) { 
                //     tablaPersonas.row.add([id, nombre, email, password, code, myStatus, sucursal, sucursal]).draw();
                // } else {
                //     tablaPersonas.row(fila).data([id, nombre, email, password, code, myStatus, sucursal, sucursal]).draw();
                // }
                location.reload();
            }
        });
        $("#modalCRUD").modal("hide");

    });

});