$(function() {
	
	$(".styled").uniform({
        radioClass: 'choice'
    });

	$('.bootstrap-select').selectpicker();

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
                            title: "Page successfully deleted",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Page can't be deleted",
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
})