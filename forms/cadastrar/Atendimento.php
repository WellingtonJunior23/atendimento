<?php 
Sessao::validarForm('cadastrar/Atendimento'); 
?>

<form name="Atendimento" id="Atendimento" method="post" enctype="multipart/form-data" action="../<?php echo($_SESSION['projeto']); ?>/action/Atendimento.php">
<fieldset>
	<legend> Cadastrar Atendimento </legend>
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Data da Ocorrência:</th>
      <td>
      <?php $at_data_cadastro = $_SESSION['cadastrar/Atendimento']['at_data_cadastro'] == '' ? date('d-m-Y') : $_SESSION['cadastrar/Atendimento']['at_data_cadastro'];?>
		<input type="text" name="at_data_cadastro" class="data" id="data2-id" size="10" value="<?php echo($at_data_cadastro); ?>">
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
		<input type="text" name="at_medicamento" size="60" value="<?php echo($_SESSION['cadastrar/Atendimento']['at_medicamento']); ?>">
      </td>
    </tr>                                             
                        
    <tr>
      <th width="119" align="left" nowrap="nowrap">Tipo de Atendimento:</th>
      <td>
		<?php 
		$tbtipoatendimento = new TbTipoAtendimento();
		FormComponente::$name = 'Selecione';
		FormComponente::selectOption('ta_codigo',$tbtipoatendimento->listarCadastroAtendimento(),true,$_SESSION['cadastrar/Atendimento']);
		?>
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Direcionar Para:</th>
	      <td>
  		   <?php 
       $tbdirecionamento = new TbTipoDirecionamento();
       FormComponente::$name = 'Selecione';
       FormComponente::selectOption('td_codigo',$tbdirecionamento->listarCadastroAtendimento(),true,$_SESSION['cadastrar/Atendimento']);
		   ?>
</td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Descrição do Atendimento:</th>
	      <td>
	      	<textarea name="at_descricao" id="areatexto" rows="10" cols="50"><?php echo($_SESSION['cadastrar/Atendimento']['at_descricao']); ?></textarea>
	      </td>
    </tr>
    
    <tr>
      <td colspan="2" align="left">
  		  <input type="hidden" name="AcaoSubmit" value="<?php echo(date('is'));?>" />	      
	      <input type="submit" name="cadastrar" id="button-tela" class="button-tela" value="Salvar" />
      </td>
    </tr>

  </table>
       <div id="insere_aqui">
     </div>
</fieldset>
</form>

<?php unset($_SESSION['cadastrar/Atendimento']);?>