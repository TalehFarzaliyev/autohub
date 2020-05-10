var siteUrl = "http://autohub.me/";
$(function() {
    
    $(".styled").uniform({
        radioClass: 'choice'
    });
    
    // Initialize multiple switches
    if (Array.prototype.forEach) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
    else {
        var elems = document.querySelectorAll('.switchery');
        for (var i = 0; i < elems.length; i++) {
            var switchery = new Switchery(elems[i]);
        }
    }

    $(".switch").bootstrapSwitch();

    $('.bootstrap-select').selectpicker();

    // On demand picker
    $('#ButtonCreationDemoButton').click(function (e) {
        $('#ButtonCreationDemoInput').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $('#ButtonCreationDemoButton2').click(function (e) {
        $('#ButtonCreationDemoInput2').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $('#ButtonCreationDemoButton3').click(function (e) {
        $('#ButtonCreationDemoInput3').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $('.remove').on('click', function(e){
        var row = $(this).parent().parent().parent().parent();
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Do you realy want to delete",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: href,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "Data successfully deleted",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Data can't be deleted",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
    });

    $('.delete').on('click', function(e){
        var row = $(this).parent().parent().parent().parent();
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Do you realy want to delete",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: href,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "Data successfully deleted",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Data can't be deleted",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
    });

   $('.clean').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Do you realy want to clean all trashed data",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: href,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "All trashed data successfully cleaned",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Trashed data can not clean",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
    });

   $('.delete_permanently').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Do you realy want to delete permanently selected trashed data",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: href,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "All selected trashed data successfully deleted permanently",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Trashed data can not remove",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
    });

    $('#language a:first').tab('show');

    $('[data-popup="lightbox"]').fancybox({
        padding: 3
    });

    var id = 1;

    $( 'textarea.editor').each( function() {
        $(this).attr("id","editor"+id);
        CKEDITOR.replace('editor'+id, {
            height: '300px',
            filebrowserBrowseUrl: siteUrl+'en/admin/filemanager'
        });
        id = id + 1;
    });
    
    $('.slug').slugify($('.slug').closest('.name'));

    // Image Manager
    $(document).on('click', 'a[data-toggle=\'image\']', function(e) {
        var $element = $(this);
        var $popover = $element.data('bs.popover'); // element has bs popover?

        e.preventDefault();

        // destroy all image popovers
        $('a[data-toggle="image"]').popover('destroy');

        // remove flickering (do not re-add popover when clicking for removal)
        if ($popover) {
            return;
        }

        $element.popover({
            html: true,
            placement: 'right',
            trigger: 'manual',
            content: function() {
                return '<button type="button" id="button-image" class="btn btn-primary"><i class="icon-pen6"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="icon-eraser2"></i></button>';
            }
        });

        $element.popover('show');

        $('#button-image').on('click', function() {
            var $button = $(this);
            var $icon   = $button.find('> i');

            $('#modal-image').remove();

            $.ajax({
                url: '/admin/filemanager/index/popup?target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id'),
                dataType: 'html',
                beforeSend: function() {
                    $button.prop('disabled', true);
                    if ($icon.length) {
                        $icon.attr('class', 'icon-spinner4');
                    }
                },
                complete: function() {
                    $button.prop('disabled', false);
                     $(".styled").uniform({
				        radioClass: 'choice'
				    });
                    if ($icon.length) {
                        $icon.attr('class', 'icon-pen6');
                    }
                },
                success: function(html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                    $('#modal-image').modal('show');
                }
            });

            $element.popover('destroy');
        });

        $('#button-clear').on('click', function() {
            $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

            $element.parent().find('input').val('');

            $element.popover('destroy');
        });
    });

     // Single picker
    
    $('.daterange-single').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY'
        }
    });

     // Single picker
    $('.daterange-single1').daterangepicker({ 
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });


});

//  # Bootstrap multiselect
$(function(){
    $('.multiselect').multiselect({
        onChange: function() {
            $.uniform.update();
        }
    });

    // Select All and Filtering features
    $('.multiselect-select-all-filtering').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        templates: {
            filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text"></li>'
        },
        onSelectAll: function() {
            $.uniform.update();
        }
    });

    // Styled checkboxes and radios
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});

});




