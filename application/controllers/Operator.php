<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends MY_Controller { 
	public function __construct()
	{
		parent::__construct();
		$this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
	    if (!$this->data['email'] || ($this->data['id_role'] != 1)){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable">Anda harus login dulu</div>');
        	redirect('login');
        	exit;
      	}  
		$this->load->model('Akun_m');
		$this->load->model('GuruPegawai_m');
		$this->load->model('Jabatan_m'); 
		$this->load->model('JamMengajar_m');
 
    	$this->data['profil'] = $this->Akun_m->get_row(['email' =>$this->data['email'] ]); 
	}
	public function index()
	{ 	  
		$this->data['index'] = 1;
		$this->data['content'] = 'operator/index';
		$this->load->view('operator/template/layout', $this->data);
	}

// KELOLA jammengajar ----------------------------------------
	public function jammengajar(){

		$this->data['list_data'] = $this->JamMengajar_m->get(['tgl_mengajar' => date('Y-m-d')]);
		$this->data['list_histori'] = $this->JamMengajar_m->get(['tgl_mengajar !=' => date('Y-m-d')]);
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 6;
		$this->data['content'] = 'operator/jammengajar';
		$this->load->view('operator/template/layout', $this->data);
	}

	public function add_jammengajar(){
		$data = [
			'nip' => $this->POST('nip'),
			'lama_mengajar' => $this->POST('lama_mengajar'),
			'tgl_mengajar' => date('Y-m-d')
		];

		if ($this->JamMengajar_m->insert($data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil ditambah.</div>');
			redirect('operator/jammengajar');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('operator/jammengajar');
			exit();
		}
	}
	 
	public function update_jammengajar(){ 
		$data = [
			'lama_mengajar' => $this->POST('lama_mengajar')
		];

		if ($this->JamMengajar_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil diedit.</div>');
			redirect('operator/jammengajar');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/jammengajar');
			exit();
		}
	}

	public function delete_jammengajar(){ 
		if ($this->JamMengajar_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data jam mengajar berhasil dihapus.</div>');
			redirect('operator/jammengajar');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/jammengajar');
			exit();
		}
	}
// KELOLA jammengajar ----------------------------------------


// KELOLA GURUPEGAWAI ----------------------------------------
	public function gurupegawai(){

		$this->data['list_data'] = $this->GuruPegawai_m->get(); 
		$this->data['list_jabatan'] = $this->Jabatan_m->get();
		$this->data['index'] = 2;
		$this->data['content'] = 'operator/gurupegawai';
		$this->load->view('operator/template/layout', $this->data);
	}

	public function add_gurupegawai(){

		if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}

		if ($this->GuruPegawai_m->get_num_row(['nip' => $this->POST('nip')])  !=  0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">NIP telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}

		$data = [
			'email' => $this->POST('email'),
			'password' => md5($this->POST('nip')),
			'role' => 4,
		];

		if ($this->Akun_m->insert($data)) {


			$data = [
				'nip' => $this->POST('nip'), 
				'email' => $this->POST('email'), 
				'nama' => $this->POST('nama'), 
				'alamat' => $this->POST('alamat'), 
				'tmpt_lahir' => $this->POST('tmpt_lahir'), 
				'tgl_lahir' => $this->POST('tgl_lahir'), 
				'jk' => $this->POST('jk'), 
				'telp' => $this->POST('telp'),  
				'id_jabatan' => $this->POST('id_jabatan'), 
				'status' => 1
			];

			if ($this->GuruPegawai_m->insert($data)) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data Guru/Pegawai berhasil ditambah.</div>');
				redirect('operator/gurupegawai');
				exit();
			}else{
				$this->Akun_m->delete($this->POST('email'));
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
				redirect('operator/gurupegawai');
				exit();	
			} 
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('operator/gurupegawai');
			exit();
		}
	}
	 
	public function update_gurupegawai(){ 
		if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_lama')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}

		if ($this->GuruPegawai_m->get_num_row(['nip' => $this->POST('nip')])  !=  0 && $this->POST('nip') != $this->POST('nip_lama')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">NIP telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}

		$data = [
			'email' => $this->POST('email') 
		];

		if ($this->Akun_m->update($this->POST('email_lama'),$data)) {


			$data = [
				'nip' => $this->POST('nip'),  
				'nama' => $this->POST('nama'), 
				'alamat' => $this->POST('alamat'), 
				'tmpt_lahir' => $this->POST('tmpt_lahir'), 
				'tgl_lahir' => $this->POST('tgl_lahir'), 
				'jk' => $this->POST('jk'), 
				'telp' => $this->POST('telp'),  
				'id_jabatan' => $this->POST('id_jabatan') 
			];

			if ($this->GuruPegawai_m->update($this->POST('nip_lama'),$data)) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data Guru/Pegawai berhasil diedit.</div>');
				redirect('operator/gurupegawai');
				exit();
			} 
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('operator/gurupegawai');
			exit();
		}


		redirect('operator/gurupegawai');
		exit();

		 
	}

	public function delete_gurupegawai(){ 
		if ($this->Akun_m->delete($this->POST('email'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data gurupegawai berhasil dihapus.</div>');
			redirect('operator/gurupegawai');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/gurupegawai');
			exit();
		}
	}
// KELOLA GURUPEGAWAI ----------------------------------------

 
// KELOLA JABATAN ----------------------------------------
	public function jabatan(){

		$this->data['list_data'] = $this->Jabatan_m->get();
		$this->data['index'] = 3;
		$this->data['content'] = 'operator/jabatan';
		$this->load->view('operator/template/layout', $this->data);
	}

	public function add_jabatan(){
		$data = [
			'nama_jabatan' => $this->POST('nama')
		];

		if ($this->Jabatan_m->insert($data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data Jabatan berhasil ditambah.</div>');
			redirect('operator/jabatan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('operator/jabatan');
			exit();
		}
	}
	 
	public function update_jabatan(){ 
		$data = [
			'nama_jabatan' => $this->POST('nama')
		];

		if ($this->Jabatan_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data jabatan berhasil diedit.</div>');
			redirect('operator/jabatan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/jabatan');
			exit();
		}
	}

	public function delete_jabatan(){ 
		if ($this->Jabatan_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data jabatan berhasil dihapus.</div>');
			redirect('operator/jabatan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/jabatan');
			exit();
		}
	}
// KELOLA JABATAN ----------------------------------------

// KELOLA PENGGUNA ----------------------------------------
	public function pengguna(){

		$this->data['list_data'] = $this->Akun_m->get(['role != ' => 4]);
		$this->data['index'] = 5;
		$this->data['content'] = 'operator/pengguna';
		$this->load->view('operator/template/layout', $this->data);
	}

	public function add_pengguna(){
		if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}


		$data = [
			'email' => $this->POST('email'),
			'password' => md5($this->POST('password')),
			'role' => $this->POST('role')
		];

		if ($this->Akun_m->insert($data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data pengguna berhasil ditambah.</div>');
			redirect('operator/pengguna');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('operator/pengguna');
			exit();
		}
	}
	 
	public function update_pengguna(){ 
		if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_lama')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('operator/gurupegawai');
			exit();
		}

		$data = [
			'email' => $this->POST('email'), 
			'role' => $this->POST('role')
		];

		if ($this->Akun_m->update($this->POST('email_lama'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data pengguna berhasil diedit.</div>');
			redirect('operator/pengguna');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/pengguna');
			exit();
		}
	}

	public function gantipass_pengguna(){ 
		if ($this->POST('pass1') != $this->POST('pass2')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Password tidak sama.</div>');
			redirect('operator/pengguna');
			exit();
		}
		$data = [ 
			'password' => md5($this->POST('pass2'))
		];

		if ($this->Akun_m->update($this->POST('email'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">password berhasil diedit.</div>');
			redirect('operator/pengguna');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/pengguna');
			exit();
		}
	}

	public function delete_pengguna(){ 
		if ($this->Akun_m->delete($this->POST('email'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data pengguna berhasil dihapus.</div>');
			redirect('operator/pengguna');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('operator/pengguna');
			exit();
		}
	}
// KELOLA PENGGUNA ----------------------------------------


// PROFIL
	public function profil(){ 
	    $this->data['index'] = 7;
		$this->data['content'] = 'operator/profil';
		$this->load->view('operator/template/layout', $this->data);
	 }

	public function proses_edit_profil(){
      if ($this->POST('edit')) { 
          if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('operator/profil');
			exit();
		}

          $this->Akun_m->update($this->POST('email_x'),['email' => $this->POST('email')   ]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('operator/profil');
          exit();

          } elseif ($this->POST('edit2')) { 

          	$msg = "";
          	$cek = 0;

          	if (md5($this->POST('pass')) != $this->data['profil']->password) {
				$msg = $msg . "Password lama salah! <br>";
				$cek = 1;
			}

			if ($this->POST('pass1') != $this->POST('pass2')) {
				$msg = $msg . "Konfirmasi Password baru tidak sama! <br>";
				$cek = 1;
			}


			if ($cek == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">'.$msg.'</div>');
				redirect('operator/profil');
				exit();
			}
            $data = [ 
              'password' => md5($this->POST('pass2')) 
            ];
            
            $this->Akun_m->update($this->data['email'],$data);
        
            $this->flashmsg('Password baru telah disimpan!', 'success');
            redirect('operator/profil');
            exit();    
          }  

          else{

          redirect('operator/profil');
          exit();
          }

    }
// PROFIL
}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */