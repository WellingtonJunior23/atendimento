  </div>
<!--FIM Corpo principal do site -->    

<!--INICIO menu secundário da direita -->
    <div id="nav_main">
    <div class="titulo_menu_direita">Menu</div>    
        <ul>
        <?php
		$controleacesso = new ControleDeAcesso();

		$botaobusca = ("<li><a href='BuscaAtendimento.php'><img src='./css/images/search.png'> Pesquisar</a></li>");
		$controleacesso->permitirBotao($botaobusca, array(ControleDeAcesso::$Solicitante,ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));
		
		//$botaosol = ("<li><a href='Solicitante.php'><img src='./css/images/chamado.png'> Atendimento</a></li>");
		//$controleacesso->permitirBotao($botaosol, array(ControleDeAcesso::$Solicitante));
		
		$botaoOperacao = ("<li><a href='Atendimento.php'><img src='./css/images/chamado.png'> Atendimento</a></li>");
		$controleacesso->permitirBotao($botaoOperacao, array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));
		
		
		$botaoprojeto = ("<li><a href='AtendimentoAnalitico.php'><img src='./css/images/ocorrencia.png'> Atendimento Analitico</a></li>");					
		$controleacesso->permitirBotao($botaoprojeto, array(ControleDeAcesso::$TecnicoADM));
		
		//$botaocklist = ("<li><a href='ExecutarCheckList.php'><img src='./css/images/ck.png'> CheckList</a></li>");
		//$controleacesso->permitirBotao($botaocklist, array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));						
		?>
		</ul>
    </div>
<!--FIM menu secundário da direita -->    
    
</div>
<!-- FIM Do quadro da pagina INTEIRA -->
