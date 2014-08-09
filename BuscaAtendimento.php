<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico,ControleDeAcesso::$Solicitante));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/addchamado.png" title="Novo Atendimento"  >','cadastrar/Atendimento');
Texto::criarTitulo("Pesquisar");
echo "</div>";


?>
<form action="" method="post">
<fieldset>
	<legend>Pesquisar Atendimento</legend>
<table border="0">
	<tr>
		<td nowrap="nowrap">
			<?php Texto::mostrarMensagem($_SESSION['erro']);?>	
		<td/>
	</tr>
	<tr>
		<td>
			Protocolo:
				<input type="text" name="at_codigo" value="<?php echo($busca->getDados('at_codigo')); ?>">
		</td>
		<td>
			<input type="submit" value="Pesquisar" />
		</td>
	</tr>
</table>
</fieldset>
</form>
<br />

<?php


#Carrega dinamicamente os formularios	
Arquivo::includeForm();


try
{

$_SESSION['cadastrar/Atendimento'] = $busca->listarBuscaAtendimento();

if($_SESSION['cadastrar/Atendimento'] AND !$_SESSION['acao'])
{

	$_SESSION['acaoform'] = base64_encode('alterar/Atendimento');

?>

<form name="Atendimento" id="Atendimento" method="post" enctype="multipart/form-data" action="../<?php echo($_SESSION['projeto']); ?>/action/Atendimento.php">
<fieldset>
	<legend>Atendimento</legend>
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem(Texto::letterRed($_SESSION['erro'])); ?>
      </td>
    </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Protocolo:</th>
      <td>
		<input type="text" disabled="disabled" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_codigo']); ?>">
      </td>
    </tr>     
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data da Ocorrência:</th>
      <td>
      <?php $at_data_cadastro = $_SESSION['cadastrar/Atendimento']['at_data_cadastro'] == '' ? date('d-m-Y') : ValidarDatas::dataCliente($_SESSION['cadastrar/Atendimento']['at_data_cadastro']);?>
		<input type="text" name="at_data_cadastro" class="data" id="data2-id" size="10" value="<?php echo($at_data_cadastro); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Paciente:</th>
      <td>
		<input type="hidden" name="at_codigo" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_codigo']); ?>">      
		<input type="text" name="at_paciente" size="60" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_paciente']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">CPF:</th>
      <td>
		<input type="text" name="at_cpf" class="cpf" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_cpf']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">RG:</th>
      <td>
		<input type="text" name="at_rg" class="rg" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_rg']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Reclamante:</th>
      <td>
		<input type="text" name="at_reclamante" size="60" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_reclamante']); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Telefone:</th>
      <td>
		<input type="text" name="at_teletone" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_teletone']); ?>">
      </td>
    </tr>  
        
    <tr>
      <th width="119" align="left" nowrap="nowrap">Processo:</th>
      <td>
		<input type="text" name="at_processo" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_processo']); ?>">
      </td>
    </tr>                         

                        
    <tr>
      <th width="119" align="left" nowrap="nowrap">Medicamento:</th>
      <td>
		<textarea name="at_medicamento" id="areatexto" rows="5" cols="50"><?php echo($_SESSION['cadastrar/Atendimento']['at_medicamento']); ?></textarea>		
      </td>
    </tr>                                             
    
                       
    <tr>
      <th width="119" align="left" nowrap="nowrap">Tipo de Atendimento:</th>
      <td>
		<?php 
		$tbtipoatendimento = new TbTipoAtendimento();
		FormComponente::selectOption('ta_codigo',$tbtipoatendimento->listarCadastroAtendimento(),false,$_SESSION['cadastrar/Atendimento']);
		?>
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Direcionar Para:</th>
	      <td>
  		   <?php 
       $tbdirecionamento = new TbTipoDirecionamento();
       FormComponente::selectOption('td_codigo',$tbdirecionamento->listarCadastroAtendimento(),false,$_SESSION['cadastrar/Atendimento']);
		   ?>
</td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Descrição do Atendimento:</th>
	      <td>
	      	<textarea name="at_descricao" rows="10" cols="50"><?php echo($_SESSION['cadastrar/Atendimento']['at_descricao']); ?></textarea>
	      </td>
    </tr>
    
    <tr>
      <td colspan="2" align="left">
	      <?php
	      $tbAtendimento = new TbAtendimento();
	       $status = $tbAtendimento->getStatus($_SESSION['cadastrar/Atendimento']['at_codigo']);
	      	
	       if($status == 1)
	       {
	       	echo("<input type='submit' name='cadastrar' class='button-tela' value='Salvar' />");
	       }
	       ?>
		<a href="./action/formcontroler.php?<?php echo(base64_encode('cadastrar/Apontamento').'='.base64_encode($_SESSION['cadastrar/Atendimento']['at_codigo'])); ?>"><span class="button-tela" >Apontamento</span></a>
		<a href="GerarRelatorioAtendimentoPdf.php?<?php echo(base64_encode('cadastrar/Apontamento').'='.base64_encode($_SESSION['cadastrar/Atendimento']['at_codigo'])); ?>" target="_blank"><span class="button-tela" >Exportar PDF</span></a>		
      </td>
    </tr>
  </table>
</fieldset>
</form>

<?php 

}else {
	
	if($busca->getDados('at_codigo') != '' AND !$_SESSION['acao'])
	{
		Texto::criarSubTitulo('Não foi encontrado nenhum atendimento para este protocolo.');
	}
}

unset($_SESSION['cadastrar/Atendimento']);
		
	
}catch (Exception $e)
{
	echo Texto::erro($e->getMessage());
}


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>