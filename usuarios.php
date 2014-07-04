 <?php 
 

 		if(!file_exists('config.txt'))
        {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:controlador/modificarTablas.php'); 
        }
    else{
        
    require_once 'vista/libsigma/Sigma.php';
        $plantilla = new HTML_Template_Sigma('vista/plantilla/');
        $plantilla -> loadTemplateFile('sitio.tlp.html');
		$tablausuarios='';
        $datos_usuario;
        session_start();
        if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:inicio.php');
            exit();
        } else {
        	require_once 'modelo/dbo_model/usuariosDAO.php';
            $usuario = $_SESSION['usuario'];
			$titulo = 'Mantenedor Usuarios';
			$listausuarios = '';
			$usuariosDAO= new usuariosDAO();
            $listausuarios = $usuariosDAO->listarUsuarios();
			for ($i=0; $i < sizeof($listausuarios); $i++) {
                $tablausuarios.='<tr><td>'.$listausuarios[$i]->id_usuario.'</td><td>'.$listausuarios[$i]->nombre.'</td><td>'.
                					  $listausuarios[$i]->correo.'</td><td>'.$listausuarios[$i]->password.'/<td>';
                $tablausuarios.='<td><form action="controlador/eliminarTipoVehiculo.php" method="post" ><input type="hidden" name="id_usuarios id="id_usuarios" value="'
                                      .$listausuarios[$i]->id_usuarios.'"/>
				                      <input type="submit" name="eliminar"></input></form></tr>';
            }
		 $titulo_front = '<h2>Bienvenido</h2>
							<p>En esta pagina usted podra agregar, eliminar
							   y mofidicar los tipos vehiculos de la empresa.
							</p>';
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
			
            $front_table = '<form class="formulario" action="controlador/registro.php" method="post" onsubmit="return validarFormulario()">
             <ul>
                <li>
                     <h2>Registrar Usuarios</h2>
                </li>
                <li>
                    <label for="nombre>Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Angelo Fecci" onblur="validarnombre()"  />
                    <span id="errnombre" style="color:red"></span>
                </li>
                <li>
                    <label for="correo">Correo Electronico</label>
                    <input type="text" name="correo" id="correo" placeholder="angelo.fecci@gmail.com" onblur="validarcorreo()"  />
                    <span id="errcorreo" style="color:red"></span>
                </li>
                <li>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password"  id="password" placeholder="Contraseña" onblur="validarcontrasena()"  />
                    <span id="errcontrasena1" style="color:red"></span>
                </li>
                <li>
                    <label for="password2">Repetir Contraseña</label>
                    <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" onblur="validarcontrasenas()"  />
                    <span id="errcontrasena2" style="color:red"></span>
                </li>
               <li> <button class="submit" type="submit" name="submit">Guardar</button></li>
             </ul>
             </form>';
            
			$front='<form class="formularioactuariza" action="controlador/registro.php" method="post" onsubmit="return validarFormulario()">
            <table>
            <thead>
                <tr>
                <th>ID Usuarios</th>
                <th>Nombre</th>
                <th>Correo</th>
                <td>Password</th>
                </tr>
            </thead>
            <tbody>
               '. $tablatipovehiculos.'
            </tbody>
            </table>
            </form>';
        
		}
		 
		 
                                
                          
         
		 
	    $plantilla->setVariable('titulo',$titulo);
	    $plantilla->setVariable('titulo_front',$titulo_front);
	    $plantilla->setVariable('front_table',$front_table);
	    $plantilla->setVariable('front',$front);
	    $plantilla -> setVariable('barra_navegacion', $menu);
	    $plantilla->parse();
	    $plantilla->show();
}
?>