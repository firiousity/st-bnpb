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
		$ppk = $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();
		//Define variable
		$nomor = $surat_tugas['0']->nomor;
		$var_kegiatan = $surat_tugas['0']->kegiatan;
		$var_tempat = $surat_tugas['0']->tempat;
		$var_tgl_mulai = $surat_tugas['0']->tgl_mulai;
		$var_tgl_akhir = $surat_tugas['0']->tgl_akhir;

		$var_tahun_kegiatan = substr($surat_tugas['0']->tgl_surat, -4);
		$var_tgl_surat = $surat_tugas['0']->tgl_surat;
		//$surat_tugas = json_encode($surat_tugas);
		$nama_ppk = $ppk['0']->nama;
		$nip_ppk = $ppk['0']->nip;
		$kapusdatin = $pegawai['0']->nama_pegawai;
		$tgl_sekarang = date('d')."-".date('m')."-".date('Y');
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
		$pdf->MultiCell(0,6,"Keputusan Presiden Nomor 72 Tahun 2004 tentang Pelaksanaan Anggaran Pendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Menteri Keuangan Nomor 134/PMK.06/2005 tentang Pedoman Pembayaran dalam Pelaksanan Anggaran Pendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'3.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Kepala Badan Nasional Penanggulangan Bencana Nomor 1 tahun 2008 tentang Organisasi dan Tata Kerja Badan Nasional Penanggulangan Bencana",0,'J');
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
		$pdf->MultiCell(0,6,"Segala biaya yang dikeluarkan untuk tugas tersebut di atas dibebankan kepada DIPA BNPB TA ". date('Y') .", Pos Kegiatan Melakukan Monitoring dan Evaluasi Teknologi Informasi dan Komunikasi;",0,'J');
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
		$pdf->MultiCell(0,6,$var_tgl_surat,0,'L');
		$pdf->Ln();

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'No',1,0,'L');
		$pdf->Cell(70,6,'Perincian biaya',1,0,'L');
		$pdf->Cell(40,6,'Jumlah',1,0,'L');
		$pdf->Cell(50,6,'Keterangan',1,1,'L');
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(70,6,'RINCIAN PENGELUARAN',0,0,'L');
		$pdf->Cell(40,6,'',0,0,'L');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"1",0,0,'L');
		$pdf->Cell(25,6,'Uang harian',0,0,'L');
		$pdf->Cell(15,6,'5 Hari',0,0,'L');
		$pdf->Cell(5,6,'x Rp',0,0,'L');
		$pdf->Cell(25,6,'480000',0,0,'R');
		$pdf->Cell(40,6,'Rp. 1290000',0,0,'C');
		$pdf->MultiCell(50,6,'Perjalanan Dinas Ke Maluku utara',0,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"2",0,0,'L');
		$pdf->Cell(25,6,'Tiket Pesawat',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'x Rp',0,0,'L');
		$pdf->Cell(25,6,'750.000',0,0,'R');
		$pdf->Cell(40,6,'Rp. 750000',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'JUMLAH: ',0,0,'R');
		$pdf->Cell(40,6,'Rp. 2040000',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Ln();

		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(70,6,'YANG TELAH DIBAYARKAN',0,0,'L');
		$pdf->Cell(40,6,'',0,0,'L');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"1",0,0,'L');
		$pdf->Cell(25,6,'Uang harian',0,0,'L');
		$pdf->Cell(15,6,'5 Hari',0,0,'L');
		$pdf->Cell(5,6,'x Rp',0,0,'L');
		$pdf->Cell(25,6,'-',0,0,'R');
		$pdf->Cell(40,6,'Rp. 0',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Cell(10,6,"2",0,0,'L');
		$pdf->Cell(25,6,'Uang transport',0,0,'L');
		$pdf->Cell(15,6,'5 Hari',0,0,'L');
		$pdf->Cell(5,6,'x Rp',0,0,'L');
		$pdf->Cell(25,6,'-',0,0,'R');
		$pdf->Cell(40,6,'Rp. 0',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'JUMLAH: ',0,0,'R');
		$pdf->Cell(40,6,'Rp. 0',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Ln();

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'SISA KURANG',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'JUMLAH: ',0,0,'R');
		$pdf->Cell(40,6,'Rp. 2040000',0,0,'C');
		$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Ln();

		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'Terbilang: ',0,0,'R');
		$pdf->MultiCell(90,6,$this->terbilang(2040000)." rupiah",0,'L');
		//$pdf->MultiCell(50,6,'',0,'L');

		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(40,6,'',0,0,'C');
		$pdf->MultiCell(50,6,'Jakarta, '.$tgl_sekarang,0,'R');

		$pdf->Ln();
		$pdf->Cell(100,6,"Mengetahui \nPejabat Pembuat Komitmen",0, 0,'C');
		$pdf->MultiCell(70,6,'Yang melakukan perjalanan dinas',0,'R');

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','B',10);
		$pdf->Ln();
		$pdf->Cell(100,6,$nama_ppk,0, 0,'C');
		$pdf->MultiCell(70,6,'Leonard, S.T',0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,"NIP. ".$nip_ppk ,0, 0,'C');
		$pdf->MultiCell(70,6,'NIP. 19820107 200912 1 002',0,'C');

		//Cetak gans
		$pdf->Output();

	}

	//Page Daftar Pengeluaran Rill
	function firly() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(0,25,"DAFTAR PENGELUARAN RILL",0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini",0,'L');
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'Leonard',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'19820107 200912 1 002',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'Staf Bidang Informasi',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,6,'Berdasarkan Surat Tugas Nomor:78/KADIH/05/2018 tanggal 22 Mei 2018 dengan ini kami menyatakan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'dengan sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,6,'1. Biaya Transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-',0,1);
		$pdf->Cell(19,7,'',0,0);
		$pdf->Cell(20,6,'bukti pengeluarannya meliputi :',0,1);
		$pdf->Ln();

		//here is table
		$pdf->Cell(20,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(100,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Jumlah',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','',10);
		$pdf->Cell(10,5,'1','L',0,'R',0);
		$pdf->Cell(70,5,'Transport Bandara Jakarta (PP)','L',0,'L',0);
		$pdf->Cell(30,5,'2 x 256.000','R',0,'R',0);
		$pdf->Cell(40,5,'942.000,00','R',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'2','LB',0,'R',0);
		$pdf->Cell(70,5,'Transport Bandara Bali (PP)','LB',0,'L',0);
		$pdf->Cell(30,5,'2 x 256.000','RB',0,'R',0);
		$pdf->Cell(40,5,'942.000,00','RB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(100,5,'Jumlah','RB',0,'C',0);
		$pdf->Cell(40,5,'942.000,00','RB',0,'R',0);
        $pdf->Ln();
        //end of table
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,6,'2. Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan',0,1);
		$pdf->Cell(19,7,'',0,0);
		$pdf->Cell(20,6,'dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia',0,1);
		$pdf->Cell(19,7,'',0,0);
		$pdf->Cell(20,6,'untuk menyetorkan kelebihan tersebut ke Kas Negara.',0,1);
		$pdf->Ln();
		$pdf->Ln();
		//Footer Surat
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(20,6,'',0,0,'C');
		$pdf->MultiCell(60,6,'Jakarta, 27 Februari 2018',0,'R');
		$pdf->Ln();
		$pdf->Cell(14,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'R');
		$pdf->Cell(100,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(50,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(100,6,'Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','BU',10);
		$pdf->Ln();
		$pdf->Cell(100,6,"Linda Lestari, S.Kom.",0, 0,'C');
		$pdf->MultiCell(72.5,6,'Leonard, S.T.',0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,"NIP. 19790305 200501 2 001",0, 0,'C');
		$pdf->MultiCell(72.5,6,'NIP. 19790305 200501 2 001',0,'C');

		//Cetak gans
		$pdf->Output();
	}

	//Page Surat Pernyataan Biaya Tiket Pesawat
	function kelik() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(0,25,"SURAT PERNYATAAN",0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini :",0,'L');
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Yanuar Yuda Darmawan, S.Kom.',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'19800126 201012 1 001',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Staf Bidang Informasi',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor:78/KADIH/05/2018 tanggal 22 Mei 2018 dengan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'1. Tiket Jakarta - Aceh (PP) dengan jumlah tiket pesawat di bawah ini melebihi dengan',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'SBU tahun 2018, meliputi :',0,1);
		$pdf->Ln();

		//here is table
		$pdf->Cell(20,7,'',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(70,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Nilai SBU',1,0,'C',0);
		$pdf->Cell(40,5,'Pengeluaran Rill',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(20,7,'',0,0);
        $pdf->SetFont('Arial','',12);
		$pdf->Cell(10,5,'1','LB',0,'R',0);
		$pdf->Cell(70,5,'Tiket Pesawat Jakarta - Aceh (PP)','LRB',0,'L',0);
		$pdf->Cell(40,5,'Rp 4.492.000,00','RB',0,'R',0);
		$pdf->Cell(40,5,'Rp 5.092.000,00','RB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(20,7,'',0,0);
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(70,5,'Jumlah','LRB',0,'C',0);
		$pdf->Cell(40,5,'Rp 4.492.000,00','RB',0,'R',0);
		$pdf->Cell(40,5,'Rp 5.092.000,00','RB',0,'R',0);
        $pdf->Ln();
		//end of table
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'2. Bahwa tiker Jakarta - Aceh (PP) dengan jumlah uang tersebut pada angka (1)',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'melebihi jumlah SBU dan benar - benar dikeluarkan dengan bukti rill kuitansi tiket',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'Perjalanan Dinas dimaksud.',0,1);
		$pdf->Ln();
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'sebagaimana mestinya.',0,1);
		$pdf->Ln();
		$pdf->Ln();
		//Footer Surat
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(20,6,'',0,0,'C');
		$pdf->MultiCell(60,6,'Jakarta, 4 Juni 2018',0,'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(18,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'R');
		$pdf->Cell(100,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(50,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(100,6,' Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Ln();
		$pdf->Cell(100,6,"Linda Lestari, S.Kom.",0, 0,'C');
		$pdf->MultiCell(72.5,6,'Yanuar Yuda Darmawan, S.Kom.',0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,"NIP. 19790305 200501 2 001",0, 0,'C');
		$pdf->MultiCell(72.5,6,'NIP. 19800126 201012 1 001',0,'C');

		//Cetak gans
		$pdf->Output();
	}

	//Page Surat Pernyataan Kehilangan Boarding
	function moxpoy() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(0,25,"SURAT PERNYATAAN",0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini :",0,'L');
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Dyah Rusmiasih, S.T., M.Kom., MDMa.',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'19660902 198903 2 001',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Kepala Sub Bidang Pemeliharaan Sistem Jaringan',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor: 18/KADIH/05/2018 tanggal 15 Februari 2018 dengan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'1. Boarding Pass Jakarta - Denpasar dengan jumlah tiket pesawat dibawah ini tidak',0,1);
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'melebihi dengan SBU tahun 2018, meliputi :',0,1);
		$pdf->Ln();

		//here is table
		$pdf->Cell(20,7,'',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(70,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Nilai SBU',1,0,'C',0);
		$pdf->Cell(40,5,'Pengeluaran Rill',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(20,7,'',0,0);
        $pdf->SetFont('Arial','',12);
		$pdf->Cell(10,5,'1','LB',0,'R',0);
		$pdf->Cell(70,5,'Tiket Pesawat Jakarta - Denpasar','LRB',0,'L',0);
		$pdf->Cell(40,5,'Rp 1.631.000,00','RB',0,'R',0);
		$pdf->Cell(40,5,'Rp 1.001.000,00','RB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(20,7,'',0,0);
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(70,5,'Jumlah','LRB',0,'C',0);
		$pdf->Cell(40,5,'Rp 1.631.000,00','RB',0,'R',0);
		$pdf->Cell(40,5,'Rp 1.001.000,00','RB',0,'R',0);
        $pdf->Ln();
		//end of table

		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'2. Boarding Pass Jakarta - Aceh hilang dengan jumlah uang tersebut pada angka',0,1);
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'(1) sesuai dengan SBU dan benar - benar dikeluarkan sesuai dengan bukti rill kuitansi',0,1);
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'tiket Perjalanan Dinas dimaksud.',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'3. Apabila dikemudian hari ditemukan suatu temuan terkait Boarding Pass tersebut,',0,1);
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'maka saya akan bertanggung jawab.',0,1);
		$pdf->Ln();
		$pdf->Cell(20,7,'',0,0);
		$pdf->Cell(20,7,'Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'sebagaimana mestinya.',0,1);
		$pdf->Ln();
		$pdf->Ln();
		//Footer Surat
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(20,6,'',0,0,'C');
		$pdf->MultiCell(60,6,'Jakarta, 27 Februari 2018',0,'R');
		$pdf->Ln();
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'C');
		$pdf->Cell(85,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(65,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(85,6,' Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Ln();
		$pdf->Cell(85,6,"Linda Lestari, S.Kom.",0, 0,'C');
		$pdf->MultiCell(105,6,'Dyah Rusmiasih, S.T., M.Kom., MDMa',0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(85,6,"NIP. 19790305 200501 2 001",0, 0,'C');
		$pdf->MultiCell(105,6,'NIP. 196600902 198903 2 001',0,'C');

		//Cetak gans
		$pdf->Output();
	}

	//Page Rincian Perhitungan SPD Rampung
	function spd_rampung() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Cell(0,6,"RINICIAN PERHITUNGAN SPD RAMPUNG",0,1,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(34,6,'Lamp. SPD Nomor',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,'$nomor',0,'L');
		$pdf->Cell(34,6,'Tanggal',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,'$var_tgl_surat',0,'L');
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'No',1,0,'C',0);
		$pdf->Cell(75,6,'Perincian biaya',1,0,'C',0);
		$pdf->Cell(40,6,'Jumlah',1,0,'C',0);
		$pdf->Cell(55,6,'Keterangan',1,0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'L',0);
		$pdf->Cell(75,6,'RINCIAN PENGELUARAN','LR',0,'L',0);
		$pdf->Cell(40,6,'','R',0,'C',0);
		$pdf->Cell(55,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,'1','L',0,'C',0);
		$pdf->Cell(75,6,'Uang Harian','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 2.400.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Perjalanan dinas ke :','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'2','L',0,'C',0);
		$pdf->Cell(75,6,'Penginapan','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 3.000.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Ke Provinsi Bali','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'3','L',0,'C',0);
		$pdf->Cell(75,6,'Tiket Pesawat','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 2.811.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'(selama 5 hari)','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'4','L',0,'C',0);
		$pdf->Cell(75,6,'Transport','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 830.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Tanggal 19 s.d 23 Februari 2018','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
		$pdf->Cell(40,6,'Rp 9.041.000,00','TR',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();

		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'YANG TELAH DIBAYARKAN :','LR',0,'L',0);
		$pdf->Cell(40,6,'','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,'1','L',0,'C',0);
		$pdf->Cell(75,6,'Uang Harian','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 0,00','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'2','L',0,'C',0);
		$pdf->Cell(75,6,'Penginapan','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 0,00','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'3','L',0,'C',0);
		$pdf->Cell(75,6,'Tiket Pesawat','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 0,00','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'4','L',0,'C',0);
		$pdf->Cell(75,6,'Transport','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 0,00','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
		$pdf->Cell(40,6,'Rp 0,00','TR',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'SISA KURANG','LR',0,'L',0);
		$pdf->Cell(40,6,'','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(75,6,'Jumlah :','LBR',0,'R',0);
		$pdf->Cell(40,6,'Rp 9.041.000,00','BR',0,'R',0);
		$pdf->Cell(55,6,'','BR',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(75,6,'Terbilang :','LBR',0,'R',0);
		$pdf->Cell(95,6,$this->Terbilang(9041000)." rupiah",'BR',0,'L',0);
		$pdf->Ln();
		//end of table
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(40,6,'',0,0,'C');
		$pdf->MultiCell(50,6,'Jakarta, ',0,'R');

		$pdf->Ln();
		$pdf->Cell(100,6,"Mengetahui \nPejabat Pembuat Komitmen",0, 0,'C');
		$pdf->MultiCell(70,6,'Yang melakukan perjalanan dinas',0,'R');

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','BU',10);
		$pdf->Ln();
		$pdf->Cell(100,6,'$nama_ppk',0, 0,'C');
		$pdf->MultiCell(70,6,'Leonard, S.T',0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,'NIP.'  ,0, 0,'C');
		$pdf->MultiCell(70,6,'NIP. 19820107 200912 1 002',0,'C');

		//Cetak gans
		$pdf->Output();
	}

	//Page Perincian Biaya Perjalanan Dinas
	function biaya() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,6,"PERINCIAN BIAYA PERJALANAN DINAS",0,1,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(34,6,'Lamp. SPD Nomor',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,'$nomor',0,'L');
		$pdf->Cell(34,6,'Tanggal',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,'$var_tgl_surat',0,'L');
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'No',1,0,'C',0);
		$pdf->Cell(75,6,'Perincian biaya',1,0,'C',0);
		$pdf->Cell(40,6,'Jumlah',1,0,'C',0);
		$pdf->Cell(55,6,'Keterangan',1,0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,'1','L',0,'C',0);
		$pdf->Cell(75,6,'Uang Harian','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 2.400.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Perjalanan dinas ke :','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'2','L',0,'C',0);
		$pdf->Cell(75,6,'Penginapan','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 3.640.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Ke Provinsi Bali','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'3','L',0,'C',0);
		$pdf->Cell(75,6,'Tiket Pesawat','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 3.262.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'(selama 5 hari)','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'4','L',0,'C',0);
		$pdf->Cell(75,6,'Transport','LR',0,'L',0);
		$pdf->Cell(40,6,'Rp 830.000,00','R',0,'R',0);
		$pdf->Cell(55,6,'Tanggal 19 s.d 23 Februari 2018','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'','LR',0,'L',0);
		$pdf->Cell(40,6,'','R',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
		$pdf->Cell(40,6,'Rp 10.132.000,00','TR',0,'R',0);
		$pdf->Cell(55,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(75,6,'','LBR',0,'L',0);
		$pdf->Cell(40,6,'','BR',0,'R',0);
		$pdf->Cell(55,6,'','BR',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(75,6,'Terbilang :','LBR',0,'R',0);
		$pdf->Cell(95,6,$this->Terbilang(10132000)." rupiah",'BR',0,'L',0);
		$pdf->Ln();
		//end of table
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(10,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(40,6,'',0,0,'C');
		$pdf->MultiCell(50,6,'Jakarta, 15 Februari 2018 ',0,'R');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(10,6,'Telah dibayar sejumlah',0,0,'L');
		$pdf->Cell(29,6,'',0,0,'R');
		$pdf->Cell(40,6,'',0,0,'C');
		$pdf->MultiCell(80,6,'Telah menerima jumlah uang sebesar',0,'R');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(10,6,'Rp 0.00',0,0,'L');
		$pdf->Cell(40,6,'',0,0,'R');
		$pdf->Cell(48,6,'',0,0,'C');
		$pdf->MultiCell(80,6,'Rp 0.00',0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(100,6,"Bendahara Pengeluaran Pembantu",0, 0,'C');
		$pdf->MultiCell(50,6,'Yang menerima',0,'R');

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','BU',10);
		$pdf->Ln();
		$pdf->Cell(100,6,'Murliana',0, 0,'C');
		$pdf->MultiCell(74,6,'Leonard, S.T',0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,'NIP. 19820107 200912 1 002'  ,0, 0,'C');
		$pdf->MultiCell(74,6,'NIP. 19820107 200912 1 002',0,'C');
		$pdf->Ln();
		$pdf->Cell(187,6,'','B',0,'C');


		//Cetak gans
		$pdf->Output();
	}

	//Page Surat Perintah Dinas
	function perintah() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(150,3,'BADAN NASIONAL PENANGGULANGAN BENCANA',0,0,'L');
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(25,3,'Lembar ke : ',0,'L');
		$pdf->Ln();
		$pdf->Cell(150,3,'Jl. Pramuka Kav. 38 - Jakarta Timur 13120',0,0,'L');
		$pdf->Cell(25,3,'Kode No. : ',0,'L');
		$pdf->Ln();
		$pdf->Cell(150,3,'',0,0,'L');
		$pdf->Cell(25,3,'Nomor : ',0,0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Cell(0,10,'SURAT PERINTAH DINAS',0,1,'C');
		//this is the table
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,5,'1.','LT',0,'C',0);
		$pdf->Cell(70,5,'Pejabat Pembuat Komitmen','LTR',0,'L',0);
		$pdf->Cell(90,5,'Pusat Data Informasi dan Humas','TR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'2.','L',0,'C',0);
		$pdf->Cell(70,5,'Nama Pegawai yang','LR',0,'L',0);
		$pdf->Cell(90,5,'Leonard,S.T.','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'diperintahkan','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'3.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Pangkat dan golongan','LR',0,'L',0);
		$pdf->Cell(90,5,'a. III','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'b. Jabatan / Instansi','LR',0,'L',0);
		$pdf->Cell(90,5,'b. ','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'c. Tingkat biaya perjalanan dinas','LBR',0,'L',0);
		$pdf->Cell(90,5,'c. c','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'4','L',0,'C',0);
		$pdf->Cell(70,5,'Maksud perjalanan Dinas','LR',0,'L',0);
		$pdf->Cell(90,5,'Melakukan penyelesaian hibah final pusdatinmas BNPB kepada BPBD','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'','LBR',0,'L',0);
		$pdf->Cell(90,5,'Provinsi, Kabupaten dan Kota','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'5','LB',0,'C',0);
		$pdf->Cell(70,5,'Alat angkutan yang dipergunakan','LBR',0,'L',0);
		$pdf->Cell(90,5,'udara','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'6.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Tempat berangkat','LR',0,'L',0);
		$pdf->Cell(90,5,'a. Jakarta','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'b. Tempat tujuan','LBR',0,'L',0);
		$pdf->Cell(90,5,'b. Provinsi Maluku Utara','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'7.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Lamanya perjalanan Dinas','LR',0,'L',0);
		$pdf->Cell(90,5,'a. 3 (Tiga) Hari','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'b. Tanggal berangkat','LR',0,'L',0);
		$pdf->Cell(90,5,'b. 30 Mei 2018','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'c. Tanggal harus kembali /','LR',0,'L',0);
		$pdf->Cell(90,5,'c. 1 Juni 2018','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'    Tiba di tempat baru','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'8.','L',0,'C',0);
		$pdf->Cell(25,5,'Pengikut :','L',0,'L',0);
		$pdf->Cell(45,5,'Nama','R',0,'L',0);
		$pdf->Cell(50,5,'Tanggal Lahir','R',0,'C',0);
		$pdf->Cell(40,5,'Keterangan','R',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(25,5,'1.','L',0,'C',0);
		$pdf->Cell(45,5,'','R',0,'L',0);
		$pdf->Cell(50,5,'','R',0,'C',0);
		$pdf->Cell(40,5,'','R',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(25,5,'2.','L',0,'C',0);
		$pdf->Cell(45,5,'','R',0,'L',0);
		$pdf->Cell(50,5,'','R',0,'C',0);
		$pdf->Cell(40,5,'','R',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(25,5,'3.','L',0,'C',0);
		$pdf->Cell(45,5,'','R',0,'L',0);
		$pdf->Cell(50,5,'','R',0,'C',0);
		$pdf->Cell(40,5,'','R',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(25,5,'4.','L',0,'C',0);
		$pdf->Cell(45,5,'','R',0,'L',0);
		$pdf->Cell(50,5,'','R',0,'C',0);
		$pdf->Cell(40,5,'','R',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(25,5,'5.','LB',0,'C',0);
		$pdf->Cell(45,5,'','RB',0,'L',0);
		$pdf->Cell(50,5,'','RB',0,'C',0);
		$pdf->Cell(40,5,'','RB',0,'C',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'9.','L',0,'C',0);
		$pdf->Cell(70,5,'Pembebanan anggaran :','LR',0,'L',0);
		$pdf->Cell(90,5,'','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'a. Instansi','LR',0,'L',0);
		$pdf->Cell(90,5,'a. BADAN NASIONAL PENANGGULANGAN BENCANA','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'b. Mata Anggaran','LBR',0,'L',0);
		$pdf->Cell(90,5,'b. 524111','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
        $pdf->Cell(10,5,'10.','L',0,'C',0);
		$pdf->Cell(70,5,'Pejabat Pembuat Komitmen','LR',0,'L',0);
		$pdf->Cell(90,5,'Pusat Data Informasi dan Humas','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        //end of table
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(70,6,'Coret yang tidak perlu',0,0,'L');
		$pdf->Ln();
		$pdf->Cell(112,7,'',0,0);
		$pdf->Cell(30,5,'Dikeluarkan di :',0,0,'L');
		$pdf->Cell(20,5,'Jakarta',0,0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(112,7,'',0,0);
		$pdf->Cell(30,5,'Pada tanggal :','B',0,'L');
		$pdf->Cell(20,5,'22 Mei 2018','B',0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(116.5,7,'',0,0);
		$pdf->Cell(40,4,'Pejabat Pembuat Komitmen',0,0,'C');
		$pdf->Ln();
		$pdf->Cell(116.5,7,'',0,0);
		$pdf->Cell(40,4,'Pusat Data Informasi dan Humas',0,0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','U',8);
		$pdf->Cell(116.5,6,'',0,0);
		$pdf->Cell(40,4,'Linda Lestari, S.Kom.',0,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(116.5,6,'',0,0);
		$pdf->Cell(40,4,'NIP. 19790305 200501 2 001',0,0,'C');

		//Cetak gans
		$pdf->Output();
	}

	function jadwal() {
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,6,"Lampiran Surat Tugas",0,1,'R');
		$pdf->Cell(0,6,"Nomor: nomor",0,1,'R');
		$pdf->Cell(0,6,"Tanggal: var_tgl_surat",0,1,'R');
		$pdf->Ln();
		$pdf->Cell(0,10,"Jadwal",0,1,'C');

		//here is the table
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'No.',1,0,'C',0);
		$pdf->Cell(50,6,'Nama',1,0,'C',0);
		$pdf->Cell(65,6,'BPBD',1,0,'C',0);
		$pdf->Cell(50,6,'Tanggal',1,0,'C',0);
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'1.','L',0,'C',0);
		$pdf->Cell(50,6,'-Meliwaty, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Lampung','LBR',0,'C',0);
		$pdf->Cell(50,6,'30 Mei s.d 1 Juni 2018','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-Dinda Tasnym','LB',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Kalimantan Barat','LBR',0,'C',0);
		$pdf->Cell(50,6,'4 s.d 6 Juni 2018','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'2.','L',0,'C',0);
		$pdf->Cell(50,6,'-Linda Lestari, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Jawa Barat dan Kota','LR',0,'C',0);
		$pdf->Cell(50,6,'6 s.d 8 Juni 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,'-Atang Supena, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Banjar','LR',0,'C',0);
		$pdf->Cell(50,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-Ersal Erlangga, S.Ip.','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'3.','L',0,'C',0);
		$pdf->Cell(50,6,'-Atang Supena, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Sulawesi Barat','LR',0,'C',0);
		$pdf->Cell(50,6,'27 s.d 29 Mei 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-Andi Ahmad Bashir','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'4.','L',0,'C',0);
		$pdf->Cell(50,6,'-Yanuar Yuda','L',0,'L',0);
		$pdf->Cell(65,6,'','LR',0,'C',0);
		$pdf->Cell(50,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,' Darmawan, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Aceh Jaya','LR',0,'C',0);
		$pdf->Cell(50,6,'27 s.d 29 Mei 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-Ersal Erlangga, S.Ip.','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'5.','L',0,'C',0);
		$pdf->Cell(50,6,'-Yanuar Yuda','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Tulungagung dan','LR',0,'C',0);
		$pdf->Cell(50,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,' Darmawan, S.Kom.','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Blitar','LR',0,'C',0);
		$pdf->Cell(50,6,'4 s.d 6 Juni 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-M Syaiful Hadi, S.T.','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'6.','L',0,'C',0);
		$pdf->Cell(50,6,'-Dyah Rusmiasih, S.T.,','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Manggarai,','LR',0,'C',0);
		$pdf->Cell(50,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,' M.Kom., MDMa.','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Manggarai Barat','LR',0,'C',0);
		$pdf->Cell(50,6,'29 Mei s.d 1 Juni 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,'-M Syaiful Hadi, S.T.','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'7.','L',0,'C',0);
		$pdf->Cell(50,6,'-Leonard, S.T.','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Maluku Utara','LBR',0,'C',0);
		$pdf->Cell(50,6,'30 Mei s.d 1 Juni 2018','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,'-Abd Kodir Jaelani,','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Sumatra Utara dan','LR',0,'C',0);
		$pdf->Cell(50,6,'4 s.d 7 Juni 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,' S.Kom.','LB',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Nias','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'8.','L',0,'C',0);
		$pdf->Cell(50,6,'-Mochammad','L',0,'L',0);
		$pdf->Cell(65,6,'Kabupaten Lombok Timur','LBR',0,'C',0);
		$pdf->Cell(50,6,'27 s.d 29 Mei 2018','BR',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,' Zakiyamani','L',0,'L',0);
		$pdf->Cell(65,6,'','LR',0,'C',0);
		$pdf->Cell(50,6,'','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(50,6,'-Ardi Karman Yumiardi,','L',0,'L',0);
		$pdf->Cell(65,6,'Provinsi Papua','LR',0,'C',0);
		$pdf->Cell(50,6,'4 s.d 7 Juni 2018','R',0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','LB',0,'C',0);
		$pdf->Cell(50,6,' S.T.','LB',0,'L',0);
		$pdf->Cell(65,6,'','LBR',0,'C',0);
		$pdf->Cell(50,6,'','BR',0,'C',0);
		$pdf->Ln();

		//Cetak gans
		$pdf->Output();
	}

	function ena ($id) {
		$surat_tugas = $this->db->select('nomor')->get_where('surat_dinas', array('id' => $id))->result();
		echo $surat_tugas['0']->nomor;
	}

	function print_biaya($id) {
		$data['nama'] = $this->home_model->get_yang_dinas($id);
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('print_biaya', $data);
		$this->load->view('footer');
	}
	function form_biaya($id) {
		$data['nama'] = $this->home_model->get_yang_dinas($id);
		$this->load->view('navbar');
		$this->load->view('header');
		$this->load->view('form_biaya', $data);
		$this->load->view('footer');
	}

	function tanggal_indo($tanggal)
	{
		$bulan = array (1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		//echo tanggal_indo('2016-03-20'); // 20 Maret 2016
	}

	function reverse_tanggal($tanggal) {
		implode('-', array_reverse(explode('-', $tanggal[0])));
	}

	function terbilang($bilangan) {

		$angka = array('0','0','0','0','0','0','0','0','0','0',
			'0','0','0','0','0','0');
		$kata = array('','satu','dua','tiga','empat','lima',
			'enam','tujuh','delapan','sembilan');
		$tingkat = array('','ribu','juta','milyar','triliun');

		$panjang_bilangan = strlen($bilangan);

		/* pengujian panjang bilangan */
		if ($panjang_bilangan > 15) {
			$kalimat = "Diluar Batas";
			return $kalimat;
		}

		/* mengambil angka-angka yang ada dalam bilangan,
           dimasukkan ke dalam array */
		for ($i = 1; $i <= $panjang_bilangan; $i++) {
			$angka[$i] = substr($bilangan,-($i),1);
		}

		$i = 1;
		$j = 0;
		$kalimat = "";


		/* mulai proses iterasi terhadap array angka */
		while ($i <= $panjang_bilangan) {

			$subkalimat = "";
			$kata1 = "";
			$kata2 = "";
			$kata3 = "";

			/* untuk ratusan */
			if ($angka[$i+2] != "0") {
				if ($angka[$i+2] == "1") {
					$kata1 = "seratus";
				} else {
					$kata1 = $kata[$angka[$i+2]] . " ratus";
				}
			}

			/* untuk puluhan atau belasan */
			if ($angka[$i+1] != "0") {
				if ($angka[$i+1] == "1") {
					if ($angka[$i] == "0") {
						$kata2 = "sepuluh";
					} elseif ($angka[$i] == "1") {
						$kata2 = "sebelas";
					} else {
						$kata2 = $kata[$angka[$i]] . " belas";
					}
				} else {
					$kata2 = $kata[$angka[$i+1]] . " puluh";
				}
			}

			/* untuk satuan */
			if ($angka[$i] != "0") {
				if ($angka[$i+1] != "1") {
					$kata3 = $kata[$angka[$i]];
				}
			}

			/* pengujian angka apakah tidak nol semua,
               lalu ditambahkan tingkat */
			if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
				($angka[$i+2] != "0")) {
				$subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
			}

			/* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
               ke variabel kalimat */
			$kalimat = $subkalimat . $kalimat;
			$i = $i + 3;
			$j = $j + 1;

		}

		/* mengganti satu ribu jadi seribu jika diperlukan */
		if (($angka[5] == "0") AND ($angka[6] == "0")) {
			$kalimat = str_replace("satu ribu","seribu",$kalimat);
		}

		return trim($kalimat);

	}
}