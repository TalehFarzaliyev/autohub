$(function() {
	$('.bootstrap-select').selectpicker();


	$('#language a:first').tab('show');

	var id = 1;

	$( 'textarea.editor').each( function() {
		$(this).attr("id","editor"+id);
	    CKEDITOR.replace('editor'+id, {
	        height: '300px',
	        filebrowserBrowseUrl: 'http://192.168.0.123/cms/en/admin/filemanager'
	    });
	    id = id + 1;
	});
});