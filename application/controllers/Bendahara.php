<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bendahara extends MY_Controller { 
	public function __construct()
	{
		parent::__construct();
		$this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
	    if (!$this->data['email'] || ($this->data['id_role'] != 3)){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable">Anda harus login dulu</div>');
        	redirect('login');
        	exit;
      	}  

		$this->load->model('Akun_m');
		$this->load->model('GuruPegawai_m');
		$this->load->model('Jabatan_m'); 
		$this->load->model('JamMengajar_m');
		$this->load->model('Wk_m');
		$this->load->model('Piket_m');
		$this->load->model('Potongan_m');
		$this->load->model('Laporan_m');
		$this->load->model('DetailLaporan_m');
 
    	$this->data['profil'] = $this->Akun_m->get_row(['email' =>$this->data['email'] ]); 
 
	}
	public function index()
	{ 	  
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 1;
		$this->data['content'] = 'bendahara/index';
		$this->load->view('bendahara/template/layout', $this->data);
	}

// KELOLA LAPORAN ----------------------------------------
	public function laporan(){

		if ($this->uri->segment(3)) {
			$id_laporan = $this->uri->segment(3);

			if ($this->Laporan_m->get_num_row(['id_laporan' => $id_laporan]) == 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Laporan tidak tersedia!</div>');
				redirect('bendahara/laporan');
				exit();
			}


			$this->data['list_guru'] = $this->GuruPegawai_m->get(['status' => 1]);
			$this->data['laporan'] = $this->Laporan_m->get_row(['id_laporan' => $id_laporan]); 
			$this->data['list_data'] = $this->DetailLaporan_m->get(['id_laporan' => $id_laporan]); 
			$this->data['index'] = 2;
			$this->data['content'] = 'bendahara/detaillaporan';
			$this->load->view('bendahara/template/layout', $this->data);
		}else{
			$this->data['list_data'] = $this->Laporan_m->get_by_order('id_laporan', 'desc', []); 
			$this->data['index'] = 2;
			$this->data['content'] = 'bendahara/laporan';
			$this->load->view('bendahara/template/layout', $this->data);
		}

		
	}

	public function slipgaji(){

		if ($this->Laporan_m->get_num_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]) == 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Laporan pada '.$this->POST('bulan').'/'.$this->POST('tahun').' tidak ada.</div>');
			redirect('bendahara/');
			exit();
		}else{
			$laporan =  $this->Laporan_m->get_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]);
			if ($this->DetailLaporan_m->get_num_row(['nip' => $this->POST('nip'), 'id_laporan' => $laporan->id_laporan]) == 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Slip Gaji Guru/Pegawai tidak ditemukan</div>');
				redirect('bendahara/');
				exit();
			}else{
				$this->data['guru'] = $this->GuruPegawai_m->get_row(['nip' => $this->POST('nip')]);
				$this->data['laporan'] = $this->Laporan_m->get_row(['id_laporan' => $laporan->id_laporan]);  
				$this->data['detail'] = $this->DetailLaporan_m->get_row(['nip' => $this->POST('nip'), 'id_laporan' => $laporan->id_laporan]);

				$this->data['index'] = 1;
				$this->data['content'] = 'bendahara/slipgaji';
				$this->load->view('bendahara/template/layout', $this->data);

			}
		}

		 
	}

	public function formtambahdatagaji(){
 
			 
			$this->data['guru'] = $this->GuruPegawai_m->get_row(['nip' => $this->POST('nip')]);
			$this->data['laporan'] = $this->Laporan_m->get_row(['id_laporan' => $this->POST('id_laporan')]);  
			$this->data['gajipokok'] = 0;


			if ($this->data['guru']->id_jabatan != 0) {
				$this->data['gajipokok'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->data['guru']->id_jabatan])->gaji;
			}else{
				$this->data['gajipokok'] = 0;
			}

			$this->data['njammengajar'] = $this->JamMengajar_m->get_njam($this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun);
			

			$this->data['nwk'] = $this->Wk_m->get_num_row(['nip' => $this->POST('nip')]);

			if ($this->data['nwk'] == 0) {
				$this->data['walikelas'] = 0;
			}else{
				$this->data['walikelas'] = 110000;
			}

			$this->data['np'] = $this->Piket_m->get_num_row(['nip' => $this->POST('nip')]);

			if ($this->data['np'] == 0) {
				$this->data['piket'] = 0;
			}else{
				$this->data['piket'] = $this->data['np'] * 20000;
			}


			$this->data['bon'] = $this->Potongan_m->get_potongan('Bon',$this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun);
			if (!$this->data['bon']) {
				$this->data['bon'] = 0;
			}
			$this->data['ks'] = $this->Potongan_m->get_potongan('Koprasi Sekolah',$this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun);
			if (!$this->data['ks']) {
				$this->data['ks'] = 0;
			}
			$this->data['YPLP'] = $this->Potongan_m->get_potongan('Koprasi YPLP',$this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun);
			if (!$this->data['YPLP']) {
				$this->data['YPLP'] = 0;
			}
			$this->data['iuaran'] = $this->Potongan_m->get_potongan('Iuaran PGRI',$this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun);
			if (!$this->data['iuaran']) {
				$this->data['iuaran'] = 0;
			}
			$this->data['uangamal'] = $this->Potongan_m->get_potongan('Uang Amal',$this->POST('nip'),$this->data['laporan']->bulan, $this->data['laporan']->tahun); 
			if (!$this->data['uangamal']) {
				$this->data['uangamal'] = 0;
			} 
			$this->data['index'] = 2;
			$this->data['content'] = 'bendahara/formtambahdatagaji';
			$this->load->view('bendahara/template/layout', $this->data);
		 

		
	}


	public function prosesgaji(){
		$data = [
			'id_laporan' => $this->POST('id_laporan'),
			'nip' => $this->POST('nip'), 
			'jam_mengajar' => $this->POST('jam_mengajar'), 
			'gaji_pokok' => $this->POST('gaji_pokok'),  
			'wali_kelas' => $this->POST('wali_kelas'), 
			'piket' => $this->POST('piket'), 
			'transport' => $this->POST('transport'), 
			'bon' => $this->POST('bon'), 
			'iuran_pgri' => $this->POST('iuaran_pgri'), 
			'koprasi_sekolah' => $this->POST('kopresi_sekolah'), 
			'koprasi_yplp' => $this->POST('kopresi_yplp'), 
			'uang_amal' => $this->POST('uang_amal'), 
			'total' => $this->POST('total')
		];
		if ($this->DetailLaporan_m->insert($data)) {

        	$id = $this->db->insert_id();
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data gaji guru/pegawai berhasil ditambah.</div>');
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}
	}

	public function add_laporan(){

		if ($this->Laporan_m->get_num_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]) != 0) {
			$id = $this->Laporan_m->get_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')])->id_laporan;
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Laporan pada '.$this->POST('bulan').'/'.$this->POST('tahun').' telah ada.</div>');
			redirect('bendahara/laporan/'.$id);
			exit();
		}

		$data = [
			'bulan' => $this->POST('bulan'),
			'tahun' => $this->POST('tahun'),
			'tgl_buat' => date('Y-m-d H:i:s'),
			'status' => 0
		];
		if ($this->Laporan_m->insert($data)) {

        	$id = $this->db->insert_id();
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data laporan berhasil ditambah.</div>');
			redirect('bendahara/laporan/'.$id);
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('bendahara/laporan');
			exit();
		}
	}
  

	public function delete_laporan(){ 
		if ($this->Laporan_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data laporan berhasil dihapus.</div>');
			redirect('bendahara/laporan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('bendahara/laporan');
			exit();
		}
	}

	public function delete_dlaporan(){ 
		if ($this->DetailLaporan_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data gaji guru/pegawai berhasil dihapus.</div>');
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}
	}

	public function proseslaporan(){ 
		if ($this->Laporan_m->update($this->POST('id_laporan'),['status' => 1])) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Laporan berhasil diproses</div>');
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			
			redirect('bendahara/laporan/'.$this->POST('id_laporan'));
			exit();
		}
	}
// KELOLA LAPORAN ----------------------------------------


// KELOLA POTONGAN GAJI ----------------------------------------
	public function potongan(){

		$this->data['list_data'] = $this->Potongan_m->get_by_order('tgl', 'desc', []);
		$this->data['list_guru'] = $this->GuruPegawai_m->get();
		$this->data['index'] = 3;
		$this->data['content'] = 'bendahara/potongan';
		$this->load->view('bendahara/template/layout', $this->data);
	}

	public function add_potongan(){
		$data = [
			'nip' => $this->POST('nip'),
			'jenis' => $this->POST('jenis'),
			'tgl' => $this->POST('tgl'),
			'nominal' => $this->POST('nominal')
		];
		if ($this->Potongan_m->insert($data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data potongan berhasil ditambah.</div>');
			redirect('bendahara/potongan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi!</div>');
			redirect('bendahara/potongan');
			exit();
		}
	}

	public function add_potongan2(){

		$list_guru = $this->GuruPegawai_m->get();
		foreach ($list_guru as $row) {
			$data = [
				'nip' => $row->nip,
				'jenis' => $this->POST('jenis'),
				'tgl' => $this->POST('tgl'),
				'nominal' => $this->POST('nominal')
			];
			$this->Potongan_m->insert($data);
		}
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data potongan berhasil ditambah.</div>');
		redirect('bendahara/potongan');
		exit();
	}
	 
	public function update_potongan(){ 
		$data = [
				'jenis' => $this->POST('jenis'),
				'tgl' => $this->POST('tgl'),
				'nominal' => $this->POST('nominal')
		];

		if ($this->Potongan_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data potongan berhasil diedit.</div>');
			redirect('bendahara/potongan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('bendahara/potongan');
			exit();
		}
	}

	public function delete_potongan(){ 
		if ($this->Potongan_m->delete($this->POST('id'))) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data potongan berhasil dihapus.</div>');
			redirect('bendahara/potongan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('bendahara/potongan');
			exit();
		}
	}
// KELOLA POTONGAN GAJI ----------------------------------------

// KELOLA GAJI GOLONGAN ----------------------------------------
	public function gajigolongan(){

		$this->data['list_data'] = $this->Golongan_m->get();
		$this->data['list_guru'] = $this->GuruPegawai_m->get(['id_golongan >' => 0]);
		$this->data['index'] = 4;
		$this->data['content'] = 'bendahara/gajigolongan';
		$this->load->view('bendahara/template/layout', $this->data);
	} 
	 
	public function update_gajigolongan(){ 
		$data = [
			'gaji_pokok' => $this->POST('gaji_pokok')
		];

		if ($this->Golongan_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data gajigolongan berhasil diedit.</div>');
			redirect('bendahara/gajigolongan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('bendahara/gajigolongan');
			exit();
		}
	}
// KELOLA GAJI GOLONGAN ----------------------------------------

// KELOLA GAJI JABATAN ----------------------------------------
	public function gajijabatan(){

		$this->data['list_data'] = $this->Jabatan_m->get();
		$this->data['index'] = 5;
		$this->data['content'] = 'bendahara/gajijabatan';
		$this->load->view('bendahara/template/layout', $this->data);
	} 
	 
	public function update_gajijabatan(){ 
		$data = [
			'gaji' => $this->POST('gaji')
		];

		if ($this->Jabatan_m->update($this->POST('id'),$data)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable">Data gaji jabatan berhasil diedit.</div>');
			redirect('bendahara/gajijabatan');
			exit();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Gagal, coba lagi.</div>');
			redirect('bendahara/gajijabatan');
			exit();
		}
	}
// KELOLA GAJI JABATAN ----------------------------------------


// PROFIL
	public function profil(){ 
	    $this->data['index'] = 7;
		$this->data['content'] = 'bendahara/profil';
		$this->load->view('bendahara/template/layout', $this->data);
	 }

	public function proses_edit_profil(){
      if ($this->POST('edit')) { 
          if ($this->Akun_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable">Email telah digunakan!</div>');
			redirect('bendahara/profil');
			exit();
		}

          $this->Akun_m->update($this->POST('email_x'),['email' => $this->POST('email')   ]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('bendahara/profil');
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
				redirect('bendahara/profil');
				exit();
			}
            $data = [ 
              'password' => md5($this->POST('pass2')) 
            ];
            
            $this->Akun_m->update($this->data['email'],$data);
        
            $this->flashmsg('Password baru telah disimpan!', 'success');
            redirect('bendahara/profil');
            exit();    
          }  

          else{

          redirect('bendahara/profil');
          exit();
          }

    }
// PROFIL
 
}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */