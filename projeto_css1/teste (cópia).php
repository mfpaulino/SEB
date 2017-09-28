<link rel="stylesheet" href="componentes/externos/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/template/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/template/css/skins/skin-blue.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">

<div class="container">
    <form role="form" method="POST" action="#" name="setpolicyform" id="setpolicyform">
        <div class='box-body pad'>
			<div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter text ..." name="assunto" />
            </div>
            <div class="form-group">
                <div class="lnbrd">
                    <textarea class="textarea form-control" placeholder="Enter text ..." name="policyta" style="width: 510px; height: 200px;"></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i>&nbsp;SAVE</button>
        </div>
    </form>
</div>
<script src="componentes/externos/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/correio_cadastrar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
<script>
	$(document).ready(function () {
		$('#setpolicyform').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				assunto:{
					validators: {
						notEmpty: {
							message: 'Textarea cannot be empty'
						}
					}
				},
				policyta: {
					group: '.lnbrd',
					validators: {
						notEmpty: {
							message: 'Textarea cannot be empty'
						},
						stringLength: {
							max: 50,
							message: 'Maximum 50 Characters Required'
						}
					}
				}
			}
		});
		$('.textarea').wysihtml5({
			events: {
				load: function () {
					$('.textarea').addClass('textnothide');
				},
				change: function () {
					$('#setpolicyform').bootstrapValidator('revalidateField', 'policyta');
				}
			}
		});
	});
</script>