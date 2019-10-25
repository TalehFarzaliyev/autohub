<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title">{$title}</h5>
		<div class="heading-elements">
		</div>
	</div>
	
	{if isset($message) && !empty($message)}
		<div class="panel-body">
			<div class="alert alert-success no-border">
				{$message}
		    </div>
		</div>
	{/if}

	
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover table-xxs">
			<thead>
				<tr>
					<th style="width: 1px;"><input type="checkbox" class="styled" onclick="$('input[name*=\'selected\']').prop('checked', this.checked); $.uniform.update();"></th>
					<th>Key</th>
					<th>Value</th>
					<th>Pattern</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				{if isset($lang_array) && !empty($lang_array)}
					{foreach $lang_array as $key => $value} 					
					<tr>
						<td><input type="checkbox" name="selected[]" value="{$key}" class="styled"></td>
						<td>{$key}</td>
						<td><input type="text" class="form-control" value="{$value}" name="{$key}" size="89"/></td>
						<td>{$pattern.$key}</td>
						<td>
							<ul class="icons-list">
								<li><a href="#" class="delete" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash"></i></a></li>
							</ul>
						</td>
					</tr>
					{/foreach}
				{else}
				<tr>
					<td colspan="9"><div class="text-center">No languages</div></td>
				</tr>
				{/if}
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

	$('.delete').on('click', function(){
		var row = $(this).parent().parent().parent().parent().remove().fadeOut();
	});

});
</script>