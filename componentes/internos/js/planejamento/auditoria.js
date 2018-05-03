/********************* Inicio DataTable ****************************/    
var table = $('#example').DataTable({
	"language": {
		"lengthMenu": "Exibindo _MENU_ registros por página",
		"zeroRecords": "Nenhum registro encontrado",
		"info": "Exibindo página _PAGE_ / _PAGES_",
		"infoEmpty": "Nenhum registro disponível",
		"infoFiltered": "(procurado nos _MAX_ registros disponíveis)",
		"clipText": 'Copiado para área de trnasferência'
	},
	"order":[],
	"ajax":{
		url:"controllers/planejamento/auditoria/listar_auditoria.php",
		dataSrc: ''
	},
	columns: [
		{ data: 'ano' },
		{ data: 'unidades' },
		{ data: 'natureza' },
		{ data: 'tipo' },
		{ data: 'periodo' },
		{ data: 'equipe' },
		{ data: 'nup'},
		{ data: 'acao'}
	],
	"columnDefs":[
		{
		"targets":[4,5,7],
		"orderable":false
		}
	],
	"drawCallback": function( settings ) {
		$('[data-tooltip="tooltip"]').tooltip();
	}
});
	
//permite selecionar a linha ficando azul
$('#example tbody').on( 'click', 'tr', function () {
	$(this).toggleClass('selected');
} );

/*************************** botoes de filtro *********************************/
$("#Btnfiltro1").hide();

$("#Btnfiltro").click(function(){

	$("#Btnfiltro1").show();
	$("#Btnfiltro").hide();

	//desenha as caixas de texto
	$('#example thead th').each( function () {
		var title = $('#example tfoot th').eq( $(this).index() ).text();
		$(this).html( '<input class="form-control"  style="width:100%" type="text" placeholder="'+title+'" />' );
	} );

	// Aplica a busca
	table.columns().eq( 0 ).each( function ( colIdx ) {
		$( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
		    table
			.column( colIdx )
			.search (this.value.replace(/,/g, "|"), true, false)
			.draw();
		} );
		//impede a ordenacao ao clicar na caixa texto
		$('input', table.column(colIdx).header()).on('click', function(e) {
			e.stopPropagation();
	    	});
	} );
});

$("#Btnfiltro1").click(function(){
	table
	 .search( '' )
	 .columns().search( '' )
	 .draw();

	$("#Btnfiltro").show();
	$("#Btnfiltro1").hide();
	$('#example').find('input').hide();	
	$('#example thead th').each( function () {
		var title = $('#example tfoot th').eq( $(this).index() ).text();
		$(this).html( '<th>'+title+'</th>' );
	} );
	
});
/***************************fim dos botoes de filtro **************/
/*************************** fim dataTable ************************/


//validacao dos forms de cadastro/atualização de auditoria
//os campos obrigatorios que nao aparecem aqui estao usando o required diretamente no form
$('form[name=form_auditoria]').bootstrapValidator({
	feedbackIcons: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		natureza: {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				}
			}
		},
		tipo_evento: {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				}
			}
		},
		'unidade[]': {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				}
			}
		},
		'auditor[]': {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				}
			}
		},
		ch_equipe: {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				}
			}
		},
		nup: {
			validators: {
				notEmpty: {
					message:'Preenchimento obrigatório'
				},
				regexp: {
					regexp: /^[0-9\.\-\/]+$/,
					message: 'somente dígitos'
				},
				stringLength: {
					min: 20,
					message: 'NUP inválido'
				}
			}
		}
	}
	
})
.on('success.form.bv', function(e) {//inclusão e edição da auditoria
	e.preventDefault();
	
	var $form = $(e.target);
	var bv = $form.data('bootstrapValidator');
	var dados = $form.serialize();

	$("#div_alerta").empty();
    
	$.ajax({
		type: "POST",
		url: "controllers/planejamento/auditoria/auditoria_acao.php",
		data: dados,
		success:function(html){
			table.ajax.reload();//atualiza a dataTable
			$('#div_alerta').html(html);
		}	
	});
    
	$('#modalCadastrarAuditoria').modal('hide');
	$('#modalAlterarAuditoria').modal('hide');
});

$("#nup").mask("99999.999999/9999-99");

// revalidando apos sair do input - necessario, pois usa outro plugin jquery (maskedinput)
$('input[name=nup]').on('mouseout', function(e) {
   $('form[name=form_auditoria]').bootstrapValidator('revalidateField', 'nup');
});

$('.daterange').daterangepicker({
	"autoUpdateInput": true,
	"autoApply": true,
	"opens": "right",
	"locale": {
		"format": "DD/MM/YYYY",
		"separator": " a ",
		"applyLabel": "Ok",
		"cancelLabel": "Cancelar",
		"fromLabel": "De",
		"toLabel": "Para",
		"customRangeLabel": "Custom",
		"daysOfWeek": [
		    "Dom",
		    "Seg",
		    "Ter",
		    "Qua",
		    "Qui",
		    "Sex",
		    "Sab"
		    
		],
		"monthNames": [
		    "Janeiro",
		    "Fevereiro",
		    "Março",
		    "Abril",
		    "Maio",
		    "Junho",
		    "Julho",
		    "Agosto",
		    "Setembro",
		    "Outubro",
		    "Novembro",
		    "Dezembro"
		],
		"firstDay": 1
	}
});

// revalidando apos sair do input - necessario, pois usa outro plugin jquery (daterangepicker)
$('input[name=periodo]').on('focusout', function(e) {
   $('form[name=form_auditoria]').bootstrapValidator('revalidateField', 'periodo');
});

//envia os valores dos campos  para o modal editar perfil
$('#modalAlterarAuditoria').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id_auditoria = button.data('id_auditoria'); // Extract info from data-* attributes no script user_habilitacao.php
	var periodo = button.data('periodo');
	var ano = button.data('ano');
	var nup = button.data('nup');
	var unidades = button.data('unidades');
	var arr_unidades = unidades.split(',');
	var equipe = button.data('equipe');
	var arr_equipe = equipe.split(',');
	var natureza = button.data('natureza');
	var tipo = button.data('tipo');
	var user_cad = button.data('user_cad');
	var data_cad = button.data('dt_cad');
	var user_alt = button.data('user_alt');
	var data_alt = button.data('dt_alt');
	var modal = $(this);
	ch_equipe = button.data('ch_equipe');//nao usei o var para deixa-la como global e usar na função dos select

	modal.find('#id_auditoria').val(id_auditoria);
	modal.find('#periodo').val(periodo);
	modal.find('#ano').selectpicker('val', ano);
	modal.find('#natureza').selectpicker('val', natureza);
	modal.find('#nup').val(nup);
	modal.find('#auditor').val(arr_equipe).trigger('change');
	modal.find('#auditor').selectpicker('refresh');
	modal.find('#unidade').val(arr_unidades).trigger('change');
	modal.find('#unidade').selectpicker('refresh');
	modal.find('#ch_equipe1').val(ch_equipe);
	modal.find('#tipo_evento').selectpicker('val', tipo);
	modal.find('#user_cad').val(user_cad);
	modal.find('#data_cad').val(data_cad);
	modal.find('#user_alt').val(user_alt);
	modal.find('#data_alt').val(data_alt);
	
	modal.find("#nup").mask("99999.999999/9999-99");
	
	modal.find('#periodo_atual').val(periodo);
	modal.find('#ano_atual').val(ano);
	modal.find('#natureza_atual').val(natureza);
	modal.find('#nup_atual').val(nup);
	modal.find('#auditor_atual').val(equipe);
	modal.find('#unidade_atual').val(unidades);
	modal.find('#ch_equipe_atual').val(ch_equipe);
	modal.find('#tipo_evento_atual').val(tipo);
});

//atualizar lista de auditores no select do chefe de equipe (fom_cadastrar e form_alterar)
$("select[id=auditor]").change(function(){
	$.post("controllers/planejamento/auditoria/listar_equipe.php", 
	{auditor:$(this).val()},
	function(valor){
		$("select[name=ch_equipe]").html(valor);//atualiza os select no cadastrar e alterar
		$('#ch_equipe1 option[value="'+ ch_equipe +'"]').attr("selected", true);//apenas o select no alterar
		$('form[name=form_auditoria]').bootstrapValidator('revalidateField', 'ch_equipe');
	})
});
	
// revalidando apos sair do input - necessario, pois usa outro plugin jquery (daterangepicker)
$('input[name=periodo]').on('focusout', function(e) {
   $('form[name=form_auditoria]').bootstrapValidator('revalidateField', 'periodo');
});


/********************* inicio exclusao ****************************/
$( document ).ajaxStop(function() {
    $(document).find('[data-toggle="confirmation"]').confirmation();
});

function excluirAuditoria(){
	$("#div_alerta").empty();
	var id = $(this)[0].getAttribute('data-id');
	$.ajax({
		type: 'POST',
		url: 'controllers/planejamento/auditoria/auditoria_acao.php',
		data: 'id_auditoria=' + id + '&flag=excluir',
		success:function(html){
			table.ajax.reload();//atualiza a dataTable
			$('#div_alerta').html(html);
		}	
	});
};

/*************************** fim exclusao ****************************************/


