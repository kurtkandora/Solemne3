<?php
    abstract class DBAbstractModel{
	# metodos abstractos 
	
	abstract protected function exist($obj);
	abstract protected function insert($obj);
	abstract protected function update($obj);
	abstract protected function delete($obj);
    abstract protected function selectAll();
     
  }  
?>