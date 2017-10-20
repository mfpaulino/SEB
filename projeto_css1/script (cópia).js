$(document).on('click', "#btnEnviarDados", function () {

  // pegando os dados
  var vNome = $("#nome").val();
  var vEmail = $("#email").val();

  // criando as variáveis
  var vUrl = "teste2.php";
  var vData = { nome:vNome, email:vEmail };

  $.post(
   vUrl, //Required URL of the page on server
   vData,
   function(response,status)
   {
     // tratando o status de retorno. Sucesso significa que o envio e retorno foi executado com sucesso.
     if(status == "success")
     {
        // pegando os dados jSON
        var obj = jQuery.parseJSON(response);

       $("#result").html(
         "Nome enviado: " + obj.nome + "<br>" +
         "E-mail enviado: " + obj.email
       );
     }
   }
  );
});