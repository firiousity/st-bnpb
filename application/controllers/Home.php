<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __Construct()
    {
        parent ::__construct();
        $this->load->model("home_model");
        $this->load->library("pagination");
    }

	public function index()
	{
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function login() {
		 $sql = "select * from admin where nama = ? and password = ?";
		 $query = $this->db->query($sql, array($this->input->post('name'), $this->input->post('password')));
         if($query->num_rows()> 0) {
         	$this->href("beranda");
         } else {
         	echo "<script>         	
         	alert('password atau username salah!');
         	window.location.href='index';</script>";
         }
	}

	public function beranda() {

			$this->load->view('navbar');
		    $this->load->view('header');
         	$this->load->view('beranda');
         	$this->load->view('footer');
    } 	

	public function pegawai()
	{
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('pegawai');
		$this->load->view('footer');
	}

	public function buat_surat () {
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('buat_surat', $data);
		$this->load->view('footer');
	}

	public function exec_buat_surat() {
		$data = array(
			'nomor'      => $this->input->post('nomor'),
			'tempat'         => $this->input->post('tempat'),
			'kegiatan'         => $this->input->post('kegiatan'),
			'tgl_mulai'          => $this->input->post('tgl_mulai'),
			'tgl_akhir'        => $this->input->post('tgl_akhir'),
			'tgl_surat'        => date('d')."/".date('m')."/".date('Y'),
			'jenis'          => $this->input->post('jenis'),
		);
		$this->db->insert('surat_dinas', $data);


		$num_data = count($this->input->post('my-select[]'));
		for($i=0;$i<$num_data;$i++) {
			$data_with_nip = array(
				'id_surat'      => $this->input->post('nomor'),
				'id_pegawai' => $this->input->post('my-select[]')[$i]
			);
			$this->db->insert('yang_dinas', $data_with_nip);
		}

		$this->alert("Surat sukses di buat :)");
		$this->href("beranda");

		//$this->db->insert('surat_dinas', $data);
	}

	function href ($route) {
		echo "<script>
         	window.location.href='$route';</script>";
	}

	function alert ($message) {
		echo "<script>         	
         	alert($message);</script>";
	}
}
