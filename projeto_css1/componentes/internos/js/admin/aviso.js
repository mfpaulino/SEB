$(document).ready(function() {
	$('#form_aviso_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'publico_cad[]': {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
				    
			}
		}
	})
	
   	//personalisando os checkbox
	$('input[name="publico_cad[]"].icheck').iCheck({
		checkboxClass: 'icheckbox_square-blue'
	})
       
        // revalidando apos click
        .on('ifChanged', function(e) {
                $('#form_aviso_cadastrar').bootstrapValidator('revalidateField', 'publico_cad[]');
        });
	
	//calendario form cadastrar
        $('#validade').datepicker({
		startDate: "date",//desabilita datas anteriores que a data atual
		autoclose: true, //fecha o calendário ao selecionar a data
		language: 'pt-BR'
        });
        
        $("#validade").mask("99/99/9999",{placeholder:" "}); //deveria criar uma mascara, mas está impedindo a digitação. Deixei pois impede que o usuario exclua a data
});

//envia os valores dos campos  para o modal alterar aviso
$('#modalAlterarAviso').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var id_aviso = button.data('id_aviso')
	var titulo = button.data('titulo') // Extract info from data-* attributes no script view_usuario_status.inc.php
	var texto = button.data('texto')
	var validade = button.data('validade')
	var atualizacao = button.data('atualizacao')
	var modal = $(this)
	
	modal.find('#id_aviso').val(id_aviso)
	modal.find('#titulo').val(titulo)
	modal.find('#texto').val(texto)
	modal.find('[name=validade]').val(validade)
	modal.find('#atualizacao').val(atualizacao) 
	modal.find('#id_aviso').val(id_aviso);
	
	$.post('controllers/admin/aviso/aviso_listar_publico_alt.inc.php',{id_aviso:id_aviso},function (res) {
		
	   	$('#listar_publico').html(res);//insere a lista de perfis no modal
		//validacao dos campos no modal
		
		$('#form_aviso_alterar').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				'publico_alt[]': {
					validators: {
						notEmpty: {
							message:'Preenchimento obrigatório'
						}
					}
					    
				}
			}
		})
		
		//personalisando os checkbox
		$('input[name="publico_alt[]"]').iCheck({
			checkboxClass: 'icheckbox_square-blue'
		})
	       
		// revalidando apos click no checkbox
		$('input[name="publico_alt[]"]').on('ifChanged', function(e) {
		   $('#form_aviso_alterar').bootstrapValidator('revalidateField', 'publico_alt[]');
		});
   	})
	
	//calendario do modal alterar aviso     
	$("#validade_altera").datepicker({
		startDate: "date",//desabilita datas anteriores que a data atual
		autoclose: true, //fecha o calendário ao selecionar a data
		language: 'pt-BR'
		}).on('show.bs.modal', function(event) {event.stopPropagation(); //impede que o datapicker reset os valores passados ao modal   
	});

	$("#validade_altera").mask("99/99/9999",{placeholder:" "}); //deveria criar uma mascara, mas está impedindo a digitação. Deixei pois impede que o usuario exclua a data	
});

//imprimir lista avisos
document.getElementById('btnPrintAviso').onclick = function() {
	var conteudo = document.getElementById('area_printAviso').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
