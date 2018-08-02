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
		$data['surat'] = $this->home_model->get_surat();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('lihat_surat', $data);
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

		$id_surat_dinas = $this->db->select('id')->get_where('surat_dinas', array('nomor' => $this->input->post('nomor')))->result();
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
		$this->href("home/beranda");

	}

	/*
	 * CRUD Biaya Penginapan
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
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('edit_penginapan', $data);
		$this->load->view('footer');
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
		$this->alert("Berhasil menghapus");
		$this->href('home/biaya_penginapan');
	}

	/*
	 * CRUD Biaya Transport
	 *
	 * */

	public function biaya_transport()
	{
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_transport', $data);
		$this->load->view('footer');
	}

	public function tambah_transport() {
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_transport', $data);
		$this->load->view('footer');
		$data = array(
			'provinsi' => $provinsi,
			'besaran' => $besaran,
		);
		$this->db->insert('biaya_transport', $data);
		$this->href('home/biaya_transport');
	}

	function edit_transport_page($id) {
		$data['biaya_transport'] = $this->db->get_where('biaya_transport',  array('id' => $id) )->result();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('edit_transport', $data);
		$this->load->view('footer');
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
		$this->alert("Berhasil menghapus");
		$this->href('home/biaya_transport');
	}

	/*
	 * CRUD Tiket Pesawat
	 *
	 * */

	public function tiket_pesawat()
	{
		$data['pesawat'] = $this->home_model->get_tiket_pesawat();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('tiket_pesawat', $data);
		$this->load->view('footer');
	}

	public function tambah_tiket() {
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('tiket_pesawat', $data);
		$this->load->view('footer');
		$data = array(
			'kota' => $kota,
			'biaya_tiket' => $biaya_tiket,
		);
		$this->db->insert('tiket_pesawat', $data);
		$this->href('home/tiket_pesawat');
	}

	function edit_tiket_page($id) {
		$data['tiket_pesawat'] = $this->db->get_where('tiket_pesawat',  array('id' => $id) )->result();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('edit_tiket', $data);
		$this->load->view('footer');
	}

	function edit_tiket($id) {
		$kota = $this->input->post('kota');
		$biaya_tiket = $this->input->post('biaya_tiket');
		$data = array(
			'kota' => $kota,
			'biaya_tiket' => $biaya_tiket,
		);
		$this->db->where('id', $id);
		$this->db->update('tiket_pesawat', $data);
		$this->href('home/tiket_pesawat');
	}

	function delete_tiket($id) {
		$where = array('id' => $id );
		$this->db->delete('tiket_pesawat', $where);
		$this->alert("Berhasil menghapus");
		$this->href('home/tiket_pesawat');
	}

	/*
	 * CRUD Uang Harian
	 *
	 * */

	public function uang_harian()
	{
		$data['harian'] = $this->home_model->get_uang_harian();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_harian', $data);
		$this->load->view('footer');
	}

	public function tambah_harian() {
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_harian', $data);
		$this->load->view('footer');
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
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('edit_harian', $data);
		$this->load->view('footer');
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
		$this->alert("Berhasil menghapus");
		$this->href('home/uang_harian');
	}

	/*
	 * CRUD Uang Harian
	 *
	 * */

	public function uang_representasi()
	{
		$data['representasi'] = $this->home_model->get_uang_representasi();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_representasi', $data);
		$this->load->view('footer');
	}

	public function tambah_representasi() {
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_representasi', $data);
		$this->load->view('footer');
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
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_representasi', $data);
		$this->load->view('footer');
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
		$this->alert("Berhasil menghapus");
		$this->href('home/uang_representasi');
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
		$data['pegawai'] = $this->db->get_where('pegawai',  array('id_pegawai' => $id) )->result();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('edit_pegawai', $data);
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
    
    public function example1() {
        $config = array();
        $config["base_url"] = base_url() . "welcome/example1";
        $config["total_rows"] = $this->Countries->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Countries->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("example1", $data);
    }
}
