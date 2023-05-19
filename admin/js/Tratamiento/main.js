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
        $("#productsForm").trigger("reset");
        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo tratamiento");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta

        $("#tratamiento_id").prop( "disabled", false );
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        console.log("🚀 ~ file: main.js:44 ~ fila:", fila)

        tratamiento_id = fila.find('td:eq(0)').text();
        tratamiento_name = fila.find('td:eq(1)').text();
        tratamiento_price = fila.find('td:eq(2)').text();
        tratamiento_duration = fila.find('td:eq(3)').text();
        tratamiento_consentimiento = fila.find('td:eq(4)').text();

        $("#tratamiento_id").val(tratamiento_id);
        $("#tratamiento_name").val(tratamiento_name);
        $("#tratamiento_price").val(tratamiento_price);
        $("#tratamiento_duration").val(tratamiento_duration);
        $("#tratamiento_consentimiento").val(tratamiento_consentimiento);
        opcion = 2; //editar

        $("#tratamiento_id").prop( "disabled", true );

        $(".modal-header").css("background-color", "#f7d9d9");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar tratamiento");
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
                    productsTable.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#productsForm").submit(function (e) {
        e.preventDefault();
        product_id = $.trim($("#product_id").val());
        product_brand = $.trim($("#product_brand").val());
        product_line = $.trim($("#product_line").val());
        product_description = $.trim($("#product_description").val());
        product_presentation = $.trim($("#product_presentation").val());
        product_stock = $.trim($("#product_stock").val());
        product_cost = $.trim($("#product_cost").val());
        product_sucursal = $.trim($("#sucursal").val());
        const data = { product_id, product_brand, product_line, product_description, product_presentation, product_stock, product_cost, product_sucursal, opcion };
        
        console.log("🚀 ~ file: main.js:97 ~ data:", data)

        $.ajax({
            url: "bd/Producto.php",
            type: "POST",
            dataType: "json",
            data,
            success: function (data) {
                console.log("🚀 ~ file: main.js:110 ~ data:", data)
                location.reload();
            }
        });
        $("#modalCRUD").modal("hide");

    });

});