<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

//resolve o problema de acentos
header('Content-Type: text/html; charset=ISO-8859-1');

$tir_codigo = $_POST['tir_codigo'];

$tbTipoResposta = new TbTipoResposta();

echo($tbTipoResposta->getDescricao($tir_codigo));

?>