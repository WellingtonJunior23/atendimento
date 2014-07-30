<?php
include_once($_SERVER['DOCUMENT_ROOT']."/atendimento/componentes/config.php");

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

Texto::mostrarMensagem(Texto::erro($_SESSION['sempermissao']));

$busca = new Busca();
$busca->validarPost($_POST);

echo"<div class='sub_menu_principal'>";
Texto::criarTitulo("Relatório: Atendimento por Status");
echo "</div>";

?>
<form action="" method="post">
<fieldset>
	<legend>Relatório</legend>
<table border="0">
 
	<tr>	
		<td>	
				Data do Atendimento - Período
				<input type="text" name="dataUm" class="data" id="data-id" size="10" value="<?php echo($busca->getDados('dataUm')); ?>">
		
			à
				<input type="text" name="dataDois" class="data" id="data" size="10" value="<?php echo($busca->getDados('dataDois'));?>">
	
		</td>
		<td>
			<input type="submit" value="Pesquisar" />
		</td>
	</tr>
</table>
</fieldset>
</form>

<?php

#Carrega dinamicamente os formularios	
Arquivo::includeForm();


try
{
	
$cabecalho = array('Quantidade','Status');

$dados = $busca->getRelatorioStatusAtendimento();

$datagrid = new DataGrid($cabecalho,$dados);

$datagrid->titulofield = 'Status';

$datagrid->islink = false;

$datagrid->mostrarDatagrid();

}catch (Exception $e)
{
	echo $e->getMessage() . " ". $e->getCode();
}


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/menurelatorio.php");
include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/rodape.php");

?>