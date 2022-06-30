<?php
/**
 *
 */
class Login extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role']))
    {
      switch ($this->data['id_role'])
      {
        case 1:
          redirect('operator');
        break; 
        case 2:
          redirect('kurikulum');
        break;  
        case 3:
          redirect('bendahara');
        break; 
      }
      exit;
    }
    $this->load->model('Akun_m');
  }

  public function cek(){
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if($this->Akun_m->cek_login($email,$password) == 0){
      $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable">email tidak terdaftar!</div>');
        
        redirect('login');
        exit;
      }else if($this->Akun_m->cek_login($email,$password) == 1){
        setcookie('email_temp', $email, time() + 5, "/");
        $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable">Password Salah!</div>');
        redirect('login');
        exit;
      }
    redirect('login');
  }

  public function index() {  
    $this->load->view('sign-in');
  }
}

?>
