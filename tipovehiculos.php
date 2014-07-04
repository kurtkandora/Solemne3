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
		$tablatipovehiculos='';
        $datos_usuario;
        session_start();
        if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:inicio.php');
            exit();
        } else {
        	require_once 'modelo/dbo_model/tipo_de_vehiculoDAO.php';
            $usuario = $_SESSION['usuario'];
			$titulo = 'Mantenedor Tipo Vehiculos';
			$listaTipoVehiculos = '';
			$TipoVehiculoDAO= new tipo_de_vehiculoDAO();
            $listaTipoVehiculos = $vehiculoDAO->listarTipoVehiculos();
			for ($i=0; $i < sizeof($listaTipoVehiculos); $i++) {
                $tablatipovehiculos.='<tr><td>'.$listaTipoVehiculos[$i]->id_tipo_vehiculo.'</td><td>'.$listaTipoVehiculos[$i]->nombre_tipo_vehiculo.'</td><td>'.
                					  $listaTipoVehiculos[$i]->descripcion_tipo_vehiculo.'</td>';
                $tablatipovehiculos.='<td><form action="controlador/eliminarTipoVehiculo.php" method="post" ><input type="hidden" name="id_tipo_vehiculo" id="id_tipo_vehiculo" value="'
                                      .$listaTipoVehiculos[$i]->id_tipo_vehiculo.'"/>
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
                     <h2>Registrar Tipo Vehiculos</h2>
                </li>
                <li>
                    <label for="nombretipo">Tipo Vehiculo</label>
                    <input type="text" name="nombretipo" id="nombretipo" placeholder="4x4" onblur="validarnombre()"  />
                    <span id="errnombre" style="color:red"></span>
                </li>
               <li>
				<label name="lblingreso">Descripcion</label>
				<textarea name="txtmensaje" cols="50" rows="6" id="txtmensaje"> </textarea>
				</li>
               <li> <button class="submit" type="submit" name="submit">Guardar</button></li>
             </ul>
             </form>';
            
			$front='<form class="formularioactuariza" action="controlador/registro.php" method="post" onsubmit="return validarFormulario()">
            <table>
            <thead>
                <tr>
                <th>ID Tipo Vehiculo</th>
                <th>Nombre Tipo Vehiculo</th>
                <th>Descripcion Tipo Vehiculo<th>
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