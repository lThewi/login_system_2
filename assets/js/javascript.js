$(document).ready(function() {
    var answer_counter = 3;


    $('#add-answer').on('click', function(){
        $('#answer-box').append(
            '<div class="form-group">' +
                '<label for="content">Antwort '+answer_counter+'</label>' +
                '<input type="text" name="answer'+answer_counter+'" id="answer'+answer_counter+'" class="form-control">' +
            '</div>'
        );
        $('#answer-counter').html(
            '<input type="hidden" value="'+answer_counter+'" name="counter">'
        );
        answer_counter++;
    });

    $('#switch').on('click', function(){
        $('#text-card').hide();
        $('#skala-card').show();
    });

    $('#switch-back').on('click', function(){
        $('#text-card').show();
        $('#skala-card').hide();
    });

    $('[type="checkbox"]').on('click', function () {
        value = true
        $('[type="checkbox"]').each(function(){
            if($(this).is(':checked')){
                value = false;
            }
        });
        $('.decline-user').prop('disabled', value);
        $('.accept-user').prop('disabled', value);
    });

    $(".delete_row").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie dieses Dokument löschen wollen?')){
            $.ajax({
                url: 'delete_document/'+id,
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

    $(".decline-active-user").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diesen Nutzeraccount deaktivieren möchten?')){
            $.ajax({
                url: 'decline_active_user/'+id,
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

    $(".decline-user").on('click', function () {
        var id = $(this).attr('data-id');
        //alle gecheckten boxen abfragen
        var index = 0;
        var array = [];
        $('input:checked').each( function () {
            array[index] = $(this).attr('value');
            index++;
        });
        var json_string = JSON.stringify(array);
        if(confirm('Sind Sie sicher, dass Sie diesen Nutzer ablehnen wollen?')){
            $.ajax({
                url: 'decline_multiple_users',
                method: 'post',
                //dataType: 'json',
                data: {json_string: json_string},
                success: function(){
                    //console.log('test');
                    location.reload();
                },
                error: function(){
                    console.log('error');
                }
            })
        }
    });

    $(".re-add-user").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diesen Nutzer hinzufügen möchten?')){
            $.ajax({
                url: 're_add_user/'+id,
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

    $(".delete-page").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Seite löschen wollen?')){
            $.ajax({
                url: 'delete_page/'+id,
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

    $(".delete-faq").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Seite löschen wollen?')){
            $.ajax({
                url: 'delete_faq/'+id,
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

    $(".delete-news").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Seite löschen wollen?')){
            $.ajax({
                url: 'delete_news/'+id,
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

    $(".delete-contact").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Kontaktperson entfernen wollen?')){
            $.ajax({
                url: 'delete_contact/'+id,
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
    $(".delete-category").on('click', function () {
        var id = $(this).attr('data-id');
        if(confirm('Sind Sie sicher, dass Sie diese Kategorie entfernen wollen?')){
            $.ajax({
                url: 'delete_category/'+id,
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
    $("#img-rating").on('change',function() {
        readURL(this, '#img_pv_rating');
    });
    

    //send table order
    var delay = 500;
    $('table#cat-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'sorted_table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_categories_order',
                error: function () {
                    console.log('Ajax error in doc-table');
                }
            });
        }
    });

    $('table.doc-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'sorted_table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_documents_order',
                error: function () {
                    console.log('Ajax error in doc-table');
                }
            });
        }
    });
    $('table#pending-users-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'pending-users-table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_pending_order',
                success: function(){
                    console.log('pending');
                },
                error: function () {
                    console.log('Ajax error in pending-table');
                }
            });
        }
    });
    $('table#active-users-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'active-users-table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_user_order',
                error: function () {
                    console.log('Ajax error in active-user-table');
                }
            });
        }
    });
    $('table#declined-users-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'declined-users-table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_pending_order',
                error: function () {
                    console.log('Ajax error in declined-table');
                }
            });
        }
    });

    $('table#contacts-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'contacts-table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_contactperson_order',
                error: function () {
                    console.log('Ajax error in contacts-table');
                }
            });
        }
    });

    $('table#news-table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'news-table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_news_order',
                error: function () {
                    console.log('Ajax error in news-table');
                }
            });
        }
    });

    $('table#all_pages_table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        group: 'all_pages_table',
        delay: delay,
        onDrop: function ($item, container, _super){
            $item.removeClass(container.group.options.draggedClass).removeAttr("style");
            $("body").removeClass(container.group.options.bodyClass);
            var index = 0;
            var array = [];
            $('tbody tr').each( function () {
                array[index] = $(this).attr('id');
                index++;
            });
            var json_string = JSON.stringify(array);
            $.ajax({
                method: 'POST',
                data: {string: json_string},
                url: 'update_page_order',
                error: function () {
                    console.log('Ajax error in pages-table');
                }
            });
        }
    });
    /////////
});