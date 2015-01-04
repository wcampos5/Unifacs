<?php

	if (! defined('BASEPATH')) exit("Acesso direto via \"script\" nao permitido");
	
	class Crud_model extends CI_Model{
		
		public function doInsert($dados=NULL){
			
			//Verifica se dados n�o esta vazio
			if ($dados != NULL){
				
				//Inserir os dados na tabela
				$this->db->insert('tbpaciente', $dados);
				/**
				 * Caso a cria��o tenha sido bem sucedida
				 * Passa o status atrav�s de session (uma vez que a library session esteja carregada no Controller)
				 * padrao � nome da sess�o seguido da mensagem
				 */
				$this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso!!!');
				/**
				 * Uma sessao set_flashdata aplica-se apenas ao proximo redirecionamento
				 * ent�o, for�amos o redirect da classe Helper para forcar o recarregamento da pagina passando a sess�o
				 * para esta e assim tamb�m limpando seu formul�rio
				 */
				redirect('agenmed/create');
			
				
			} //Fim do if ($dados) n�o vazio
			
		} //Fim da funcao doInsert
		
		
		
		public function doUpdate($dados=NUll, $condicao=NULL){
			
			//Verifica se dados e a condi��o n�o est�o vazios
			if ($dados != NULL && $condicao != NULL){
			
				//Atualiza os dados na tabela
				$this->db->update('tbpaciente', $dados, $condicao);
				/**
				 * Caso a cria��o tenha sido bem sucedida
				 * Passa o status atrav�s de session (uma vez que a library session esteja carregada no Controller)
				 * padrao � nome da sess�o seguido da mensagem
				*/
				$this->session->set_flashdata('editarok','Atualiza��o efetuada com sucesso!!!');
				/**
				 * Uma sessao set_flashdata aplica-se apenas ao proximo redirecionamento
				 * ent�o, for�amos o redirect da classe Helper para forcar o recarregamento da pagina passando a sess�o
				 * para esta e assim tamb�m limpando seu formul�rio
				*/
				redirect('agenmed/consultar');	//Redireciona para a url que chamou a fun��o
					
			
			} //Fim do if ($dados) n�o vazio
			
		} //fim da fun��o doUpdate
		
		
		
		
		public function doDelete($condicao=NULL){
			//Verifica se existe uma condi��o
			if ($condicao!=NULL){
				$this->db->delete('tbpaciente',$condicao);
				//Configura a msg de exluido com sucesso
				$this->session->set_flashdata('excluirok','Dele��o efetuada com sucesso!!!');
				//Redirecionar para consulta
				redirect('agenmed/consultar');
				
			} //fim do if
			
			
		} //fim da funcao doDelete
		
		
		
		
		
		
		
		/**
		 * Fun��o para retornar todos os usuarios
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
				//limita a apenas um j� que � uma chave prim�ria
				$this->db->limit(1);
				//Retorna na fun��o get_byId
				return $this->db->get($table);
			} else {
				return FALSE;
			}
		}
		
		
		public function get_byField_table($tbField=NULL, $field=NULL, $table=NULL){
			if ($tbField!=NULL && $field!=NULL && $table!=NULL){
				$this->db->where($tbField, $field);
				//limita a apenas um j� que � uma chave prim�ria
				$this->db->limit(1);
				//Retorna na fun��o get_byId
				return $this->db->get($table);
			} else {
				return FALSE;
			}
		}
		
		
		public function get_byId($userId=NULL){
			if ($userId!=NULL){
				$this->db->where('id', $userId);
				//limita a apenas um j� que � uma chave prim�ria
				$this->db->limit(1);
				//Retorna na fun��o get_byId
				return $this->db->get('tbpaciente');
			} else {
				return FALSE;
			}
		}
		
		
	} //fim do CrudModel
	