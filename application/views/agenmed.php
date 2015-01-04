<?php 

	//Monta o site
	$this->load->view('includes/header.php');
	$this->load->view('includes/menu.php');
	//Caso receba a variavel $tela do array dentro do controlador
	if ($tela!=''){
		$this->load->view('telas/' . $tela);
	} else {
		$this->load->view('telas/home.php');
	}
	$this->load->view('includes/footer.php');
