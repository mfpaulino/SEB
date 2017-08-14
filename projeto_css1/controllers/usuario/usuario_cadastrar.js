$(document).ready(function() {
	$('#form_usuario_cadastrar').bootstrapValidator({
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
					remote: {
						type: 'POST',
						url: 'componentes/internos/php/valida_cpf.json.php',
						message: 'CPF inválido',
						delay: 1000
					}
				}
			},
			posto: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			},
			nome_guerra: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			},
			nome: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			},
			email: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					emailAddress: {
						message: 'E-mail inválido'
					},
					remote: {
						type: 'POST',
						url: 'controllers/usuario/usuario_verificar.json.php',
						message: 'E-mail já cadastrado no sistema',
						delay: 1000
					}
				}
			},
			senha: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					stringLength: {
						min: 8,
						max: 20,
						message: 'Mínimo de 8 caracteres'
					},
					identical: {
						field: 'senha1',
						message: 'As senhas devem ser iguais.'
					},
					different: {
						field: 'cpf',
						message: 'Não pode ser igual ao CPF.'
					}
				}
			},
			senha1: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					identical: {
						field: 'senha',
						message: 'As senhas devem ser iguais.'
					}
				}
			},
			codom: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
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
