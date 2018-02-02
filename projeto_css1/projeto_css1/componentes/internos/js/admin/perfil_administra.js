//Só libera os botoes do form perfil_administra ao selecionar o perfil
$(function(){
	$('#btnAdminPerfil').attr('disabled', 'disabled');
	$('#perfil',$('#form_admin_perfil')).change(function(){//pega apenas o valor do campo 'perfil' do form 'form_perfil_administra' 
		if($('#perfil',$('#form_admin_perfil')).val() != ""){
		   $('#btnAdminPerfil').removeAttr('disabled');
		}
		else{
			$('#btnAdminPerfil').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal AdminPerfil
$('#modalAdminPerfil').on('show.bs.modal', function (event) {
	var array_perfil = $('#perfil',$('#form_admin_perfil')).val().split('|');
	var id_perfil = array_perfil[0];
	var perfil = array_perfil[1];
	var modal = $(this);

	modal.find('.modal-title').text('Perfis Administrados por (' + perfil + ')')
	modal.find('#id_perfil_admin').val(id_perfil);
	
	$.post('controllers/admin/perfil/listar_perfis_administra.inc.php',{id_perfil:id_perfil},function (res) {
	   	$('#listar_perfis').html(res);//insere a lista de perfis no modal
	   	
	   	//personalisando os checkbox
		$('input[type="checkbox"].icheck').iCheck({
			checkboxClass: 'icheckbox_square-blue'
		})
   	})
   		
})
/*
//imprimir lista area
document.getElementById('btnPrintAdminPerfil').onclick = function() {
	var conteudo = document.getElementById('AdminPerfil_printArea').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
*/


