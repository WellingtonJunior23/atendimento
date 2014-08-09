<?php 
Sessao::validarForm('cadastrar/TipoAtendimento'); 
?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Novo Tipo Atendimento</legend>
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
      	<input size="50" name="at_descricao" type="text" value="<?php echo($_SESSION['cadastrar/TipoAtendimento']['at_descricao']); ?>" />
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