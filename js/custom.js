$(document).ready(function() {

    $(document).on('click', '#button', function (e) {
        e.preventDefault();
        var text = $('#input_text').val();     //  исходный текст
        var count_words = $('#count_words').val();     //  число тегов
        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: {data: text, count: count_words},
            success: function(response){
                var res = JSON.parse(response);
                        $('#one').text(Object.keys(res));

            }
        });

    })

});



