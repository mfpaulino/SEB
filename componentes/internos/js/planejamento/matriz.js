function editAuditoria(id){
   $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'controllers/planejamento/auditoria/teste_auditoria.php',
        data: 'id='+id,
        success:function(data){
        	jQuery("#modalCadastrarMtzPlanejamento").modal('show');
        	
        	
        	var nup = data.nup;
        	
        	$('#id_nup').val(nup);
        	$("#id_nup").mask("99999.999999/9999-99");
        	$('#id_periodo').val(data.periodo);
        	$('#id_natureza').selectpicker('val', data.natureza);
        	$('#id_ano').selectpicker('val', data.ano);
        	$('#tipo_evento').selectpicker('val', data.tipo);
        	
        	
        	var unidades = data.unidades;
        	var arr_unidades = unidades.split(',');
        	//$('#unidade').val(arr_unidades).trigger('change');
        	$('#unidade').selectpicker('val',arr_unidades);
        	
        	
        	
        }
    });
    /*
    $('#modalCadastrarMtzPlanejamento').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var unidades = button.data('unidades');
	var arr_unidades = unidades.split(',');
	var equipe = button.data('equipe');
	var arr_equipe = equipe.split(',');
	var tipo = button.data('tipo');
	var modal = $(this);
	ch_equipe = button.data('ch_equipe');//nao usei o var para deixa-la como global e usar na função dos select
	
	modal.find('#auditor').val(arr_equipe).trigger('change');
	modal.find('#auditor').selectpicker('refresh');
	modal.find('#unidade').val(arr_unidades).trigger('change');
	modal.find('#unidade').selectpicker('refresh');
	modal.find('#ch_equipe1').val(ch_equipe);
	modal.find('#tipo_evento').selectpicker('val', tipo);	
	});
	*/
   
}


