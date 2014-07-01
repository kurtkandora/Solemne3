/**
 * @author David
 */

function validarnombre() {
	var nombre = document.getElementById("nombre").value;
    var patrondenombre = /([a-z ñáéíóú]{2,60})$/;
    if ((nombre.match(patrondenombre)) && (nombre.toString()!='')) {
        document.getElementById("errnombre").innerHTML='';
         return true;
    } else {
		document.getElementById("errnombre").innerHTML='(*)';
		 return false;
      } 
    }
function validarapellido() {
	var apellido = document.getElementById("apellido").value;
    var patrondeapellido = /([a-z ñáéíóú]{2,60})$/;
    if ((apellido.match(patrondeapellido)) && (apellido.toString()!='')) {
        document.getElementById("errapellido").innerHTML='';
         return true;
    } else {
		document.getElementById("errapellido").innerHTML='(*)';
		 return false;
      } 
    }
function validarcorreo() {
	var correo = document.getElementById("correo").value;
    var patrondecorreo = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if ((correo.match(patrondecorreo)) && (correo.toString()!='')) {
        document.getElementById("errcorreo").innerHTML='';
         return true; 
    } else {
		document.getElementById("errcorreo").innerHTML='(*)';
         return false;
      } 
    }

function validarFormulario(){
	
	var formulario = false;
	formulario = validarnombre();
	if(formulario){
		formulario = validarapellido();
		if(formulario){
	      formulario = validarcorreo();
	      if(formulario){
	      	formulario = validarcorreo();
	       }
	    }
	}
	return formulario; 
}
