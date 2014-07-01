<?php
    class Validaciones{
    	public function validarCorreo($value)
		{
			 if (! preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $value)) {
	            return FALSE;
            
               }else{
               	return TRUE;
				
               }
		}
		public function validarNombre($value)
		{
			 if(! preg_match('/([a-z ñáéíóú]{2,60})$/', $value)) {
	            return FALSE;
				 
              } else{
              	return TRUE;
				
              } 
		}
		public function validaraApellido($value)
		{
			 if(! preg_match('/([a-z ñáéíóú]{2,60})$/', $value)) {
	            return FALSE;
				 
              } else{
              	return TRUE;
				
              } 
		}
    }
?>