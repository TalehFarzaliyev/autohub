<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title">{$title}</h5>
		<div class="heading-elements">
			<div class="btn-group">
				{if isset($language_list_holder) && is_array($language_list_holder)}
				{foreach $language_list_holder as $language}
				<a href="{site_url_multi('admin/category')}?lang_id={$language.id}" class="{$language.class}"><img src="{base_url('templates/admin/assets/images/flags/')}{$language.code}.png" alt="{$language.name}"> {$language.name} <span class="label bg-slate-700">{$language.count}</span></a>
				{/foreach}
				{/if}
			</div>
			<a href="#" class="btn btn-default heading-btn pull-right table-toolbar-button"><i class="icon-gear"></i></a>
			{form_open(current_url(), 'class="heading-form pull-right" method="get"')}
				<div class="form-group has-feedback">
					{form_element($search_field.name)}
					<div class="form-control-feedback">
						<i class="icon-search4 text-size-base text-muted"></i>
					</div>
				</div>
			{form_close()}
		</div>
	</div>
	{if isset($message) && !empty($message)}
	<div class="panel-body">
		<div class="alert alert-success no-border">
			{$message}
		</div>
	</div>
	{/if}
	{if isset($columns) && !empty($columns)}
	<div class="table-toolbar-area" style="display: none; border-bottom: 1px solid #dfdfdf; background: #f5f5f5; padding: 10px;">
		<div class="row">
			<div class="col-md-11" style="padding-top: 5px">
				{foreach $columns as $column} 
				<label class="checkbox-inline"><input type="checkbox" class="styled table-column-checkbox" checked="checked" value="{$column}">{$text.category["category_table_head_{$column}"]}</label></a>
				{/foreach}
			</div>
			<div class="col-md-1">				
				<button class="btn btn-xs btn-primary btn-labeled btn-block"><b><i class="icon-floppy-disk"></i></b> {$text.common.common_form_button_save}</button>
			</div>
		</div>
	</div>
	{/if}
	{form_open_multipart('http://192.168.0.123/cms/admin/category/delete', 'class="form-horizontal" id="form-list"')}
	{$table}
	{form_close()}
	<div class="panel-footer">
		<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		<div class="heading-elements">
			<span class="heading-left-element">
			{form_dropdown('per_page', $per_page_lists, $per_page, ["class" => "bootstrap-select", "data-style" => "btn-default btn-xs", "data-width" => "100%"])}
			</span>
			{$pagination}
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.table-toolbar-button').on('click', function(){
		$('.table-toolbar-area').toggle();
	});
	$('.table-column-checkbox').change(function(){
		var column = $(this).val();
		if($(this).prop('checked')){
			$('.column_'+column).removeClass('hide');
		}
		else{
			$('.column_'+column).addClass('hide');
		}
	});
</script>