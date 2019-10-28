<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title text-semibold">{$title} <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
		<div class="heading-elements"></div>
	</div>

	{if validation_errors()}
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger no-border">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				{$message}
		    </div>
		</div>
	</div>
	{/if}

	{form_open(current_url(), 'class="form-horizontal has-feedback", id="form-save"')}
	<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
		<li class="active"><a href="#translation" data-toggle="tab"><i class="icon-earth position-left"></i> {$text.common.common_tab_translation}</a></li>
		<li><a href="#general" data-toggle="tab"><i class="icon-menu7 position-left"></i> {$text.common.common_tab_general}</a></li>
		<li><a href="#photo" data-toggle="tab"><i class="icon-menu position-left"></i> {$text.common.common_tab_images}</a></li>
		<li><a href="#videos" data-toggle="tab"><i class="icon-menu position-left"></i> Video</a></li>
	</ul>

	

	<div class="tab-content">
		
		<div class="tab-pane active" id="translation">
			<div class="panel-body">
				<div class="tabbable tab-content-bordered">
					<ul class="nav nav-tabs nav-tabs-highlight nav-justified" id="language">
						{if isset($language_list) && is_object($language_list)}
						{foreach $language_list as $language}
							<li>
								<a href="#{$language->slug}" data-toggle="tab">
									{$language->name}
									<img src="{base_url('templates/admin/assets/images/flags/')}{$language->code}.png" alt="{$language->name}" class="pull-right">									
								</a>
							</li>
						{/foreach}
						{/if}
					</ul>

					<div class="tab-content">
						{if isset($language_list) && is_object($language_list)}
						{foreach $language_list as $language}
							<div class="tab-pane active" id="{$language->slug}">									
								<div class="panel-body">
									<fieldset class="content-group">
										{foreach from=$form_field.translation[{$language->id}] key=key item=value}
										<div class="form-group {if form_error($form_field.translation[{$language->id}][{$key}].name)}has-error{/if}">
											{form_label($form_field.translation[{$language->id}][{$key}].label, $key, ['class' => 'control-label col-md-2'])}
											<div class="col-md-10">
											{form_element($form_field.translation[{$language->id}][{$key}])}
											{form_error($form_field.translation[{$language->id}][{$key}].name)}
											</div>
										</div>
										{/foreach}	
																
									</fieldset>
								</div>					
							</div>
						{/foreach}
						{/if}
					</div>								
				</div>
			</div>
		</div>

		<div class="tab-pane" id="general">
			<div class="panel-body">
				{foreach from=$form_field.general key=key item=value}
				<div class="form-group {if form_error($form_field.general[{$key}].name)}has-error{/if}">
					{form_label($form_field.general[{$key}].label, $key, ['class' => 'control-label col-md-2'])}
					<div class="col-md-10">
					{form_element($form_field.general[{$key}])}
					{form_error($form_field.general[{$key}].name)}
					</div>
				</div>
				{/foreach}
			</div>		
		</div>
		<div class="tab-pane" id="photo">
			<div class="panel-body">
				<div class="row photo_area">
					{assign var=image_row value=0}
					{if !empty($images)}
					{foreach from=$images item=image}
					<div class="col-lg-2 col-sm-6" id="image_row_{$image_row}">
						<div class="thumbnail">
							<div class="thumb">
								<a href="#" id="thumb-image" data-toggle="image"><img src="{$image.thumb}" alt=""></a>
							</div>
							<input type="hidden" name="images[]" id="input-image" value="{$image.image}">
						</div>
						<button type="button" onclick="$('#image_row_{$image_row}').remove();" class="btn btn-danger btn-block"><i class="icon-minus-circle2"></i> {$text.common.common_remove}</button>
					</div>
					{assign var=image_row value=$image_row+1}
					{/foreach}
					{/if}
				</div>
			</div>
			<div class="panel-footer text-center">
				<a href="#" id="add_photo" class="btn btn-success"><i class="icon-plus-circle2"></i> Add image</a>
			</div>
		</div>
		<div class="tab-pane" id="videos">
			<div class="panel-body">
				<div class="video_area">
					{assign var=video_row value=0}
					{if !empty($videos)}
					{foreach from=$videos item=video}
					<div class="form-group" id="video_row_{$video_row}">
						<label for="video" class="control-label col-md-2">Video</label>
						<div class="col-md-9">
							<input type="text" name="videos[{$video_row}]" value="{$video}" placeholder="Video URL" class="form-control" >
						</div>
						<div class="col-md-1"><button type="button" onclick="$('#video_row_{$video_row}').remove();" class="btn btn-danger btn-block"><i class="icon-minus-circle2"></i></button></div>
					</div>
					{assign var=video_row value=$video_row+1}
					{/foreach}
					{/if}
				</div>

			</div>
			<div class="panel-footer text-center">
				<a href="#" id="add_video" class="btn btn-success"><i class="icon-plus-circle2"></i> Add video</a>
			</div>
		</div>
	</div>
	{form_close()}
</div>
<script type="text/javascript">
	var image_row = {$image_row};
	$('body').delegate('#add_photo', 'click', function(e){
		e.preventDefault();
		var append_data = '<div class="col-lg-2 col-sm-6" id="image_row_'+image_row+'"><div class="thumbnail"><div class="thumb"><a href="#" id="thumb-input-image-'+image_row+'" data-toggle="image"><img src="/uploads/catalog/nophoto.png" data-placeholder="/uploads/catalog/nophoto.png"></a><input type="hidden" name="images[]" id="input-image-'+image_row+'" value=""></div></div><button type="button" onclick="$(\'#image_row_'+image_row+'\').remove();" class="btn btn-danger btn-block"><i class="icon-minus-circle2"></i> {$text.common.common_remove}</button></div>';
		$('.photo_area').append(append_data);
		image_row++;
	});

	var video_row = {$video_row};
	$('body').delegate('#add_video', 'click', function(e){
		e.preventDefault();
		var append_data = '<div class="form-group" id="video_row_'+video_row+'"><label for="video" class="control-label col-md-2">Video</label><div class="col-md-9"><input type="text" name="videos['+video_row+']" value="" placeholder="Video" class="form-control" ></div><div class="col-md-1"><button type="button" onclick="$(\'#video_row_'+video_row+'\').remove();" class="btn btn-danger btn-block"><i class="icon-minus-circle2"></i></button></div></div>';
		$('.video_area').append(append_data);
		video_row++;
	});
</script>
{literal}

<script type="text/javascript">

$(function(){
	$('input[data-role="tagsinput"]').each(function(){
		var lang_id = $(this).attr('data-lang-id');

		var substringMatcher = function(strs) {
	        return function findMatches(q, cb) {
	            var tags = [];
	            strs = function(params){
	                $.ajax({
	                    type: 'get',
	                    url: siteUrl+'admin/tag/ajax_get_tags/',
	                    data: {lang: lang_id, query: q},
	                    dataType: 'json',
	                    async: false,
	                    success: function (data) {
	                        tags = data;
	                    }
	                });
	                return tags;
	            }();


	            var matches, substringRegex;
	            matches = [];
	            substrRegex = new RegExp(q, 'i');

	            $.each(strs, function(i, str) {
	                if (substrRegex.test(str)) {

	                    matches.push({ value: str });
	                }
	            });
	            cb(matches);
	        };
	    };

	    // Attach typeahead
	    $(this).tagsinput('input').typeahead(
	        {
	            hint: true,
	            highlight: true,
	            minLength: 1
	        },
	        {
	            name: 'states',
	            displayKey: 'value',
	            source: substringMatcher([])
	        }
	    ).bind('typeahead:selected', $.proxy(function (obj, datum) {
	        this.tagsinput('add', datum.value);
	        this.tagsinput('input').typeahead('val', '');
	    }, $(this)));
	});
	
});
</script>
{/literal}