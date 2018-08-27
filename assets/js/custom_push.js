
$(document).ready(function(){


    $('#send').on('click', function() {
        //getting oauth 2.0 token (hopefully)
        var access_token = '285246244690-kl0m5ikmcmq34lukltljpmi5hc352ed5.apps.googleusercontent.com' ;
        var msg = $('#message').val();
        $.ajax({
            url: 'test',
            type: 'post',
            data: {token: access_token,message:msg},
            success: function(){
                console.log('success');
            },
            error: function(){
                console.log('error');
            }
        });
    });
})