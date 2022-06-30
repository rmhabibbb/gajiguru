<?php
$data =[ 
  'index' => $index
];
$this->load->view('kurikulum/template/header',$data);
$this->load->view('kurikulum/template/navbar');
$this->load->view('kurikulum/template/sidebar',$data);
$this->load->view($content);
$this->load->view('kurikulum/template/footer');
 ?>
