<head>
<link rel="stylesheet" href="componentes/externos/bootstrap/dist/css/bootstrap.min-.css">
<style type="text/css">
	body{
    font-family: 'Open Sans', 'Helvetica Neue', 'Arial', sans-serif;
    font-size: 13px;
}

form span{
    display: block;
    margin: 10px;
}

label{
    display: inline-block;
    width: 100px;
}

input[type="text"]{
    border: 1px soild #ccc;
    width: 200px;
    padding: 5px;
}

input[type="submit"]{
     padding: 5px 15px;
}

span#result{
    padding: 5px;
    background: #ff9;
}

img#loadingimg{
    display: none;
}
</style>
<script src="componentes/externos/jquery/dist/jquery.min.js"></script>
</head>
<form method="post" action="/echo/html/" ajax="true">
	 <span id="result"></span>
    <span>
        <label>Message: </label>
        <input type="text" name="html" placeholder="Howdy..." />
    </span>

    <span>
        <label><img id="loadingimg" src="componentes/internos/img/logo.gif-"/>   </label>
        <input type="submit" value="Submit" />
    </span>

</form>



<script>
	$(document).ready(function(e) {

		$("form[ajax=true]").submit(function(e) {

			e.preventDefault();

			var form_data = $(this).serialize();
			var form_url = $(this).attr("action");
			var form_method = $(this).attr("method").toUpperCase();

			$("#loadingimg").show();

			$.ajax({
				url: form_url,
				type: form_method,
				data: form_data,
				cache: false,
				success: function(returnhtml){
					$("#result").html(returnhtml);
					$("#loadingimg").hide();
				}
			});

		});

	});
</script>