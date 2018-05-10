<div class="box box-solid bg-blue collapsed-box">
	<div class="box-header">
		<i class="fa fa-search"></i>
		<h3 class="box-title">Auditorias</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-blue-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<?php
					if (in_array("plan_aud_cad", $lista_permissoes)){
						echo '<li><a href="#" data-toggle="modal" data-target="#modalCadastrarAuditoria">Cadastrar Auditoria</a></li>';
					}
					?>
					<li><a href="#" data-toggle="modal" data-target="#modalExibirAuditoria">Listar/Imprimir</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-blue-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-blue-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="col-sm-12">
			<div class="text-right">
			<button id="Btnfiltro" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-filter"></span> Aplicar Filtros</button>
			<button id="Btnfiltro1" class="btn btn-default btn-xs"><span class="fa fa-close"></span> Limpar Filtros</button></div>
			<br />
			<button onclick="abrirModal('1');">ok</button>
			<table id="table_auditoria" class="table table-striped table-hover" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>Ano</th>
						<th>Unid C I</th>
						<th>Unidade(s)</th>
						<th>Natureza</th>
						<th>Tipo</th>
						<th>Período</th>
						<th>Equipe</th>
						<th>NUP</th>
						<th class="text-center text-bold" width="5%">Ação</td>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th width="6%">Ano</th>
						<th>Unid C I</th>
						<th>Unidade(s)</th>
						<th width="10%">Natureza</th>
						<th>Tipo</th>
						<th width="8%">Período</th>
						<th>Equipe</th>
						<th width="12%">NUP</th>
						<th class="text-center" width="5%">Ação</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>