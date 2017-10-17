//jquery para o avatar
<script>
	//exibe a imagem do avatar
	var btnCust = '';
	$("#avatar-1").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: false,
		removeLabel: '',
		removeIcon: '',
		removeTitle: '',
		elErrorContainer: '',
		msgErrorClass: '',
		defaultPreviewContent: '<img src="views/avatar/<?php echo $avatar_usuario;?>" style="width:160px">',
		layoutTemplates: {main2: '{preview}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
</script>
<script>
	//chama o script que avisa ao usuario_alterar.php que o avatar será excluído
	function chamarPhpAjax() {
	   $.ajax({
		  url:'controllers/usuario/usuario_excluir_avatar.php',
		  complete: function (response) {
			 alert('Confirme no botão enviar!');
		  }
	  });
	  return false;
	}
</script>
<script>
	//editar imagem do avatar
	var btnCust = '<button type="button" class="btn btn-secondary" title="Excluir imagem" ' +
		'onclick="return chamarPhpAjax();">' +
		'<i class="fa fa-trash"> </i>' +
		'</button>';
	$("#avatar").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: true,
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="views/avatar/<?php echo $avatar_usuario;?>" alt="Sua Foto" style="width:160px"><h6 class="text-muted">clique para alterar<br />(Tam máx: 1500Kb)</h6>',
		layoutTemplates: {main2: '{preview} ' +  btnCust },
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
</script>