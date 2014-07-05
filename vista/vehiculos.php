 <?php 
 

 		if(!file_exists('../config.txt'))
        {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:../controlador/modificarTablas.php'); 
        }
    else{
        
    require_once 'libsigma/Sigma.php';
        $plantilla = new HTML_Template_Sigma('plantilla/');
        $plantilla -> loadTemplateFile('sitio.tlp.html');
		$tablavehiculos='';
        $datos_usuario;
        session_start();
        if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location:inicio.php');
            exit();
        } else {
        	require_once '../modelo/dbo_model/vehiculoDAO.php';
			require_once '../modelo/dbo_model/tipo_de_vehiculoDAO.php';
            $usuario = $_SESSION['usuario'];
			$titulo = 'Mantenedor Vehiculos';
            $vehiculoDAO= new vehiculoDAO();
			$listaVehiculos = $vehiculoDAO->selectAll();
            if(sizeof($listaVehiculos)>0)
            {
			for ($i=0; $i < sizeof($listaVehiculos); $i++) {
                $tablavehiculos.='<tr><td>'.$listaVehiculos[$i]->id_vehiculo.'</td><td>'.$listaVehiculos[$i]->nombre_tipo_vehiculo.'</td><td>'.$listaVehiculos[$i]->fabricante_vehiculo.'</td>
                <td>'.$listaVehiculos[$i]->modelo_vehiculo.'</td><td>'.$listaVehiculos[$i]->anio_fabricacion.'</td><td>'.$listaVehiculos[$i]->descripcion_vehiculo.'</td>';
                $tablavehiculos.='<td><a href="../mantenedorVehiculo.php?del='.$listaVehiculos[$i]->id_vehiculo.'">
            Eliminar</a></td></tr>';
            }
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
		
		$tipo_vehiculoDAO= new tipo_de_vehiculoDAO();	
		$lista_tipo_vehiculo = $tipo_vehiculoDAO -> selectAll();
		
		$front_table ='<form class="formulario" action="../controlador/mantenedorVehiculo.php" method="post" onsubmit="return validarFormulario()">
						<ul>
                			<li>
                    			 <h2>Registrar Vehiculos</h2>
                			</li>';
        $size_tipo = sizeof($lista_tipo_vehiculo);
        $listatipos='';
        if ($size_tipo > 0) {
            for ($i = 0; $i < $size_tipo; $i++) {
                $listatipos .= '<option value="' . $lista_tipo_vehiculo[$i] -> id_tipo_vehiculo . '">' . $lista_tipo_vehiculo[$i] -> nombre_tipo_vehiculo . '</option>';
            }
        }	
			
            $front_table .= '
                <li>
                    <label for="nombretipo">ID Vehiculo</label>
                    <input type="text" placeholder="Ingresar uno para actualizar" name="id_vehiculo" id="id_vehiculo" placeholder="4x4" />
                </li>
                <li>
                <label for="nombretipo">Tipo Vehiculo</label>
                    <select id="id_tipo_vehiculo" name="id_tipo_vehiculo" ><option value="none" selected="selected">-- Tipo --</option>'.$listatipos.'
                    </select>
                </li>
                <li>
                    <label for="fabricante">Fabricante</label>
                    <input type="text" name="fabricante_vehiculo" id="fabricante_vehiculo" placeholder="Toyota" onblur="validarnombre()"  />
                    <span id="errnombre" style="color:red"></span>
                </li>
                <li>
                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo_vehiculo id="modelo_vehiculo" placeholder="L2000" required  />
                    <span id="errnombre" style="color:red"></span>
                </li>
                <li>
                    <label for="anofabrica">Año Fabricacion</label>
                    <input type="text" name="anio_fabricacion" id="anio_fabricacion" placeholder="01-01-2000" required"  />
                    <span id="errfecha" style="color:red"></span>
                </li>
                <li>
                	<label name="lblingreso">Descripcion</label>
				    <textarea name="descripcion_vehiculo" cols="50" rows="6" id="descripcion_vehiculo" required>  </textarea>
                </li>
                 <button class="submit" type="submit" name="submit">Guardar</button>
             </ul>
             </form>';
			 
			 
			         
			$front='<table>
            <thead>
                <tr>
                <th>ID Vehiculo</th>
                <th>Tipo Vehiculo</th>
                <th>Fanbricante Vehiculo</th>
                <th>Modelo Vehiculo</th>
                <th>Fabricacion</th>
                <th>Descripcion Vehiculo<th>
                </tr>
            </thead>
            <tbody>
               '. $tablavehiculos.'
            </tbody>
            </table>';
			
			
			
			
        
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