$(document).ready(function () {
    let tipoUsuario = $("#userPermission").val();
    let sucursalUsuario = $("#userSucursal").val();

    // Si el valor del input es "desactivar", desactivar la opción correspondiente
    if (tipoUsuario !== "global") {
        $("#status option[value='admin']").prop("disabled", true);
        $("#code option[value='global']").prop("disabled", true);

        $("#sucursal option").each(function (index, element) {
            var optionValue = $(element).val();

            if (optionValue != sucursalUsuario) {
                $(this).prop("disabled", true);
            }
        });
    }
});
