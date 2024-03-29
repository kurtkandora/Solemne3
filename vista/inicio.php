 <?php 
if (!file_exists('../config.txt')) {
        header('Status: 301 Moved Permanently', false, 301);
        header('Location:../controlador/modificarTablas.php');
    } else {


	    require_once 'libsigma/Sigma.php';
	   
	 	$plantilla = new HTML_Template_Sigma('plantilla/');
		$plantilla->loadTemplateFile('sitio.tlp.html');
		
		$titulo='Motor Mosquito';
		$titulo_front='<h2>Bienvenido</h2>
            		   <p>
            		   Queremos atender en forma agil sus requerimientos, ofrecer el mejor servicio en motores.
					   Esta pagina web le permite mantener de manera eficiente los motores, vehiculos y usuarios.
					   Para proceder tiene que logearse.
            		   </p>';

        session_start();
        if (isset($_SESSION['usuario'])) {
            $front_table = '<span class="picContainer picImg"><img src="plantilla/imagenes/motor.jpg" class="imgimportada" ></span>
            				<h2>Felicidades</h2>
							<p>Inicio de sesion correcto.
							 Bienvenido Sr(a). '.$_SESSION['usuario'].'</p>
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />';
			
			$menu = '<ul id="menu">
					    <li><a href="inicio.php">Home</a></li>
					    <li>
					        <a href="#">Mantenedor</a>
					        <ul>
					            <li><a href="usuarios.php">Usuarios</a></li>
					            <li><a href="tipovehiculos.php">Tipo Vehiculos</a></li>
					            <li><a href="vehiculos.php">Vehiculos</a></li>
					        </ul>
					    </li>
					    <li><a href="logout.php">Cerrar Sesion</a></li>
					</ul>';
            
        } else {
		$front_table = '<span class="picContainer picImg"><img src="plantilla/imagenes/motor.jpg" class="imgimportada" ></span>
		<form class="formulario" action="../controlador/autentificar.php" method="post" onsubmit="validarFormulario()">
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
	            <button class="submit" type="submit" name="submit">Entrar</button>
	        </li>
	     </ul>
	     </form>	';
		$menu = '<ul id="menu">
			    <li><a href="inicio.php">Home</a></li>
			</ul>';
		}
		 
		 $front='<center><h3> Motores mosquitos, la mejor empresa de vehiculos del pais. <h3></center>';
        
		
	    $plantilla->setVariable('titulo',$titulo);
	    $plantilla->setVariable('titulo_front',$titulo_front);
	    $plantilla->setVariable('front_table',$front_table);
	    $plantilla->setVariable('front',$front);
	    $plantilla -> setVariable('barra_navegacion', $menu);
	    $plantilla->parse();
	    $plantilla->show();
	    }
?>