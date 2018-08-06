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
		$pdf->Cell(20,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini",0,'L');
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'Leonard',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'19820107 200912 1 002',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,'Staf Bidang Informasi',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor:78/KADIH/05/2018 tanggal 22 Mei 2018 dengan ini kami',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'menyatakan dengan sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'1. Biaya Transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'diperoleh bukti-bukti pengeluarannya meliputi :',0,1);
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		//$pdf->Cell(40,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(100,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Jumlah',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','',10);
		//$pdf->Cell(40,5,'Solid Here','LR',0,'C',0);  // cell with left and right borders
		$pdf->Cell(10,5,'1','LR',0,'R',0);
		$pdf->Cell(70,5,'Transport Bandara Jakarta (PP)','L',0,'L',0);
		$pdf->Cell(30,5,'2 x 256.000','R',0,'R',0);
		$pdf->Cell(40,5,'942.000,00','LR',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10,5,'2','LRB',0,'R',0);
		$pdf->Cell(70,5,'Transport Bandara Bali (PP)','B',0,'L',0);
		$pdf->Cell(30,5,'2 x 256.000','B',0,'R',0);
		$pdf->Cell(40,5,'942.000,00','LRB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','B',10);
		//$pdf->Cell(40,5,'','LBR',0,'L',0);   // empty cell with left,bottom, and right borders
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(100,5,'Jumlah','RB',0,'C',0);
		$pdf->Cell(40,5,'942.000,00','LRB',0,'R',0);
        $pdf->Ln();
        //end of table
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'2. Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'perjalanan dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas,',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke Kas Negara.',0,1);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		//Footer Surat
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(20,6,'',0,0,'C');
		$pdf->MultiCell(60,6,'Jakarta, 27 Februari 2018',0,'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'R');
		$pdf->Cell(100,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(50,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(100,6,'Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',10);
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
		$pdf->Cell(20,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini :",0,'L');
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Yanuar Yuda Darmawan, S.Kom.',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'19800126 201012 1 001',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Staf Bidang Informasi',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor:78/KADIH/05/2018 tanggal 22 Mei 2018 dengan',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'1. Tiket Jakarta - Aceh (PP) dengan jumlah tiket pesawat di bawah ini melebihi dengan',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'SBU tahun 2018, meliputi :',0,1);
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','B',12);
		//$pdf->Cell(40,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(70,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Nilai SBU',1,0,'C',0);
		$pdf->Cell(40,5,'Pengeluaran Rill',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','',12);
		//$pdf->Cell(40,5,'Solid Here','LR',0,'C',0);  // cell with left and right borders
		$pdf->Cell(10,5,'1','LRB',0,'R',0);
		$pdf->Cell(70,5,'Tiket Pesawat Jakarta - Aceh (PP)','LB',0,'L',0);
		$pdf->Cell(40,5,'Rp 4.492.000,00','LRB',0,'R',0);
		$pdf->Cell(40,5,'Rp 5.092.000,00','LRB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','B',12);
		//$pdf->Cell(40,5,'','LBR',0,'L',0);   // empty cell with left,bottom, and right borders
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(70,5,'Jumlah','RB',0,'C',0);
		$pdf->Cell(40,5,'Rp 4.492.000,00','LRB',0,'R',0);
		$pdf->Cell(40,5,'Rp 5.092.000,00','LRB',0,'R',0);
        $pdf->Ln();
		//end of table
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'2. Bahwa tiker Jakarta - Aceh (PP) dengan jumlah uang tersebut pada angka (1)',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'melebihi jumlah SBU dan benar - benar dikeluarkan dengan bukti rill kuitansi',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'tiket Perjalanan Dinas dimaksud.',0,1);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan',0,1);
		$pdf->Cell(10,7,'',0,0);
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
		$pdf->MultiCell(60,6,'Jakarta, 4 Juni 2018',0,'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'R');
		$pdf->Cell(100,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(50,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(100,6,' Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
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
		$pdf->Cell(20,7,'',0,0);
		$pdf->MultiCell(0,6,"Yang bertandatangan di bawah ini :",0,'L');
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'Nama',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Dyah Rusmiasih, S.T., M.Kom., MDMa.',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'19660902 198903 2 001',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(20,7,'Kepala Sub Bidang Pemeliharaan Sistem Jaringan',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor: 18/KADIH/05/2018 tanggal 15 Februari 2018 dengan',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'1. Boarding Pass Jakarta - Denpasar dengan jumlah tiket pesawat dibawah ini tidak',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'melebihi dengan SBU tahun 2018, meliputi :',0,1);
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','B',12);
		//$pdf->Cell(40,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(10,5,'No.',1,0,'C',0);
		$pdf->Cell(70,5,'Uraian',1,0,'C',0);
		$pdf->Cell(40,5,'Nilai SBU',1,0,'C',0);
		$pdf->Cell(40,5,'Pengeluaran Rill',1,0,'C',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','',12);
		//$pdf->Cell(40,5,'Solid Here','LR',0,'C',0);  // cell with left and right borders
		$pdf->Cell(10,5,'1','LRB',0,'R',0);
		$pdf->Cell(70,5,'Tiket Pesawat Jakarta - Denpasar','LB',0,'L',0);
		$pdf->Cell(40,5,'Rp 1.631.000,00','LRB',0,'R',0);
		$pdf->Cell(40,5,'Rp 1.001.000,00','LRB',0,'R',0);
        $pdf->Ln();
        $pdf->Cell(5,7,'',0,0);
        $pdf->Cell(10,7,'',0,0);
        $pdf->SetFont('Arial','B',12);
		//$pdf->Cell(40,5,'','LBR',0,'L',0);   // empty cell with left,bottom, and right borders
		$pdf->Cell(10,5,'','LB',0,'L',0);
		$pdf->Cell(70,5,'Jumlah','RB',0,'C',0);
		$pdf->Cell(40,5,'Rp 1.631.000,00','LRB',0,'R',0);
		$pdf->Cell(40,5,'Rp 1.001.000,00','LRB',0,'R',0);
        $pdf->Ln();
		//end of table
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'2. Boarding Pass Jakarta - Aceh hilang dengan jumlah uang tersebut pada angka',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'(1) sesuai dengan SBU dan benar - benar dikeluarkan sesuai dengan bukti rill kuitansi',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'tiket Perjalanan Dinas dimaksud.',0,1);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'3. Apabila dikemudian hari ditemukan suatu temuan terkait Boarding Pass tersebut,',0,1);
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->Cell(20,7,'maka saya akan bertanggung jawab.',0,1);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,7,'',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,7,'Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan',0,1);
		$pdf->Cell(10,7,'',0,0);
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
		$pdf->Ln();
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->MultiCell(55,6,'Mengetahui/Menyetujui',0,'R');
		$pdf->Cell(100,6,'Pejabat Pembuat Komitmen',0, 0,'C');
		$pdf->MultiCell(50,6,'Pelaksana SPD',0,'R');
		$pdf->Cell(100,6,' Pusat Data Informasi dan Humas',0, 0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln();
		$pdf->Cell(100,6,"Linda Lestari, S.Kom.",0, 0,'C');
		$pdf->MultiCell(72.5,6,'Dyah Rusmiasih, S.T., M.Kom., MDMa',0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(100,6,"NIP. 19790305 200501 2 001",0, 0,'C');
		$pdf->MultiCell(72.5,6,'NIP. 196600902 198903 2 001',0,'C');

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
