//envia os valores dos campos  para o modal editar perfil
$('#modalUserPerfil').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var cpf = button.data('cpf') // Extract info from data-* attributes nos scripts view_pedido_cadastro_lista.inc.php e view_user_lista.inc.php
	var id_usuario = button.data('id_usuario')
	var rg = button.data('rg')
	var nome = button.data('nome')
	var usuario = button.data('usuario')
	var email = button.data('email')
	var ritex = button.data('ritex')
	var fixo = button.data('fixo')
	var celular = button.data('celular')
	var id_perfil = button.data('id_perfil')
	var perfil = button.data('perfil')
	var user_habilita = button.data('user_habilita')
	var data_habilita = button.data('data_habilita')
	var unidade = button.data('unidade')
	var avatar = button.data('avatar')
	var modal = $(this)

	modal.find('.modal-title').text('Visualizar Perfil')
	modal.find('#id_usuario').val(id_usuario)
	modal.find('#cpf').val(cpf)
	modal.find('#rg').val(rg)
	modal.find('#email').val(email)
	modal.find('#ritex').val(ritex)
	modal.find('#fixo').val(fixo)
	modal.find('#celular').val(celular)
	modal.find('#usuario').val(usuario)
	modal.find('#nome').val(nome)
	modal.find('#perfil').val(perfil)
	modal.find('#user_habilita').val(user_habilita)
	modal.find('#data_habilita').val(data_habilita)
	modal.find('#unidade').val(unidade)
	modal.find('#avatar').attr('src',avatar)
	
	//oculta os campos user_habilita e data_habilita, caso a chama tenha sida feita pela view_pedido_cadastro_lista.inc.php
	if(user_habilita == 'nenhum'){//ainda nao foi habilitado
		modal.find('#user_habilita').hide()
		modal.find('#label_user_habilita').hide()
		modal.find('#data_habilita').hide()
		modal.find('#label_data_habilita').hide()
	}
	//exibe os campos user_habilita e data_habilita, caso a chamada tenha sida feita pela view_user_lista.inc.php
	else{//usuario já habilitado
		modal.find('#user_habilita').show()
		modal.find('#label_user_habilita').show()
		modal.find('#data_habilita').show()
		modal.find('#label_data_habilita').show()
	}
	
   	//insere o select perfil na div_perfil e atualiza de acordo com a unidade do usuário
   	$.ajax({
   		url: 'listas/admin/select_alterar_user_perfil.inc.php',
   		type: "POST",
   		data: {
   			user_sigla:unidade,
   			user_id_perfil:id_perfil,
   			user_perfil:perfil
   		},
   		success: function (res) {
	   		$('#div_perfil').html(res);
   		}
	});	
})

//Informa os valores dos campos ao modal UserListaHabilitacao
$('#modalUserListaHabilitacao').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var cpf = button.data('cpf') // Extract info from data-* attributes nos scripts view_pedido_cadastro_lista.inc.php e view_user_lista.inc.php
	var id_usuario = button.data('id_usuario')
	var usuario = button.data('usuario')
	var modal = $(this)

	modal.find('.modal-title').text('Habilitações - ' + usuario)
	modal.find('#id_usuario').val(id_usuario)
	modal.find('#cpf').val(cpf)
	modal.find('#usuario').val(usuario)
	
	$.post('controllers/admin/user/listar_user_habilitacao.inc.php',{cpf_user:cpf},function (res) {
	   	$('#user_listar_habilitacao').html(res);//insere a lista de habilitações no modal
   	})	
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

//imprimir lista user_habilitacao
document.getElementById('btnPrintUserHabilitacao').onclick = function() {
	var conteudo = document.getElementById('user_listar_habilitacao').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

