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

	public function beranda()
	{
			$this->load->view('navbar');
		    $this->load->view('header');
         	$this->load->view('beranda');
         	$this->load->view('footer');
    } 	

	public function pegawai()
	{
		$data['pegawai'] = $this->home_model->get_pegawai();
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('pegawai', $data);
		$this->load->view('footer');
	}

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

	function test_pdf($id) {
//		$this->load->view('navbar');
//		$this->load->view('header');
//		$this->load->view('test_pdf');
//		$this->load->view('footer');

		$tab = "\t \t \t \t \t";
		$surat_tugas = $this->db->get_where('surat_dinas', array('id' => $id))->result();
		//$surat_tugas = json_encode($surat_tugas);
		$pdf = new FPDF('p','mm','A4');

		// membuat halaman baru
		$pdf->AddPage();
		$pdf->SetLeftMargin(20);
		$pdf->SetRightMargin(20);
		// setting jenis font yang akan digunakan
		$pdf->SetFont('Arial','B',14);
		// mencetak string
		$pdf->Cell(0,6,"",0,1,'C');
		$pdf->Ln();
		$pdf->Cell(0,6,"",0,1,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(0,6,"",0,1,'C');
		$pdf->Ln();
		$pdf->Cell(0,3,'SURAT TUGAS',0,1,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,10,"NOMOR: ".$surat_tugas['0']->nomor,0,1,'C');
		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,6,'Menimbang',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->MultiCell(0,6,"Dalam rangka melakukan kegiatan kegiatan di tempat  pada waktu",0,'J');
		//$pdf->Cell(27,6,'Dalam rangka melakukan kegiatan $kegiatan di $tempat  pada $waktu	',0,0);
		$pdf->Cell(25,6,'Dasar',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->Cell(5,6,'1.',0,0);
		$pdf->MultiCell(0,6,"Keputusan Presiden Nomor 72 Tahun 2004 tentang Pelaksanaan AnggaranPendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Menteri Keuangan Nomor 134/PMK.06/2005 tentang Pedoman Pembayaran dalam Pelaksanan Anggaran Pendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'3.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Kepala Badan Nasinal Penanggulangan Bencana Nomor 1 tahun 2008 tentang Organisasi dan Tata Kerja Badan Nasional Penanggulangan Bencana",0,'J');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,10,"Memberi tugas",0,1,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,6,'Kepada',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->MultiCell(0,6,"Daftar Terlampir",0,'L');
		$pdf->Cell(25,6,'Untuk',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->Cell(5,6,'1.',0,0);
		$pdf->MultiCell(0,6,"Dinas ke var_tempat dalam rangka mendukung kegiatan var_kegiatan tahun var_tahun, pada tanggal var_tgl_mulai s.d var_tgl_akhir;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Melaksanakan tugas ini dengan penuh tanggungjawab;",0,'L');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'3.',0,0);
		$pdf->MultiCell(0,6,"Segala biaya yang dikeluarkan untuk tugas tersebut di atas dibebankan kepada DIPA BNPB TA 2018, Pos Kegiatan Melakukan Monitoring dan Evaluasi Teknologi Informasi dan Komunikasi;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Apabila terdapat kekeliruan dalam Surat Tugas ini akan dilakukan perbaikan sebagaimana mestinya.",0,'J');
		$pdf->Ln();
		$pdf->MultiCell(0,6,"Jakarta, var_tgl-bulan-tahun",0,'R');
		$pdf->MultiCell(0,6,"Kepala Pusat Data Informasi dan Humas",0,'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,6,"DR. Sutopo Purwo Nugroho, M.Si, APU	",0,'R');

		$pdf->Output();

	}
	function ena ($id) {
		$surat_tugas = $this->db->select('nomor')->get_where('surat_dinas', array('id' => $id))->result();
		echo $surat_tugas['0']->nomor;
	}

	function delete_pegawai($id) {
		$where = array('id_pegawai' => $id );
		$this->db->delete('pegawai', $where);
		$this->alert("Berhasil menghapus");
		$this->href('home/pegawai');
	}

	function href ($route) {
		echo "<script>
         	window.location.href='".base_url()."$route';</script>";
	}

	function alert ($message) {
		echo "<script>         	
         	alert($message);</script>";
	}

	public function biaya_penginapan()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_penginapan');
		$this->load->view('footer');
	}

	public function biaya_transport()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('biaya_transport');
		$this->load->view('footer');
	}

	public function tiket_pesawat()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('tiket_pesawat');
		$this->load->view('footer');
	}

	public function uang_harian()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_harian');
		$this->load->view('footer');
	}

	public function uang_representasi()
	{
		$this->load->view('nav');
		$this->load->view('header');
		$this->load->view('uang_representasi');
		$this->load->view('footer');
	}
}
