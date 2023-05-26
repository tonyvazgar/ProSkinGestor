$(document).ready(function () {
    // var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>";
    var actionButtons = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>";
    productsTable = $("#productsTable").DataTable({
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
        $("#formSucursal").trigger("reset");
        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva sucursal");
        $("#modalSucursal").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        console.log("🚀 ~ file: main.js:44 ~ fila:", fila)

        sucursal_id = fila.find('td:eq(0)').text();
        sucursal_name = fila.find('td:eq(1)').text();
        
        $("#sucursal_id").val(sucursal_id);
        $("#sucursal_name").val(sucursal_name);
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar sucursal");
        $("#modalSucursal").modal("show");

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
                    productsTable.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formSucursal").submit(function (e) {
        e.preventDefault();
        sucursal_name = $.trim($("#sucursal_name").val());
        sucursal_id = $.trim($("#sucursal_id").val());
        
        const data = { sucursal_name, sucursal_id, opcion };
        
        console.log("🚀 ~ file: main.js:97 ~ data:", JSON.stringify(data))

        $.ajax({
            url: "bd/Sucursal.php",
            type: "POST",
            dataType: "json",
            data,
            success: function (data) {
                console.log("🚀 ~ file: main.js:110 ~ data:", data)
                location.reload();
            }
        });
        $("#modalSucursal").modal("hide");

    });

});