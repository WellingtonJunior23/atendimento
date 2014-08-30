<?php
session_start();

include_once 'componentes/config.php';

$busca = new Busca();

$busca->validarPost($_POST);

$arquivo = 'RelatorioAtendimentoAnalitico.xls';

$cabecalho = array('Protocolo','Data do Atendimento','Data de Retorno','Status','Tipo Atendimento','Paciente','Atendente');

$dados = $busca->listarAtendimentoAnalitico();

$datagrid = new DataGrid($cabecalho,$dados);

$datagrid->islink = false;

$datagrid->borda = 2;


header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");

header ("Cache-Control: no-cache, must-revalidate");

header ("Content-type: application/vnd.ms-msexcel");
//header ("Content-type: application/x-msexcel");

header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );

header ("Content-Description: PHP Generated Data" );

header ("Pragma: no-cache");

$datagrid->mostrarDatagrid();

exit;