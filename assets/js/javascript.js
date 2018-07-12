$(document).ready(function() {
    $(".delete_row").on('click', function (e) {
        var id = e.relatedTarget.data('id');
        console.log(id);
        if(confirm('Sind Sie sicher?')){
            $.ajax({
                url: 'http://localhost/login_system_2/documents/delete_document/'+id,
                method: 'post',
                success: function(){
                    console.log('success');
                },
                error: function(){
                    console.log('error');
                }
            })
        }
    });

    tinymce.init({
        selector: 'textarea',
        branding: false
    });
    $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});

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
});