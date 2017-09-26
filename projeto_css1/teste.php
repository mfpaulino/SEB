<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Checkbox</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="checkbox.js"> </script>
  </head>
  <body>
  <h1>Checkbox</h1>
  <form name="form1">
  <table style="width:70%; border:1px solid #000000;">
	<tr bgcolor="#ededed">
		<td><input type='checkbox' name='tudo' onclick='verificaStatus(this)' /></td>
		<td>Código</td>
		<td>Nome</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="ckb[]" value="1" /></td>
		<td>1</td>
		<td>Rafael</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="ckb[]" value="2" /></td>
		<td>2</td>
		<td>João</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="ckb[]" value="3" /></td>
		<td>3</td>
		<td>Pedro</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="ckb[]" value="4" /></td>
		<td>4</td>
		<td>Maria</td>
	</tr>
	<tr bgcolor="#ededed">
		<td><input type='checkbox' name='tudo' onclick='verificaStatus(this)' /></td>
		<td>Código</td>
		<td>Nome</td>
	</tr>
  </table>
  </form>
  </body>
  </html>
  <script>
		function verificaStatus(nome){
			if(nome.form.tudo.checked == 0)
				{
					nome.form.tudo.checked = 1;
					marcarTodos(nome);
				}
			else
				{
					nome.form.tudo.checked = 0;
					desmarcarTodos(nome);
				}
		}

		function marcarTodos(nome){
		   for (i=0;i<nome.form.elements.length;i++)
			  if(nome.form.elements[i].type == "checkbox")
				 nome.form.elements[i].checked=1
		}

		function desmarcarTodos(nome){
		   for (i=0;i<nome.form.elements.length;i++)
			  if(nome.form.elements[i].type == "checkbox")
				 nome.form.elements[i].checked=0
		}
	</script>