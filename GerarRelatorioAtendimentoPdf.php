<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');
include_once 'plugin/MPDF54/mpdf.php';

if($_GET)
{

$busca = new Busca();

$busca->setValueGet($_GET,'at_codigo');
	
try
{

ob_start();


?>
<?php 
$tbAtendimento = new TbAtendimento();

$_SESSION['pdf/Atendimento'] = $busca->getRelatorioAtendimentoPDF();

?>
<fieldset>
<legend><img src="./css/images/header.png"><span class="titulo">Sistema de Atendimento</span>
				<hr/></legend>
<fieldset class="atendimento">
<legend></legend>
  <table id="esconder" border="0" cellspacing="5">
    <tr>
      <th width="119" align="left" nowrap="nowrap">Protocolo:</th>
      <td>
		<input type="text" disabled="disabled" value="<?php echo($_SESSION['pdf/Atendimento']['at_codigo']); ?>">
      </td>    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data da Ocorrência:</th>
      <td>
		<input type="text" name="at_data_cadastro" class="data" value="<?php echo(ValidarDatas::dataCliente($_SESSION['pdf/Atendimento']['at_data_cadastro'])); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data do Retorno:</th>
      <td>
		<input type="text" name="at_data_retorno" class="data" value="<?php echo(ValidarDatas::dataCliente($_SESSION['pdf/Atendimento']['at_data_retorno'])); ?>">
    </td>
    </tr>     
    <tr>
      <th width="119" align="left" nowrap="nowrap">Paciente:</th>
      <td>
		<input type="text" name="at_paciente" size="60" value="<?php echo($_SESSION['pdf/Atendimento']['at_paciente']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">CPF:</th>
      <td>
		<input type="text" name="at_cpf" class="cpf" size="35" value="<?php echo($_SESSION['pdf/Atendimento']['at_cpf']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">RG:</th>
      <td>
		<input type="text" name="at_rg" class="rg" size="35" value="<?php echo($_SESSION['pdf/Atendimento']['at_rg']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Reclamante:</th>
      <td>
		<input type="text" name="at_reclamante" size="60" value="<?php echo($_SESSION['pdf/Atendimento']['at_reclamante']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Telefone:</th>
      <td>
		<input type="text" name="at_teletone" size="35" value="<?php echo($_SESSION['pdf/Atendimento']['at_teletone']); ?>">
      </td>
    </tr>                     
    <tr>
      <th width="119" align="left" nowrap="nowrap">Tipo de Atendimento:</th>
      <td>
		<?php $tbtipoatendimento = new TbTipoAtendimento(); ?>
		<input type="text" name="ta_codigo" size="55" value="<?php echo($tbtipoatendimento->getDescricao($_SESSION['pdf/Atendimento']['ta_codigo'])); ?>">
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Direcionar Para:</th>
	      <td>
  		<?php $tbdirecionamento = new TbTipoDirecionamento(); ?>
		<input type="text" name="td_codigo" size="55" value="<?php echo($tbdirecionamento->getDescricao($_SESSION['pdf/Atendimento']['td_codigo'])); ?>">		
		</td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Status:</th>
	      <td>
  		<?php $tbStatus = new TbStatusAtendimento(); ?>
		<input type="text" name="sat_codigo" size="35" value="<?php echo($tbStatus->getDescricaoStatus($_SESSION['pdf/Atendimento']['sat_codigo'])); ?>">
		</td>
    </tr>    
    <tr>
      <th align="left" nowrap="nowrap">Descrição do Atendimento:</th>
	      <td>
	      	<textarea name="at_descricao" rows="10" cols="50"><?php echo($_SESSION['pdf/Atendimento']['at_descricao']); ?></textarea>
	      </td>
    </tr>

  </table>
</fieldset>
<?php 
  	try
  	{
	  	$tbApontamento = new TbApontamento();
	  	$tabela = $tbApontamento->listarApontamento($_SESSION['pdf/Atendimento']['at_codigo']);
	
	  	$cabecalho = array('Data do Apontamento','Data de Retorno','Atendente','Apontamento');
	  	
	  	$grid = new DataGrid($cabecalho, $tabela);
	  	
	  	$grid->colunaoculta = 1;
	  	$grid->titulofield = 'Apontamento(s)';
	  	$grid->islink = false;
	  	$grid->mostrarDatagrid();
	  	
  	}catch (Exception $e)
  	{
  		echo $e->getMessage();
  	}
  	?>
 </fieldset>
 </fieldset>
<?php 

unset($_SESSION['buscaRapida']);
	
}catch (Exception $e)
{
	echo Texto::erro($e->getMessage());
}

$html = ob_get_clean();

$mpdf = new mPDF();

$mpdf->SetHeader(utf8_encode('Emitido em: - '.date("d-m-Y")));


$mpdf->SetAuthor(utf8_encode("Márcio Ramos"));
$css =  file_get_contents('../atendimento/css/formatacao.css');

$mpdf->WriteHTML($css,1);

$mpdf->setFooter(utf8_encode('Emitido por: '.$_SESSION['usu_nome'] .' '.$_SESSION['usu_sobrenome'].' - Em: '.date("d-m-Y")));

$mpdf->WriteHTML(utf8_encode($html),2);

$mpdf->Output();

exit();

}
?>