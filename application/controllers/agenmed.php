<?php
	if (! defined('BASEPATH')) exit("Acesso direto via \"script\" nao permitido");
	
	class Agenmed extends CI_Controller {
		
		//Construtor
		public function __construct(){
			parent::__construct();
			//Carrega o helper url para utilizar as ancoras
			$this->load->helper('url');
			//Carrega o helper form para ajudar na cria��o de formul�rios
			$this->load->helper('form');
			//Carrega o helper array que ajuda na tarefa de enviar os dados para o DB
			$this->load->helper('array');
			
			//Libraries
			
			//Valida��o
			$this->load->library('form_validation');
			
			//Session
			$this->load->library('session');
			
			//Tabelas
			$this->load->library('table');
			
			//Model
			//Pode ser utilizado um alias como segundo paramentro
			$this->load->model('Crud_model');
			
		}
		
		
		
		public function index(){
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'home.php',					
					);
			
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o index
		
		
		
		public function login(){
			
			//Valida��o do formul�rio
			$this->form_validation->set_rules('email', 'EMAIL','required|trim|valid_email|strtolower|max_lenght[200]');
			$this->form_validation->set_rules('senha', 'SENHA','required|trim|strtolower|max_lenght[15]');
			
		//Caso a valida��o passe
			if ($this->form_validation->run()==TRUE){
				/**
				 * Caso passe pela validacao e depois de adicionado o helper 'array'
				 * 
				 * elements = array(todos os campos recebidos do formulario), 
				 * 					origem dos dados (No caso, $this->input->post()
				 */
				
				$dados = elements(array('email','senha'), $this->input->post());
				
				//Convertendo a senha para MD5 antes de enviar para o DB
				$dados['senha'] = md5($dados['senha']);
				/**
				 * Antes de passar os dados para o model n�o esquecer de carregar o model na fun��o o na constru��o da classe
				 * $this->load->model('nome_do_model);
				 */
				//Chama o modulo depois de carregado passando os $dados
				$query = $this->Crud_model->get_byEmail_table($dados['email'],'tbadministrador')->row();
				
				//Valida a senha
				if ($query->senha == $dados['senha']){
					//Inicializa a sess�o do usuario;
					$this->session->set_userdata('session_username', $query->nome );
					$this->session->set_userdata('session_email', $query->email);
					$this->session->set_userdata('session_logged', 'TRUE' );
					
					//Redireciona para a pagina principal
					redirect('agenmed/index');
				} else {
					//Retorna a tela de login
					$this->session->set_flashdata('naoLogado', '<b>Certifique de digitar corretamente seu email e senha!!!<br>Tente novamente.</b>');
					redirect(current_url());
				}
				
				
			}
			
			
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'login.php',
			);
				
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o login
		
		
		
		
		
		public function about(){
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'about.php',
			);
				
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o index
		
		
		
		
		
		public function create(){
			
			
			//Valida��o do formul�rio
			$this->form_validation->set_rules('email', 'EMAIL','required|trim|valid_email|strtolower|unique|is_unique[tbpaciente.email]|max_lenght[200]');
			$this->form_validation->set_rules('email2', 'REPITA O EMAIL','required|trim|valid_email|strtolower|matches[email]|max_lenght[200]');
			$this->form_validation->set_rules('senha', 'SENHA','required|trim|strtolower|max_lenght[15]');
			$this->form_validation->set_rules('senha2', 'REPITA A SENHA','required|trim|strtolower|matches[senha]|max_lenght[15]');
			$this->form_validation->set_rules('cpf', 'CPF','trim|is_unique[tbpaciente.cpf]|max_lenght[15]');
			$this->form_validation->set_rules('nome', 'NOME','required|trim|ucwords|max_lenght[50]');
			$this->form_validation->set_rules('sobrenome', 'SOBRENOME','required|trim|ucwords|max_lenght[200]');
			$this->form_validation->set_rules('endereco', 'ENDERECO','required|trim|ucwords|max_lenght[200]');
			$this->form_validation->set_rules('complemento', 'COMPLEMENTO','trim|ucwords|max_lenght[100]');
			$this->form_validation->set_rules('telefone', 'TELEFONE','trim|numeric|max_lenght[15]');
			$this->form_validation->set_rules('celular', 'TELEFONE CELULAR','trim|numeric|max_lenght[15]');
			//$this->form_validation->set_rules('idConvenio', 'CONVENIO','trim|numeric|max_lenght[11]');
			
			
			//Caso a valida��o passe
			if ($this->form_validation->run()==TRUE){
				/**
				 * Caso passe pela validacao e depois de adicionado o helper 'array'
				 * 
				 * elements = array(todos os campos a serem armazenados no banco de dados), 
				 * 					origem dos dados (No caso, $this->input->post()
				 */
				
				$dados = elements(array('email','senha', 'cpf', 'nome', 'sobrenome', 'endereco', 'complemento', 'bairro', 'cidade', 'estado', 'paise', 'cep', 'telefone', 'celular', 'convenios'), $this->input->post());
				var_dump($dados['senha']);
				var_dump($dados['bairro']->selected);
				//Convertendo a senha para MD5 antes de enviar para o DB
				$dados['senha'] = md5($dados['senha']);
				
				//Converte os nomes em Ids
				//Recebe nome do atributos na tabela, campo recebido do formulario e nome da tabela
				$query = $this->Crud_model->get_byField_table('bairro', $dados['bairro'], 'tbbairro')->result();
				$dados['bairro'] = $query->idbairro;
				
				$query = $this->Crud_model->get_byField_table('cidade', $dados['cidade'], 'tbcidade')->result();
				$dados['cidade'] = $query->idcidade;
				
				$query = $this->Crud_model->get_byField_table('estado', $dados['estado'], 'tbestado')->result();
				$dados['estado'] = $query->idestado;
				
				$query = $this->Crud_model->get_byField_table('pais', $dados['pais'], 'tbpais')->result();
				$dados['pais'] = $query->idpais;
				
				$query = $this->Crud_model->get_byField_table('operadora', $dados['convenio'], 'tbconvenio')->result();
				$dados['convenio'] = $query->idconvenio;
				
				
				/**
				 * Antes de passar os dados para o model n�o esquecer de carregar o model na fun��o o na constru��o da classe
				 * $this->load->model('nome_do_model);
				 */
				//Chama o modulo depois de carregado passando os $dados
				$this->Crud_model->doInsert($dados);
			}
			
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'criar',
					'bairro'=> $this->Crud_model->get_all('tbbairro')->result(),
					'cidade' => $this->Crud_model->get_all('tbcidade')->result(),
					'estado' => $this->Crud_model->get_all('tbestado')->result(),
					'pais' => $this->Crud_model->get_all('tbpais')->result(),
					'convenio' => $this->Crud_model->get_all('tbconvenio')->result(),
			);
				
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o criar
		
		
		
		
		
		
		public function consultar(){
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'consultar',
					'lstUsuarios' => $this->Crud_model->get_all()->result(),
			);
		
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o consultar
		
		
		
		
		
		
		public function editar(){
			
			//Valida��o do formul�rio
			$this->form_validation->set_rules('nome', 'NOME','required|trim|ucwords|max_lenght[50]');
			$this->form_validation->set_rules('sobrenome', 'SOBRENOME','required|trim|ucwords|max_lenght[200]');
			$this->form_validation->set_rules('endereco', 'ENDERECO','required|trim|ucwords|max_lenght[200]');
			$this->form_validation->set_rules('complemento', 'COMPLEMENTO','trim|ucwords|max_lenght[100]');
			$this->form_validation->set_rules('telefone', 'TELEFONE','trim|numeric|max_lenght[15]');
			$this->form_validation->set_rules('celular', 'TELEFONE CELULAR','trim|numeric|max_lenght[15]');
			$this->form_validation->set_rules('idConvenio', 'CONVENIO','trim|numeric|max_lenght[11]');
				
				
			//Caso a valida��o passe
			if ($this->form_validation->run()==TRUE){
				/**
				 * Caso passe pela validacao e depois de adicionado o helper 'array'
				 *
				 * elements = array(todos os campos a serem armazenados no banco de dados),
				 * 					origem dos dados (No caso, $this->input->post()
				 */
			
				$dados = elements(array('email', 'nome', 'sobrenome', 'endereco', 'complemento', 'telefone', 'celular', 'idConvenio'), $this->input->post());
			
				//Convertendo a senha para MD5 antes de enviar para o DB
//				$dados['senha'] = md5($dados['senha']);
				/**
				 * Antes de passar os dados para o model n�o esquecer de carregar o model na fun��o o na constru��o da classe
				 * $this->load->model('nome_do_model);
				*/
				
				/**
				 * Chama o modulo depois de carregado passando os $dados e a condicao para atualiza��o como 2o parametro
				 * onde a condi��o � garantir que o id � o mesmo da base de dados
				 */
				$this->Crud_model->doUpdate($dados, array('id'=>$this->input->post('h_idUsuario')));
			}
			
			
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'editar',
			);
		
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
			
		} //Fim da fun��o editar
		
		
		
		public function excluir(){
			
			//Verifica se recebeu o formulario para efetuar a exclus�o
			if ($this->input->post('h_idUsuario')>0){
				
				$this->Crud_model->doDelete(array('id'=>$this->input->post('h_idUsuario')));
				
			}
			
			
			//Array de views
			$dados = array(
					'titulo' => 'AGENMED - Sistema de agendamento medico online',
					'tela' => 'excluir',
			);
		
			//Carrega as respectivas views
			$this->load->view('agenmed', $dados);
		} //Fim da fun��o excluir
		
		
		
		
	} //fim do controlador Agenmend
