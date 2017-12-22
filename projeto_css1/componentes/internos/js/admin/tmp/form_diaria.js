$(document).ready(function() {
	$('#form_diaria_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			categoria: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			posto: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			valor: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_diaria_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			valor: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});
