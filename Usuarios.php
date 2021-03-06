<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/new_usuario.png" title="Novo '.$_SESSION['config']['usuario'].'">','cadastrar/usuario');
Texto::criarTitulo($_SESSION['config']['usuario']);
echo "</div>";


Arquivo::includeForm();

$tbusuario = new TbUsuario();

$datagrid = new DataGrid(array($_SESSION['config']['usuario'],'Departamento','Tipo de Acesso','Ativo'),$tbusuario->selectUsuarios());
$datagrid->colunaoculta = 1;

$datagrid->islink2 = true;
$datagrid->nomelink2 = '<img src="./css/images/edit_password.png" title="Alterar Senha">';
$datagrid->acao2 = 'alterar/SenhaUsuario';


$datagrid->nomelink = '<img src="./css/images/editar.gif" title="Alterar Usu�rio">';
$datagrid->acao = 'alterar/usuario';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>