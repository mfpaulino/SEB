//envia os valores dos campos  para o modal editar perfil
$('#modalEditar').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var cpf = button.data('cpf') // Extract info from data-* attributes no script view_usuario_status.inc.php
	var rg = button.data('rg')
	var nome_guerra = button.data('nome_guerra')
	var nome = button.data('nome')
	var id_posto = button.data('id_posto')
	var posto = button.data('posto')
	var email = button.data('email')
	var ritex = button.data('ritex')
	var celular = button.data('celular')
	var unidade = button.data('unidade')
	var id_perfil = button.data('id_perfil')
	var perfil = button.data('perfil')
	var modal = $(this)

	modal.find('.modal-title').text('Editar Perfil')
	modal.find('#cpf').val(cpf)
	modal.find('#rg').val(rg)
	modal.find('#email').val(email)
	modal.find('#ritex').val(ritex)
	modal.find('#celular').val(celular)
	modal.find('#posto').val(id_posto)
	modal.find('#nome_guerra').val(nome_guerra)
	modal.find('#nome').val(nome)
	modal.find('#perfil').val(perfil)
})

