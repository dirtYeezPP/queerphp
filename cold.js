$(document).ready(function(){
    $("#createForm").on('submit', function(e){
        e.preventDefault(); 

        const formData = {
            title: $('#title').val(), 
            atype: $('#atype').val(),
            published: $('#published').val(),
            rating: $('#rating').val()
        }

        $.ajax({
            url: 'index.php',
            type: 'POST', 
            data: formData, 
            dataType: 'json', 

            success: function(response){
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'purple').text(response.message);
                    $('#createForm')[0].reset(); 
                } else {
                    $('#responseMessage').css('color', 'red').text(response.message); 
                }
            },
            error: function(){
                $('#responseMessage').css('color', 'red').text('Server Communication fail.');
            }
        });
    });
});