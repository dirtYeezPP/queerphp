$(document).ready(function () {
    $("#createForm").on('submit', function (e) {
        e.preventDefault();

        const formData = {
            title: $('#title').val(),
            atype: $('#genre').val(),
            published: $('#poem').val(),
            animeImg: $('#pImg').val()
        }

        $.ajax({
            url: '/poems',
            type: 'POST',
            contentType: 'applicaiton/json',
            data: JSON.stringify(formData),
            dataType: 'json',

            success: function (response) {
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'purple').text(response.message);
                    $('#createForm')[0].reset();
                } else {
                    $('#responseMessage').css('color', 'red').text(response.message);
                }
            },
            error: function (xhr) {
                let errorMessage = 'Server communication fail';
                if (xhr.responseText) {
                    try {
                        const errData = JSON.parse(xhr.responseText);
                        errorMessage = errData.message;
                    } catch (e) {
                        console.error('Couldnt parse response');
                    }
                }

                 $('#responseMessage').css('color', 'red').text(errorMessage)

                // console.error(xhr.responseText); 
                // $('#responseMessage').css('color', 'red').text('Server Communication fail.');
            }
        });
    });
});