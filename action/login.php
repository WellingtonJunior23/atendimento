<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

if($_POST)
{
	try
	{
		$login = new Logar();

		$login->setDados($_POST);


		$login->fazerLogin();
		
		if($_SESSION['tac_codigo'] == 2)
		{
			header('location: /atendimento/Atendimento.php');
		}else
		{ 
			header('location: /atendimento/Atendimento.php');
		}
		
	} catch (Exception $e)
	{
		$_SESSION['erro'] = $e->getMessage();
		header('location: '.$_SERVER['HTTP_REFERER']);
	}

}
else
{
	Sessao::destroiSessao();
}

?>
