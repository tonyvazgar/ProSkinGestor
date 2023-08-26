$(document).ready(function () {
    let tipoUsuario = $("#userPermission").val();
    let sucursalUsuario = $("#userSucursal").val();

    
    if (tipoUsuario !== "global") {
        $("#sucursal option").each(function (index, element) {
            var optionValue = $(element).val();

            if (optionValue != sucursalUsuario) {
                $(this).prop("disabled", true);
            }
        });
    }
});
