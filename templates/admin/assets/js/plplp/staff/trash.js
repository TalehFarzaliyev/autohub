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
                            title: "Staff successfully deleted",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        row.remove();
                    }else{
                        swal({
                            title: "Staff can't be deleted",
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