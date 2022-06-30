<?php 
class Piket_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_piket';
    $this->data['table_name'] = 'piket';
  } 
  
}

?>
