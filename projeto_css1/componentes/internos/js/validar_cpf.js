	var cpf = document.getElementById("cpf");
	function TestaCPF() {
		var valor_cpf = cpf.value;
		var Soma;
		var Resto;
		var $erro;
		Soma = 0;
		if (valor_cpf == "11111111111" || valor_cpf == "22222222222" || valor_cpf == "33333333333" || valor_cpf == "44444444444" || valor_cpf == "55555555555" || valor_cpf == "66666666666" || valor_cpf == "77777777777" || valor_cpf == "88888888888" || valor_cpf == "99999999999"){
			$erro = 'sim';
		}

		for (i=1; i<=9; i++) {
			Soma = Soma + parseInt(valor_cpf.substring(i-1, i)) * (11 - i);
		}

		Resto = (Soma * 10) % 11;

		if ((Resto == 10) || (Resto == 11))  {
			Resto = 0;
		}

		if (Resto != parseInt(valor_cpf.substring(9, 10))) {
			$erro = 'sim';
		}

		Soma = 0;

		for (i = 1; i <= 10; i++) {
			Soma = Soma + parseInt(valor_cpf.substring(i-1, i)) * (12 - i);
		}

		Resto = (Soma * 10) % 11;

		if ((Resto == 10) || (Resto == 11))  {
			Resto = 0;
		}

		if (Resto != parseInt(valor_cpf.substring(10, 11) )) {
			$erro = 'sim';
		}
		if ($erro == 'sim'){
			cpf.setCustomValidity("CPF inválido!");
		}
		else {cpf.setCustomValidity("");
		}
	}
	cpf.onkeyup  = TestaCPF;
//o id do campo deve ser:cpf
//colocar no botao: onClick="return TestaCPF();"
