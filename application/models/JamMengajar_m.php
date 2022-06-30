<?php 
class JamMengajar_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'jam_mengajar';
  } 
  
  	public function  get_njam($nip,$bulan,$tahun){
  		$query = $this->db->query('SELECT sum(lama_mengajar) as n from jam_mengajar WHERE nip="'.$nip.'"  and month(tgl_mengajar)="'.$bulan.'" and year(tgl_mengajar)="'.$tahun.'"'); 
		return $query->row()->n; 
	}

	
}

?>
