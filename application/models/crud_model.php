<?php

	if (! defined('BASEPATH')) exit("Acesso direto via \"script\" nao permitido");
	
	class Crud_model extends CI_Model{
		
		public function doInsert($dados=NULL){
			
			//Verifica se dados não esta vazio
			if ($dados != NULL){
				
				//Inserir os dados na tabela
				$this->db->insert('tbpaciente', $dados);
				/**
				 * Caso a criação tenha sido bem sucedida
				 * Passa o status através de session (uma vez que a library session esteja carregada no Controller)
				 * padrao é nome da sessão seguido da mensagem
				 */
				$this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso!!!');
				/**
				 * Uma sessao set_flashdata aplica-se apenas ao proximo redirecionamento
				 * então, forçamos o redirect da classe Helper para forcar o recarregamento da pagina passando a sessão
				 * para esta e assim também limpando seu formulário
				 */
				redirect('agenmed/create');
			
				
			} //Fim do if ($dados) não vazio
			
		} //Fim da funcao doInsert
		
		
		
		public function doUpdate($dados=NUll, $condicao=NULL){
			
			//Verifica se dados e a condição não estão vazios
			if ($dados != NULL && $condicao != NULL){
			
				//Atualiza os dados na tabela
				$this->db->update('tbpaciente', $dados, $condicao);
				/**
				 * Caso a criação tenha sido bem sucedida
				 * Passa o status através de session (uma vez que a library session esteja carregada no Controller)
				 * padrao é nome da sessão seguido da mensagem
				*/
				$this->session->set_flashdata('editarok','Atualização efetuada com sucesso!!!');
				/**
				 * Uma sessao set_flashdata aplica-se apenas ao proximo redirecionamento
				 * então, forçamos o redirect da classe Helper para forcar o recarregamento da pagina passando a sessão
				 * para esta e assim também limpando seu formulário
				*/
				redirect('agenmed/consultar');	//Redireciona para a url que chamou a função
					
			
			} //Fim do if ($dados) não vazio
			
		} //fim da função doUpdate
		
		
		
		
		public function doDelete($condicao=NULL){
			//Verifica se existe uma condição
			if ($condicao!=NULL){
				$this->db->delete('tbpaciente',$condicao);
				//Configura a msg de exluido com sucesso
				$this->session->set_flashdata('excluirok','Deleção efetuada com sucesso!!!');
				//Redirecionar para consulta
				redirect('agenmed/consultar');
				
			} //fim do if
			
			
		} //fim da funcao doDelete
		
		
		
		
		
		
		
		/**
		 * Função para retornar todos os usuarios
		 */
		
		public function get_all($table=NULL){
			//Retorna todas as tuplas da tabela para quem estiver chamando
			if ($table!=NULL){
				return $this->db->get($table);
			}
		}
		
		public function get_byEmail_table($email=NULL, $table=NULL){
			if ($email!=NULL && $table!=NULL){
				$this->db->where('email', $email);
				//limita a apenas um já que é uma chave primária
				$this->db->limit(1);
				//Retorna na função get_byId
				return $this->db->get($table);
			} else {
				return FALSE;
			}
		}
		
		
		public function get_byField_table($tbField=NULL, $field=NULL, $table=NULL){
			if ($tbField!=NULL && $field!=NULL && $table!=NULL){
				$this->db->where($tbField, $field);
				//limita a apenas um já que é uma chave primária
				$this->db->limit(1);
				//Retorna na função get_byId
				return $this->db->get($table);
			} else {
				return FALSE;
			}
		}
		
		
		public function get_byId($userId=NULL){
			if ($userId!=NULL){
				$this->db->where('id', $userId);
				//limita a apenas um já que é uma chave primária
				$this->db->limit(1);
				//Retorna na função get_byId
				return $this->db->get('tbpaciente');
			} else {
				return FALSE;
			}
		}
		
		
	} //fim do CrudModel
	