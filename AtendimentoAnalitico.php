<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);

echo"<div class='sub_menu_principal'>";
Texto::criarTitulo("Atendimento Analítico");
echo "</div>";


?>
<form action="" method="post">
<fieldset>
	<legend>Pesquisar Atendimento</legend>
<table border="0">
 
	<tr>	
		<td nowrap="nowrap">
			Status:
			<?php 
			$tbstatusatendimento = new TbStatusAtendimento();
			FormComponente::$name = 'TODOS';
		    FormComponente::selectOption('sat_codigo',$tbstatusatendimento->listarCadastroAtendimento(),true,$busca->getDados('sat_codigo'));
			?> Tipo de Atendimento:<?php 
			$tbtipoatendimento = new TbTipoAtendimento();
			FormComponente::$name = 'TODOS';
			FormComponente::selectOption('ta_codigo_busca', $tbtipoatendimento->listarCadastroAtendimento(),true,$busca->getDados('ta_codigo_busca'));
			?>
		</td>
				
	</tr>
	
	<tr>
		<td>	
			Data de Cadastro - Período
				<input type="text" name="data1" class="data" id="data-id" size="10" value="<?php echo($busca->getDados('data1')); ?>">
		
			à
				<input type="text" name="data2" class="data" id="data" size="10" value="<?php echo($busca->getDados('data2'));?>">

		</td>
		<td>
				<input type='submit' value='Pesquisar' />
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
	
$cabecalho = array('Protocolo','Data do Atendimento','Data de Retorno','Status','Tipo Atendimento','Paciente','Atendente');

$dados = $busca->listarAtendimentoAnalitico();


$datagrid = new DataGrid($cabecalho,$dados);

	$botao = ('<a href="GerarExcelAtendimentoAnalitico.php"><img src="./css/images/excel.png" title="Exportar Excel"></a>');

$datagrid->titulofield = $botao.' Atendimento(s)';
$datagrid->acao = 'alterar/Atendimento';
$datagrid->nomelink = '<img src="/atendimento/css/images/search.png" />';	

$datagrid->islink2 = true;
$datagrid->link2 = 'GerarRelatorioAtendimentoPdf.php';
$datagrid->acao2 = 'gerarPDF';
$datagrid->nomelink2 = '<img src="/atendimento/css/images/pdf.png" />';

$datagrid->mostrarDatagrid();

}catch (Exception $e)
{
	echo $e->getMessage() . " ". $e->getCode();
}

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>