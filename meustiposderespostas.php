<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

//resolve o problema de acentos
header('Content-Type: text/html; charset=ISO-8859-1');

$tbTipoResposta = new TbTipoResposta();

$at_codigo = $_POST["at_codigo"];

	echo ('<option value="">Selecione</option>');
foreach ($tbTipoResposta->listarRepostaPadrao($at_codigo) as $linha):
	
	echo ('<option value='.$linha[0].'>'.$linha[1].'</option>');
	
endforeach;

?>