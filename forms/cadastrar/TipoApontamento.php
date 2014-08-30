<?php 
Sessao::validarForm('cadastrar/TipoApontamento'); 
?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Novo Tipo Apontamento</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/TipoApontamento.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Titulo:</th>
      <td>
      	<input size="58" name="tap_titulo" type="text" value="<?php echo($_SESSION['cadastrar/TipoApontamento']['tap_titulo']); ?>" />
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Texto padrão:</th>
      <td>
		<textarea name="tap_descricao" rows="7" cols="45"><?php echo($_SESSION['cadastrar/TipoApontamento']['tap_descricao']);?></textarea>
      </td>
    </tr>
    
    <tr>
      <th align="left" nowrap="nowrap">Tipo de Atendimento:</th>
	      <td>
		<?php 
		$tbtipoatendimento = new TbTipoAtendimento();
		FormComponente::$name = 'Selecione';
		FormComponente::selectOption('at_codigo',$tbtipoatendimento->listarCadastroAtendimento(),true,$_SESSION['cadastrar/TipoApontamento']);
		?>
	      
	      </td>
    </tr>
    
    
    <tr>
      <th align="left" nowrap="nowrap">Ativo:</th>
	      <td>
	      	<?php 
			$tbSN = new TbSimNao();
	      	FormComponente::selectOption('tap_status',$tbSN->selectSimNao(),false,$_SESSION['cadastrar/TipoApontamento']);	      	
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
<?php unset($_SESSION['cadastrar/TipoApontamento']);?>