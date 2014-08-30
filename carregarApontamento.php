<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

//resolve o problema de acentos
header('Content-Type: text/html; charset=ISO-8859-1');

$tbTipoApontamento = new TbTipoApontamento();

echo($tbTipoApontamento->getDescricao($_POST['tap_codigo']));

?>