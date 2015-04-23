<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/atendimento/componentes/config.php');

if($_POST)
{
	if ($_SESSION['validacaoform'] == base64_encode(date('d-m-Y')))
	{


		$acao = base64_decode($_SESSION['acaoform']);

		switch ($acao)
		{
			case 'cadastrar/TipoProcesso' :

				$cadastro = new Cadastro();

				try
				{
					$cadastro->setDados($_POST);

					$cadastro->cadastrarTipoProcesso();

					$cadastro->finalizarApp('cadastrar/TipoProcesso');

				}catch (Exception $e)
				{
					ClasseException::throwException($e,$_POST,'cadastrar/TipoProcesso');
				}
				break;

			case 'alterar/TipoProcesso' :
				$alteracao = new Alteracao();

				try
				{

					$alteracao->setDados($_POST);

					$alteracao->alterarTipoProcesso();

					$alteracao->finalizarApp();

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
