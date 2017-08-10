$(document).ready(function() {
	$('#form_usuario_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			rg: {
				validators: {
					notEmpty: {
						message:'preenchimento obrigatório'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'somente dígitos'
					}
				}
			},
			posto: {
				validators: {
					notEmpty: {
						message: 'preenchimento obrigatório'
					}
				}
			},
			nome_guerra: {
				validators: {
					notEmpty: {
						message: 'preenchimento obrigatório'
					}
				}
			},
			nome: {
				validators: {
					notEmpty: {
						message: 'preenchimento obrigatório'
					}
				}
			},
			email: {
				validators: {
					notEmpty: {
						message: 'preenchimento obrigatório'
					},
					emailAddress: {
						message: 'E-mail válido'
					}
				}
			},
			ritex: {
				validators: {
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'somente dígitos'
					},
					stringLength: {
						min: 7,
						max: 7,
						message: 'RITEx inválido'
					}
				}
			},
			celular: {
				validators: {
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'somente dígitos'
					},
					stringLength: {
						min: 10,
						max: 11,
						message: 'Celular inválido'
					}
				}
			}
		}
	})
});