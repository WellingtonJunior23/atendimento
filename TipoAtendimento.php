<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Novo Departamento"  >','cadastrar/TipoAtendimento');
Texto::criarTitulo("Tipo de Atendimento");
echo "</div>";

?>

<?php

Arquivo::includeForm();

$tbTipoAtendimento = new TbTipoAtendimento();

$datagrid = new DataGrid(array('Tipo de Atendimento','Status'),$tbTipoAtendimento->listarAtendimento());
$datagrid->colunaoculta = 1;

$datagrid->acao = 'alterar/TipoAtendimento';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>