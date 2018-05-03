<Script language='javascript'>

	var minutos=1;
  	var seconds=0;
	var tempo = document.getElementById('crono_tempo');
	var aviso = document.getElementById('crono_aviso');

		function Cronometro(){
		
			if (seconds<=0){
				seconds=60;
				minutos-=1;
			}
			 
			if (minutos<=-1){
				seconds=0;
				seconds+=1;
				tempo.innerHTML='';
				aviso.innerHTML='  Fim da sessão, favor efetuar novo login';
			} 
			else{
				seconds-=1;
				
				if(seconds < 10) {
					seconds = '0' + seconds;
				}
				
				tempo.innerHTML = ' ' + minutos+'min'+seconds+'s';
				setTimeout('Cronometro()',1000);
			}
		}

</Script>
