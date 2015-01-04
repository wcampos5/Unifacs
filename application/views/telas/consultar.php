<?php

	
	

	echo '<h2>Lista de Usu&aacute;rios</h2>';
	
	echo validation_errors('<p>','<p>');
	//Verifica se tem dados na sessão
	if ($this->session->flashdata('excluirok')){
		echo '<p>' . $this->session->flashdata('excluirok') . '</p>';
	} elseif ($this->session->flashdata('editarok')){
		echo '<p>' . $this->session->flashdata('editarok') . '</p>';
	} elseif ($this->session->flashdata('missingId')){
		echo '<p>' . $this->session->flashdata('missingId') . '</p>';
	}
	
	//Adiciona o header da tabela
	echo $this->table->set_heading('ID', 'Email', 'Nome', 'Ação');
	
	foreach ($lstUsuarios as $linha) {
		
		$this->table->add_row($linha->id,
				$linha->email,
				$linha->nome,
				anchor("agenmed/editar/$linha->id",'Editar') . ' - ' . anchor("agenmed/excluir/$linha->id",'Excluir')
				);
		
	}
	
	echo $this->table->generate();