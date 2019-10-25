<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title">{$title}</h5>
	</div>
	{if isset($message) && !empty($message)}
	<div class="panel-body">
		<div class="alert alert-success no-border">
			{$message}
		</div>
	</div>
	{/if}
	
	{form_open_multipart(site_url('admin/gallery/delete'), 'class="form-horizontal" id="form-list"')}
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