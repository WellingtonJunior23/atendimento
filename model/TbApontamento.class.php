<?php

class TbApontamento extends Banco
{
	
	private $tabela = 'tb_apontamento';
	
	private $ap_codigo = 'ap_codigo';
	private $ap_data_apontamento = 'ap_data_apontamento';
	private $ap_data_retorno = 'ap_data_retorno';
	private $usu_codigo = 'usu_codigo';
	private $ap_descricao = 'ap_descricao';
	private $at_codigo = 'at_codigo';
	
	
	public function insert($dados)
	{
		
		$query = ("
				   INSERT INTO $this->tabela 
						($this->ap_data_retorno, $this->usu_codigo, 
						 $this->ap_descricao, $this->at_codigo)
					VALUES(?,?,?,?)
				  ");
		
		try
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dados[$this->ap_data_retorno],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->usu_codigo],PDO::PARAM_INT);
			$stmt->bindParam(3,$dados[$this->ap_descricao],PDO::PARAM_STR);				
			$stmt->bindParam(4,$dados[$this->at_codigo],PDO::PARAM_INT);				
					
			$stmt->execute();
		
		return($stmt);
		
		}catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	public function select($colum, $param = null)
	{
		
	}

	public function getForm($codigo_id_tabela){}
	
	public function update($dados){}
	
	public function listarApontamento($at_codigo)
	{
		$query = ("SELECT ap_codigo, date_format(ap_data_apontamento,'%d/%m/%Y %H:%i:%s') AS ap_data_apontamento, 
					        date_format(ap_data_retorno,'%d/%m/%Y') AS ap_data_retorno,  USU.usu_nome, ap_descricao
					FROM tb_apontamento AS APO
					INNER JOIN tb_usuario AS USU
					ON APO.usu_codigo = USU.usu_codigo
					WHERE APO.at_codigo = ?
					ORDER BY 1 DESC
				");
		
		
		try
		{
			
			$stmt = $this->conexao->prepare($query);
						
			$stmt->bindParam(1,$at_codigo,PDO::PARAM_INT);				
					
			$stmt->execute();
		
		return($stmt);
		
		}catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
}
?>