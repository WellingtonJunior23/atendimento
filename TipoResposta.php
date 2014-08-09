<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Novo Departamento"  >','cadastrar/TipoResposta');
Texto::criarTitulo("Tipo de Resposta");
echo "</div>";

$busca = new Busca();
$busca->validarPost($_POST);

?>
<form action="" method="post">
<fieldset>
	<legend>Relatório</legend>
<table border="0">
 
	<tr>	
		<td>Tipo de Atendimento:	
		<?php 
		$tbtipoatendimento = new TbTipoAtendimento();
		FormComponente::$name = 'Todos';
		FormComponente::selectOption('at_codigo',$tbtipoatendimento->listarCadastroAtendimento(),true,$_SESSION['cadastrar/TipoResposta']);
		?>
	
		</td>
		<td>
			<input type="submit" value="Pesquisar" />
		</td>
	</tr>
</table>
</fieldset>
</form>

<?php

Arquivo::includeForm();



$datagrid = new DataGrid(array('Tipo de Atendimento','Titulo','Texto Padrão','Status'),$busca->listarTipoResposta());
$datagrid->colunaoculta = 1;

$datagrid->acao = 'alterar/TipoResposta';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>