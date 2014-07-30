<?php 


$tbTipoDirecionamento= new TbTipoDirecionamento();

$_SESSION['cadastrar/TipoDirecionamento'] = $tbTipoDirecionamento->getForm(base64_decode($_SESSION['valorform'])); 

?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Alterar Direcionar Para</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/TipoDirecionamento.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Descrição:</th>
      <td>
      	<input name="td_descricao" type="text" value="<?php echo($_SESSION['cadastrar/TipoDirecionamento']['td_descricao']); ?>" />
      	<input name="td_codigo" type="hidden" value="<?php echo($_SESSION['cadastrar/TipoDirecionamento']['td_codigo']); ?>" />      	
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Ativo:</th>
	      <td>
	      	<?php 
			$tbSN = new TbSimNao();
	      	FormComponente::selectOption('td_ativo',$tbSN->selectSimNao(),false,$_SESSION['cadastrar/TipoDirecionamento']);	      	
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
<?php unset($_SESSION['cadastrar/TipoDirecionamento']);?>