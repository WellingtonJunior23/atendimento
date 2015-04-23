<?php 
$tbAtendimento = new TbAtendimento();

$_SESSION['cadastrar/Atendimento'] = $tbAtendimento->getForm(base64_decode($_SESSION['valorform']));

?>

<form name="Atendimento" id="Atendimento" method="post" enctype="multipart/form-data" action="../<?php echo($_SESSION['projeto']); ?>/action/Atendimento.php">
<fieldset>
	<legend>Atendimento</legend>
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
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
      <?php $at_data_cadastro = date('d/m/Y H:i:s',strtotime($_SESSION['cadastrar/Atendimento']['at_data_cadastro_real']));  ?>
		<input type="text" name="at_data_cadastro" size="18" value="<?php echo($at_data_cadastro); ?>">
      </td>
    </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data do Retorno:</th>
      <td>
		<input type="text" name="at_data_retorno" class="data" size="10" value="<?php echo(ValidarDatas::dataCliente($_SESSION['cadastrar/Atendimento']['at_data_retorno'])); ?>">
    </td>     
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
      <th width="119" align="left" nowrap="nowrap">CNS:</th>
      <td>
		<input type="text" name="at_cns" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_cns']); ?>">
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
      <th width="119" align="left" nowrap="nowrap">Tipo de Processo:</th>
      <td>
		<?php 
		$tbtipoprocesso = new TbTipoProcesso();
		FormComponente::$name = 'Selecione';
		FormComponente::selectOption('ttp_codigo',$tbtipoprocesso->listarTipoProcessoAtivo(),true,$_SESSION['cadastrar/Atendimento']);
		?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Processo / Protocolo:</th>
      <td>
		<input type="text" name="at_processo" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_processo']); ?>">
      </td>
    </tr>                         
                        
    <tr>
      <th width="119" align="left" nowrap="nowrap">Produto:</th>
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
      <th align="left" nowrap="nowrap">Atendimento Interno:</th>
	      <td>
		 	<input type="checkbox" name="at_localidade" <?php echo ($_SESSION['cadastrar/Atendimento']['at_localidade'] == '1') ? 'checked="checked"' : ''; ?> > 
	      </td>
    </tr>
   
   <tr>
      <th align="left" nowrap="nowrap"></th>
	      <td>
	      &emsp;
	      </td>
    </tr>
  
    
    <tr>
      <td colspan="2" align="left">
	      <?php
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

</form>
<hr>
  	<?php
  	try
  	{
	  	$tbApontamento = new TbApontamento();
	  	$tabela = $tbApontamento->listarApontamento($_SESSION['cadastrar/Atendimento']['at_codigo']);
	
	  	$cabecalho = array('Data do Apontamento','Data de Retorno','Atendente','Apontamento');
	  	
	  	$grid = new DataGrid($cabecalho, $tabela);
	  	$grid->colunaoculta = 1;
	  	$grid->titulofield = 'Apontamento(s)';
	  	$grid->islink = false;
	  	$grid->mostrarDatagrid(1);
	  	
  	}catch (Exception $e)
  	{
  		echo $e->getMessage();
  	}
  	?>
</fieldset>

<?php unset($_SESSION['cadastrar/Atendimento']);?>