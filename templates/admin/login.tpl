
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
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/loaders/pace.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/jquery.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/libraries/bootstrap.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/loaders/blockui.min.js')}"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/plugins/forms/styling/uniform.min.js')}"></script>
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/app.js')}"></script>
	<!-- /theme JS files -->
	<script type="text/javascript" src="{base_url('templates/admin/assets/js/core/common.js')}"></script>

</head>

<body class="login-container">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					{form_open()}
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="{base_url('templates/admin/assets/images/logo_dark.png')}">
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>

							{$message}

							<div class="form-group has-feedback has-feedback-left">
								{form_input('login', '', 'class="form-control" placeholder="Login" autofocus')}
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								{form_password('password', '', 'class="form-control" placeholder="Password"')}
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											{form_checkbox('remember', '1', '', ["class" => "styled"])}
											Remember me
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								{form_submit('submit', 'Sign in', 'class="btn btn-primary btn-block"')}
							</div>

							
						</div>
					{form_close('')}
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						{$copyright}
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>