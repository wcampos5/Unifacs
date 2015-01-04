<?php 
if ($this->session->userdata('username')){
	echo '<p>' . $this->session->userdata('username') . '</p>';
}
?>

<h1>Menu</h1>
<ul>
	<li><?php echo anchor('agenmed/index', 'Pagina Inicial')?></li>
	<li><?php echo anchor('agenmed/about', 'Quem Somos')?></li>
	<li><?php echo anchor('agenmed/', 'Dicas de Saúde')?></li>
	<li><?php echo anchor('agenmed/', 'Profissionais de Saúde')?></li>
	<li><?php echo anchor('agenmed/login', 'Entrar')?></li>
	<li><?php echo anchor('agenmed/create', 'Cadastre-se')?></li>
	<?php 
		if ($this->session->userdata('session_username')){
			echo '<p>' . $this->session->userdata('session_username') . ' Logado' . '</p>';
		}
    ?>
	
</ul>