//envia os valores dos campos  para o modal editar perfil
$('#modalUserPerfil').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var cpf = button.data('cpf') // Extract info from data-* attributes no script view_usuario_status.inc.php
	var id_usuario = button.data('id_usuario')
	var rg = button.data('rg')
	var nome = button.data('nome')
	var usuario = button.data('usuario')
	var email = button.data('email')
	var ritex = button.data('ritex')
	var celular = button.data('celular')
	var id_perfil = button.data('id_perfil')
	var perfil = button.data('perfil')
	var unidade = button.data('unidade')
	var avatar = button.data('avatar')
	var modal = $(this)

	modal.find('.modal-title').text('Visualizar Perfil')
	modal.find('#id_usuario').val(id_usuario)
	modal.find('#cpf').val(cpf)
	modal.find('#rg').val(rg)
	modal.find('#email').val(email)
	modal.find('#ritex').val(ritex)
	modal.find('#celular').val(celular)
	modal.find('#usuario').val(usuario)
	modal.find('#nome').val(nome)
	modal.find('#perfil').val(perfil)
	modal.find('#unidade').val(unidade)
	modal.find('#avatar').attr('src',avatar)
	
   	//insere o select perfil na div_perfil e atualiza de acordo com a unidade do usuário
   	$.ajax({
   		url: 'listas/admin/select_alterar_user_perfil.inc.php',
   		type: "POST",
   		data: {
   			user_sigla:unidade,
   			user_perfil:perfil
   		},
   		success: function (res) {
	   		$('#div_perfil').html(res);
   		}
	});	
})

//imprimir lista user_lista
document.getElementById('btnPrintUser').onclick = function() {
	var conteudo = document.getElementById('area_printUser').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

//imprimir user_pedido_cadastro
document.getElementById('btnPrintPedidoCadastro').onclick = function() {
	var conteudo = document.getElementById('area_printPedidoCadastro').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

