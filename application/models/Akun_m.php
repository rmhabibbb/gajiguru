<?php

class Akun_m extends MY_Model{

  	protected $data = [];
	public function __construct(){
		parent::__construct();
		$this->data['table_name'] 	= 'akun';
    	$this->data['primary_key']	= 'email';
	}
	
	public function cek_login($email,$password){

	    $this->db->where(['email' => $email ]);
	    $user_data = $this->db->get($this->data['table_name'])->row(); 
		if(isset($user_data)){
			if ($user_data->password == md5($password)) {

				 
				$user_session = [
					'email'	=> $user_data->email, 
					'id_role'	=> $user_data->role 
				];
				$this->session->set_userdata($user_session);
				return 2;
			}else {
				return 1;
			}
		}
		return 0;
	}
}