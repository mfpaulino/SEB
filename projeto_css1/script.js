$(document).ready(function(){
  $('#visualizaranexo').on('show.bs.modal', function (e) {
    var documento = $(e.relatedTarget).data('doc');
    $.ajax({
      type : 'post', 
      url : 'visualiza_anexo.php', 
      data :  'documento='+ documento, 
      success : function(data){
        $('.fetched-data').html(data);
      } 
    });
  });
});
