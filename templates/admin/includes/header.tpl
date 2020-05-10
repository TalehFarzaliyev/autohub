<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$title}</title>

<!-- Favicons-->
<link rel="icon" type="image/png" href="{base_url('templates/admin/assets/images/favicon.png')}">

<!-- Global stylesheets -->
	<link href="{base_url('templates/admin/assets/css/icons/icomoon/styles.css')}" rel="stylesheet" type="text/css">
	<link href="{base_url('templates/admin/assets/css/bootstrap.css')}" rel="stylesheet" type="text/css">
	<link href="{base_url('templates/admin/assets/css/core.css')}" rel="stylesheet" type="text/css">
	<link href="{base_url('templates/admin/assets/css/components.css')}" rel="stylesheet" type="text/css">
	<link href="{base_url('templates/admin/assets/css/colors.css')}" rel="stylesheet" type="text/css">
	<link href="{base_url('templates/admin/assets/css/colors.css')}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->



<!-- Core JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/jquery.min.js')}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/jquery.slugify.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/jquery.nestable.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/bootstrap.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/loaders/pace.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/loaders/blockui.min.js')}"></script>
{*	<script type="text/javascript" src="{base_url('templates/admin/assets/js/ckeditor/ckeditor.js')}"></script>*}
	<script src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/pickers/anytime.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/ui/moment/moment.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/pickers/daterangepicker.js')}"></script>
	<script type="text/javascript" src=""></script>
<!-- /core JS files -->

<!-- Theme JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/styling/uniform.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/selects/bootstrap_select.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/selects/bootstrap_multiselect.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/notifications/sweet_alert.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/ui/nicescroll.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/tags/tagsinput.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/media/fancybox.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/styling/switchery.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/styling/switch.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/tags/tokenfield.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/ui/prism.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/app.js')}"></script>
<!-- /theme JS files -->

<!-- Common JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/common.js')}"></script>
<!-- /common JS files -->

{$scrips}
</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<div class="navbar navbar-default navbar-fixed-top header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="{site_url('admin/dashboard')}"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a target="_blank" href="{site_url_multi()}">{$text.common.common_header_visit_site}</a></li>
				
				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{base_url('templates/admin/assets/images/image.png')}" alt="">
						<span>{$user.fullname}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li class="divider"></li>
						<li><a href="{site_url_multi('admin/authentication/logout')}"><i class="icon-switch2"></i> {$text.common.common_header_user_logout}</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->