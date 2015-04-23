<?php
class TbAtendimento extends Banco
{
	
	private $tabela = 'tb_atendimento';
	
	private $at_codigo = 'at_codigo';
	private $at_data_cadastro = 'at_data_cadastro';
	private $at_data_retorno = 'at_data_retorno';
	private $at_paciente = 'at_paciente';
	private $at_cpf = 'at_cpf';
	private $at_rg = 'at_rg';
	private $at_reclamante = 'at_reclamante';
	private $at_teletone = 'at_teletone';
	private $ta_codigo = 'ta_codigo';
	private $td_codigo = 'td_codigo';
	private $sat_codigo = 'sat_codigo';
	private $at_descricao = 'at_descricao';
	private $usu_codigo = 'usu_codigo';
	private $at_data_cadastro_real = 'at_data_cadastro_real';
	private $at_processo = 'at_processo';
	private $at_medicamento = 'at_medicamento';
	private $ttp_codigo = 'ttp_codigo';
	private $at_cns = 'at_cns';
	private $at_localidade = 'at_localidade';
	
	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
					($this->at_data_cadastro, $this->at_data_retorno, $this->at_paciente, $this->at_cpf,
					$this->at_rg, $this->at_reclamante, $this->at_teletone, $this->ta_codigo,
					$this->td_codigo, $this->sat_codigo, $this->at_descricao, $this->usu_codigo,
					$this->at_processo, $this->at_medicamento, $this->ttp_codigo, $this->at_cns, $this->at_localidade)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
				   ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->at_data_cadastro],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->at_data_cadastro],PDO::PARAM_STR);			
			$stmt->bindParam(3,$dados[$this->at_paciente],PDO::PARAM_STR);
			$stmt->bindParam(4,$dados[$this->at_cpf],PDO::PARAM_STR);
			$stmt->bindParam(5,$dados[$this->at_rg],PDO::PARAM_STR);
			$stmt->bindParam(6,$dados[$this->at_reclamante],PDO::PARAM_STR);
			$stmt->bindParam(7,$dados[$this->at_teletone],PDO::PARAM_STR);
			$stmt->bindParam(8,$dados[$this->ta_codigo],PDO::PARAM_INT);
			$stmt->bindParam(9,$dados[$this->td_codigo],PDO::PARAM_INT);
			$stmt->bindParam(10,$dados[$this->sat_codigo],PDO::PARAM_INT);
			$stmt->bindParam(11,$dados[$this->at_descricao],PDO::PARAM_STR);
			$stmt->bindParam(12,$dados[$this->usu_codigo],PDO::PARAM_INT);
			$stmt->bindParam(13,$dados[$this->at_processo],PDO::PARAM_STR);
			$stmt->bindParam(14,$dados[$this->at_medicamento],PDO::PARAM_INT);
			$stmt->bindParam(15,$dados[$this->ttp_codigo],PDO::PARAM_INT);
			$stmt->bindParam(16,$dados[$this->at_cns],PDO::PARAM_STR);
			$stmt->bindParam(17,$dados[$this->at_localidade],PDO::PARAM_STR);
												

			$stmt->execute();

			$this->at_codigo =  $this->conexao->lastInsertId();

			return($this->at_codigo);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
					
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
					SET 
						$this->at_paciente = ?, 
						$this->at_cpf = ?,
						$this->at_rg = ?, 
						$this->at_reclamante = ?, 
						$this->at_teletone = ?, 
						$this->ta_codigo = ?,
						$this->td_codigo = ?, 
						$this->sat_codigo = ?, 
						$this->at_descricao = ?,
						$this->at_processo = ?,
						$this->at_medicamento = ?,
						$this->ttp_codigo = ?,
						$this->at_cns = ?,
						$this->at_localidade = ?
					WHERE $this->at_codigo = ?
				   ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->at_paciente],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->at_cpf],PDO::PARAM_STR);
			$stmt->bindParam(3,$dados[$this->at_rg],PDO::PARAM_STR);
			$stmt->bindParam(4,$dados[$this->at_reclamante],PDO::PARAM_STR);
			$stmt->bindParam(5,$dados[$this->at_teletone],PDO::PARAM_STR);
			$stmt->bindParam(6,$dados[$this->ta_codigo],PDO::PARAM_INT);
			$stmt->bindParam(7,$dados[$this->td_codigo],PDO::PARAM_INT);
			$stmt->bindParam(8,$dados[$this->sat_codigo],PDO::PARAM_INT);
			$stmt->bindParam(9,$dados[$this->at_descricao],PDO::PARAM_STR);
			$stmt->bindParam(10,$dados[$this->at_processo],PDO::PARAM_INT);			
			$stmt->bindParam(11,$dados[$this->at_medicamento],PDO::PARAM_INT);
			$stmt->bindParam(12,$dados[$this->ttp_codigo],PDO::PARAM_INT);
			$stmt->bindParam(13,$dados[$this->at_cns],PDO::PARAM_STR);
			$stmt->bindParam(14,$dados[$this->at_localidade],PDO::PARAM_STR);
			$stmt->bindParam(15,$dados[$this->at_codigo],PDO::PARAM_INT);									

			$stmt->execute();


			return($stmt);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	#Listagem da tela principal de atendimento
	public function listarTelaPrincial($dados)
	{
		/*
		$query = ("SELECT ATE.at_codigo, date_format(at_data_cadastro,'%d/%m/%Y') AS at_data_cadastro,SAT.sat_descricao, 
       					  TA.at_descricao, at_paciente, concat(USU.usu_nome,' ', USU.usu_sobrenome) 
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					INNER JOIN tb_tipo_atendimento AS TA
					ON ATE.ta_codigo = TA.at_codigo
					INNER JOIN tb_usuario AS USU
					ON ATE.usu_codigo = USU.usu_codigo
				");
		*/
		
		$query = ("SELECT ATE.at_codigo, date_format(at_data_cadastro_real,'%d/%m/%Y %H:%i:%s') AS at_data_cadastro,
						  date_format(at_data_retorno,'%d/%m/%Y') AS at_data_retorno, SAT.sat_descricao, 
					      TA.at_descricao, at_paciente, concat(USU.usu_nome,' ', USU.usu_sobrenome)
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					INNER JOIN tb_tipo_atendimento AS TA
					ON ATE.ta_codigo = TA.at_codigo
					INNER JOIN tb_usuario AS USU
					ON ATE.usu_codigo = USU.usu_codigo
					INNER JOIN tb_tipo_direcionamento AS TD
					ON ATE.td_codigo = TD.td_codigo
					WHERE ATE.sat_codigo LIKE ?
					AND ATE.ta_codigo LIKE ?
					AND ATE.usu_codigo LIKE ?
					AND ATE.td_codigo LIKE ?
					AND ATE.at_paciente LIKE ?
					AND ATE.at_descricao LIKE ?
					AND ATE.at_processo LIKE ?
					AND ATE.at_medicamento LIKE ?
					AND at_data_retorno >= ? AND at_data_retorno <= ?
					ORDER BY 1 DESC
					LIMIT 500
				");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute(array("{$dados[$this->sat_codigo]}",
								  "{$dados[$this->ta_codigo]}",
								  "{$dados[$this->usu_codigo]}",
								  "{$dados[$this->td_codigo]}",
								  "%{$dados[$this->at_paciente]}%",
								  "%{$dados[$this->at_descricao]}%",
								  "%{$dados[$this->at_processo]}%",
								  "%{$dados[$this->at_medicamento]}%",			
					               "{$dados['data1']}",
								  "{$dados['data2']}"));
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	#Listagem da tela principal de atendimento
	public function relatorioAtendimentoAnalitico($dados)
	{
	
		$query = ("SELECT ATE.at_codigo, date_format(at_data_cadastro_real,'%d/%m/%Y %H:%i:%s') AS at_data_cadastro,
						  date_format(at_data_retorno,'%d/%m/%Y') AS at_data_retorno, SAT.sat_descricao,
					      TA.at_descricao, at_paciente, concat(USU.usu_nome,' ', USU.usu_sobrenome)
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					INNER JOIN tb_tipo_atendimento AS TA
					ON ATE.ta_codigo = TA.at_codigo
					INNER JOIN tb_usuario AS USU
					ON ATE.usu_codigo = USU.usu_codigo
					INNER JOIN tb_tipo_direcionamento AS TD
					ON ATE.td_codigo = TD.td_codigo
					WHERE ATE.sat_codigo LIKE ?
					AND ATE.ta_codigo LIKE ?
					AND at_data_cadastro >= ? AND at_data_cadastro <= ?
					ORDER BY 1 DESC
				");
	
			try
			{
				$stmt = $this->conexao->prepare($query);
					
				$stmt->execute(array("{$dados[$this->sat_codigo]}",
									 "{$dados[$this->ta_codigo]}",
									 "{$dados['data1']}",
									 "{$dados['data2']}"));
					
				return($stmt);
					
		} catch (PDOException $e)
			{
					throw new PDOException($e->getMessage(), $e->getCode());
	}
	
	}
	
	#Listagem da tela principal de atendimento
	public function listarBuscaAtendimento($dados)
	{
		
		$query = ("SELECT ATE.at_codigo, date_format(at_data_cadastro,'%d/%m/%Y') AS at_data_cadastro, at_data_retorno, 
					        SAT.sat_descricao, TA.ta_descricao, at_paciente, concat(USU.usu_nome,' ', USU.usu_sobrenome)
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					INNER JOIN tb_tipo_atendimento AS TA
					ON ATE.ta_codigo = TA.ta_codigo
					INNER JOIN tb_usuario AS USU
					ON ATE.usu_codigo = USU.usu_codigo
					INNER JOIN tb_tipo_direcionamento AS TD
					ON ATE.td_codigo = TD.td_codigo
					WHERE 
					ATE.at_codigo = ?
				");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute(array("{$dados[$this->at_codigo]}"));
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function select()
	{
		
	}
	
	public function getForm($at_codigo)
	{
		$query = ("SELECT * FROM $this->tabela 
					WHERE $this->at_codigo = ?
				  ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$at_codigo,PDO::PARAM_INT);			

			$stmt->execute();

			$dados = $stmt->fetch();
			
			return($dados);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
					
	}
	
	#Usado para atualizar o Atendimento no Apontamento
	public function updateAtendimento($dados)
	{
	
		$query = ("UPDATE $this->tabela
					SET 
						$this->sat_codigo = ?,
						$this->at_data_retorno = ?,
						$this->td_codigo = ?
					WHERE $this->at_codigo = ?
				   ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->sat_codigo],PDO::PARAM_INT);
			$stmt->bindParam(2,$dados[$this->at_data_retorno],PDO::PARAM_STR);		
			$stmt->bindParam(3,$dados[$this->td_codigo],PDO::PARAM_INT);							
			$stmt->bindParam(4,$dados[$this->at_codigo],PDO::PARAM_INT);			

			$stmt->execute();

			return($stmt);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function getStatus($at_codigo)
	{
	
		$query = ("SELECT $this->sat_codigo
					FROM $this->tabela
					WHERE $this->at_codigo = ?
				   ");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$at_codigo,PDO::PARAM_INT);			

			$stmt->execute();

			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	
	public function getMenorDataPendente()
	{
	
		$query = ("SELECT min(at_data_retorno) 
                    FROM tb_atendimento 
                    WHERE sat_codigo = 1");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->execute();

			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function getMenorDataFinalizado()
	{
	
		$query = ("SELECT min(at_data_retorno) 
                    FROM tb_atendimento 
                    WHERE sat_codigo = 3");
		
		try 
		{
			
			$stmt = $this->conexao->prepare($query);

			$stmt->execute();

			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (Exception $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	#Relatório de Tempo de Atendimento
	public function listarRelatioTempoAtendimento($dados)
	{

		$query = ("
				SELECT ATE.at_codigo, concat(USU.usu_nome,' ', USU.usu_sobrenome)AS Usuario, at_paciente, SAT.sat_descricao, 
                date_format(at_data_cadastro_real,'%d/%m/%Y %H:%i:%s') AS dataAbertura,
                date_format((SELECT max(ap_data_apontamento) FROM tb_apontamento WHERE ATE.at_codigo = at_codigo),'%d/%m/%Y %H:%i:%s') AS dataFechamento,
                /*timediff(fechamento, abertura)*/
                    TIMEDIFF((SELECT max(ap_data_apontamento) 
                        FROM tb_apontamento WHERE ATE.at_codigo = at_codigo), at_data_cadastro_real) AS diferenca
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					INNER JOIN tb_tipo_atendimento AS TA
					ON ATE.ta_codigo = TA.at_codigo
					INNER JOIN tb_usuario AS USU
					ON ATE.usu_codigo = USU.usu_codigo
					WHERE ATE.sat_codigo = 3 
					AND at_data_cadastro >= ? AND at_data_cadastro <= ?
          		ORDER BY 1 DESC
				");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute(array("{$dados['dataUm']}",
								  "{$dados['dataDois']}"));
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	#Atendimento pos Status
	public function listarRelatioStatusAtendimento($dados)
	{

		$query = ("
					SELECT count(ATE.sat_codigo) AS Quantidade, SAT.sat_descricao AS Descricao
					FROM tb_atendimento AS ATE
					INNER JOIN tb_status_atendimento AS SAT
					ON ATE.sat_codigo = SAT.sat_codigo
					WHERE at_data_cadastro >= ? 
					  AND at_data_cadastro <= ?
					GROUP BY ATE.sat_codigo
					ORDER BY ATE.sat_codigo
				");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute(array("{$dados['dataUm']}",
								  "{$dados['dataDois']}"));
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}

	#Atendimento pos Tipo de Atendimento e Status, seleciodados por data
	public function listarAtendimentoPorTipoStatus($dados)
	{
	
		$query = ("SELECT count(*) AS Quantidade, TA.at_descricao AS TipoAtendimento, SAT.sat_descricao AS STATUS
						FROM tb_atendimento AS ATE
						INNER JOIN tb_tipo_atendimento AS TA
						ON ATE.ta_codigo = TA.at_codigo
						INNER JOIN tb_status_atendimento AS SAT
						ON ATE.sat_codigo = SAT.sat_codigo
						WHERE at_data_cadastro >= ? 
						AND at_data_cadastro <= ?
						GROUP BY ATE.ta_codigo, SAT.sat_codigo
						ORDER BY TA.at_descricao;
				");
	
		try{
			$stmt = $this->conexao->prepare($query);
				
			$stmt->execute(array("{$dados['dataUm']}",
								 "{$dados['dataDois']}"));
				
			return($stmt);
				
		} catch (PDOException $e){
			throw new PDOException($e->getMessage(), $e->getCode());
		  }
	
	}
	
}
?>