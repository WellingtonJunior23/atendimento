<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php'); 




echo  date('is');

	$dados['AcaoSubmit'] = 1620;			

	$Segundos = 10;

	$tempo = $dados['AcaoSubmit'];
		
		#Acrescenta o tempo mais 
	$tempo = $tempo + $Segundos;
		
		#Tempo de enviado
	$tempoEnviado = date('is');
		
		if($tempo > $tempoEnviado)
		{
			echo "Tempo: ".$tempo;
		
		}

// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.

?>,

