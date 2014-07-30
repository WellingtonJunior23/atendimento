<?php 

$tbTipoAtendimento = new TbTipoAtendimento();

$_SESSION['cadastrar/TipoAtendimento'] = $tbTipoAtendimento->getForm(base64_decode($_SESSION['valorform'])); 

?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Alterar Tipo Atendimento</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/TipoAtendimento.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Descrição:</th>
      <td>
      	<input name="at_descricao" type="text" value="<?php echo($_SESSION['cadastrar/TipoAtendimento']['at_descricao']); ?>" />
      	<input name="at_codigo" type="hidden" value="<?php echo($_SESSION['cadastrar/TipoAtendimento']['at_codigo']); ?>" />      	
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Ativo:</th>
	      <td>
	      	<?php 
			$tbSN = new TbSimNao();
	      	FormComponente::selectOption('at_ativo',$tbSN->selectSimNao(),false,$_SESSION['cadastrar/TipoAtendimento']);	      	
	      	?>
	      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Texto padrão:</th>
      <td>
		<textarea name="at_texto_padrao" rows="5" cols="20"><?php echo($_SESSION['cadastrar/TipoAtendimento']['at_texto_padrao']);?></textarea>
      </td>
    </tr>
    
    <tr>
      <td colspan="2" align="right">
	      <input type="submit" name="cadastrar" id="button" value="Salvar" />
      </td>
    </tr>
    
  </table>
</form>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['cadastrar/TipoAtendimento']);?>