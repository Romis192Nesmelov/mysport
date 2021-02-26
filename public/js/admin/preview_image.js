$(document).ready(function() {
    // Preview upload image
    $('input[type=file]').change(function () {
        var input = $(this)[0];
        var imagePreview = $(this).parents('.edit-image-preview').find('img');

        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.attr('src', '/images/placeholder.jpg');
        }
    });
});