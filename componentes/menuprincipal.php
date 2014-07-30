</div>     
		<!--FIM Quadro de menu miniatura -->
<!--INICIO menu principal -->
<div id="navcont">
    <ul id="nav">
    
		<?php
		$acesso = new ControleDeAcesso(); 
        $acesso->permitirBotao("<li><a href='Atendimento.php'>Atendimento</a></li>",array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));
        $acesso->permitirBotao("<li><a href='RelatorioAtendimento.php'>Relatório</a></li>",array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));        
        $acesso->permitirBotao("<li><a href='AdministracaoAtendimento.php'>Administração</a></li>",array(ControleDeAcesso::$TecnicoADM));

        ?>                        
    </ul>
</div>    
<!--FIM Menu principal -->

<!--INICIO Corpo principal do site -->
        <div id="content_main">