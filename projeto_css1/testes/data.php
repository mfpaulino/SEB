<link rel="stylesheet" href="../componentes/externos/bootstrap/dist/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min.css">-->
<link rel="stylesheet" href="../componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

	<script src="componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<style type="text/css">
#datetimeForm .has-feedback .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<script src="//oss.maxcdn.com/momentjs/2.8.2/moment.min.js"></script>
<script src="/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<form id="datetimeForm" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">DateTime Picker</label>
        <div class="col-sm-5">
            <div class="input-group date" id="datetimePicker">
                <input type="text" class="form-control" name="datetimePicker" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
</form>


	<script src="../componentes/externos/jquery/dist/jquery.min.js"></script>
	<script src="../componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	<script src="../componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="../componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>





<script>
	$(document).ready(function() {
		//calendario
        $('#datetimePicker').datepicker({
		autoclose: true,
		language: 'pt-BR'
        })
        $("#datetimePicker").mask("99/99/9999",{placeholder:" "})

		$('#datetimeForm').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				datetimePicker: {
					validators: {
						notEmpty: {
							message: 'The date is required and cannot be empty'
						},
						date: {
							format: 'MM/DD/YYYY h:m A'
						}
					}
				}
			}
		});

		$('#datetimePicker')
			.on('dp.change dp.show', function (e) {
				// Revalidate the date when user change it
				$('#datetimeForm').bootstrapValidator('revalidateField', 'datetimePicker');
			});
	});
</script>
