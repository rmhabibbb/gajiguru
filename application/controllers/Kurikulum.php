<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends MY_Controller { 
	public function __construct()
	{
		parent::__construct();
		$this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
	    if (!$this->data['email'] || ($this->data['id_role'] != 2)){
			$this->session->set_flashdata('msg2', '<div class="alert alert-danger alert-dismissable">Anda harus login dulu</div>');
        	redirect('login');
        	exit;
      	}  


		$this->load->model('Akun_m');
		$this->load->model('GuruPegawai_m');
		$this->load->model('Jabatan_m');
		$this->load->model('Golongan_m');
		$this->load->model('JamMengajar_m');
		$this->load->model('Wk_m');
		$this->load->model('Piket_m');
 
    	$this->data['profil'] = $this->Akun_m->get_row(['email' =>$this->data['email'] ]); 
    	date_default_timezone_set("Asia/Jakarta");
 
	}
	public function index()
	{ 	
 
		$this->data['index'] = 1; 
		$this->data['content'] = 'kurikulum/index';
		$this->load->view('kurikulum/template/layout', $this->data);
	}
 	
// KELOLA jammengajar ----------------------------------------
	public function jammengajar(){

		$this->data['list_data'] = $this->JamMengajar_m->get(['tgl_mengajar' => date('Y-m-d')]);
		$this->data['list_histori'] = $this->JamMengajar_m->get(['tgl_mengajar !=' => date('Y-m-d')]);
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 2;
		$this->data['content'] = 'kurikulum/jammengajar';
		$this->load->view('kurikulum/template/layout', $this->data);
	}

	public function add_jammengajar(){
		$data = [
			'nip' => $this->POST('nip'),
			'lama_mengajar' => $this->POST('lama_mengajar'),
			'tgl_mengajar' => date('Y-m-d')
		];

		if ($this->JamMengajar_m->insert($data)) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil ditambah.</div>');
			redirect('kurikulum/jammengajar', 'refresh');
			exit();
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('kurikulum/jammengajar');
			exit();
		}
	}
	 
	public function update_jammengajar(){ 
		$data = [
			'lama_mengajar' => $this->POST('lama_mengajar')
		];

		if ($this->JamMengajar_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil diedit.</div>');
			redirect('kurikulum/jammengajar');
			exit();
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('kurikulum/jammengajar');
			exit();
		}
	}

	public function delete_jammengajar(){ 
		if ($this->JamMengajar_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil dihapus.</div>');
			redirect('kurikulum/jammengajar');
			exit();
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('kurikulum/jammengajar');
			exit();
		}
	}
// KELOLA jammengajar ----------------------------------------


// KELOLA walikelas ----------------------------------------
	public function walikelas(){

		$this->data['list_data'] = $this->Wk_m->get(); 
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 3;
		$this->data['content'] = 'kurikulum/walikelas';
		$this->load->view('kurikulum/template/layout', $this->data);
	}

	public function add_walikelas(){

		 
		$data = [
			'kelas' => $this->POST('kelas'),
			'nip' => $this->POST('nip'),
			'keterangan' => $this->POST('keterangan')
		];

		if ($this->Wk_m->insert($data)) {
 
				$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data Wali kelas berhasil ditambah.</div>');
				redirect('kurikulum/walikelas');
				exit();
			 
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('kurikulum/walikelas');
			exit();
		}
	}
	 
	public function update_walikelas(){ 
	 
		$data = [
			'kelas' => $this->POST('kelas'), 
			'keterangan' => $this->POST('keterangan')
		];

		if ($this->Wk_m->update($this->POST('id'),$data)) { 
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data Wali kelas berhasil diedit.</div>');
			redirect('kurikulum/walikelas');
			exit(); 
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('kurikulum/walikelas');
			exit();
		}


		redirect('kurikulum/walikelas');
		exit();

		 
	}

	public function delete_walikelas(){ 
		if ($this->Wk_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data walikelas berhasil dihapus.</div>');
			redirect('kurikulum/walikelas');
			exit();
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('kurikulum/walikelas');
			exit();
		}
	}
// KELOLA walikelas ----------------------------------------

// KELOLA piket ----------------------------------------
	public function piket(){

		$this->data['list_data'] = $this->Piket_m->get(); 
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 4;
		$this->data['content'] = 'kurikulum/piket';
		$this->load->view('kurikulum/template/layout', $this->data);
	}

	public function add_piket(){

		 
		$data = [
			'hari_piket' => $this->POST('hari_piket'),
			'nip' => $this->POST('nip'),
			'keterangan' => $this->POST('keterangan')
		];

		if ($this->Piket_m->insert($data)) {
 
				$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data Piket berhasil ditambah.</div>');
				redirect('kurikulum/piket');
				exit();
			 
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('kurikulum/piket');
			exit();
		}
	}
	 
	public function update_piket(){ 
	 
		$data = [
			'hari_piket' => $this->POST('hari_piket'), 
			'keterangan' => $this->POST('keterangan')
		];

		if ($this->Piket_m->update($this->POST('id'),$data)) { 
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data Piket  berhasil diedit.</div>');
			redirect('kurikulum/piket');
			exit(); 
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('kurikulum/piket');
			exit();
		}


		redirect('kurikulum/piket');
		exit();

		 
	}

	public function delete_piket(){ 
		if ($this->Piket_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-success alert-dismissable">Data piket berhasil dihapus.</div>');
			redirect('kurikulum/piket');
			exit();
		}else{
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('kurikulum/piket');
			exit();
		}
	}
// KELOLA piket ----------------------------------------



// PROFIL
	public function profil(){ 
	    $this->data['index'] = 7;
		$this->data['content'] = 'kurikulum/profil';
		$this->load->view('kurikulum/template/layout', $this->data);
	 }

	public function proses_edit_profil(){
      if ($this->POST('edit')) { 
          if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
			$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('kurikulum/profil');
			exit();
		}

          $this->Akun_m->update($this->POST('email_x'),['email' => $this->POST('email')   ]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg2('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('kurikulum/profil');
          exit();

          } elseif ($this->POST('edit2')) { 

          	$msg2 = "";
          	$cek = 0;

          	if (md5($this->POST('pass')) != $this->data['profil']->password) {
				$msg2 = $msg2 . "Password lama salah! <br>";
				$cek = 1;
			}

			if ($this->POST('pass1') != $this->POST('pass2')) {
				$msg2 = $msg2 . "Konfirmasi Password baru tidak sama! <br>";
				$cek = 1;
			}


			if ($cek == 1) {
				$this->session->set_flashdata('msg2', '<div class="alert alert-warning alert-dismissable">'.$msg2.'</div>');
				redirect('kurikulum/profil');
				exit();
			}
            $data = [ 
              'password' => md5($this->POST('pass2')) 
            ];
            
            $this->Akun_m->update($this->data['email'],$data);
        
            $this->flashmsg2('Password baru telah disimpan!', 'success');
            redirect('kurikulum/profil');
            exit();    
          }  

          else{

          redirect('kurikulum/profil');
          exit();
          }

    }
// PROFIL
}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */