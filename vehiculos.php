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
		$tablavehiculos='';
        $datos_usuario;
        session_start();
        if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:inicio.php');
            exit();
        } else {
        	require_once '/modelo/dbo_model/tipo_de_vehiculoDAO.php';
            $usuario = $_SESSION['usuario'];
			$titulo = 'Mantenedor Vehiculos';
			$listaVehiculos = '';
			for ($i=0; $i < sizeof($listaVehiculos); $i++) {
                $tablavehiculos.='<tr><td>'.$listaVehiculos[$i]->id_vehiculo.'</td><td>'.$listaVehiculos[$i]->id_tipo_vehiculo.'</td><td>'.$listaVehiculos[$i]->fabricante_vehiculo.'</td>
                <td>'.$listaVehiculos[$i]->modelo_vehiculo.'</td><td>'.$listaVehiculos[$i]->anio_fabricacion.'</td><td>'.$listaVehiculos[$i]->descripcion_vehiculo.'</td>';
                $tablavehiculos.='<td><form action="controlador/eliminarUsuario.php" method="post" ><input type="hidden" name="id_usuarioel" id="id_usuarioel" value="'.$listaVehiculos[$i]->id_vehiculo.'" />
				<input type="submit" name="eliminar"></input></form></tr>';
            }
		 $titulo_front = '<h2>Bienvenido</h2>
							<p>En esta pagina usted podra agregar, eliminar
							   y mofidicar los vehiculos de la empresa.
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
			
            $front_table = '<form class="formularioregistroVehiculos" action="controlador/registro.php" method="post" onsubmit="return validarFormulario()">
             <ul>
                <li>
                     <h2>Registrar Vehiculos</h2>
                </li>
                <li>
                    <label for="idvehiculo">ID Tipo Vehiculo</label>
                    <input type="text" name="idtipo" id="idtipo" placeholder="1" onblur="validarnumero()"  />
                    <span id="errnum" style="color:red"></span>
                </li>
                <li>
                    <label for="fabricante">Fabricante Vehiculo</label>
                    <input type="text" name="fabricante" id="fabricante" placeholder="Toyota" onblur="validarnombre()"  />
                    <span id="errnombre" style="color:red"></span>
                </li>
                <li>
                    <label for="modelo">Modelo Vehiculo</label>
                    <input type="text" name="modelo id="modelo" placeholder="L2000" onblur="validarnombre()"  />
                    <span id="errnombre" style="color:red"></span>
                </li>
                <li>
                    <label for="anofabrica">Año Fabricacion</label>
                    <input type="text" name="anofabrica" id="anofabrica" placeholder="01-01-2000" onblur="asdsaasd"  />
                    <span id="errfecha" style="color:red"></span>
                </li>
                <li>
                	<label name="lblingreso">Mensaje</label>
				    <textarea name="txtmensaje" cols="50" rows="6" id="txtmensaje"> </textarea>
                </li>
                 <button class="submit" type="submit" name="submit">Guardar</button>
             </ul>
             </form>';
            
			$front='<form class="formularioactuariza" action="controlador/registro.php" method="post" onsubmit="return validarFormulario()">
            <table>
            <thead>
                <tr>
                <th>ID Vehiculo</th>
                <th>ID Tipo Vehiculo</th>
                <th>Fanbricante Vehiculo</th>
                <th>Modelo Vehiculo</th>
                <th>Año Fabricacion/th>
                <th>Descripcion Vehiculo<th>
                </tr>
            </thead>
            <tbody>
               '. $tablavehiculos.'
            </tbody>
            </table>
            </form>';
        
		}
		 
		 
                                
                          
         
		 
	    $plantilla->setVariable('titulo',$titulo);
	    $plantilla->setVariable('titulo_front',$titulo_front);
	    $plantilla->setVariable('front_table',$front_table);
	    $plantilla->setVariable('front',$front);
	    $plantilla ->setVariable('barra_navegacion', $menu);
	    $plantilla->parse();
	    $plantilla->show();
	}  
?>