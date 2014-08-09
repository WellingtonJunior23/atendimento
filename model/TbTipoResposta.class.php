<?php
class TbTipoResposta extends Banco
{
	
	private $tabela = 'tb_tipo_resposta';
	
	private $tir_codigo = 'tir_codigo';
	private $at_codigo = 'at_codigo';
	private $tir_titulo = 'tir_titulo';
	private $tir_descricao = 'tir_descricao'; 
	private $tir_status = 'tir_status'; 
	
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
						($this->at_codigo, $this->tir_titulo, 
						 $this->tir_descricao, $this->tir_status)
						VALUES(:at_codigo, :tir_titulo,
							   :tir_descricao, :tir_status)");
		
		try{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(':at_codigo',$dados[$this->at_codigo]);
			$stmt->bindParam(':tir_titulo',$dados[$this->tir_titulo]);			
			$stmt->bindParam(':tir_descricao',$dados[$this->tir_descricao]);
			$stmt->bindParam(':tir_status',$dados[$this->tir_status]);			
			
			$stmt->execute();
			
			$this->tir_codigo = $this->conexao->lastInsertId();
			
			return($this->tir_codigo);
			
			
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), $e->getCode());
		  }
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
						SET $this->tir_titulo = ?,
							$this->tir_descricao = ?,
							$this->at_codigo = ?,
							$this->tir_status = ?
						WHERE $this->tir_codigo = ?");
		
		try 
		{

			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->tir_titulo],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->tir_descricao],PDO::PARAM_INT);
			$stmt->bindParam(3,$dados[$this->at_codigo],PDO::PARAM_STR);						
			$stmt->bindParam(4,$dados[$this->tir_status],PDO::PARAM_INT);						
			$stmt->bindParam(5,$dados[$this->tir_codigo],PDO::PARAM_INT);			
						
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
	public function listarTipoResposta($dados)
	{
		
		$query = ("SELECT tir_codigo, 
						(SELECT at_descricao FROM tb_tipo_atendimento WHERE at_codigo = TR.at_codigo ) as at_descricao , 
						tir_titulo, tir_descricao, 
						(IF (tir_status = 1 ,'ATIVO' ,'INATIVO')) AS Status
					FROM tb_tipo_resposta AS TR
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
	
	public function getForm($tir_codigo)
	{
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->tir_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$tir_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt->fetch());
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}

	#Utilizado na Exportaчуo do PDF
	public function getDescricao($tir_codigo)
	{
		$query = ("SELECT $this->tir_descricao
					FROM $this->tabela
					WHERE $this->tir_codigo = ?");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$tir_codigo,PDO::PARAM_INT);
			
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

	
	#Utilizado para respostas padrao no cadastro de atendimento
	public function listarRepostaPadrao($at_codigo)
	{
	
		$query = ("SELECT tir_codigo, tir_titulo 
					FROM $this->tabela
					WHERE $this->at_codigo = ? 
					AND $this->tir_status = 1");
	
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
	
	
}
?>