<?php
class TbTipoApontamento extends Banco
{
	
	private $tabela = 'tb_tipo_apontamento';
	
	private $tap_codigo = 'tap_codigo';
	private $at_codigo = 'at_codigo';
	private $tap_titulo = 'tap_titulo';	
	private $tap_descricao = 'tap_descricao';
	private $tap_status = 'tap_status';
		
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
						($this->at_codigo, $this->tap_descricao, $this->tap_titulo)
						VALUES(:at_codigo, :tap_descricao, :tap_titulo)");
		
		try{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(':at_codigo',$dados[$this->at_codigo]);
			$stmt->bindParam(':tap_descricao',$dados[$this->tap_descricao]);
			$stmt->bindParam(':tap_titulo',$dados[$this->tap_titulo]);						
			
			$stmt->execute();
			
			$this->tap_codigo = $this->conexao->lastInsertId();
			
			return($this->tap_codigo);
			
			
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), $e->getCode());
		  }
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
						SET $this->tap_descricao = ?,
							$this->at_codigo = ?,
							$this->tap_status = ?,
							$this->tap_titulo = ?
 					  WHERE $this->tap_codigo = ?");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->tap_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->at_codigo],PDO::PARAM_INT);
			$stmt->bindParam(3,$dados[$this->tap_status],PDO::PARAM_STR);
			$stmt->bindParam(4,$dados[$this->tap_titulo],PDO::PARAM_INT);								
			$stmt->bindParam(5,$dados[$this->tap_codigo],PDO::PARAM_INT);
						
			$stmt->execute();
				
			return($stmt);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	
	public function getForm($tap_codigo)
	{
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->tap_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$tap_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt->fetch());
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}

	public function listarTipoApontamento($dados)
	{

		$query = ("SELECT tap_codigo,
		(SELECT at_descricao FROM tb_tipo_atendimento WHERE at_codigo = TA.at_codigo ) as at_descricao ,
						tap_titulo, tap_descricao,
						(IF (tap_status = 1 ,'ATIVO' ,'INATIVO')) AS Status
					FROM tb_tipo_apontamento AS TA
					WHERE at_codigo LIKE ?
					ORDER BY 2
				");
		
		try
		{
				
			$stmt = $this->conexao->prepare($query);
				
			$stmt->bindParam(1, $dados['at_codigo'],PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (Exception $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
 	#Utilizado no carregamento de resposta
	public function getDescricao($tap_codigo)
	{
		$query = ("SELECT $this->tap_descricao
					FROM $this->tabela
					WHERE $this->tap_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$tap_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}
	
	#Utilizado para respostas padrao no cadastro de Apontamento
	public function listarApontamentoPadrao($at_codigo)
	{
	
		$query = ("SELECT tap_codigo, tap_titulo
					FROM $this->tabela
					WHERE $this->at_codigo = ?
					AND $this->tap_status = 1");
	
				try
				{
	
				$stmt = $this->conexao->prepare($query);
				$stmt->bindParam(1, $at_codigo,PDO::PARAM_INT);
					
				$stmt->execute();
	
				return($stmt);
	
				} catch (Exception $e)
				{
				throw new PDOException($e->getMessage(), $e->getCode());
				}
	
	}

	/*
	#Pega o Texto padrão do tipo de atendimento
	public function getTextoPadrao($ta_codigo)
	{
		$query = ("SELECT $this->at_texto_padrao
					FROM $this->tabela
					WHERE $this->at_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$ta_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}

	
	
	
	#Utilizado no formulario de cadastro de atendimento
	public function listarCadastroAtendimento()
	{
	
		$query = ("SELECT * FROM $this->tabela
				WHERE $this->tap_status = 1");
	
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
	
	 */
	
}
?>