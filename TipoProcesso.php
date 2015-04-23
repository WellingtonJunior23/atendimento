<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Novo Tipo de Processo"  >','cadastrar/TipoProcesso');
Texto::criarTitulo("Tipo de Processo");
echo "</div>";

$busca = new Busca();
$busca->validarPost($_POST);


Arquivo::includeForm();



$datagrid = new DataGrid(array('Tipo de Processo','Status'),$busca->listarTipoProcesso());
$datagrid->colunaoculta = 1;

$datagrid->acao = 'alterar/TipoProcesso';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>