<!-- Abertura do body...fechamento no footer.php -->
    <body>
    	<!-- Inicio de body -->
    	
    	<h1>
    		<center>Agenmed System
    			<p>(volte em breve)</p>
    			
    		</h3>
    		</center>
    	</h1>
    	
    	
    	<?php 
    	//Adiciona o formulario para pesquisa de especialidades
    	echo form_open('agenmed/search');
    	
    		//Imprime os erros de validação do formulario passados pelo Controller
    		echo validation_errors('<p>', '</p>');
    	
    		//Campos
    		echo form_label('Especialidade');
    		echo form_dropdown('especialidade','a,b','Dentista');
    		
    		echo form_label('Onde?');
    		echo form_dropdown('especialidade','','Bahia');
    		
    		echo form_label('Convenio');
    		echo form_dropdown('convenio','','Rede Publica');
    	echo form_close();
    	?>
    	
    		
    	
    