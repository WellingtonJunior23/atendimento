<?php 

$tbTipoProcesso = new TbTipoProcesso();

$_SESSION['cadastrar/tipoprocesso'] = $tbTipoProcesso->getForm(base64_decode($_SESSION['valorform'])); 


?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Novo Tipo de Processo</legend>
<form name="arquivo" id="tipoprocesso" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/tipoprocesso.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Descricão:</th>
      <td>
      	<input name="ttp_descricao" type="text" value="<?php echo($_SESSION['cadastrar/tipoprocesso']['ttp_descricao']); ?>" />
      	<input name="ttp_codigo" type="hidden" value="<?php echo($_SESSION['cadastrar/tipoprocesso']['ttp_codigo']); ?>" />      	
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Status:</th>
	      <td>
		 <input type="checkbox" name="ttp_status"  <?php echo ($_SESSION['cadastrar/tipoprocesso']['ttp_status'] == '1') ? 'checked="checked"' : ''; ?>  > 
	      </td>
    </tr>
    
    <tr>
      <td colspan="2" align="right">
	      <input type="submit" name="cadastrar" id="button" value="Cadastrar" />
      </td>
    </tr>
  </table>
</form>

    <div id="novoteste"> </div>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['cadastrar/tipoprocesso']);?>