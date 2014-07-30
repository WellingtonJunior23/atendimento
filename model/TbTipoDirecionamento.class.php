<?php
class TbTipoDirecionamento extends Banco
{
	
	private $tabela = 'tb_tipo_direcionamento';
	
	private $td_codigo = 'td_codigo';
	private $td_descricao = 'td_descricao';
	private $td_ativo = 'td_ativo';
	
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
						($this->td_descricao)
						VALUES(?)");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->td_descricao]);
			
			$stmt->execute();
			
			$this->td_codigo = $this->conexao->lastInsertId();
			
			return($this->td_codigo);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
						SET $this->td_descricao = ?,
							$this->td_ativo = ?
						WHERE $this->td_codigo = ?");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->td_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->td_ativo],PDO::PARAM_INT);
			$stmt->bindParam(3,$dados[$this->td_codigo],PDO::PARAM_INT);						
			
			$stmt->execute();
				
			return($stmt);
			
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}
	
	#Listagem usada na tela de Cadastro e Alteraчуo de Tipos de Direcionamento
	public function listarDirecionamento()
	{
		
		$query = ("SELECT td_codigo, td_descricao, 
					    (CASE WHEN td_ativo = 1 THEN 'ATIVO' ELSE 'INATIVO' END)
					FROM tb_tipo_direcionamento");
							
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
	
	#Utilizado no formulario de cadastro de atendimento
	public function listarCadastroAtendimento()
	{
		
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->td_ativo = 1");
		
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
	
	public function getForm($td_codigo)
	{
	
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->td_codigo = ?
				  ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$td_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt->fetch());
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	public function getDescricao($td_codigo)
	{
	
		$query = ("SELECT $this->td_descricao 
					FROM $this->tabela
					WHERE $this->td_codigo = ?
				  ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$td_codigo,PDO::PARAM_INT);
			
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