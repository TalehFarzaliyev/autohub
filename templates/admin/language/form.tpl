<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title">{$title} <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
		<div class="heading-elements">
			
    	</div>
	</div>

	<div class="panel-body">
			{form_open(current_url(), 'class="form-horizontal"')}
			
			{if isset($message) && !empty($message)}
				{$message}
			{/if}

			<fieldset class="content-group">
				<div class="form-group">
					{form_label($text.language.language_form_label_name, 'name', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_input($form_field.name)}
					</div>
				</div>

				<div class="form-group">
					{form_label($text.language.language_form_label_directory, 'directory', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_input($form_field.directory)}
					</div>
				</div>

				<div class="form-group">					
					{form_label($text.language.language_form_label_slug, 'slug', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_input($form_field.slug)}
					</div>
				</div>

				<div class="form-group">
					{form_label($text.language.language_form_label_code, 'code', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_input($form_field.code)}
					</div>
				</div>

				<div class="form-group">					
					{form_label($text.language.language_form_label_default, 'default', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_checkbox($form_field.default)}
					</div>
				</div>

				<div class="form-group">
					{form_label($text.language.language_form_label_sort, 'sort', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_input($form_field.sort)}
					</div>
				</div>

				<div class="form-group">
					{form_label($text.language.language_form_label_status, 'status', ['class' => 'control-label col-lg-2'])}
					<div class="col-lg-10">
						{form_dropdown('status', $options.status, [], $form_field.status)}
					</div>
				</div>
			</fieldset>			

			<div class="text-right">
				{form_button($form_button.submit)}
				{form_button($form_button.reset)}
			</div>
		{form_close()}
	</div>
</div>