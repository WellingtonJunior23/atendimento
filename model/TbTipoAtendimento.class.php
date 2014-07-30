<?php
class TbTipoAtendimento extends Banco
{
	
	private $tabela = 'tb_tipo_atendimento';
	
	private $at_codigo = 'at_codigo';
	private $at_descricao = 'at_descricao';
	private $at_ativo = 'at_ativo';
	private $at_texto_padrao = 'at_texto_padrao';
	
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
						($this->at_descricao,
						$this->at_texto_padrao)
						VALUES(?,?)");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->at_descricao]);
			$stmt->bindParam(2,$dados[$this->at_texto_padrao]);			
			
			$stmt->execute();
			
			$this->ta_codigo = $this->conexao->lastInsertId();
			
			return($this->ta_codigo);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
						SET $this->at_descricao = ?,
							$this->at_ativo = ?,
							$this->at_texto_padrao = ?
						WHERE $this->at_codigo = ?");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->at_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->at_ativo],PDO::PARAM_INT);
			$stmt->bindParam(3,$dados[$this->at_texto_padrao],PDO::PARAM_STR);						
			$stmt->bindParam(4,$dados[$this->at_codigo],PDO::PARAM_INT);						
						
			$stmt->execute();
				
			return($stmt);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Utilizado no formulario de cadastro de atendimento
	public function listarCadastroAtendimento()
	{
		
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->at_ativo = 1");
		
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
	
	#Utilizado na listagem de alteraчуo
	public function listarAtendimento()
	{
		
		$query = ("SELECT at_codigo, at_descricao,  
					    (CASE WHEN at_ativo = 1 THEN 'ATIVO' ELSE 'INATIVO' END),
					    $this->at_texto_padrao
					FROM tb_tipo_atendimento");
		
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
	
	public function getForm($ta_codigo)
	{
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->at_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$ta_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt->fetch());
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}

	#Utilizado na Exportaчуo do PDF
	public function getDescricao($ta_codigo)
	{
		$query = ("SELECT $this->at_descricao 
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
	
	#Pega o Texto padrуo do tipo de atendimento
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
		
}
?>