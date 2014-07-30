<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Novo Departamento"  >','cadastrar/TipoDirecionamento');
Texto::criarTitulo("Direcionamento");
echo "</div>";

?>

<?php

Arquivo::includeForm();

$tbDirecionar = new TbTipoDirecionamento();

$datagrid = new DataGrid(array('Direcionamentos','Status'),$tbDirecionar->listarDirecionamento());
$datagrid->colunaoculta = 1;

$datagrid->nomelink = "<img src='./css/images/editar.gif' title='Alterar Departamento'/> ";
$datagrid->acao = 'alterar/TipoDirecionamento';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>