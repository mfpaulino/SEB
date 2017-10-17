//script para receber a selecao da unidade de controle interno e atualizar o 2º select
$(document).ready(function(){
	$("select[name=unidade_ci]").change(function(){
		$("select[name=codom]").html('<option value="">Carregando...</option>');
		$.post("listas/select_unidade_usuario.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
	 })
 })
 
//exibe modal alterar unidade
$('#modalTrocarUnidade').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var unidade = button.data('unidade')
	var modal = $(this)
	modal.find('.modal-title').text('Unidade atual: ' + unidade )
	modal.find('#unidade').val(unidade)
})

//verifica os dados ao confirmar alteracao de unidade
$('[data-toggle="confirmation"]').confirmation({
	onConfirm: function() {
		$('#form_altera_unidade').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				unidade_ci: {
					validators: {
						notEmpty: {
							message:'preenchimento obrigatório'
						}
					}
				},
				codom: {
					validators: {
						notEmpty: {
							message:'preenchimento obrigatório'
						}
					}
				}
			}
		})
	}
});
