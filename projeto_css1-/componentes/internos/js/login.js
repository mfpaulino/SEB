$(document).ready(function() {
	$('#form_usuario_acessar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-user',
			invalid: '',
			validating: ''
		},
		fields: {
			cpf: {
				validators: {
					notEmpty: {
						message:'&nbsp;&nbsp;Preenchimento obrigatório'
					},
					remote: {
						type: 'POST',
						url: 'controllers/usuario/usuario_verificar.json.php',
						message: '&nbsp;&nbsp;Usuário não encontrado',
						delay: 1000
					}
				}
			},
			senha: {
				validators: {
					notEmpty: {
						message: '&nbsp;&nbsp;Preenchimento obrigatório'
					},
					stringLength: {
						min: 8,
						max: 20,
						message: '&nbsp;&nbsp;Mínimo de 8 e máximo de 20 caracteres'
					}
				}
			},
			captcha: {
				validators: {
					notEmpty: {
						message:'&nbsp;&nbsp;Preenchimento obrigatório'
					}
				}
			}
		}
	})
});
