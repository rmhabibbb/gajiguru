<?php
$data =[ 
  'index' => $index
];
$this->load->view('bendahara/template/header',$data);
$this->load->view('bendahara/template/navbar');
$this->load->view('bendahara/template/sidebar',$data);
$this->load->view($content);
$this->load->view('bendahara/template/footer');
 ?>
