


<link rel="stylesheet" href="componentes/externos/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/template/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/template/css/skins/skin-blue.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">











<form id="profileForm" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">Full name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="fullName" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Bio</label>
        <div class="col-sm-9">
            <textarea class="form-control" name="bio" style="height: 400px;"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
            <button type="submit" class="btn btn-default">Validate</button>
        </div>
    </div>
</form>



<script src="componentes/externos/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>









<script>


$(document).ready(function() {
    $('#profileForm')
        .bootstrapValidator({
            excluded: [':disabled'],
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                fullName: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required and cannot be empty'
                        }
                    }
                },
                bio: {
                    validators: {
                        notEmpty: {
                            message: 'The bio is required and cannot be empty'
                        },
                        callback: {
                            message: 'The bio must be less than 200 characters long',
                            callback: function(value, validator, $field) {
                                // Get the plain text without HTML
                                var div  = $('<div/>').html(value).get(0),
                                    text = div.textContent || div.innerText;

                                return text.length <= 200;
                            }
                        }
                    }
                }
            }
        })
        .find('[name="bio"]')
            .ckeditor()
            .editor
                // To use the 'change' event, use CKEditor 4.2 or later
                .on('change', function() {
                    // Revalidate the bio field
                    $('#profileForm').bootstrapValidator('revalidateField', 'bio');
                });
});
</script>

