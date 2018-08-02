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

	/*
     * Helper Function
     *
     * */

	function href ($route) {
		echo "<script>
         	window.location.href='".base_url()."$route';</script>";
	}

	function alert ($message) {
		echo "<script>         	
         	alert($message);</script>";
	}

	public function login() {
		$sql = "select * from admin where nama = ? and password = ?";
		$query = $this->db->query($sql, array($this->input->post('name'), $this->input->post('password')));
		if($query->num_rows()> 0) {
			$this->href("home/beranda");
		} else {
			echo "<script>         	
         	alert('password atau username salah!');
         	window.location.href='index';</script>";
		}
	}

	/*
	 * Main Funtion Mnagement
	 *
	 *  */

	public function index()
	{
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}


	public function beranda()
	{
		$this->load->view('navbar');
		$this->load->view('header');
        $this->load->view('beranda');
        $this->load->view('footer');
    } 	

	/*
	 * Surat Management
	 */
	public function lihat_surat() {
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('lihat_surat');
		$this->load->view('footer');
	}

	public function buat_surat ()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$this->load->view('nav');
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

	/*
	 * Anggaran Management
	 *
	 * */

	public function biaya_penginapan()
	{
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_penginapan', $data);
		$this->load->view('footer');
	}

	public function biaya_transport()
	{
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_transport', $data);
		$this->load->view('footer');
	}

	public function tiket_pesawat()
	{
		$data['pesawat'] = $this->home_model->get_tiket_pesawat();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('tiket_pesawat', $data);
		$this->load->view('footer');
	}

	public function uang_harian()
	{
		$data['harian'] = $this->home_model->get_uang_harian();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_harian', $data);
		$this->load->view('footer');
	}

	public function uang_representasi()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_representasi');
		$this->load->view('footer');
	}

	public function layout_biaya()
	{
		$this->load->view('header');
		$this->load->view('layout_biaya');
	}

	/*
	 * Pegawai Management
	 */

	public function pegawai()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('pegawai', $data);
		$this->load->view('footer');
	}
	public function tambah_pegawai() {
		$name = $this->input->post('nama');
		$nip = $this->input->post('nip');
		$jabatan = $this->input->post('jabatan');
		$golongan = $this->input->post('gol');
		$data = array(
			'nama_pegawai' => $name,
			'nip_pegawai' => $nip,
			'jabatan_pegawai' => $jabatan,
			'golongan_pegawai' => $golongan
		);
		$this->db->insert('pegawai', $data);
		$this->href('home/pegawai');

	}

	function delete_pegawai($id) {
		$where = array('id_pegawai' => $id );
		$this->db->delete('pegawai', $where);
		$this->alert("Berhasil menghapus");
		$this->href('home/pegawai');
	}

	function edit_pegawai_page($id) {
		$data = array(
			'id' => $id
		);
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('edit_page', $data);
		$this->load->view('footer');
	}

	function edit_pegawai($id) {
		$name = $this->input->post('nama');
		$nip = $this->input->post('nip');
		$jabatan = $this->input->post('jabatan');
		$golongan = $this->input->post('gol');
		$data = array(
			'nama_pegawai' => $name,
			'nip_pegawai' => $nip,
			'jabatan_pegawai' => $jabatan,
			'golongan_pegawai' => $golongan
		);
		$this->db->where('id_pegawai', $id);
		$this->db->update('pegawai', $data);
		$this->href('home/pegawai');
	}
}
