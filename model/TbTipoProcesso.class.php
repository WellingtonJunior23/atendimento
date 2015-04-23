<?php
class TbTipoProcesso extends Banco
{
	
	private $tabela = 'tb_tipo_processo';
	
	private $ttp_codigo = 'ttp_codigo';
	private $ttp_descricao = 'ttp_descricao';
	private $ttp_status = 'ttp_status';
	
	
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
						($this->ttp_descricao, $this->ttp_status)
						VALUES(?, ?)");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->ttp_descricao]);
			$stmt->bindParam(2,$dados[$this->ttp_status]);
			
			$stmt->execute();
			
			return $this->conexao->lastInsertId();
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
						SET $this->ttp_descricao = ?,
							$this->ttp_status = ?
						WHERE $this->ttp_codigo = ?");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->ttp_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->ttp_status],PDO::PARAM_STR);
			$stmt->bindParam(3,$dados[$this->ttp_codigo],PDO::PARAM_INT);						
			
			$stmt->execute();
				
			return($stmt);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	/**
	* @example Utilizado no formulario de cadastro de atendimento
	*/
	public function listarTipoProcessoAtivo()
	{
		
		$query = ("SELECT $this->ttp_codigo, $this->ttp_descricao 
					FROM $this->tabela
					WHERE $this->ttp_status = 1");
		
							
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
	
	/**
	*@example Listagem usada na tela de listagem de atendimento
	*/
	public function listarCadastroTipoProcesso()
	{

		$query = ("SELECT $this->ttp_codigo, $this->ttp_descricao,
					    (CASE WHEN $this->ttp_status = 1 THEN 'ATIVO' ELSE 'INATIVO' END)
					FROM $this->tabela");
		
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
	
	public function getForm($ttd_codigo)
	{
	
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->ttp_codigo = ?
				  ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$ttd_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt->fetch());
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	public function getDescricao($ttd_codigo)
	{
	
		$query = ("SELECT $this->ttp_descricao 
					FROM $this->tabela
					WHERE $this->ttp_codigo = ?
				  ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$ttd_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
		
}
?>