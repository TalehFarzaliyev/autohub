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
	</ul>

	

	<div class="tab-content">
		
		<div class="tab-pane active" id="translation">
			<div class="panel-body">
				<div class="tabbable tab-content-bordered">
					<ul class="nav nav-tabs nav-tabs-highlight nav-justified" id="language">
						{if isset($language_list) && is_object($language_list)}
						{foreach $language_list as $language}
							<li><a href="#{$language->slug}" data-toggle="tab">{$language->name} <img src="{base_url('templates/admin/assets/images/flags/')}{$language->code}.png" alt="{$language->name}" class="pull-right"></a></li>
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
	</div>
	{form_close()}
</div>