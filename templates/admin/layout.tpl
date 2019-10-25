{include file="{$template_dir}/admin/includes/header.tpl"}
<!-- Page container -->
<div class="page-container">
	<!-- Page content -->
	<div class="page-content">
		{include file="{$template_dir}/admin/includes/sidebar.tpl"}
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-default page-header-xs">
				<div class="page-header-content">
					<div class="page-title">
						<h5><i class="icon-arrow-left52 position-left"></i> {$title} <small class="display-block">{$subtitle}</small></h5>
					</div>
					<div class="heading-elements">
						{if isset($buttons) && is_array($buttons)}
							{foreach $buttons as $button}
							<{$button.type} {if $button.type eq 'a'} href="{$button.href}" {/if} class="{$button.class}" id="{$button.id}" {if !empty($button.additional) && isset($button.additional)}{foreach from=$button.additional key=key item=value} {$key}="{$value}"{/foreach} {/if}>
								<b><i class="{$button.icon}"></i></b> {$button.text}</{$button.type}>
							{/foreach}
						{/if}
					</div>
				</div>
				<div class="breadcrumb-line">
				{$breadcrumbs}
					<ul class="breadcrumb-elements">
						{if isset($breadcrumb_links) && is_array($breadcrumb_links)}
							{foreach $breadcrumb_links as $breadcrumb_link}
								<li><a href="{$breadcrumb_link.href}"><i class="{$breadcrumb_link.icon_class}"></i> {$breadcrumb_link.text} <span class="{$breadcrumb_link.label_class}">{$breadcrumb_link.label_value}</span></a></li>
							{/foreach}
						{/if}
					</ul>
				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				{include file="{$template_dir}/{$content}.tpl"}
			</div>
			<!-- /content area -->

			{include file="{$template_dir}/admin/includes/footer.tpl"}
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>