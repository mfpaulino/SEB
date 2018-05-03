$(document).ready(function() {
	//validacao
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
			rg: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'somente dígitos'
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
			unidade_ci: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			},
			perfil: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			},
			ritex: {
				validators: {
					regexp: {
						regexp: /^[0-9-]+$/,
						message: 'somente dígitos'
					},
					stringLength: {
						min: 8,
						max: 8,
						message: 'RITEx inválido'
					}
				}
			},
			fixo: {
				validators: {
					regexp: {
						regexp: /^[0-9-()\s]+$/,
						message: 'somente dígitos'
					},
					stringLength: {
						min: 14,
						max: 14,
						message: 'Telefone inválido (DDD + Nº)'
					}
				}
			},
			celular: {
				validators: {
					regexp: {
						regexp: /^[0-9()-\s]+$/,
						message: 'somente dígitos'
					},
					stringLength: {
						min: 14,
						max: 15,
						message: 'Celular inválido (DDD + Nº)'
					}
				}
			}
		}
	})
	//fim validacao
	//mascaras
	$("#ritex").mask("999-9999");
	
	$("#fixo").mask("(99) 9999-9999");
	
	$('#celular').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	}).trigger('mouseout');
	//fim mascaras	
	
	// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
	$('#ritex').on('mouseout', function(e) {
	   $('#form_usuario_cadastrar').bootstrapValidator('revalidateField', 'ritex');
	});	
	
	// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
	$('#fixo').on('mouseout', function(e) {
	   $('#form_usuario_cadastrar').bootstrapValidator('revalidateField', 'fixo');
	});
	
	// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
	$('#celular').on('mouseout', function(e) {
	   $('#form_usuario_cadastrar').bootstrapValidator('revalidateField', 'celular');
	});	
});
