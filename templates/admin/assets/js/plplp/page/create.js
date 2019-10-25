$(function() {
	$('.bootstrap-select').selectpicker();


	$('#language a:first').tab('show');

	var id = 1;

	$( 'textarea.editor').each( function() {
		$(this).attr("id","editor"+id);
	    CKEDITOR.replace('editor'+id, {
	        height: '300px',
	    });
	    id = id + 1;
	});

	$('.slug').slugify($('.slug').closest('.name'));
});