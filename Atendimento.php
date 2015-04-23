<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/addchamado.png" title="Novo Atendimento"  >','cadastrar/Atendimento');
Texto::criarTitulo("Atendimento");
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
			?> Atendente:<?php 
			$tbusuario = new TbUsuario();
			FormComponente::$name = 'TODOS';
			$usu_codigo['usu_codigo'] = $busca->getDados('usu_codigo');
			FormComponente::selectOption('usu_codigo', $tbusuario->listarUsuario(),true,$usu_codigo);
			?> 
		</td>
				
	</tr>
	<tr>
		<td>Direcionado Para:<?php 
			$tbdirecionado = new TbTipoDirecionamento();
			FormComponente::$name = 'TODOS';
			FormComponente::selectOption('td_codigo', $tbdirecionado->listarCadastroAtendimento(),true,$busca->getDados('td_codigo'));
			?>	
			Data de Retorno - Período
				<input type="text" name="data1" class="data" id="data-id" size="10" value="<?php echo($busca->getDados('data1')); ?>">
		
			à
				<input type="text" name="data2" class="data" id="data" size="10" value="<?php echo($busca->getDados('data2'));?>">

		</td>
		<td>
				<input type='submit' value='Pesquisar' />
		</td>

	</tr>
	<tr>
		<td>	
			
	
				Paciente:
				<input type="text" name="at_paciente" size="40" value="<?php echo($busca->getDados('at_paciente')); ?>">
				Tipo de Processo:
	<?php 
		$tbtipoprocesso = new TbTipoProcesso();
		FormComponente::$name = 'TODOS';
		$ttp_codigo['ttp_codigo'] = $busca->getDados('ttp_codigo');
		FormComponente::selectOption('ttp_codigo',$tbtipoprocesso->listarTipoProcessoAtivo(),true,$ttp_codigo);
		?>
		Atendimento Interno: 
		 	<input type="checkbox" id="at_localidade" name="at_localidade" <?php $var = ($busca->getDados('at_localidade') == '') ? '' : 'checked="checked"'; echo $var; ?> > 
		
		<td>
				<input type="button" id="limparFiltros" name="limpar" value='Limpar Filtros' />
				
		</td>		
		

	</tr>
	
	<tr>
		<td nowrap="nowrap">	
			
	
				Processo:
				<input type="text" name="at_processo" size="40" value="<?php echo($busca->getDados('at_processo')); ?>">
				Produto:
				<input type="text" name="at_medicamento" size="65" value="<?php echo($busca->getDados('at_medicamento')); ?>">
						
		</td>
			<td><span id="informacao" style="display: none; color: red;">Concluído</span></td>
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

$dados = $busca->listarAtendimento();


$datagrid = new DataGrid($cabecalho,$dados);

	$botao = ('<a href="./GerarExcel.php"><img src="./css/images/excel.png" title="Exportar Excel"></a>');

$datagrid->titulofield = $botao.' Atendimento(s)';
$datagrid->acao = 'alterar/Atendimento';
$datagrid->nomelink = '<img src="/atendimento/css/images/search.png" />';	

$datagrid->islink2 = true;
$datagrid->link2 = 'GerarRelatorioAtendimentoPdf.php';
$datagrid->acao2 = 'gerarPDF';
$datagrid->nomelink2 = '<img src="/atendimento/css/images/pdf.png" />';

$datagrid->mostrarDatagrid(1);

}catch (Exception $e)
{
	echo $e->getMessage() . " ". $e->getCode();
}

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>