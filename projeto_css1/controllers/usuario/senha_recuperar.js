$(document).ready(function() {
	$('#form_senha_recuperar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			cpf: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					},
					stringLength: {
						min: 11,
						max: 11,
						message: '11 dígitos'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'Somente dígitos'
					},
					remote: {
						type: 'POST',
						url: 'controllers/usuario/usuario_verificar.json.php',
						message: 'Usuário não encontrado',
						delay: 1000
					}
				}
			}
		}
	})
});
