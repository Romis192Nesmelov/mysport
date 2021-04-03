$(document).ready(function() {
    // window.phoneRegExp = /^((\+)[0-9]{11})$/gi;
    $('input[name=phone]').mask("+7(999)999-99-99");
    $('input[name=born]').mask("99.99.9999");
    $('input[name=start_time],input[name=end_time]').mask("99.99");
    $('input[name=latitude],input[name=longitude]').mask("99.999999");
});