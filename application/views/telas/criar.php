<?php
	
	//Inicializa as variaveis que irão ser utilizadas nos comboboxes
	$lstBairros = array();
	$lstCidades = array();
	$lstEstados = array();
	$lstPaises = array();
	$lstConvenios = array();
	
	//Varre a variavel $bairro recebida do Controller
	foreach ($bairro as $linha){
		$lstBairros[] = $linha->bairro;
	}
	
	
	//Varre a variavel $cidade recebida do Controller
	foreach ($cidade as $linha){
		$lstCidades[] = $linha->cidade;
	}
	
	//Varre a variavel $estado recebida do Controller
	foreach ($estado as $linha){
		$lstEstados[] = $linha->estado;
	}
	
	
	//Varre a variavel $pais recebida do Controller
	foreach ($pais as $linha){
		$lstPaises[] = $linha->pais;
	}
	
	//Varre a variavel $pais recebida do Controller
	foreach ($convenio as $linha){
		$lstConvenios[] = $linha->operadora;
	}
	
	//Inicia o formulario
	echo form_open('agenmed/create');
		//Imprime os error de validação do formulário recebidos
		echo validation_errors('<p>','<p>');
		//Verifica se tem dados na sessão
		if ($this->session->flashdata('cadastrook')){
			echo '<p>' . $this->session->flashdata('cadastrook') . '</p>';
		}
		//Insere os campos
		echo form_label('Email');
		echo form_input(array('name'=>'email'),set_value('email'),'autofocus');
		echo form_label('Repita o email');
		echo form_input(array('name'=>'email2'),set_value('email2'));
		echo form_label('Senha');
		echo form_password(array('name'=>'senha'),set_value('senha'));
		echo form_label('Repita a senha');
		echo form_password(array('name'=>'senha2'),set_value('senha2'));
		echo form_label('CPF');
		echo form_input(array('name'=>'cpf'),set_value('cpf'));
		echo form_label('Nome');
		echo form_input(array('name'=>'nome'),set_value('nome'));
		echo form_label('Sobrenome');
		echo form_input(array('name'=>'sobrenome'),set_value('sobrenome'));
		echo form_label('Endereco');
		echo form_input(array('name'=>'endereco'),set_value('endereco'));
		echo form_label('Complemento');
		echo form_input(array('name'=>'complemento'),set_value('complemento'));
		
		echo form_label('Bairro');
		echo form_dropdown('bairro', $lstBairros);
		
		echo form_label('Cidade');
		echo form_dropdown('cidade', $lstCidades);
		
		echo form_label('Estado');
		echo form_dropdown('estado', $lstEstados);
		
		echo form_label('Pais');
		echo form_dropdown('pais', $lstPaises);
		
		echo form_label('CEP/ZIP Code');
		echo form_input(array('name'=>'cep'),set_value('cep'));
		
		echo form_label('Telefone');
		echo form_input(array('name'=>'telefone'),set_value('telefone'));
		echo form_label('Celular');
		echo form_input(array('name'=>'celular'),set_value('celular'));
		
		echo form_label('Convenios');
		echo form_dropdown('convenio', $lstConvenios);
		
		//Botao para envio
		echo form_submit(array('name'=>'cadastrar'),'Cadastrar');
		
	//Fecha o formulario
	echo form_close();