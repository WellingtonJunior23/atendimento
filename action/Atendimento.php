<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

if($_POST)
{
	if ($_SESSION['validacaoform'] == base64_encode(date('d-m-Y')))
	{


		$acao = base64_decode($_SESSION['acaoform']);

		switch ($acao)
		{
			case 'cadastrar/Atendimento' :

				$cadastro = new Cadastro();

				try
				{
					$cadastro->setDados($_POST);	
					
					$cadastro->cadastrarAtendimento();
					
					$cadastro->finalizarApp('cadastrar/Atendimento');

				}catch (Exception $e)
				{
					ClasseException::throwException($e,$_POST,'cadastrar/Atendimento');
				}
				break;

			case 'alterar/Atendimento' :
				$alteracao = new Alteracao();

				try
				{

					$alteracao->setDados($_POST);

					$alteracao->alterarAtendimento();
					//$alteracao->listarDados();
					$alteracao->finalizarApp(null,'Alterado com sucesso!');

				}catch (Exception $e)
				{
					ClasseException::throwException($e);
				}
				break;

			default:
				Sessao::destroiSessao();
				break;
					
		}

	}else
	{
		Sessao::destroiSessao();
	}
}else
{
	Sessao::destroiSessao();
}


?>

