<?php

	echo '<h2>Entrar</h2>';
	
	//Inicializa $n�oLogado
	if ($this->session->flashdata('naoLogado')){
			echo '<p>' . $this->session->flashdata('naoLogado') . '</p>';
	}
	
	
	//Inicializa um formulario de login
	echo form_open('agenmed/login');
		
		//Imprime os erros de valida��o do formulario passados pelo Controller
		echo validation_errors('<p>', '</p>');
		
		//TODO: Tratamento de dados de session
		
		//Insere os campos
		echo form_label('Email');
		echo form_input(array('name'=>'email', set_value('email','wcampos5'), 'autofocus'));
		echo form_label('Senha');
		echo form_password(array('name'=>'senha'));
		echo form_submit(array('name'=>'login'),'Entrar');
	
	//Encerra o formulario
	echo form_close();