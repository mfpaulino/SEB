<div class="modal fade modal-wide" data-backdrop="static" id="modalUserPerfil" tabindex="-1" role="dialog" aria-labelledby="modalUserPerfilLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="modalUserPerfilLabel"></h4>
			</div>
			<div class="modal-body">
				<form name="form_user_alterar" id="form_user_alterar" method="POST" action="controllers/admin/user/user_alterar.php" enctype="multipart/form-data">
					<div class="col-sm-3">
						<div class="kv-avatar center-block text-center">
							<img id="avatar" src="" style="width:160px">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="usuario">Usuário</label>
									<input name="usuario" id="usuario" type="text" class="form-control" disabled />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome">Nome completo</label>
									<input name="nome" id="nome" type="text" class="form-control" disabled />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="cpf">CPF</label>
									<input id="cpf" name="cpf" class="form-control" type="text"  disabled>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="rg">RG</label>
									<input id="rg" name="rg" placeholder="Nr da identidade" class="form-control" type="text" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="unidade">Unidade</label>
									<input name="unidade" id="unidade" type="text" class="form-control" disabled />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input name="email" id="email" type="text" class="form-control"  disabled />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ritex">RITEx</label>
									<input name="ritex" id="ritex" type="text" class="form-control" disabled />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input name="celular" id="celular" type="text" class="form-control" disabled />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label for="perfil">Perfil*</label>
								<div id="div_perfil" class="form-group">
									<!-- select vem do componentes/internos/js/admin/modal_adm_perfil.js"> -->
								</div>
							</div>
						</div>
						<input type="hidden" name="flag" value="alterar" />
						<input type="hidden" name="perfil_atual"   id="perfil_atual" />
						<input type="hidden" name="id_usuario"   id="id_usuario" />
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Enviar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>