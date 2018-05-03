$(document).ready(function() {
	//validacao do form de cadastro de habilitacao
	//os campos obrigatorios que nao aparecem aqui estao usando o required diretamente no form
	
	dataAtual = new Date();
	fim = dataAtual.getFullYear();
	inicio = (fim - 39);
	
	$('form[name=form_habilitacao]').bootstrapValidator({
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
			carga_horaria: {
				validators: {
					integer: {
						message: 'Inválido - apenas dígitos'
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
						message: 'Apenas os realizados nos últimos 40 anos'
					}
				}
			}
		}
	});
	
	//oculta os campos carga_horaria e ano_conclusao se o tipo for 'Experiência'
	$('select[name="tipo"]',$('form[name=form_habilitacao]')).on('change', function() {
        	
        	var bootstrapValidator = $('form[name=form_habilitacao]').data('bootstrapValidator');
        	var tipo     = $(this).val();
            
		if (tipo == "Capacitação"){

			// mostra e habilita o campos carga_horaria
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', false);
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').removeClass('hide');
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').removeClass('has-error');
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').show();
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).removeClass('hide');
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).show();		
	
			// mostra e habilita o campo ano_conclusao
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', false);
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').removeClass('hide');
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').removeClass('has-error');
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').show();
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).removeClass('hide');
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).show();
	
			bootstrapValidator.enableFieldValidators('carga_horaria', true);
			bootstrapValidator.enableFieldValidators('ano_conclusao', true);
	
			$('#form_habilitacao_cadastrar',$('form[name=form_habilitacao]')).formValidation('validateField', 'carga_horaria');
			$('#form_habilitacao_cadastrar',$('form[name=form_habilitacao]')).formValidation('validateField', 'ano_conclusao');

		}
		else{
			// desabilita e esconde o div carga_horaria e o label
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', true);
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').hide();
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').toggleClass('hide');
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).toggleClass('hide');
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).hide();

			// esconde a mensagem e o icone de erro
			$( "#div_carga_horaria small",$('form[name=form_habilitacao]')).attr('data-bv-result', 'VALID');
			$( "#div_carga_horaria small",$('form[name=form_habilitacao]')).attr('style', 'display: none;');
			$( "#div_carga_horaria i",$('form[name=form_habilitacao]')).attr('class', 'form-control-feedback');
	
			// desabilita e esconde o div ano_conclusao e o label
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', true);
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').hide();
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').toggleClass('hide');
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).toggleClass('hide');
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).hide();
	
			// esconde a mensagem e o icone de erro
			$( "#div_ano_conclusao small",$('form[name=form_habilitacao]')).attr('data-bv-result', 'VALID');
			$( "#div_ano_conclusao small",$('form[name=form_habilitacao]')).attr('style', 'display: none;');
			$( "#div_ano_conclusao i",$('form[name=form_habilitacao]')).attr('class', 'form-control-feedback');
	

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
		modal.find('#area').selectpicker('val', id_area + '|' + area);
		modal.find('#tipo').selectpicker('val', tipo);
		modal.find('#descricao').val(descricao)
		modal.find('#carga_horaria').val(carga_horaria)
		modal.find('#ano_conclusao').val(ano_conclusao)
		
		modal.find('#id_habilitacao_atual').val(id_habilitacao)
		modal.find('#area_atual').val(id_area)
		modal.find('#tipo_atual').val(tipo)
		modal.find('#descricao_atual').val(descricao)
		modal.find('#carga_horaria_atual').val(carga_horaria)
		modal.find('#ano_conclusao_atual').val(ano_conclusao)
		
		if(tipo == "Experiência profissional"){
		
			// desabilita e esconde o div carga_horaria e o label
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', true);
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').hide();
			$('#div_carga_horaria',$('form[name=form_habilitacao]')).find('.form-control').toggleClass('hide');
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).toggleClass('hide');
			$("#label_carga_horaria",$('form[name=form_habilitacao]')).hide();

			// esconde a mensagem e o icone de erro
			$( "#div_carga_horaria small",$('form[name=form_habilitacao]')).attr('data-bv-result', 'VALID');
			$( "#div_carga_horaria small",$('form[name=form_habilitacao]')).attr('style', 'display: none;');
			$( "#div_carga_horaria i",$('form[name=form_habilitacao]')).attr('class', 'form-control-feedback');
			
			// desabilita e esconde o div ano_conclusao e o label
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').attr('disabled', true);
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').hide();
			$('#div_ano_conclusao',$('form[name=form_habilitacao]')).find('.form-control').toggleClass('hide');
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).toggleClass('hide');
			$("#label_ano_conclusao",$('form[name=form_habilitacao]')).hide();
		
			// esconde a mensagem e o icone de erro
			$( "#div_ano_conclusao small",$('form[name=form_habilitacao]')).attr('data-bv-result', 'VALID');
			$( "#div_ano_conclusao small",$('form[name=form_habilitacao]')).attr('style', 'display: none;');
			$( "#div_ano_conclusao i",$('form[name=form_habilitacao]')).attr('class', 'form-control-feedback');
		}
	});
});
