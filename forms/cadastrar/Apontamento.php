<?php 
$tbAtendimento = new TbAtendimento();

$_SESSION['cadastrar/Atendimento'] = $tbAtendimento->getForm(base64_decode($_SESSION['valorform']));
?>
<fieldset>
<legend>Apontamento</legend>
<fieldset class="atendimento">
<legend><span id="atendimento"><a href="#aponta">Informações do Atendimento [Esconder]</a></span><span id="ico"></span></legend>
  <table id="esconder" border="0" cellspacing="5">
    <tr>
      <th width="119" align="left" nowrap="nowrap">Protocolo:</th>
      <td>
		<input type="text" disabled="disabled" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_codigo']); ?>">
      </td>    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data da Ocorrência:</th>
      <td>
		<input type="text" name="at_data_cadastro" class="data" size="10" value="<?php echo(ValidarDatas::dataCliente($_SESSION['cadastrar/Atendimento']['at_data_cadastro'])); ?>">
      </td>
    </tr> 
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data do Retorno:</th>
      <td>
		<input type="text" name="at_data_retorno" class="data" size="10" value="<?php echo(ValidarDatas::dataCliente($_SESSION['cadastrar/Atendimento']['at_data_retorno'])); ?>">
    </td>
    </tr>     
    <tr>
      <th width="119" align="left" nowrap="nowrap">Paciente:</th>
      <td>
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
		<input type="text" name="at_medicamento" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_medicamento']); ?>">
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

  </table>
</fieldset>

<form name="cadastrar/Apontamento" id="Apontamento" enctype="multipart/form-data" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/Apontamento.php">
<fieldset>
	<legend>Criação do Apontamento<a name="aponta"></a></legend>
  <table width="300" border="0">
    <tr>
      <td colspan="2">	
      <?php Texto::mostrarMensagem($_SESSION['erro']);?>
    </td>
    </tr>    
    <tr>
      <th nowrap="nowrap">Descrição:</th>
      <td>
      <textarea name="ap_descricao" cols="55" rows="7"	><?php echo($_SESSION['cadastrar/Apontamento']['ap_descricao']); ?></textarea> 
	  <input type="hidden" name="at_codigo" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_codigo']); ?>">      
      </td>
    </tr>
    
    <tr>
    
    	<th nowrap="nowrap">Direcionar para: </th>
    	<td>
    	<?php 
    	$tbDirecionarPara =  new TbTipoDirecionamento();
    	FormComponente::selectOption('td_codigo',$tbDirecionarPara->listarDirecionamento(),false,$_SESSION['cadastrar/Atendimento']);
    	?>
    	</td>
    </tr>
    
    <tr>
      <th nowrap="nowrap">Status do Atendimento:</th>
      <td>
      <?php 
      	$tbstatusAtendimento = new TbStatusAtendimento();
      	$_SESSION['cadastrar/Apontamento']['sat_codigo'] = 
      			($_SESSION['cadastrar/Apontamento']['sat_codigo'] == '') ? 
      				$tbAtendimento->getStatus($_SESSION['cadastrar/Atendimento']['at_codigo']) : $_SESSION['cadastrar/Apontamento']['sat_codigo']; 
      				 
      	FormComponente::selectOption('sat_codigo', $tbstatusAtendimento->listarStatusApontamento(),false,$_SESSION['cadastrar/Apontamento']);
      ?>
	  </td>
    </tr>
    <tr>
      
      <?php 
      	$status = $tbAtendimento->getStatus($_SESSION['cadastrar/Atendimento']['at_codigo']);
      	
      	$ap_data_retorno = $_SESSION['cadastrar/Apontamento']['ap_data_retorno'] == '' ? date('d-m-Y') : $_SESSION['cadastrar/Apontamento']['ap_data_retorno']; 
		
      	if($status != 3)
      	{
      	?>
      	<th width="119" align="left" nowrap="nowrap">Data do Retorno:</th>
      	<td>
			<input type="text" name="ap_data_retorno" class="data" id="data2-id" size="10" value="<?php echo($ap_data_retorno); ?>">
      <?php }?>
      	</td>
    </tr>         
   <tr>
      <td colspan="2" align="left">
	    <?php 
		
	    	
			if($status != 3)
			{
				echo('<input type="submit" name="alterar" class="button-tela" value="Salvar" />');
			}
			?>
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
	  	$grid->mostrarDatagrid();
	  	
  	}catch (Exception $e)
  	{
  		echo $e->getMessage();
  	}
  	?>
 </fieldset>
 
 </fieldset>
<?php
unset($_SESSION['cadastrar/Atendimento']);
unset($_SESSION['cadastrar/Apontamento']);?>
