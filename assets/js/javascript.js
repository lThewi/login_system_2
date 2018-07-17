$(document).ready(function() {
    $(".delete_row").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie dieses Dokument löschen wollen?')){
            $.ajax({
                url: 'http://localhost/login_system_2/documents/delete_document/'+id,
                method: 'post',
                success: function(){
                    console.log('success');
                    location.reload();
                },
                error: function(){
                    console.log('error');
                }
            })
        }
    });

    $(".decline-user").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diesen Nutzer ablehnen wollen?')){
            $.ajax({
                url: 'http://localhost/login_system_2/users/decline_user/'+id,
                method: 'post',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                        location.reload();
                },
                error: function(){
                    console.log('error');
                }
            })
        }
    });

    $(".delete-contact").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Kontaktperson entfernen wollen?')){
            $.ajax({
                url: 'http://localhost/login_system_2/documents/delete_contact/'+id,
                method: 'post',
                success: function(){
                    location.reload();
                },
                error: function(){
                    console.log('error');
                }
            })
        }
    });

    function readURL(input, img_pv) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(img_pv).attr('src', e.target.result);
                $(img_pv).attr('class', 'img-thumbnail mt-2');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_1").on('change',function() {
        readURL(this, '#img_pv_1');
    });
    $("#img_2").on('change',function() {
        readURL(this, '#img_pv_2');
    });
    $("#img_3").on('change',function() {
        readURL(this, '#img_pv_3');
    });
    $("#img").on('change',function() {
        readURL(this, '#img_pv');
    });
});