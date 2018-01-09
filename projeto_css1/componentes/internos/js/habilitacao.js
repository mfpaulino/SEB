$(document).ready(function() {
	//validacao do form de cadastro de habilitacao
	//os campos obrigatorios que nao aparecem aqui estao usando o required diretamente no form
	
	dataAtual = new Date();
	fim = dataAtual.getFullYear();
	inicio = (fim - 19);
	
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
	});
	
	//oculta os campos carga_horaria e ano_conclusao se o tipo for 'Experiência'
	$('select[name="tipo"]',$('#form_habilitacao_cadastrar')).on('change', function() {
        	
        	var bootstrapValidator = $('#form_habilitacao_cadastrar').data('bootstrapValidator');
        	var tipo     = $(this).val();
            
		if (tipo != "Experiência"){

			// mostra e habilita o campos carga_horaria
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').attr('disabled', false);
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').removeClass('hide');
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').removeClass('has-error');
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').show();
			$("#label_carga_horaria",$('#form_habilitacao_cadastrar')).removeClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_cadastrar')).show();		
	
			// mostra e habilita o campo ano_conclusao
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').attr('disabled', false);
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').removeClass('hide');
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').removeClass('has-error');
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').show();
			$("#label_ano_conclusao",$('#form_habilitacao_cadastrar')).removeClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_cadastrar')).show();
	
			bootstrapValidator.enableFieldValidators('carga_horaria', true);
			bootstrapValidator.enableFieldValidators('ano_conclusao', true);
	
			$('#form_habilitacao_cadastrar',$('#form_habilitacao_cadastrar')).formValidation('validateField', 'carga_horaria');
			$('#form_habilitacao_cadastrar',$('#form_habilitacao_cadastrar')).formValidation('validateField', 'ano_conclusao');

		}
		else{
			// desabilita e esconde o div carga_horaria e o label
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').attr('disabled', true);
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').hide();
			$('#div_carga_horaria',$('#form_habilitacao_cadastrar')).find('.form-control').toggleClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_cadastrar')).toggleClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_cadastrar')).hide();

			// esconde a mensagem e o icone de erro
			$( "#div_carga_horaria small",$('#form_habilitacao_cadastrar')).attr('data-bv-result', 'VALID');
			$( "#div_carga_horaria small",$('#form_habilitacao_cadastrar')).attr('style', 'display: none;');
			$( "#div_carga_horaria i",$('#form_habilitacao_cadastrar')).attr('class', 'form-control-feedback');
	
			// desabilita e esconde o div ano_conclusao e o label
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').attr('disabled', true);
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').hide();
			$('#div_ano_conclusao',$('#form_habilitacao_cadastrar')).find('.form-control').toggleClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_cadastrar')).toggleClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_cadastrar')).hide();
	
			// esconde a mensagem e o icone de erro
			$( "#div_ano_conclusao small",$('#form_habilitacao_cadastrar')).attr('data-bv-result', 'VALID');
			$( "#div_ano_conclusao small",$('#form_habilitacao_cadastrar')).attr('style', 'display: none;');
			$( "#div_ano_conclusao i",$('#form_habilitacao_cadastrar')).attr('class', 'form-control-feedback');
	

			bootstrapValidator.enableFieldValidators('carga_horaria', false );

			bootstrapValidator.enableFieldValidators('ano_conclusao', false );
		}
	});
     	
	//validacao do form de alteração de habilitacao
	//os campos obrigatorios que nao aparecem aqui estao usando o required diretamente no form
	
	$('#form_habilitacao_alterar').bootstrapValidator({
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
	});
	//parei aki
	//var teste = $('select[name="tipo"]',$('#form_habilitacao_alterar')).value;
	//if (teste != "Experiência"){
	
	//var bootstrapValidator = $('#form_habilitacao_alterar').data('bootstrapValidator');
	//bootstrapValidator.enableFieldValidators('ano_conclusao', false );}
	
	//oculta os campos carga_horaria e ano_conclusao se o tipo for 'Experiência' $('#area',$('#form_area'))
	$('select[name="tipo"]',$('#form_habilitacao_alterar')).on('change', function() {
        
        	var bootstrapValidator = $('#form_habilitacao_alterar').data('bootstrapValidator');
            	var tipo    = $(this).val();
            
		if (tipo != "Experiência"){

			// mostra e habilita o campos carga_horaria
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').attr('disabled', false);
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').removeClass('hide');
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').removeClass('has-error');
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').show();
			$("#label_carga_horaria",$('#form_habilitacao_alterar')).removeClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_alterar')).show();		
		
			// mostra e habilita o campo ano_conclusao
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').attr('disabled', false);
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').removeClass('hide');
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').removeClass('has-error');
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').show();
			$("#label_ano_conclusao",$('#form_habilitacao_alterar')).removeClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_alterar')).show();
		
			bootstrapValidator.enableFieldValidators('carga_horaria', true);
			bootstrapValidator.enableFieldValidators('ano_conclusao', true);
		
			$('#form_habilitacao_alterar').formValidation('validateField', 'carga_horaria');
			$('#form_habilitacao_alterar').formValidation('validateField', 'ano_conclusao');

		}
		else{
			// desabilita e esconde o div carga_horaria e o label
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').attr('disabled', true);
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').hide();
			$('#div_carga_horaria',$('#form_habilitacao_alterar')).find('.form-control').toggleClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_alterar')).toggleClass('hide');
			$("#label_carga_horaria",$('#form_habilitacao_alterar')).hide();

			// esconde a mensagem e o icone de erro
			$( "#div_carga_horaria small",$('#form_habilitacao_alterar')).attr('data-bv-result', 'VALID');
			$( "#div_carga_horaria small",$('#form_habilitacao_alterar')).attr('style', 'display: none;');
			$( "#div_carga_horaria i",$('#form_habilitacao_alterar')).attr('class', 'form-control-feedback');
		
			// desabilita e esconde o div ano_conclusao e o label
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').attr('disabled', true);
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').hide();
			$('#div_ano_conclusao',$('#form_habilitacao_alterar')).find('.form-control').toggleClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_alterar')).toggleClass('hide');
			$("#label_ano_conclusao",$('#form_habilitacao_alterar')).hide();
		
			// esconde a mensagem e o icone de erro
			$( "#div_ano_conclusao small",$('#form_habilitacao_alterar')).attr('data-bv-result', 'VALID');
			$( "#div_ano_conclusao small",$('#form_habilitacao_alterar')).attr('style', 'display: none;');
			$( "#div_ano_conclusao i",$('#form_habilitacao_alterar')).attr('class', 'form-control-feedback');
		

			bootstrapValidator.enableFieldValidators('carga_horaria', false );

			bootstrapValidator.enableFieldValidators('ano_conclusao', false );
		}
	});
	
   	//envia os valores dos campos  para o modal editar perfil
	$('#modalAlterarHabilitacao').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id_habilitacao = button.data('id_habilitacao'); // Extract info from data-* attributes no script user_habilitacao.php
		var id_area = button.data('id_area');
		var area = button.data('area');
		var tipo = button.data('tipo');
		var descricao = button.data('descricao');
		var carga_horaria = button.data('carga_horaria');
		var ano_conclusao = button.data('ano_conclusao');
		var modal = $(this);
	
		modal.find('#id_habilitacao').val(id_habilitacao)
		modal.find('#area').val(id_area + '|' + area)
		modal.find('#tipo').val(tipo)
		modal.find('#descricao').val(descricao)
		modal.find('#carga_horaria').val(carga_horaria)
		modal.find('#ano_conclusao').val(ano_conclusao)
		
		modal.find('#id_habilitacao_atual').val(id_habilitacao)
		modal.find('#area_atual').val(id_area)
		modal.find('#tipo_atual').val(tipo)
		modal.find('#descricao_atual').val(descricao)
		modal.find('#carga_horaria_atual').val(carga_horaria)
		modal.find('#ano_conclusao_atual').val(ano_conclusao)
	});
});
