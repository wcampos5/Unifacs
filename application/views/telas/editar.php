<?php

/**
 * Variavel $userId recebe o id do usuário lendo o 3o segmento da url agenmed/consutar opcao editar
 */
$userId = $this->uri->segment(3);

//Verifica se userId recebeu algo
if ($userId==NULL){
	//Se for nulo redireciona para consultar para que o usuario selecionar um id existente
	$this->session->set_flashdata('missingId', 'Por favor selecione um usuário para edição!!!');
	redirect('agenmed/consultar');
	
} else {
	//Executa uma busca utilizando a função get_byId do model
	$query = $this->Crud_model->get_byId($userId)->row();
}




//Inicia o formulario
	echo form_open("agenmed/editar/$userId");
		//Imprime os error de validação do formulário recebidos
		echo validation_errors('<p>','<p>');
		//Verifica se tem dados na sessão
		if ($this->session->flashdata('edicaook')){
			echo '<p>' . $this->session->flashdata('edicaook') . '</p>';
		}
		//Insere os campos
		echo form_label('Email');
		echo form_input(array('name'=>'email'),set_value('email', $query->email));
		echo form_label('Nome');
		echo form_input(array('name'=>'nome'),set_value('nome', $query->nome),'autofocus');
		echo form_label('Sobrenome');
		echo form_input(array('name'=>'sobrenome'),set_value('sobrenome', $query->sobrenome));
		echo form_label('Endereco');
		echo form_input(array('name'=>'endereco'),set_value('endereco', $query->endereco));
		echo form_label('Complemento');
		echo form_input(array('name'=>'complemento'),set_value('complemento', $query->complemento));
		echo form_label('Telefone');
		echo form_input(array('name'=>'telefone'),set_value('telefone', $query->telefone));
		echo form_label('Celular');
		echo form_input(array('name'=>'celular'),set_value('celular', $query->celular));
		echo form_label('Convenio');
		echo form_input(array('name'=>'idConvenio'),set_value('idConvenio', $query->idConvenio));
		//Botao para envio
		echo form_submit(array('name'=>'editar'),'Editar');
		
		//Passa os parametros de maneira oculta
		echo form_hidden('h_idUsuario', $query->id);	//$query->id Para garantir que é o mesmo valor que está no Banco de Dados
	//Fecha o formulario
	echo form_close();
