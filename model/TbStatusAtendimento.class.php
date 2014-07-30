<?php
class TbStatusAtendimento extends Banco
{

	private $tabela = 'tb_status_atendimento';

	private $sat_codigo = 'sat_codigo';
	private $sat_descricao = 'sat_descricao';
	private $sat_ativo = 'sat_ativo';

	public function insert($dados)
	{

	}

	public function update($dados)
	{

	}

	#Utilizado no formulario de cadastro de atendimento
	public function listarCadastroAtendimento()
	{

		$query = ("SELECT * FROM $this->tabela
					WHERE $this->sat_ativo = 1");

		try
		{
				
			$stmt = $this->conexao->prepare($query);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (Exception $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}

	}

	#Utilizado no formulario de cadastro de Apontamento
	public function listarStatusApontamento()
	{

		$query = ("SELECT * FROM $this->tabela
					WHERE $this->sat_ativo = 1
					AND $this->sat_codigo != 1
				  ");

		try
		{
				
			$stmt = $this->conexao->prepare($query);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (Exception $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}

	}

	#Utilizado no Relatorio PDF
	public function getDescricaoStatus($sat_codigo)
	{

		$query = ("SELECT $this->sat_descricao FROM $this->tabela
					WHERE $this->sat_codigo = ? 
				  ");

		try
		{
				
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sat_codigo,PDO::PARAM_INT);
			
			$stmt->execute();

			$dados = $stmt->fetch();
			
			return($dados[0]);
				
		} catch (Exception $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}

	}
	
	public function getForm($codigo)
	{

	}


}
?>