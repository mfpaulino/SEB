$(document).ready(function() {
	//validacao do form de cadastro de habilitacao
	//os campos obrigatorios que nao aparecem aqui estao usando o required diretamente no form
	
	dataAtual = new Date();
	fim = dataAtual.getFullYear();
	inicio = (fim - 20);
	
	$('#form_habilitacao_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			area: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			ano_conclusao: {
				validators: {
					integer: {
						message: 'Inválido'
					},
					between: {
						min: inicio,
						max: fim,
						message: 'Apenas os realizados nos últimos 20 anos'
					    }
				}
			}
		}
	})
	//oculta os campos carga_horaria e ano_conclusao se o tipo for 'Experiência'
	$('select[name="tipo"]').on('change', function() {
        var bootstrapValidator = $('#form_habilitacao_cadastrar').data('bootstrapValidator'),
            tipo     = $(this).val();
            
        if (tipo != "Experiência"){

		// mostra e habilita o campos carga_horaria
		$('#div_carga_horaria').find('.form-control').attr('disabled', false);
		$('#div_carga_horaria').find('.form-control').removeClass('hide');
		$('#div_carga_horaria').find('.form-control').removeClass('has-error');
		$('#div_carga_horaria').find('.form-control').show();
		$("#label_carga_horaria").removeClass('hide');
		$("#label_carga_horaria").show();		
		
		// mostra e habilita o campo ano_conclusao
		$('#div_ano_conclusao').find('.form-control').attr('disabled', false);
		$('#div_ano_conclusao').find('.form-control').removeClass('hide');
		$('#div_ano_conclusao').find('.form-control').removeClass('has-error');
		$('#div_ano_conclusao').find('.form-control').show();
		$("#label_ano_conclusao").removeClass('hide');
		$("#label_ano_conclusao").show();
		
		bootstrapValidator.enableFieldValidators('carga_horaria', true);
		bootstrapValidator.enableFieldValidators('ano_conclusao', true);
		
		$('#form_habilitacao_cadastrar').formValidation('validateField', 'carga_horaria');
		$('#form_habilitacao_cadastrar').formValidation('validateField', 'ano_conclusao');

	}
	else{
		// desabilita e esconde o div carga_horaria e o label
		$('#div_carga_horaria').find('.form-control').attr('disabled', true);
		$('#div_carga_horaria').find('.form-control').hide();
		$('#div_carga_horaria').find('.form-control').toggleClass('hide');
		$("#label_carga_horaria").toggleClass('hide');
		$("#label_carga_horaria").hide();

		// esconde a mensagem e o icone de erro
		$( "#div_carga_horaria small").attr('data-bv-result', 'VALID');
		$( "#div_carga_horaria small").attr('style', 'display: none;');
		$( "#div_carga_horaria i").attr('class', 'form-control-feedback');
		
		// desabilita e esconde o div ano_conclusao e o label
		$('#div_ano_conclusao').find('.form-control').attr('disabled', true);
		$('#div_ano_conclusao').find('.form-control').hide();
		$('#div_ano_conclusao').find('.form-control').toggleClass('hide');
		$("#label_ano_conclusao").toggleClass('hide');
		$("#label_ano_conclusao").hide();
		
		// esconde a mensagem e o icone de erro
		$( "#div_ano_conclusao small").attr('data-bv-result', 'VALID');
		$( "#div_ano_conclusao small").attr('style', 'display: none;');
		$( "#div_ano_conclusao i").attr('class', 'form-control-feedback');
		

		bootstrapValidator.enableFieldValidators('carga_horaria', false );

		bootstrapValidator.enableFieldValidators('ano_conclusao', false );
	}

    });

});
