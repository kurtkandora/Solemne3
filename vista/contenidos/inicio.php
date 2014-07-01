 <?php {
	    require_once '../vista/libsigma/Sigma.php';
	   
	
	 	$plantilla = new HTML_Template_Sigma('vista/plantilla/');
		$plantilla->loadTemplateFile('sitio.tlp.html');
		
		$titulo_pagina='Biblioteca Nacional';
		$titulo_front='Biblioteca Nacional';
		$subtitulo_font='La vida es una biblioteca, nunca sabes que libro te va a tocar';
		
		$formulario_front = '
		<form class="formulario" action="./vista/validaciones.php" method="post" onsubmit="return validarFormauth()">
	     <ul>
	        <li>
	            <h2>Iniciar Sesión</h2>
	        </li>
			<li>
	            <input type="text" name="authcorreo" id="correoauth" placeholder="Correo Electronico" onblur="validarCorreo()" required />
	            <span id="errcorreo_auth" style="color:red"></span>
	        </li>
	        <li>
	            <input type="password" name="authpassword" id="passwordauth" placeholder="Contraseña" onblur="validarcontrasenaauth()" required />
	            <span id="errcontrasena_auth" style="color:red"></span>
	        </li>
	        <li>
	            <button class="submit" type="submit" name="submit">Iniciar</button>
	        </li>
	     </ul>
	     </form>
		
		';
	    $plantilla->setVariable('titulo',$titulo_pagina);
	    $plantilla->setVariable('titulo_front',$titulo_front);
	    $plantilla->setVariable('sub_titulo_front',$subtitulo_font);
	    $plantilla->setVariable('front',$formulario_front);
	    $plantilla->setVariable('columna',$formulario_columna);
	    $plantilla->parse();
	    $plantilla->show();
    }
  
?>