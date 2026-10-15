$(document).ready(function () {
    $("#createForm").on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '/poems',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,

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



$(document).ready(function () {
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '/auth/register',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,

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
            }
        })
    })
});

$(document).ready(function(){
    $('#loginForm').on('submit', function(e){
        e.preventDefault(); 

        const formData = new FormData(this); 

        $.ajax({
            url: '/auth/login',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,

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
            }
        })
    })
})


$(document).ready(function(){
    $('#authVisibility').on('click', function(e){
        e.preventDefault(); // Prevents the page from jumping if it's an <a> link or submitting if it's a button
        
        // This will instantly flip the visibility of both forms
        $('#loginForm, #registerForm').toggle();
    });
});