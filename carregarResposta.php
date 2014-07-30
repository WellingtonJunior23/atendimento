<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

//resolve o problema de acentos
header('Content-Type: text/html; charset=ISO-8859-1');

$ta_codigo = $_POST['novo_codigo'];

$tbTipoAtendimento = new TbTipoAtendimento();

echo($tbTipoAtendimento->getTextoPadrao($ta_codigo));

?>