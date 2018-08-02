<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_PDF extends CI_Controller {

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
		include_once ("home.php");
    }

	public function index()
	{
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}



	function print($id) {
		$surat_tugas = $this->db->get_where('surat_dinas', array('id' => $id))->result();
		$pegawai = $this->db->get_where('pegawai',
			array('jabatan_pegawai' => 'Kepala Pusat Data Informasi dan Humas'))->result();

		//Define variable
		$nomor = $surat_tugas['0']->nomor;
		$var_kegiatan = $surat_tugas['0']->kegiatan;
		$var_tempat = $surat_tugas['0']->tempat;
		$var_tgl_mulai = $surat_tugas['0']->tgl_mulai;
		$var_tgl_akhir = $surat_tugas['0']->tgl_akhir;

		$var_tahun_kegiatan = substr($surat_tugas['0']->tgl_surat, -4);
		$var_tgl_surat = $surat_tugas['0']->tgl_surat;
		//$surat_tugas = json_encode($surat_tugas);
		$kapusdatin = $pegawai['0']->nama_pegawai;
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
		$pdf->Cell(0,10,"NOMOR: ".$nomor,0,1,'C');
		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,6,'Menimbang',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->MultiCell(0,6,"Dalam rangka melakukan kegiatan $var_kegiatan di $var_tempat",0,'J');
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
		$pdf->MultiCell(0,6,"Dinas ke ".$var_tempat." dalam rangka mendukung kegiatan ".$var_kegiatan." tahun ".$var_tahun_kegiatan.", pada tanggal ".$var_tgl_mulai." s.d ".$var_tgl_akhir.";",0,'J');
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
		$pdf->MultiCell(0,6,"Jakarta, ".$var_tgl_surat,0,'R');
		$pdf->MultiCell(0,6,"Kepala Pusat Data Informasi dan Humas",0,'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,6,$kapusdatin,0,'R');

		//Page ke-2
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,6,"Lampiran Surat Tugas",0,1,'R');
		$pdf->Cell(0,6,"Nomor: $nomor",0,1,'R');
		$pdf->Cell(0,6,"Tanggal: $var_tgl_surat",0,1,'R');
		$pdf->Cell(0,10,"Daftar Nama",0,1,'C');
		$pdf->SetFont('Arial','',12);
		$nama = $this->home_model->get_yang_dinas($id);
		$counter = 1;
		foreach ($nama as $row) {
			$pdf->Cell(5,6,"$counter. ",0,0);
			$pdf->MultiCell(0,6,"$row->nama_pegawai",0,'J');
			$counter++;
		}

		//Page ke-3
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(0,6,"PERINCIAN BIAYA PERJALANAN DINAS",0,1,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(34,6,'Lamp. SPD Nomor',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,$nomor,0,'L');
		$pdf->Cell(34,6,'Tanggal',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(0,6,$var_tgl_surat,0,'L');
		$pdf->Cell(10,6,'No',1,0,'L');
		$pdf->Cell(70,6,'Perincian biaya',1,0,'L');
		$pdf->Cell(40,6,'Jumlah',1,0,'L');
		$pdf->Cell(50,6,'Keterangan',1,1,'L');
		$pdf->Cell(10,6,"1",0,0,'L');
		$pdf->Cell(70,6,'Uang harian',0,0,'L');
		$pdf->Cell(40,6,'Rp. 1,290,000',0,0,'L');
		$pdf->MultiCell(50,6,'Perjalanan Dinas Ke Maluku utara',0,'L');

		//Cetak gans
		$pdf->Output();

	}

	function firly() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,6,"ENA",0,'J');
		$pdf->SetFont('Arial','',12);

		//Cetak gans
		$pdf->Output();
	}
	function ena ($id) {
		$surat_tugas = $this->db->select('nomor')->get_where('surat_dinas', array('id' => $id))->result();
		echo $surat_tugas['0']->nomor;
	}
}
