//Só libera os botoes do form permissao_administra ao selecionar a permissao
$(function(){
	$('#btnAdminPermissao').attr('disabled', 'disabled');
	
	$('#permissao',$('#form_admin_permissao')).change(function(){//pega apenas o valor do campo 'permissao' do form 'form_permissao_administra' 
		if($('#permissao',$('#form_admin_permissao')).val() != ""){
		   $('#btnAdminPermissao').removeAttr('disabled');
		}
		else{
			$('#btnAdminPermissao').attr('disabled', 'disabled');
		}
	});
	
	$('#perfil',$('#form_admin_permissao')).change(function(){//pega apenas o valor do campo 'permissao' do form 'form_permissao_administra' 
		if($('#perfil',$('#form_admin_permissao')).val() != ""){
		   $('#btnAdminPermissao').removeAttr('disabled');
		}
		else{
			$('#btnAdminPermissao').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal AdminPerfil
$('#modalAdminPermissao').on('show.bs.modal', function (event) {
	var array_permissao = $('#permissao',$('#form_admin_permissao')).val().split('|');
	var id_permissao = array_permissao[0];
	var permissao = array_permissao[1];
	var modal = $(this);

	modal.find('.modal-title').text('Perfis que podem ' + permissao)
	modal.find('#id_permissao').val(id_permissao);
	
	$.post('controllers/admin/permissao/listar_permissoes_administra.inc.php',{id_permissao:id_permissao},function (res) {
	   	$('#listar_perfis1').html(res);//insere a lista de perfis no modal
	   	
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


