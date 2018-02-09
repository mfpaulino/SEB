
function buscar(palavra)
{
var page = "controllers/testes/buscador.inc.php";
$.ajax
        ({
            type: 'POST',
            dataType: 'html',
            url: page,
            beforeSend: function () {
                $("#dados").html("Carregando...");
            },
            data: {palavra: palavra},
            success: function (msg)
            {
                $("#dados").html(msg);
            }
        });
}


$('#buscar').click(function () {
buscar($("#palavra").val())
});
