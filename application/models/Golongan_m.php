<?php 
class Golongan_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_golongan';
    $this->data['table_name'] = 'golongan';
  } 
  
}

?>
