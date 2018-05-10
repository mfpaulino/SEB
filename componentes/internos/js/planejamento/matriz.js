function editAuditoria(id){


   $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'controllers/planejamento/auditoria/teste_auditoria.php',
        data: 'id='+id,
        success:function(data){
        	//alert(id);
        	jQuery("#modalCadastrarMtzPlanejamento").modal('show');
        	$('#id_nup').val(data.nup);
        	$("#id_nup").mask("99999.999999/9999-99");
        }
    });
   
}
