<?php 
class Potongan_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_potongan';
    $this->data['table_name'] = 'potongan';
  } 
  
  public function  get_potongan($jenis,$nip,$bulan,$tahun){
  		$query = $this->db->query('SELECT sum(nominal) as sum from potongan WHERE nip="'.$nip.'"  and month(tgl)="'.$bulan.'" and year(tgl)="'.$tahun.'" and jenis="'.$jenis.'"'); 
		return $query->row()->sum; 
	}

}

?>
