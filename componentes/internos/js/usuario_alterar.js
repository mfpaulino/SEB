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
						message: 'E-mail inválido'
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
	   $('#form_usuario_alterar').bootstrapValidator('revalidateField', 'ritex');
	});	
	
	// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
	$('#fixo').on('mouseout', function(e) {
	   $('#form_usuario_alterar').bootstrapValidator('revalidateField', 'fixo');
	});
	
	// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
	$('#celular').on('mouseout', function(e) {
	   $('#form_usuario_alterar').bootstrapValidator('revalidateField', 'celular');
	});	
});
