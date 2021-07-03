$(document).ready(function () {
    //use keyup event on email field
    $(document).on('keyup',"#nombre", function () {
        $(this).val($(this).val().toUpperCase());  
    });
});