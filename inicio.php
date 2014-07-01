 <?php {
	    require_once './libsigma/Sigma.php';
	   
	
	 	$plantilla = new HTML_Template_Sigma('vista/plantilla/');
		$plantilla->loadTemplateFile('sitio.tlp.html');
		
		$titulo='Motor Mosquito';
		$titulo_front='<h2>Bienvenido</h2>
            		   <p>
            		   Queremos atender en forma agil sus requerimientos, ofrecer el mejor servicio en motores.
					   Esta pagina web le permite mantener de manera eficiente los motores, vehiculos y usuarios.
					   Para proceder tiene que logearse.
            		   </p>';
		
		$front_table = '
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
	     </form>	';
		 
		 $front='<p>
							  Motores mosquitos, la mejor empresa de vehiculos del pais.
                          </p>';
		 
	    $plantilla->setVariable('titulo',$titulo);
	    $plantilla->setVariable('titulo_front',$titulo_front);
	    $plantilla->setVariable('front_table',$front_table);
	    $plantilla->setVariable('front',$front);
	    $plantilla->parse();
	    $plantilla->show();
    }
  
?>