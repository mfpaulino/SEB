//
<!doctype html>
<html>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# object: http://ogp.me/ns/object# article: http://ogp.me/ns/article#">
		<meta charset="utf-8">
		<title>Validating a form placed inside a Bootstrap modal - FormValidation</title>
		<link href="componentes/externos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="componentes/externos/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="componentes/externos/bootstrap-validator/dist/css/bootstrapValidator.css"/>
		<script src="componentes/externos/jquery/jquery.min.js"></script>
		<script src="componentes/externos/bootstrap/js/bootstrap.min.js"></script>
		<script src="componentes/externos/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
		<script>
			var _gaq = _gaq || [];
			var _gaq.push(['_setAccount', 'UA-44786951-2']);
			var _gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script');
				var ga.type = 'text/javascript';
				var ga.async = true;
				var ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				var s.parentNode.insertBefore(ga, s);
			})
			();
		</script>
	</head>
	<body>
<div class="doc-demo">
	<div class="tab-content">
		<div class="tab-pane active" id="modal-form-tab">
			<p class="text-center">
				<button class="btn btn-default" data-toggle="modal" data-target="#loginModal">Login</button>
			</p>
			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h5 class="modal-title">Login</h5>
						</div>
						<div class="modal-body"> <!-- The form is placed inside the body of modal -->
							<form id="loginForm" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="col-xs-3 control-label">Username</label>
									<div class="col-xs-5">
										<input type="text" class="form-control" name="username" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Password</label>
									<div class="col-xs-5">
										<input type="password" class="form-control" name="password" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-5 col-xs-offset-3">
										<button type="submit" class="btn btn-primary">Login</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
		$(document).ready(function() {
			$('#loginForm').formValidation({
				framework: 'bootstrap',
				excluded: ':disabled',
				icon: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'The username is required'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'The password is required'
							}
						}
					}
				}
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#loginForm').on('success.form.fv',
				function(e) {
				e.preventDefault();
				var validator = $(e.target).data('formValidation');
				var username = validator.getFieldElements('username').val();
				$('#loginModal').one(
					'hidden.bs.modal',
					function() {
						$('#welcomeModal').find('.username').html(username).end().modal('show');
					}
				).modal('hide');
			});
			$('#loginModal').on(
				'hide.bs.modal',
				function() {
					$('#loginForm').formValidation('resetForm', true).find('[name="username"]').focus();
				}
			);
		});
	</script>
</div>
</body>
</html>