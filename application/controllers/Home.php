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
			$_SESSION['success'] = [ 'Berhasil login!', 'Selamat datang'];
			$this->href("home/beranda/");
		} else {
			$_SESSION['error'] = 'Username atau password salah';
         	$this->href("");
		}
	}

	/*
	 * Main Funtion Mnagement
	 *
	 *  */

	public function index()
	{
		$this->load->view('layouts/navlogin');
		$this->load->view('layouts/header');
		$this->load->view('login');
		$this->load->view('layouts/footer3');
	}

	public function beranda()
	{
		//if (isset($_SESSION['success'])) {
			$this->load->view('layouts/nav');
			$this->load->view('layouts/header');
	        $this->load->view('beranda');
	        $this->load->view('layouts/footer2');
		// } else {
		// 	$_SESSION['error'] = 'Username atau password salah';
  //        	$this->href("");
		// }
    } 	

	/*
	 * Surat Management
	 */
	public function lihat_surat() {
		$data['surat'] = $this->home_model->get_surat();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('lihat_surat', $data);
		// $this->load->view('layouts/footer');
	}

	/* Cek nomor apakah kosong */
	public function isNomorFilled($id) {
		$surat_result = $this->db->get_where('surat_dinas', array('id' => $id))->result();
		$nomor = $surat_result['0']->nomor;
		$arr_nomor = explode('/', $nomor);
		$nomor_surat = trim($arr_nomor[0], " ");
		if(empty($nomor_surat)) {
			return false;
		} else {
			return true;
		}
	}


	public function buat_surat ()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$data['harian'] = $this->home_model->get_uang_harian();
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$data['tiket'] = $this->home_model->get_tiket_pesawat();
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('buat_surat', $data);
		// $this->load->view('layouts/footer');
	}


	public function buat_surat2 ()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$data['harian'] = $this->home_model->get_uang_harian();
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$data['tiket'] = $this->home_model->get_tiket_pesawat();
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('buat_surat2', $data);
		// $this->load->view('layouts/footer');
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

		$nomor_result = $this->db->from('surat_dinas')->order_by('id', 'desc')->limit(1)->get()->result();
		$nomor = $nomor_result['0']->id;

		//SAVE TO DATABASE

		$num_data = count($this->input->post('my-select[]'));
		for($i=0;$i<$num_data;$i++) {
			$data_rinci = array(
				'id_surat'      => $nomor,
				'id_pegawai' => $this->input->post('my-select[]')[$i],
				'transport'         => $this->input->post('my-select-transport[]')[0],
				'penginapan'          => $this->input->post('my-select-penginapan[]')[0],
				'harian'        => $this->input->post('my-select-harian[]')[0],
				'tiket'        =>  $this->input->post('my-select-tiket[]')[0],
			);
			$this->db->insert('rincian_biaya', $data_rinci);
		}

		$id_surat_dinas = $this->db->select('id')->get_where('surat_dinas',
			array('nomor' => $this->input->post('nomor')))->result();
		$id_surat_dinas = $id_surat_dinas[0];

		$num_data = count($this->input->post('my-select[]'));
		for($i=0;$i<$num_data;$i++) {
			$data_with_nip = array(
				'id_surat'      => $id_surat_dinas->id,
				'id_pegawai' => $this->input->post('my-select[]')[$i]
			);
			$this->db->insert('yang_dinas', $data_with_nip);
		}

		$this->alert("Surat sukses di buat :)");
		$this->href("home/lihat_surat");

	}

	function delete_surat($id) {
		$where = array('id' => $id );
		$this->db->delete('surat_dinas', $where);
		$this->alert("Berhasil menghapus");
		$this->href('home/lihat_surat');
	}

	/*
	 * CRUD Biaya Penginapan
	 *
	 * */

	public function biaya_penginapan()
	{
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('biaya_penginapan', $data);
		// $this->load->view('layouts/footer');
	}

	public function tambah_penginapan() {
		$provinsi = $this->input->post('provinsi');
		$eselon_1 = $this->input->post('eselon_1');
		$eselon_2 = $this->input->post('eselon_2');
		$eselon_3 = $this->input->post('eselon_3');
		$eselon_4 = $this->input->post('eselon_4');
		$eselon_5 = $this->input->post('eselon_5');
		$data = array(
			'provinsi' => $provinsi,
			'eselon_1' => $eselon_1,
			'eselon_2' => $eselon_2,
			'eselon_3' => $eselon_3,
			'eselon_4' => $eselon_4,
			'eselon_5' => $eselon_5,
		);
		$this->db->insert('biaya_penginapan', $data);
		$this->href('home/biaya_penginapan');
	}

	function edit_penginapan_page($id) {
		$data['biaya_penginapan'] = $this->db->get_where('biaya_penginapan',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_penginapan', $data);
		$this->load->view('layouts/footer');
	}

	function edit_penginapan($id) {
		$provinsi = $this->input->post('provinsi');
		$eselon_1 = $this->input->post('eselon_1');
		$eselon_2 = $this->input->post('eselon_2');
		$eselon_3 = $this->input->post('eselon_3');
		$eselon_4 = $this->input->post('eselon_4');
		$eselon_5 = $this->input->post('eselon_5');
		$data = array(
			'provinsi' => $provinsi,
			'eselon_1' => $eselon_1,
			'eselon_2' => $eselon_2,
			'eselon_3' => $eselon_3,
			'eselon_4' => $eselon_4,
			'eselon_5' => $eselon_5,
		);
		$this->db->where('id', $id);
		$this->db->update('biaya_penginapan', $data);
		$this->href('home/biaya_penginapan');
	}

	function delete_penginapan($id) {
		$where = array('id' => $id );
		$this->db->delete('biaya_penginapan', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/biaya_penginapan');
	}

	/*
	 * CRUD Biaya Transport
	 *
	 * */

	public function biaya_transport()
	{
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('biaya_transport', $data);
		// $this->load->view('layouts/footer');
	}

	public function tambah_transport() {
		$provinsi = $this->input->post('provinsi');
		$besaran = $this->input->post('besaran');

		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('biaya_transport');
		$this->load->view('layouts/footer');
		$data = array(
			'provinsi' => $provinsi,
			'besaran' => $besaran,
		);
		$this->db->insert('biaya_transport', $data);
		$this->href('home/biaya_transport');
	}

	function edit_transport_page($id) {
		$data['biaya_transport'] = $this->db->get_where('biaya_transport',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_transport', $data);
		$this->load->view('layouts/footer2');
	}

	function edit_transport($id) {
		$provinsi = $this->input->post('provinsi');
		$besaran = $this->input->post('besaran');
		$data = array(
			'provinsi' => $provinsi,
			'besaran' => $besaran,
		);
		$this->db->where('id', $id);
		$this->db->update('biaya_transport', $data);
		$this->href('home/biaya_transport');
	}

	function delete_transport($id) {
		$where = array('id' => $id );
		$this->db->delete('biaya_transport', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/biaya_transport');
	}

	/*
	 * CRUD Transport Lokal
	 *
	 * */

	public function transport_lokal()
	{
		$data['transport'] = $this->home_model->get_transport_lokal();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('transport_lokal', $data);
		// $this->load->view('layouts/footer');
	}

	public function tambah_transport_lokal() {
		$provinsi = $this->input->post('provinsi');
		$ibukota = $this->input->post('ibukota');
		$kota_kabupaten = $this->input->post('kota_kabupaten');
		$besaran = $this->input->post('besaran');

		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('transport_lokal');
		// $this->load->view('layouts/footer');
		$data = array(
			'provinsi' => $provinsi,
			'ibukota' => $ibukota,
			'kota_kabupaten' => $kota_kabupaten,
			'besaran' => $besaran,
		);
		$this->db->insert('transport_lokal', $data);
		$this->href('home/transport_lokal');
	}

	function edit_transport_lokal_page($id) {
		$data['transport_lokal'] = $this->db->get_where('transport_lokal',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_transport', $data);
		$this->load->view('layouts/footer2');
	}

	function edit_transport_lokal($id) {
		$provinsi = $this->input->post('provinsi');
		$ibukota = $this->input->post('ibukota');
		$kota_kabupaten = $this->input->post('kota_kabupaten');
		$besaran = $this->input->post('besaran');
		$data = array(
			'provinsi' => $provinsi,
			'ibukota' => $ibukota,
			'kota_kabupaten' => $kota_kabupaten,
			'besaran' => $besaran,
		);
		$this->db->where('id', $id);
		$this->db->update('transport_lokal', $data);
		$this->href('home/transport_lokal');
	}

	function delete_transport_lokal($id) {
		$where = array('id' => $id );
		$this->db->delete('transport_lokal', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/transport_lokal');
	}

	/*
	 * CRUD Tiket Pesawat
	 *
	 * */

	public function tiket_pesawat()
	{
		$data['pesawat'] = $this->home_model->get_tiket_pesawat();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('tiket_pesawat', $data);
		// $this->load->view('layouts/footer');
	}

	public function tambah_tiket() {
		$rute = $this->input->post('rute');
		$biaya_tiket = $this->input->post('biaya_tiket');

		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('tiket_pesawat');
		// $this->load->view('layouts/footer');
		$data = array(
			'rute' => $rute,
			'biaya_tiket' => $biaya_tiket,
		);
		$this->db->insert('tiket_pesawat', $data);
		$this->href('home/tiket_pesawat');
	}

	function edit_tiket_page($id) {
		$data['tiket_pesawat'] = $this->db->get_where('tiket_pesawat',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_tiket', $data);
		$this->load->view('layouts/footer2');
	}

	function edit_tiket($id) {
		$rute = $this->input->post('rute');
		$biaya_tiket = $this->input->post('biaya_tiket');
		$data = array(
			'rute' => $rute,
			'biaya_tiket' => $biaya_tiket,
		);
		$this->db->where('id', $id);
		$this->db->update('tiket_pesawat', $data);
		$this->href('home/tiket_pesawat');
	}

	function delete_tiket($id) {
		$where = array('id' => $id );
		$this->db->delete('tiket_pesawat', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/tiket_pesawat');
	}

	/*
	 * CRUD Uang Harian
	 *
	 * */

	public function uang_harian()
	{
		$data['harian'] = $this->home_model->get_uang_harian();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('uang_harian', $data);
		// $this->load->view('layouts/footer');
	}

	public function tambah_harian() {
		$provinsi = $this->input->post('provinsi');
		$luar_kota = $this->input->post('luar_kota');
		$dalam_kota = $this->input->post('dalam_kota');
		$diklat = $this->input->post('diklat');

		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('uang_harian');
		// $this->load->view('layouts/footer');
		$data = array(
			'provinsi' => $provinsi,
			'luar_kota' => $luar_kota,
			'dalam_kota' => $dalam_kota,
			'diklat' => $diklat,
		);
		$this->db->insert('uang_harian', $data);
		$this->href('home/uang_harian');
	}

	function edit_harian_page($id) {
		$data['uang_harian'] = $this->db->get_where('uang_harian',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_harian', $data);
		// $this->load->view('layouts/footer');
	}

	function edit_harian($id) {
		$provinsi = $this->input->post('provinsi');
		$luar_kota = $this->input->post('luar_kota');
		$dalam_kota = $this->input->post('dalam_kota');
		$diklat = $this->input->post('diklat');
		$data = array(
			'provinsi' => $provinsi,
			'luar_kota' => $luar_kota,
			'dalam_kota' => $dalam_kota,
			'diklat' => $diklat,
		);
		$this->db->where('id', $id);
		$this->db->update('uang_harian', $data);
		$this->href('home/uang_harian');
	}

	function delete_harian($id) {
		$where = array('id' => $id );
		$this->db->delete('uang_harian', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/uang_harian');
	}

	/*
	 * CRUD Uang Representasi
	 *
	 * */

	public function uang_representasi()
	{
		$data['representasi'] = $this->home_model->get_uang_representasi();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('uang_representasi', $data);
		// $this->load->view('layouts/footer2');
	}

	public function tambah_representasi() {
		$uraian = $this->input->post('uraian');
		$luar_kota = $this->input->post('luar_kota');
		$dalam_kota = $this->input->post('dalam_kota');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('uang_representasi');
		// $this->load->view('layouts/footer');
		$data = array(
			'uraian' => $uraian,
			'luar_kota' => $luar_kota,
			'dalam_kota' => $dalam_kota,
		);
		$this->db->insert('uang_representasi', $data);
		$this->href('home/uang_representasi');
	}

	function edit_representasi_page($id) {
		$data['uang_representasi'] = $this->db->get_where('uang_representasi',  array('id' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_representasi', $data);
		$this->load->view('layouts/footer2');
	}

	function edit_representasi($id) {
		$uraian = $this->input->post('uraian');
		$luar_kota = $this->input->post('luar_kota');
		$dalam_kota = $this->input->post('dalam_kota');
		$data = array(
			'uraian' => $uraian,
			'luar_kota' => $luar_kota,
			'dalam_kota' => $dalam_kota,
		);
		$this->db->where('id', $id);
		$this->db->update('uang_representasi', $data);
		$this->href('home/uang_representasi');
	}

	function delete_representasi($id) {
		$where = array('id' => $id );
		$this->db->delete('uang_representasi', $where);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/uang_representasi');
	}

	public function layout_biaya()
	{
		$this->load->view('layouts/header');
		$this->load->view('layout_biaya');
	}

	public function layout_perhitungan()
	{
		$this->load->view('layouts/header');
		$this->load->view('layout_perhitungan');
	}

	/*
	 * Pegawai Management
	 */

	public function pegawai()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('pegawai', $data);
		// $this->load->view('layouts/footer');
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
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/pegawai');
	}

	function edit_pegawai_page($id) {
		$data['pegawai'] = $this->db->get_where('pegawai',  array('id_pegawai' => $id) )->result();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('edit_pegawai', $data);
		// $this->load->view('layouts/footer');
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
