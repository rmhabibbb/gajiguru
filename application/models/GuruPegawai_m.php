<?php 
class GuruPegawai_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'nip';
    $this->data['table_name'] = 'guru_pegawai';
  } 
  
}

?>
