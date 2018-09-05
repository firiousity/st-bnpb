<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_PDF extends CI_Controller {
	private  $extension = ".pdf";


	/**
	 * This controller provide engine to manage data of Surat Dinas in BNPB
	 * We using FPDF and MC_Tables for make autoheight base on content length
	 * Please be careful when you want to edit
	 * You can contact me at mnurilmanbaehaqi@gmail.com as Backend devs
	 * You can contact on instagram kelikisc and firiousity as Front end devs
	 * Native Inc. All Right Reserved
	 */


	function __Construct()
    {
        parent ::__construct();
        $this->load->model("home_model");
        $this->load->library("pagination");
    }

    /*
     * Helper Function
     * Your necessary function */

    /* This function return the format of number */
    function rupiah($n) {
		return number_format($n,2,',','.');
	}

	/* Converting php date format into String */
	function tanggal_indo($tanggal, $delimiter)
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
		$split = explode($delimiter, $tanggal);
		if ($delimiter == '/') {
			return $split[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[2];
		} elseif ($delimiter == '-') {
			return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}
	}

	function reverse_tanggal($tanggal) {
		implode('-', array_reverse(explode('-', $tanggal[0])));
	}

	/* This function will generate number into string sentence */
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

	/* How many days between two input date */
	function hitung_hari($awal,$akhir){
		$tglAwal = strtotime($awal);
		$tglAkhir = strtotime($akhir);
		$jeda = abs($tglAkhir - $tglAwal);
		return floor($jeda/(60*60*24));
	}

	/* Just show you alert, you only need to pass the parameters*/
	function alert ($message) {
		echo "<script>         	
         	alert($message);</script>";
	}

	/* This funtion will automatically redirect to another input route */
    function href($route) {
		echo "<script>
         	window.location.href='".base_url()."$route';</script>";
	}

	/* ------------------------------------------------------------- */


	public function index()
	{
		$this->load->view('layouts/navbar');
		$this->load->view('layouts/header');
		$this->load->view('login');
		$this->load->view('layouts/footer');
	}

	/* PRINT SURAT DINAS (2 LEMBAR) */

	function print($id) {

		/* DEFINE VARIABLE WE WILL USED */
		$surat_tugas	= $this->db->get_where('surat_dinas',
			array('id' => $id))->result();
		$pegawai 		= $this->db->get_where('pegawai',
			array('jabatan_pegawai' => 'Kepala Pusat Data Informasi dan Humas'))->result();
		$nomor 			= $surat_tugas['0']->nomor;
		$id_pos 			= $surat_tugas['0']->pos;
		$var_kegiatan 	= $surat_tugas['0']->kegiatan;

		//get pos kegiatan
		$pos_result = $this->db->get_where('pos_kegiatan',
			array('id' => $id_pos))->result();
		$pos = $pos_result['0']->kegiatan;

		//Get data only one from data_rinci table
		$data_rinci	= $this->db->limit(1)->get_where('data_rinci',
			array('id_surat' => $id))->result();
		//Get all data from data_rinci table
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $id))->result();
		//Get pegawai from join table with yang_dinas
		$nama_result = $this->home_model->get_data_rinci_pegawai($id);
		$num_pegawai = count($nama_result);


		//get type of pegawai
		$opsi = $data_rinci['0']->opsi;

		$var_tempat 	= $data_rinci['0']->tempat;
		$var_tgl_mulai 	= $data_rinci['0']->tgl_mulai;
		$var_tgl_akhir 	= $data_rinci['0']->tgl_akhir;

		$var_tahun_kegiatan 	= substr($data_rinci['0']->tgl_surat, -4);
		$var_tgl_surat 			= $data_rinci['0']->tgl_surat;

		$kapusdatin 			= $pegawai['0']->nama_pegawai;
		$tgl_sekarang 			= date('d')."-".date('m')."-".date('Y');
		$arr_nomor = explode('/', $nomor);
		$nomor_surat = trim($arr_nomor[0], " ");

		$pdf = new PDF_MC_Table('p','mm','A4');

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
		$pdf->Cell(0,10,"NOMOR:    ".$nomor,0,1,'C');
		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,6,'Menimbang',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->MultiCell(0,6,"Dalam rangka melakukan kegiatan $var_kegiatan di $var_tempat",0,'J');
		//$pdf->Cell(27,6,'Dalam rangka melakukan kegiatan $kegiatan di $tempat  pada $waktu	',0,0);
		$pdf->Cell(25,6,'Dasar',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'1.',0,0);
		$pdf->MultiCell(0,6,"Keputusan Presiden Nomor 72 Tahun 2004 tentang Pelaksanaan Anggaran Pendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Menteri Keuangan Nomor 134/PMK.06/2005 tentang Pedoman Pembayaran dalam Pelaksanan Anggaran Pendapatan dan Belanja Negara;",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'3.',0,0);
		$pdf->MultiCell(0,6,"Peraturan Kepala Badan Nasional Penanggulangan Bencana Nomor 1 tahun 2008 tentang Organisasi dan Tata Kerja Badan Nasional Penanggulangan Bencana.",0,'J');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,10,"Memberi tugas",0,1,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,6,'Kepada',0,0);
		$pdf->Cell(5,6,':',0,0);

		//kalo jumlah pegawai yg ditugaskan kurang dari 4
		if($num_pegawai < 4 && $opsi == "0") {
			$counterr = 1;
			foreach ($nama_result as $row) {
				$pdf->Cell(6,6,$counterr. ". ",0,0);
				$pdf->MultiCell(0,6,"$row->nama_pegawai",0,'J');
				$pdf->Cell(30,6,"",0,0);
				$counterr++;
			}
		} else  {
			$pdf->MultiCell(0,6,"Daftar Terlampir",0,'L');
		}

		$pdf->MultiCell(0,6,"",0,'L');
		$pdf->Cell(25,6,'Untuk',0,0);
		$pdf->Cell(5,6,':',0,0);
		$pdf->Cell(5,6,'1.',0,0);
		if ($opsi == "1") {
			$pdf->MultiCell(0,6,"Dinas ke BPBD dalam rangka mendukung kegiatan ".$var_kegiatan.";",0,'J');
		} else {
			$pdf->MultiCell(0,6,"Dinas ke ".$var_tempat." dalam rangka mendukung kegiatan ".$var_kegiatan." tahun ".$var_tahun_kegiatan.", pada tanggal "
				.$this->tanggal_indo($var_tgl_mulai,'-')." s.d "
				.$this->tanggal_indo($var_tgl_akhir,'-').";",0,'J');
		}

		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'2.',0,0);
		$pdf->MultiCell(0,6,"Melaksanakan tugas ini dengan penuh tanggungjawab;",0,'L');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'3.',0,0);
		$pdf->MultiCell(0,6,"Segala biaya yang dikeluarkan untuk tugas tersebut di atas dibebankan kepada DIPA BNPB TA ". date('Y') .", Pos Kegiatan ".$pos.";",0,'J');
		$pdf->Cell(25,6,'',0,0);
		$pdf->Cell(5,6,'',0,0);
		$pdf->Cell(5,6,'4	.',0,0);
		$pdf->MultiCell(0,6,"Apabila terdapat kekeliruan dalam Surat Tugas ini akan dilakukan perbaikan sebagaimana mestinya.",0,'J');
		$pdf->Ln();
		$pdf->Ln();

		//remove tanggal di surat dinas
		$tanggal_sekarang = $this->tanggal_indo($var_tgl_surat,'/');
		$arr_tgl = explode(' ', $tanggal_sekarang);

		$pdf->Cell(85, 6, "", 0,0);

		//kalo nomor belum diisi maka tanggal juga ga diisi
		if(empty($nomor_surat)) {
			$pdf->MultiCell(0,6,"Jakarta,       ".$arr_tgl[1]." ".$arr_tgl[2],0,'C');
		} else {
			//get tanggal spd rampung
			$rampung_result = $this->db->get_where('spd_rampung', array('id_surat' => $id))->result();
			$tgl = $rampung_result['0']->tgl;
			$tgl_surat = $this->tanggal_indo($tgl, '/');
			$pdf->MultiCell(0,6,"Jakarta, ".$tgl_surat,0,'C');
		}
		$pdf->Cell(85, 6, "", 0,0);
		$pdf->MultiCell(0,6,"Kepala Pusat Data Informasi dan Humas",0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(85, 6, "", 0,0);
		$pdf->MultiCell(0,6,$kapusdatin,0,'C');

		//Page ke-2
		if ($opsi == '0') {
			if($num_pegawai>3) {
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',12);
				$pdf->Cell(0,6,"Lampiran Surat Tugas",0,1,'R');
				$pdf->Cell(0,6,"Nomor: $nomor",0,1,'R');
				$pdf->Cell(0,6,"Tanggal: ". $this->tanggal_indo($var_tgl_surat,'/'),0,1,'R');
				$pdf->Cell(0,10,"Daftar Nama",0,1,'C');
				$pdf->SetFont('Arial','',12);
				$counter = 1;
				foreach ($nama_result as $row) {
					$pdf->Cell(9,6,$counter.". ",0,0);
					$pdf->MultiCell(0,6,$row->nama_pegawai,0,'J');
					$counter++;
				}
			}
		} else if ($opsi == "1") {
			//Print Multiple Tempat
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(115,5,'',0,0,'L');
			$pdf->Cell(25,5,'Lampiran Surat Tugas ',0,'L');
			$pdf->Ln();
			$pdf->Cell(115,5,'',0,0,'L');
			$pdf->Cell(25,5,'Nomor   : '. $nomor,0,'L');
			$pdf->Ln();
			$pdf->Cell(115,5,'',0,0,'L');
			$pdf->Cell(25,5,'Tanggal :  '.$var_tgl_surat,0,0,'L');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(0,10,"Jadwal",0,1,'C');

			//here is the table
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'No.',1,0,'C',0);
			$pdf->Cell(50,6,'Nama',1,0,'C',0);
			$pdf->Cell(65,6,'Tempat',1,0,'C',0);
			$pdf->Cell(50,6,'Tanggal',1,0,'C',0);
			$pdf->SetFont('Arial','',12);
			$counterrr = 1;
			$pdf->Ln();
			foreach ($nama_result as $row) {
				$pdf->Cell(5,7,'',0,0);
				$pdf->SetWidths(array(10, 50, 65, 50));
				for($i=0;$i<1;$i++) {
					$pdf->Row(array($counterrr,$row->nama_pegawai,$row->tempat, $this->tanggal_indo($row->tgl_mulai,'-')
						.' s.d '.$this->tanggal_indo($row->tgl_akhir,'-')));
				}
//				$pdf->Cell(5,7,'',0,0);
//				$pdf->Cell(10,6,$counterrr. '. ',0,0,'C',0);
//				$pdf->Cell(50,6,$row->nama_pegawai,0,0,'L',0);
//				$pdf->Cell(65,6,$row->tempat,0,0,'C',0);
//				$pdf->MultiCell(50,6,$this->tanggal_indo($row->tgl_mulai,'-').' s.d '
//					.$this->tanggal_indo($row->tgl_akhir,'-'),0,'L');
				$counterrr++;
			}

			//end of the table
		}

		//Cetak gans

		$filename = "Surat Dinas - Nomor ".$nomor.$this->extension;
		$pdf->setTitle($filename);
		$pdf->Output("I", $filename);

	}

	//Page Daftar Pengeluaran Rill
	function riil($slug) {
		/* ---- PREPARE VARIABLE ------*/
		$arr_slug		= explode('_', $slug);
		$pegawai_result = $this->db->get_where('pegawai', array('id_pegawai' => $arr_slug[1]))->result();
		$pegawai 		= $pegawai_result['0']->nama_pegawai;
		$jabatan		= $pegawai_result['0']->jabatan_pegawai;
		$nip 		= $pegawai_result['0']->nip_pegawai;
		$surat_result 	= $this->db->get_where('data_rinci', array('id_surat' => $arr_slug[0],
			'id_pegawai' => $arr_slug[1]))->result();
		$nomor 			= $surat_result['0']->nomor;

		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$id_tiket = $data_rinci_all['0']->id_tiket;
		$id_transport = $data_rinci_all['0']->id_transport;
		$id_transport2 = $data_rinci_all['0']->id_transport2;
		$id_lokal = $data_rinci_all['0']->id_lokal;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$sbu_tiket = $tiket_result['0']->biaya_tiket;
		$rute			= $tiket_result['0']->rute;
		$arr_rute = explode('-', $rute);
		$berangkat = $arr_rute[0];
		$tujuan = $arr_rute[1];

		//get sbu transport berangkat
		$transport_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport))->result();
		$sbu_transport = $transport_result['0']->besaran;

		//get sbu transport tujuan
		if($id_transport2 == 0 ) {
			$sbu_transport2 = 0;
		} else {
			$transport2_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport2))->result();
			$sbu_transport2 = $transport2_result['0']->besaran;
		}

		if($id_lokal == 0 ) {
			$lokal_result = 0;
			$besaran_lokal = 0;
			$rute_lokal = "";
		} else {
			//get sbu transport lokal
			$lokal_result	= $this->db->get_where('transportasi_lokal',array('id' => $id_lokal))->result();
			$rute_lokal = $lokal_result['0']->ibukota."-".$lokal_result['0']->kabupaten;
			$besaran_lokal = $lokal_result['0']->besaran;
		}


		$total1 = 2*$sbu_transport;
		$total2 = 2*$sbu_transport2;
		$total_transport = $total1 + $total2 +$besaran_lokal;

		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();
		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;

		$var_tgl_skrg = $this->tanggal_indo(date('Y').'-'.date('m').'-'.date('d'), '-');
		$var_tgl_surat 	= $this->tanggal_indo($surat_result['0']->tgl_surat,'/');

		/* -----------------------------*/
		$pdf = new PDF_MC_Table('p','mm','A4');
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
		$pdf->Cell(20,7,$pegawai,0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'NIP',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,$nip,0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,7,'Jabatan',0,0);
		$pdf->Cell(10,7,':',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,7,$jabatan,0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,6,'Berdasarkan Surat Tugas Nomor:'.$nomor.' tanggal '.$var_tgl_surat.' dengan ini kami menyatakan',0,1);
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,7,'dengan sesungguhnya bahwa :',0,1);
		$pdf->Ln();
		$pdf->Cell(15,7,'',0,0);
		$pdf->Cell(20,6,'1. Biaya Transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-',0,1);
		$pdf->Cell(19,7,'',0,0);
		$pdf->Cell(20,6,'bukti pengeluarannya meliputi :',0,1);
		$pdf->Ln();

		//here is table
		if (empty($lokal_result) ) {
			$pdf->Cell(20,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,5,'No.',1,0,'C',0);
			$pdf->Cell(110,5,'Uraian',1,0,'C',0);
			$pdf->Cell(30,5,'Jumlah',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->Cell(20,7,'',0,0);
	        $pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','L',0,'R',0);
			$pdf->Cell(83,6,'Transport Bandara '.$berangkat.' (PP)','L',0,'L',0);
			$pdf->Cell(5,5,'2 x','',0,'L',0);
			$pdf->Cell(22,6,number_format($sbu_transport,2,',','.'),'R',0,'R',0);
			$pdf->Cell(30,6,number_format($total1,2,',','.'),'R',0,'R',0);
	        $pdf->Ln();
	        $pdf->Cell(20,7,'',0,0);
	        $pdf->Cell(10,5,'2','LB',0,'R',0);
	        $pdf->Cell(83,5,'Transport Bandara '.$tujuan.' (PP)','LB',0,'L',0);
			$pdf->Cell(5,5,'2 x','B',0,'L',0);
			$pdf->Cell(22,5,number_format($sbu_transport2,2,',','.'),'BR',0,'R',0);
			$pdf->Cell(30,5,number_format($total2,2,',','.'),'BR',0,'R',0);
	        $pdf->Ln();
	        $pdf->Cell(20,7,'',0,0);
	        $pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,5,'','LB',0,'L',0);
			$pdf->Cell(110,5,'Jumlah','RB',0,'C',0);
			$pdf->Cell(30,5,number_format($total_transport,2,',','.'),'RB',0,'R',0);
	        $pdf->Ln();
		} else {
			$pdf->Cell(20,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,5,'No.',1,0,'C',0);
			$pdf->Cell(110,5,'Uraian',1,0,'C',0);
			$pdf->Cell(30,5,'Jumlah',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->Cell(20,7,'',0,0);
	        $pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','LB',0,'L',0);
			$pdf->Cell(80,6,'Transport Bandara '.$berangkat.' (PP)','LB',0,'L',0);
			$pdf->Cell(30,6,'2 x '.number_format($sbu_transport,2,',','.'),'LBR',0,'L',0);
			$pdf->Cell(30,6,number_format($total1,2,',','.'),'BR',0,'L',0);
	        $pdf->Ln();
	        $pdf->Cell(20,7,'',0,0);
	        $pdf->Cell(10,5,'2','L',0,'L',0);
			$pdf->Cell(80,5,'Transport Bandara '.$tujuan.' (PP)','L',0,'L',0);
			$pdf->Cell(30,5,'2 x '.number_format($sbu_transport2,2,',','.'),'LR',0,'L',0);
			$pdf->Cell(30,5,number_format($total2,2,',','.'),'R',0,'L',0);
	        $pdf->Ln();
			$pdf->Cell(20,7,'',0,0);
			$pdf->SetFont('Arial','',10);
				$pdf->SetWidths(array(10, 80, 30, 30));
				for($i=0;$i<1;$i++) {
					$pdf->Row(array("3","Transport Lokal ".$rute_lokal,"1 x ".number_format($besaran_lokal,2,',','.'), number_format($besaran_lokal,2,',','.')));
				}
			$pdf->Cell(20,7,'',0,0);
	        $pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,5,'','LB',0,'L',0);
			$pdf->Cell(110,5,'Jumlah','RB',0,'C',0);
			$pdf->Cell(30,5,number_format($total_transport,2,',','.'),'RB',0,'L',0);
	        $pdf->Ln();
		}
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
		$pdf->MultiCell(60,6,'Jakarta, '.$var_tgl_skrg,0,'R');
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
		$pdf->Cell(100,6,$nama_ppk,0, 0,'C');
		$pdf->MultiCell(72.5,6,$pegawai,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,"NIP. ".$nip_ppk,0, 0,'C');
		$pdf->MultiCell(72.5,6,'NIP. '.$nip,0,'C');

		//Cetak gans
		$filename = "Riil - ".$arr_slug[0]." - ".$pegawai.$this->extension;
		$pdf->setTitle($filename);
		$pdf->Output("I", $filename);
	}

	//Page Surat Pernyataan Biaya Tiket Pesawat
	function lebih($slug) {

		/* ---- PREPARE VARIABLE ------*/
		$arr_slug		= explode('_', $slug);
		$pegawai_result = $this->db->get_where('pegawai', array('id_pegawai' => $arr_slug[1]))->result();
		$pegawai 		= $pegawai_result['0']->nama_pegawai;
		$jabatan		= $pegawai_result['0']->jabatan_pegawai;
		$nip 		= $pegawai_result['0']->nip_pegawai;
		$surat_result 	= $this->db->get_where('data_rinci', array('id_surat' => $arr_slug[0],
			'id_pegawai' => $arr_slug[1]))->result();
		$nomor 			= $surat_result['0']->nomor;

		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$id_tiket = $data_rinci_all['0']->id_tiket;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$sbu_tiket = $tiket_result['0']->biaya_tiket;
		$rute			= $tiket_result['0']->rute;

		//$sbu_tiket_ena = $sbu_tiket == 0 ? '-' : $this->rupiah($sbu_tiket);
		$sbu_tiket_ena = $this->rupiah($sbu_tiket);
		//get real pengeluaran untuk tiket
		$r_tiket_result = $this->db->get_where('spd_rampung', array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$r_tiket = $r_tiket_result != NULL ? $r_tiket_result['0']->tiket : 0;

		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();
		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;

		$var_tgl_skrg = $this->tanggal_indo(date('Y').'-'.date('m').'-'.date('d'), '-');
		$var_tgl_surat 	= $this->tanggal_indo($surat_result['0']->tgl_surat,'/');

		/* -----------------------------*/
		if(empty($r_tiket_result)) {
			echo "<script>         	
         	alert('Anda belum mengisi SPD Rampung!');
         	window.location.href='".base_url('C_PDF/print_biaya/').$arr_slug[0]."';</script>";
		}

		if($sbu_tiket<$r_tiket) {
			$pdf = new PDF_MC_Table('p','mm','A4');
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
			$pdf->Cell(20,7,$pegawai,0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'NIP',0,0);
			$pdf->Cell(10,7,':',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(20,7,$nip,0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'Jabatan',0,0);
			$pdf->Cell(10,7,':',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(20,7,$jabatan,0,1);
			$pdf->Ln();
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor:'.$nomor.' tanggal '.$var_tgl_surat.' dengan',0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'sesungguhnya bahwa : input alasan lebih here',0,1);
			$pdf->Ln();
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'1. Tiket '.$rute.' (PP) dengan jumlah tiket pesawat di bawah ini melebihi dengan',0,1);
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'SBU tahun '.date('Y').', meliputi :',0,1);
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

			$counterrr = 1;
				$pdf->SetWidths(array(10, 70, 40, 40));
				for($i=0;$i<1;$i++) {
					$pdf->Row(array($counterrr,"Tiket Pesawat ".$rute. " (PP)","Rp ".$sbu_tiket_ena, "Rp ".number_format($r_tiket,2,',','.')));
					$counterrr++;
				}
			$pdf->Cell(20,7,'',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(10,5,'','LB',0,'L',0);
			$pdf->Cell(70,5,'Jumlah','LRB',0,'C',0);
			$pdf->Cell(7,5,'Rp ','B',0,'L',0);
			$pdf->Cell(33,5,''.$sbu_tiket_ena,'RB',0,'L',0);
			$pdf->Cell(7,5,'Rp ','B',0,'L',0);
			$pdf->Cell(33,5,''.$sbu_tiket_ena,'RB',0,'L',0);
			$pdf->Ln();
			
			//end of table
			$pdf->Ln();
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'2. Bahwa tiket '.$rute.' (PP) dengan jumlah uang tersebut pada angka (1)',0,1);
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
			$pdf->MultiCell(60,6,'Jakarta, '.$var_tgl_skrg,0,'R');
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
			$pdf->Cell(100,6,$nama_ppk,0, 0,'C');
			$pdf->MultiCell(72.5,6,$pegawai,0,'C');
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(100,6,"NIP. ".$nip_ppk,0, 0,'C');
			$pdf->MultiCell(72.5,6,'NIP. '.$nip,0,'C');

			//Cetak gans
			$filename = "Lebih - ".$arr_slug[0]." - ".$pegawai.$this->extension;
			$pdf->setTitle($filename);
			$pdf->Output("I", $filename);
		} else {
			echo "<script>         	
         	alert('Tidak bisa mencetak karena biaya tiket tidak lebih dari SBU!');
         	window.location.href='".base_url('C_PDF/print_biaya/').$arr_slug[0]."';</script>";
		}
	}

	//Page Surat Pernyataan Kehilangan Boarding
	function hilang($slug) {

		/* ---- PREPARE VARIABLE ------*/
		$arr_slug		= explode('_', $slug);
		$pegawai_result = $this->db->get_where('pegawai', array('id_pegawai' => $arr_slug[1]))->result();
		$pegawai 		= $pegawai_result['0']->nama_pegawai;
		$jabatan		= $pegawai_result['0']->jabatan_pegawai;
		$nip 		= $pegawai_result['0']->nip_pegawai;
		$surat_result 	= $this->db->get_where('data_rinci', array('id_surat' => $arr_slug[0],
			'id_pegawai' => $arr_slug[1]))->result();
		$nomor 			= $surat_result['0']->nomor;

		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$id_tiket = $data_rinci_all['0']->id_tiket;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$sbu_tiket = $tiket_result['0']->biaya_tiket;
		$sbu_tiket_ena =$this->rupiah($sbu_tiket);
		$rute			= $tiket_result['0']->rute;

		//get real pengeluaran untuk tiket
		$r_tiket_result = $this->db->get_where('spd_rampung', array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$r_tiket_row = $this->db->get_where('spd_rampung', array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->num_rows();
		$r_tiket = $r_tiket_result != NULL ? $r_tiket_result['0']->tiket : 0;
//		$r_tiket = $r_tiket_result['0']->tiket;
		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();
		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;

		$var_tgl_skrg = $this->tanggal_indo(date('Y').'-'.date('m').'-'.date('d'), '-');
		$var_tgl_surat 	= $this->tanggal_indo($surat_result['0']->tgl_surat,'/');

		if($r_tiket_row <= 0) {
			echo "<script>         	
         	alert('Anda harus mengisi SPD Rampung Dulu!');
         	window.location.href='".base_url('C_PDF/print_biaya/').$arr_slug[0]."';</script>";
		} else {
			/* -----------------------------*/
			$pdf = new PDF_MC_Table('p','mm','A4');
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
			$pdf->Cell(20,7,$pegawai,0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'NIP',0,0);
			$pdf->Cell(10,7,':',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(20,7,$nip,0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'Jabatan',0,0);
			$pdf->Cell(10,7,':',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(20,7,$jabatan,0,1);
			$pdf->Ln();
			$pdf->Cell(15,7,'',0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(20,7,'Berdasarkan Surat Tugas Nomor: '. $nomor .' tanggal '.$var_tgl_surat.' dengan',0,1);
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'sesungguhnya bahwa :',0,1);
			$pdf->Ln();
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'1. Boarding Pass '.$rute.' dengan jumlah tiket pesawat dibawah ini tidak',0,1);
			$pdf->Cell(20,7,'',0,0);
			$pdf->Cell(20,7,'melebihi dengan SBU tahun '.date('Y').', meliputi :',0,1);
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
			$counterrr = 1;
			$pdf->SetWidths(array(10, 70, 40, 40));
			for($i=0;$i<1;$i++) {
				$pdf->Row(array($counterrr,"Tiket Pesawat ".$rute,"Rp ".$sbu_tiket_ena, "Rp ".number_format($r_tiket,2,',','.')));
				$counterrr++;
			}
			$pdf->Cell(20,7,'',0,0);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(10,5,'','LB',0,'L',0);
			$pdf->Cell(70,5,'Jumlah','LRB',0,'C',0);
			$pdf->Cell(7,5,'Rp','B',0,'L',0);
			$pdf->Cell(33,5,''.$sbu_tiket_ena,'RB',0,'L',0);
			$pdf->Cell(7,5,'Rp','B',0,'L',0);
			$pdf->Cell(33,5,''.$sbu_tiket_ena,'RB',0,'L',0);
			$pdf->Ln();
			//end of table

			$pdf->Ln();
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(15,7,'',0,0);
			$pdf->Cell(20,7,'2. Boarding Pass '.$rute.' hilang dengan jumlah uang tersebut pada angka',0,1);
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
			$pdf->MultiCell(60,6,'Jakarta, '.$var_tgl_skrg,0,'R');
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
			$pdf->Cell(85,6,$nama_ppk,0, 0,'C');
			$pdf->MultiCell(105,6,$pegawai,0,'C');
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(85,6,"NIP. ".$nip_ppk,0, 0,'C');
			$pdf->MultiCell(105,6,'NIP. '.$nip,0,'C');

			//Cetak gans
			$filename = "Hilang - ".$arr_slug[0]." - ".$pegawai.$this->extension;
			$pdf->setTitle($filename);
			$pdf->Output("I", $filename);
		}


	}

	//Page Surat Perintah Dinas
	function spd($slug) {
		$arr_slug		= explode('_', $slug);
		$pegawai_result = $this->db->get_where('pegawai', array('id_pegawai' => $arr_slug[1]))->result();
		$pegawai 		= $pegawai_result['0']->nama_pegawai;
		$jabatan		= $pegawai_result['0']->jabatan_pegawai;
		$golongan 		= $pegawai_result['0']->golongan_pegawai;
		$surat_result 	= $this->db->get_where('data_rinci', array('id_surat' => $arr_slug[0],
			'id_pegawai' => $arr_slug[1]))->result();
		$nomor 			= $surat_result['0']->nomor;
		$kegiatan 		= $surat_result['0']->kegiatan;

		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$jenis = $data_rinci_all['0']->jenis;
		$id_harian = $data_rinci_all['0']->id_harian;
		$id_penginapan = $data_rinci_all['0']->id_penginapan;
		$id_transport = $data_rinci_all['0']->id_transport;
		$id_tiket = $data_rinci_all['0']->id_tiket;

		//get data uang harian
		$harian_result	= $this->db->get_where('uang_harian',array('id' => $id_harian))->result();
		$harian = $harian_result['0']->luar_kota;
		//get data uang penginapan
		$penginapan_result	= $this->db->get_where('biaya_penginapan',array('id' => $id_penginapan))->result();
		$sbu_penginapan = $penginapan_result['0']->eselon_4;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$sbu_tiket = $tiket_result['0']->biaya_tiket;
		$rute			= $tiket_result['0']->rute;
		$rute_arr		= explode('-', $rute);
		$berangkat		= $rute_arr[0];
		$tujuan			= $rute_arr[1];

		//get data uang transport
		$transport_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport))->result();
		$transport = $transport_result['0']->besaran;


		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();

		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;

		$var_tgl_mulai 	= $this->tanggal_indo($surat_result['0']->tgl_mulai, '-');
		$var_tgl_akhir 	= $this->tanggal_indo($surat_result['0']->tgl_akhir, '-');
		$var_tgl_surat 	= $this->tanggal_indo($surat_result['0']->tgl_surat,'/');
		$jumlah_hari	= $this->hitung_hari($surat_result['0']->tgl_mulai, $surat_result['0']->tgl_akhir)+1;

		$var_tgl_rampung = $this->db->get_where('spd_rampung',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$var_tgl_rampung = $var_tgl_rampung != NULL ? $this->tanggal_indo($var_tgl_rampung['0']->tgl,'/') : 0;

		if (empty($var_tgl_rampung)) {
			echo "<script>         	
         	alert('Anda harus mengisi SPD Rampung Dulu!');
         	window.location.href='".base_url('C_PDF/print_biaya/').$arr_slug[0]."';</script>";
		}
		$pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(150,3,'BADAN NASIONAL PENANGGULANGAN BENCANA',0,0,'L');
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(25,3,'Lembar ke : ',0,'L');
		$pdf->Ln();
		$pdf->Cell(150,3,'Jl. Pramuka Kav. 38 - Jakarta Timur 13120',0,0,'L');
		$pdf->Cell(25,3,'Kode No. : '.$nomor,0,'L');
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
		$pdf->Cell(90,5,$pegawai,'R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'diperintahkan','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'3.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Pangkat dan golongan','LR',0,'L',0);
		$pdf->Cell(90,5,'a. '.$golongan,'R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'b. Jabatan / Instansi','LR',0,'L',0);
		$pdf->Cell(90,5,'b. ','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'c. Tingkat biaya perjalanan dinas','LBR',0,'L',0);
		$pdf->Cell(90,5,'c. C','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'4','L',0,'C',0);
		$pdf->Cell(70,5,'Maksud perjalanan Dinas','LR',0,'L',0);
		$pdf->MultiCell(90,5,'Melakukan kegiatan '.$kegiatan,'LR','L');
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'','LBR',0,'L',0);
		$pdf->Cell(90,5,'','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'5','LB',0,'C',0);
		$pdf->Cell(70,5,'Alat angkutan yang dipergunakan','LBR',0,'L',0);
		$pdf->Cell(90,5,'Udara dan Darat','BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'6.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Tempat berangkat','LR',0,'L',0);
		$pdf->Cell(90,5,'a. '.$berangkat,'R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','LB',0,'C',0);
		$pdf->Cell(70,5,'b. Tempat tujuan','LBR',0,'L',0);
		$pdf->Cell(90,5,'b. '.$tujuan,'BR',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'7.','L',0,'C',0);
		$pdf->Cell(70,5,'a. Lamanya perjalanan Dinas','LR',0,'L',0);
		$pdf->Cell(90,5,'a. '. $jumlah_hari .' ('. $this->terbilang($jumlah_hari) .') Hari','R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'b. Tanggal berangkat','LR',0,'L',0);
		$pdf->Cell(90,5,'b. '.$var_tgl_mulai,'R',0,'L',0);
        $pdf->Ln();
        $pdf->Cell(10,7,'',0,0);
		$pdf->Cell(10,5,'','L',0,'C',0);
		$pdf->Cell(70,5,'c. Tanggal harus kembali /','LR',0,'L',0);
		$pdf->Cell(90,5,'c. '.$var_tgl_akhir,'R',0,'L',0);
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
		$pdf->Cell(20,5,$var_tgl_rampung,'B',0,'L');
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
		$pdf->Cell(40,4,$nama_ppk,0,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(116.5,6,'',0,0);
		$pdf->Cell(40,4,'NIP. '.$nip_ppk,0,0,'C');

		//Cetak gans
		$filename = "Surat Perintah Dinas - ".$arr_slug[0]." - ".$pegawai.$this->extension;
		$pdf->setTitle($filename);
		$pdf->Output("I", $filename);
	}

	/* Page buat nampilin rincian print per pegawai per nomor*/

	function print_biaya($id) {
		$surat_tugas  = $this->db->get_where('surat_dinas',
      		array('id' => $id))->result();
		$nomor = $surat_tugas['0']->nomor;
		$data['nomor'] = $nomor;
		$data['nama'] = $this->home_model->get_yang_dinas($id);
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('print_biaya', $data);
		// $this->load->view('layouts/footer');
	}
	function form_biaya($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$data['slug'] = array('slug' => $slug);
		$data['nama'] = $this->home_model->get_yang_dinas($id_surat);
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$data['harian'] = $this->home_model->get_uang_harian();
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$data['tiket'] = $this->home_model->get_tiket_pesawat();
		$data['transport'] = $this->home_model->get_biaya_transport();

		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('form_biaya', $data);
		$this->load->view('layouts/footer');
	}

	function print_rincian($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];

		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$jenis = $data_rinci_all['0']->jenis;
		$id_harian = $data_rinci_all['0']->id_harian;
		$id_penginapan = $data_rinci_all['0']->id_penginapan;
		$id_transport = $data_rinci_all['0']->id_transport;
		$id_transport2 = $data_rinci_all['0']->id_transport2;
		$id_tiket = $data_rinci_all['0']->id_tiket;

		//get data uang harian
		$harian_result	= $this->db->get_where('uang_harian',array('id' => $id_harian))->result();
		$harian = $harian_result['0']->luar_kota;
		//get data uang penginapan
		$penginapan_result	= $this->db->get_where('biaya_penginapan',array('id' => $id_penginapan))->result();
		$penginapan = $penginapan_result['0']->eselon_4;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$tiket = $tiket_result['0']->biaya_tiket;
		//get data uang transport
		$transport_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport))->result();
		$transport = $transport_result['0']->besaran*2;

		//get data uang transport2
		if ($id_transport2 == 0) {
			$transport2 = 0;
		} else {
			$transport2_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport2))->result();
			$transport2 = $transport2_result['0']->besaran*2;
		}


		$transport = $transport + $transport2;

		$surat_tugas	= $this->db->limit(1)->get_where('data_rinci',
			array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->result();
		$rampung_result	= $this->db->limit(1)->order_by('total', 'DESC')->get_where('spd_rampung',
			array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->result();

		$pegawai 		= $this->db->get_where('pegawai',
			array('id_pegawai' => $id_pegawai))->result();
		$bendahara 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Bendahara Pengeluaran Pembantu'))->result();
		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();

		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;
		$malam = $this->hitung_hari($surat_tugas['0']->tgl_mulai, $surat_tugas['0']->tgl_akhir);
		$hari = $malam + 1;

		$nomor 			= $surat_tugas['0']->nomor;
		$id_lokal = $surat_tugas['0']->id_lokal;
		$lokal_result	= $this->db->limit(1)->get_where('transportasi_lokal', array(
			'id' => $id_lokal))->result();
		if($id_lokal>0) {
			$var_tempat = $lokal_result['0'] -> kabupaten . " Provinsi " . $lokal_result['0'] -> provinsi;
		} else {
			$var_tempat 	= $surat_tugas['0']->tempat;
		}
		$var_tgl_mulai 	= $this->tanggal_indo($surat_tugas['0']->tgl_mulai, '-');
		$var_tgl_akhir 	= $this->tanggal_indo($surat_tugas['0']->tgl_akhir, '-');

		$var_tgl_surat 			= $this->tanggal_indo($surat_tugas['0']->tgl_surat,'/');
		$current_date = date('d/m/Y');
		$var_tgl_skrg = $this->tanggal_indo($current_date, '/');
		$nama_bendahara 				= $bendahara['0']->nama;
		$nip_bendahara				= $bendahara['0']->nip;

		$yang_dinas = $pegawai['0']->nama_pegawai;
		$nip_yang_dinas = $pegawai['0']->nip_pegawai;

		$total_harian = $hari*$harian;
		$total_penginapan = $malam*$penginapan;
		$total_biaya = $total_harian + $total_penginapan + $tiket + $transport;
		$total_rampung = $rampung_result != NULL ? $rampung_result['0']->total : NULL;

		$var_tgl_rampung = $this->db->get_where('spd_rampung',
			array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->result();
		$var_tgl_rampung = $var_tgl_rampung != NULL ? $this->tanggal_indo($var_tgl_rampung['0']->tgl,'/') : NULL;

		$pembayaran_result = $this->home_model->get_pembayaran_awal($slug);
		$pembayaran_row = $this->db->get_where('pembayaran_awal',
			array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->num_rows();
		if($pembayaran_row <= 0) {
			echo "<script>         	
         	alert('Anda harus mengisi SPD Rampung Dulu!');
         	window.location.href='".base_url('C_PDF/print_biaya/').$id_surat."';</script>";
		} else {
			$semula = $pembayaran_result['0']->total;
			$sisa = $total_rampung - $semula;
			if($sisa<0) {
				$keterangan = "Lebih";
			} elseif ($sisa>0) {
				$keterangan = "Kurang";
			} else {
				$keterangan = "";
			}
			//PRINT USING FPDF
			$pdf = new PDF_MC_Table('p','mm','A4');
			//Page 1
			$pdf->AddPage();
			$pdf->SetFont('Arial','BU',12);
			$pdf->Cell(0,10,'',0,1,'C');
			$pdf->Cell(0,6,"PERINCIAN BIAYA PERJALANAN DINAS",0,1,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(34,5,'Lamp. SPD Nomor',0,0);
			$pdf->Cell(3,6,':',0,0);
			$pdf->MultiCell(0,6,$nomor,0,'L');
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(34,6,'Tanggal',0,0);
			$pdf->Cell(3,6,':',0,0);
			$pdf->MultiCell(0,6,$var_tgl_rampung,0,'L');
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
			$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
			$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,number_format($harian,2,',','.'),'R',0,'R',0);
			$pdf->Cell(10,6,'Rp',0,0,'L',0);
			$pdf->Cell(30,6,number_format($total_harian,2,',','.'),'R',0,'R',0);
			$pdf->Cell(55,6,'Perjalanan dinas ke','R',0,'L',0);
			$pdf->Ln();
//			$pdf->Cell(5,6,'','R',0,'L',0);
//			$pdf->SetWidths(array(10,25,17,3,7,23,10,30,55));
//			$pdf->SetAligns(array('C','L','L','R','L', 'R', 'L', 'R', 'L') );
//			for($i=0;$i<1;$i++) //enaena
//				$pdf->Row2(array('2','Penginapan', $malam." Malam",'x', 'Rp', $this->rupiah($penginapan),
//					'Rp', $this->rupiah($total_penginapan), $var_tempat));

			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'2','L',0,'C',0);
			$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
			$pdf->Cell(10,6,$malam." Malam",0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,number_format($penginapan,2,',','.'),'R',0,'R',0);
			$pdf->Cell(10,6,'Rp',0,0,'L',0);
			$pdf->Cell(30,6,number_format($total_penginapan,2,',','.'),'R',0,'R',0);
			$pdf->Cell(55,6,"Kab. Bolaang Mongondow Selatan",'R',0,'L',0);
			$pdf->Ln();

//			$pdf->SetWidths(array(55));
//			$pdf->SetAligns(array('L') );
//			for($i=0;$i<1;$i++)
//				$pdf->Row2(array($var_tempat));

			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'3','L',0,'C',0);
			$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,number_format($tiket,2,',','.'),'R',0,'R',0);
			$pdf->Cell(10,6,'Rp',0,0,'L',0);
			$pdf->Cell(30,6,number_format($tiket,2,',','.'),'R',0,'R',0);
			$pdf->Cell(55,6,'selama '.$hari.' ('. $this->terbilang($hari).') hari','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'4','L',0,'C',0);
			$pdf->Cell(25,6,'Transport','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,number_format($transport,2,',','.'),'R',0,'R',0);
			$pdf->Cell(10,6,'Rp',0,0,'L',0);
			$pdf->Cell(30,6,number_format($transport,2,',','.'),'R',0,'R',0);
			$pdf->Cell(55,6,'Tanggal '.$var_tgl_mulai.' s.d ','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'','LR',0,'L',0);
			$pdf->Cell(40,6,'','LR',0,'L',0);
			$pdf->Cell(55,6,'','R',0,'L',0);
			$pdf->Cell(8,6,'','L',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
			$pdf->Cell(10,6,'Rp',0,0,'L',0);
			$pdf->Cell(30,6,number_format($total_biaya,2,',','.'),'TR',0,'R',0);
			$pdf->Cell(55,6,'','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			//terbilang
			$pdf->SetWidths(array(10, 75, 95));

			//srand(microtime()*1000000);
			for($i=0;$i<1;$i++)
				$pdf->Row(array("",
					"Terbilang",$this->Terbilang($total_biaya)." rupiah"));
			//$pdf->Cell(10,6,'','LB',0,'C',0);
			/*$pdf->Cell(75,6,'Terbilang :','LB',0,'R',0);
			$pdf->MultiCell(95,6,$this->Terbilang($total_biaya)." rupiah",'LBR','L',0);
			$pdf->Ln();*/
			//end of table
			$pdf->Ln();

			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,"",0,0,'L');
			$pdf->Cell(25,6,'',0,0,'L');
			$pdf->Cell(15,6,'',0,0,'L');
			$pdf->Cell(10,6,'',0,0,'L');
			$pdf->Cell(25,6,'',0,0,'R');
			$pdf->Cell(40,6,'',0,0,'C');
			$pdf->MultiCell(50,6,'Jakarta, '.$var_tgl_rampung,0,'R');
			$pdf->Ln();
			$pdf->Cell(15,6,'',0,0,'L');
			$pdf->Cell(10,3,'Telah dibayar sejumlah',0,0,'L');
			$pdf->Cell(29,6,'',0,0,'R');
			$pdf->Cell(40,6,'',0,0,'C');
			$pdf->MultiCell(80,3,'Telah menerima jumlah uang sebesar',0,'R');
			$pdf->Cell(15,6,'',0,0,'L');
			if($jenis == '0') {
				//bayar di belakang brrti yg udah diterima 0
				$pdf->Cell(10,6,'Rp 0,00',0,0,'L');
			} else {
				$pdf->Cell(10,6,'Rp '.number_format($semula,2,',','.'),0,0,'L');
			}
			$pdf->Cell(40,6,'',0,0,'R');
			$pdf->Cell(48,6,'',0,0,'C');

			$pdf->MultiCell(80,6,'Rp '.number_format($semula,2,',','.'),0,'L');
			$pdf->Ln();
			$pdf->Cell(100,6,"Bendahara Pengeluaran Pembantu",0, 0,'C');
			$pdf->MultiCell(50,6,'Yang menerima',0,'R');

			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetFont('Arial','BU',10);
			$pdf->Ln();
			$pdf->Cell(100,3,$nama_bendahara,0, 0,'C');
			$pdf->MultiCell(74,3,$yang_dinas,0,'C');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(100,6,'NIP. '.$nip_bendahara  ,0, 0,'C');
			$pdf->MultiCell(74,6,'NIP. '.$nip_yang_dinas,0,'C');
			$pdf->Ln();
			$pdf->Cell(187,6,'','B',0,'C');
			$pdf->Ln();$pdf->Ln();
			$pdf->SetFont('Arial','BU',10);
			$pdf->Cell(0,6,"PERHITUNGAN SPD RAMPUNG",0,1,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(15,6,'',0,0,'L');
			$pdf->Cell(10,5,"Ditetapkan sejumlah",0, 0,'L');
			$pdf->Cell(45,5,'',0,0,'L');
			$pdf->Cell(80,5,".............................................. : Rp",0, 0,'L');
			$pdf->Cell(7,5,number_format($total_rampung,2,',','.'),0, 0,'R');
			$pdf->Ln();
			$pdf->Cell(15,6,'',0,0,'L');
			$pdf->Cell(10,5,"Yang telah dibayarkan semula",0, 0,'L');
			$pdf->Cell(45,5,'',0,0,'L');
			$pdf->Cell(80,5,".............................................. : Rp",0, 0,'L');
			$pdf->Cell(7,5,	number_format($semula,2,',','.'),0, 0,'R');
			$pdf->Ln();
			$pdf->Cell(15,6,'',0,0,'L');
			$pdf->Cell(10,5,"Sisa ".$keterangan,0, 0,'L');
			$pdf->Cell(45,5,'',0,0,'L');
			$pdf->Cell(80,5,".............................................. : Rp",0, 0,'L');
			$sisa = abs($sisa);
			$pdf->Cell(7,5,number_format($sisa,2,',','.'),0, 0,'R');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(115,6,'',0, 0,'C');
			$pdf->MultiCell(50,5,'SETUJU DIBAYAR',0,'C');
			$pdf->Cell(115,6,'',0, 0,'C');
			$pdf->MultiCell(50,5,'Pejabat Pembuat Komitmen',0,'C');
			$pdf->Cell(110,6,'',0, 0,'C');
			$pdf->MultiCell(60,5,'Pusat Data Informasi dan Humas',0,'C');
			$pdf->SetFont('Arial','BU',10);
			$pdf->Ln();$pdf->Ln();$pdf->Ln();
			$pdf->Cell(115,6,'',0, 0,'C');
			$pdf->MultiCell(50,5,$nama_ppk,0,'C');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(115,6,'',0, 0,'C');
			$pdf->Cell(50,6,'NIP. '.$nip_ppk  ,0, 0,'C');

			//Cetak gans
			$filename = "SPD Rampung - ".$slug.$this->extension;
			$pdf->setTitle($filename);
			$pdf->Output('I', $filename);
		}

	}

	function rampung($slug) {
		$arr_slug = explode('_', $slug);
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$jenis = $data_rinci_all['0']->jenis;
		$nomor = $data_rinci_all['0']->nomor;
		$hari = $this->hitung_hari($data_rinci_all['0']->tgl_mulai, $data_rinci_all['0']->tgl_akhir);
		$hari = $hari + 1;
		$malam = $hari - 1 ;
		$data = array(
			'slug' => $slug, 'jenis' => $jenis, 'hari' => $hari, 'malam' => $malam, 'nomor' => $nomor
		);

		//cek duls dia udah ngisi spd rampung belum supaya ga dobel ngisinya
		$r_result = $this->db->get_where('spd_rampung', array('id_surat'=>$arr_slug[0],
			'id_pegawai'=> $arr_slug[1]))->num_rows();
		if($r_result>0) {
			echo "<script>
         	window.location.href='".base_url('C_PDF/print_rampung/').$slug."';</script>";
		} else {
			$this->load->view('layouts/nav');
			$this->load->view('layouts/header');
			$this->load->view('rampung_form', $data);
			// $this->load->view('layouts/footer2');
		}
	}

	function print_rampung ($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		//Get data rinci
		$data_rinci_all	= $this->db->get_where('data_rinci',
			array('id_surat' => $arr_slug[0], 'id_pegawai' => $arr_slug[1]))->result();
		$id_harian = $data_rinci_all['0']->id_harian;
		$id_penginapan = $data_rinci_all['0']->id_penginapan;
		$id_transport = $data_rinci_all['0']->id_transport;
		$id_transport2 = $data_rinci_all['0']->id_transport2;
		$id_tiket = $data_rinci_all['0']->id_tiket;
		$id_lokal = $data_rinci_all['0']->id_lokal;

		//get data uang harian
		$harian_result	= $this->db->get_where('uang_harian',array('id' => $id_harian))->result();
		$harian = $harian_result['0']->luar_kota;
		//get data uang penginapan
		$penginapan_result	= $this->db->get_where('biaya_penginapan',array('id' => $id_penginapan))->result();
		$sbu_penginapan = $penginapan_result['0']->eselon_4;
		//get data uang tiket
		$tiket_result	= $this->db->get_where('tiket_pesawat',array('id' => $id_tiket))->result();
		$sbu_tiket = $tiket_result['0']->biaya_tiket;
		//get data uang transport
		$transport_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport))->result();
		$transport = $transport_result['0']->besaran*2;
		//get data uang transport2

		//handle jika transport tujuan tidak diisi, otomatis nilainya 0
		if ($id_transport2 == 0) {
			$transport2 = 0;
		} else {
			$transport2_result	= $this->db->get_where('biaya_transport',array('id' => $id_transport2))->result();
			$transport2 = $transport2_result['0']->besaran*2;
		}
		if ($id_lokal == 0) {
			$biaya_lokal = 0;
		} else {
			//get data uang transport lokal
			$lokal_result	= $this->db->get_where('transportasi_lokal',array('id' => $id_lokal))->result();
			$biaya_lokal= $lokal_result['0']->besaran;
		}

		$total_transport = $transport + $transport2 + $biaya_lokal;
		$jenis = $data_rinci_all['0'] -> jenis;

		//create tanggal setelah dapet tandatangan pa topo
		$tgl_baru = date('d/m/Y');

		//Get pegawai
		$pegawai_result = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->result();
		$nama_dinas 	= $pegawai_result['0']->nama_pegawai;
		$nip_dinas		= $pegawai_result['0']->nip_pegawai;

		//Get ppk
		$ppk 			= $this->db->get_where('pejabat_administratif',
			array('jabatan' => 'Pejabat Pembuat Komitmen'))->result();
		$nama_ppk 				= $ppk['0']->nama;
		$nip_ppk 				= $ppk['0']->nip;

		//Get surat_dinas with id = is_surat
		$surat_result = $this->db->get_where('data_rinci',
			array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->result();
		$nomor = $surat_result['0']->nomor;
		$lokal_result	= $this->db->limit(1)->get_where('transportasi_lokal', array(
			'id' => $id_lokal))->result();
		if($id_lokal>0) {
			$tempat = $lokal_result['0'] -> kabupaten . " Provinsi " . $lokal_result['0'] -> provinsi;
		} else {
			$tempat 	= $surat_tugas['0']->tempat;
		}
		$var_tgl_mulai = $this->tanggal_indo($surat_result['0']->tgl_mulai, '-');
		$var_tgl_akhir = $this->tanggal_indo($surat_result['0']->tgl_akhir, '-');
		$var_tgl_surat = $this->tanggal_indo($surat_result['0']->tgl_surat, '/');
		$var_tgl_skrg = $this->tanggal_indo(date('Y').'-'.date('m').'-'.date('d'), '-');
		$hari = $this->hitung_hari($surat_result['0']->tgl_mulai, $surat_result['0']->tgl_akhir);
		$hari = $hari + 1;
		$malam = $hari - 1 ;



		//nilai penginapan dan tiket akan berubah sesuai jenis. kalo di depan makan nilainya sama dengan sbu
		if(!isset($_POST['rsubmit'])) {
			//Artinya dia udah ngisi SPD, tinggal nyetak aja
			//dibayar di belakang maka nilai tiket dan penginapan sesuai dengan post di spd rampung
			//get real pengeluaran untuk tiket
			$r_tiket_result = $this->db->get_where('spd_rampung', array('id_surat' => $arr_slug[0],
				'id_pegawai' => $arr_slug[1]))->result();
			$tiket = $r_tiket_result['0']->tiket;
			$penginapan = $r_tiket_result['0']->penginapan;
			$isMultiple = $r_tiket_result['0']->multiple;
			$malam = $r_tiket_result['0']->malam;
			$var_tgl_rampung = $this->db->get_where('spd_rampung',
				array('id_surat' => $id_surat, 'id_pegawai' => $id_pegawai))->result();
			$var_tgl_rampung = $this->tanggal_indo($var_tgl_rampung['0']->tgl,'/');
			if($jenis == '0') {
				//bayar di belakang, set all value to zero
				$s_harian = 0;
				$s_penginapan = 0;
				$s_tiket = 0;
				$s_transport = 0;
			} else if ($jenis == '1') {
				//bayar di depan, nilainya sesuai sbu
				$s_harian = $harian;
				$s_penginapan = $sbu_penginapan;
				$s_tiket = $sbu_tiket;
				$s_transport = $total_transport;
			}
			$jml_harian = $harian*$hari;
			$jml_s_harian = $s_harian*$hari;
			$jml_penginapan = $malam*$penginapan;
			$jml_s_penginapan = $s_penginapan*$malam;
			$s_total = $jml_s_harian+$jml_s_penginapan+$s_tiket+$s_transport;
			$total = $jml_harian+$jml_penginapan+$tiket+$transport;
			$sisa = $s_total - $total;
		} else  {
			$var_tgl_rampung = date('d/m/Y');
			$var_tgl_rampung = $this->tanggal_indo($var_tgl_rampung,'/');
			/* Menyimpan Ke Pembayaran Awal */
			if($jenis == '0') {
				//bayar di belakang, set all value to zero
				$s_harian = 0;
				$s_penginapan = 0;
				$s_tiket = 0;
				$s_transport = 0;
				$s_total = 0;
				$data_yang_sudah_dibayar = array(
					'id_surat' => $id_surat,
					'id_pegawai' => $id_pegawai,
					'penginapan' => $s_penginapan,
					'harian' => $s_harian,
					'transport' => $s_transport,
					'tiket' => $s_tiket,
					'total' => $s_total
				);
				$this->db->insert('pembayaran_awal', $data_yang_sudah_dibayar);
			} else if ($jenis == '1') {
				//bayar di depan, nilainya sesuai sbu
				$s_harian = $harian;
				$s_penginapan = $sbu_penginapan;
				$s_tiket = $sbu_tiket;
				$s_transport = $total_transport;
				$s_total = ($s_harian*$hari)+($s_penginapan*$malam)+$s_tiket+$total_transport;
				$data_yang_sudah_dibayar = array(
					'id_surat' => $id_surat,
					'id_pegawai' => $id_pegawai,
					'penginapan' => $s_penginapan,
					'harian' => $s_harian,
					'transport' => $total_transport,
					'tiket' => $s_tiket,
					'total' => $s_total
				);
				$this->db->insert('pembayaran_awal', $data_yang_sudah_dibayar);
			}
			//nilainya diambil dari isian form
			$isMultiple = isset($_POST['isMultiple']) ? "1" : "0";
			$tiket = $this->input->post('tiket');
			$jml_harian = $harian*$hari;
			$jml_s_harian = $s_harian*$hari;
			if ($isMultiple == "0") {
				//satu tempat penginapan saja bosq
				$penginapan = $this->input->post('inap');
				$jml_penginapan = $malam*$penginapan;
				$jml_s_penginapan = $s_penginapan*$malam;
				$s_total = $jml_s_harian+$jml_s_penginapan+$s_tiket+$s_transport;
				$total = $jml_harian+$jml_penginapan+$tiket+$total_transport;
				$sisa = $s_total - $total;

				$data = array(
					'id_surat' => $id_surat,
					'id_pegawai' => $id_pegawai,
					'multiple' => $isMultiple,
					'malam' => $malam,
					'penginapan' => $penginapan,
					'harian' => $harian,
					'transport' => $total_transport,
					'tiket' => $tiket,
					'total' => $total,
					'tgl' => $tgl_baru
				);
				$this->db->insert('spd_rampung', $data);
			} else {
				//multiple tempat penginapan

				$penginapan_d = $this->input->post('penginapan');
				$num_data = count($penginapan_d);

				$total_penginapan = 0;
				for($key=1;$key<=$num_data;$key++) {
					$malam_d = $this->input->post('malam');
					$jml_penginapan = $malam_d[$key]*$penginapan_d[$key];
					$total_penginapan = $total_penginapan + $malam_d[$key]*$penginapan_d[$key];
					$jml_s_penginapan = $s_penginapan*$malam_d[$key];
					$s_total = $jml_s_harian+$jml_s_penginapan+$s_tiket+$s_transport;
					$total = $jml_harian+$total_penginapan+$tiket+$total_transport;
					$sisa = $s_total - $total;

					$data = array(
						'id_surat' => $id_surat,
						'id_pegawai' => $id_pegawai,
						'multiple' => $isMultiple,
						'malam' => $malam_d[$key],
						'penginapan' => $penginapan_d[$key],
						'harian' => $harian,
						'transport' => $total_transport,
						'tiket' => $tiket,
						'total' => $total,
						'tgl' => $tgl_baru
					);
					$this->db->insert('spd_rampung', $data);
				}
			}
		}

		/* Otomatis Menyesuaikan Apakah Sisanya Lebih atau Kurang*/
		if ($total>$s_total) {
			$keterangan = "KURANG";
		} elseif (($total<$s_total)) {
			$keterangan = "LEBIH";
		} else {
			$keterangan = "";
		}
		$tiket_ena = $this->rupiah($tiket);

		/* Print PDF */
		$pdf = new PDF_MC_Table('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Cell(0,6,"RINCIAN PERHITUNGAN SPD RAMPUNG",0,1,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(34,6,'Lamp. SPD Nomor',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,$nomor,0,'L');
		$pdf->Cell(34,6,'Tanggal',0,0);
		$pdf->Cell(3,6,':',0,0);
		$pdf->MultiCell(0,6,$var_tgl_rampung,0,'L');
		$pdf->Ln();
		//here is table
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'No',1,0,'C',0);
		$pdf->Cell(75,6,'Perincian biaya',1,0,'C',0);
		$pdf->Cell(34,6,'Jumlah',1,0,'C',0);
		$pdf->Cell(66,6,'Keterangan',1,0,'C',0);

		//Rincian pengeluaran akan berbeda karna pengisiannya beda
		//Belum isi SPD dan Memilih penginapan banyak
		if (isset($_POST['rsubmit']) && $isMultiple == "1") {
			/* Nilainya di dapat dari form dan ini buat double tempat penginapan*/
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'L',0);
			$pdf->Cell(75,6,'RINCIAN PENGELUARAN','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'C',0);
			$pdf->Cell(66,6,'','R',0,'C',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','L',0,'C',0);
			$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
			$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($harian),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_harian),'R',0,'R',0);
			$pdf->Cell(66,6,'Perjalanan dinas :','R',0,'L',0);
			$counterx = 2;
			for ($a = 1; $a <= count($penginapan_d); $a++) {
				$jml_penginapan = $malam_d[$a]*$penginapan_d[$a];
				$jml_s_penginapan = $s_penginapan*$malam_d[$a];
				$s_total = $jml_s_harian+$jml_s_penginapan+$s_tiket+$s_transport;
				$total_result = $this->db->order_by('id', 'desc')->limit(1)->get_where('spd_rampung',
					array(
						'id_surat' => $id_surat, 'id_pegawai' => $id_pegawai
					))->result();
				$total = $total_result['0']->total;
				$sisa = $s_total - $total;
				$pdf->Ln();
				$pdf->Cell(5,7,'',0,0);
				$pdf->Cell(10,6,$counterx,'L',0,'C',0);
				$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
				$pdf->Cell(10,6,$malam_d[$a].' Malam',0,0,'L',0);
				$pdf->Cell(10,6,'x',0,0,'R',0);
				$pdf->Cell(5,6,'Rp',0,0,'L',0);
				$pdf->Cell(25,6,$this->rupiah($penginapan_d[$a]),'R',0,'R',0);
				$pdf->Cell(5,6,'Rp',0,0,'L',0);
				$pdf->Cell(29,6,$this->rupiah($jml_penginapan),'R',0,'R',0);
				if ($a == 1) {
					$pdf->Cell(66,6,'Ke '.$tempat,'R',0,'L',0);
				} else {
					$pdf->Cell(66,6,'','R',0,'L',0);
				}
				$counterx++;
			}

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,$counterx,'L',0,'C',0);
			$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
		
			$pdf->Cell(25,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(66,6,'selama '.$hari.' ('. $this->terbilang($hari).') hari','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,$counterx+1,'L',0,'C',0);
			$pdf->Cell(25,6,'Transport','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(66,6,'Tanggal '.$var_tgl_mulai.' s.d ','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'R',0);
			$pdf->Cell(66,6,$var_tgl_akhir,'R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total),'TR',0,'R',0);
			$pdf->Cell(66,6,'','R',0,'L',0);
			$pdf->Ln();
		} else if (isset($_POST['rsubmit']) && $isMultiple == "0") {
			/* Nilainya di dapat dari form dan ini cuma buat satu tempat penginapan aja*/
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'L',0);
			$pdf->Cell(75,6,'RINCIAN PENGELUARAN','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'C',0);
			$pdf->Cell(66,6,'','R',0,'C',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','L',0,'C',0);
			$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
			$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($harian),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_harian),'R',0,'R',0);
			$pdf->Cell(66,6,'Perjalanan dinas ke :','R',0,'L',0);

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'2','L',0,'C',0);
			$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
			$pdf->Cell(10,6,$malam.' Malam',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($penginapan),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_penginapan),'R',0,'R',0);
			$pdf->Cell(66,6,'Ke '.$tempat,'R',0,'L',0);

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'3','L',0,'C',0);
			$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(66,6,'selama '.$hari.' ('. $this->terbilang($hari).') hari','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'4','L',0,'C',0);
			$pdf->Cell(25,6,'Transport','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(66,6,'Tanggal '.$var_tgl_mulai.' s.d ','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'R',0);
			$pdf->Cell(66,6,$var_tgl_akhir,'R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total),'TR',0,'R',0);
			$pdf->Cell(66,6,'','R',0,'L',0);
			$pdf->Ln();
		} else if (!isset($_POST['rsubmit']) && $isMultiple == "0") {

			$malam_t = $hari-1;
			$jml_penginapan = $penginapan*$malam_t;
			$total = $jml_penginapan+$jml_harian+$tiket+$total_transport;
			$sisa = $s_total - $total;

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'L',0);
			$pdf->Cell(75,6,'RINCIAN PENGELUARAN','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'C',0);
			$pdf->Cell(66,6,'','R',0,'C',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','L',0,'C',0);
			$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
			$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($harian),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_harian),'R',0,'R',0);
			$pdf->Cell(66,6,'Perjalanan dinas ke :','R',0,'L',0);

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'2','L',0,'C',0);
			$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
			$pdf->Cell(10,6,$malam_t.' Malam',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($penginapan),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_penginapan),'R',0,'R',0);
			$pdf->Cell(66,6,'Ke '.$tempat,'R',0,'L',0);

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'3','L',0,'C',0);
			$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(66,6,'selama '.$hari.' ('. $this->terbilang($hari).') hari','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'4','L',0,'C',0);
			$pdf->Cell(25,6,'Transport','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(66,6,'Tanggal '.$var_tgl_mulai.' s.d ','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'R',0);
			$pdf->Cell(66,6,$var_tgl_akhir,'R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total),'TR',0,'R',0);
			$pdf->Cell(66,6,'','R',0,'L',0);
			$pdf->Ln();
		} else {
			/* Nilainya di dapat dari spd rampung dan ini buat double tempat penginapan*/
			//get value from db
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'L',0);
			$pdf->Cell(75,6,'RINCIAN PENGELUARAN','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'C',0);
			$pdf->Cell(66,6,'','R',0,'C',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'1','L',0,'C',0);
			$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
			$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
			$pdf->Cell(10,6,'x',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($harian),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($jml_harian),'R',0,'R',0);
			$pdf->Cell(66,6,'Perjalanan dinas ke :','R',0,'L',0);
			$counterx = 2;
			$num_penginapan = $this->db->get_where('spd_rampung', array('id_surat' => $arr_slug[0],
				'id_pegawai' => $arr_slug[1]));
			$total_penginapan = 0;
			for ($a = 0; $a < $num_penginapan->num_rows(); $a++) {
				$jml_penginapan = $r_tiket_result[$a]->penginapan*$r_tiket_result[$a]->malam;
				$total_penginapan = $total_penginapan + $r_tiket_result[$a]->penginapan*$r_tiket_result[$a]->malam;
				$jml_s_penginapan = $s_penginapan*$malam;
				$s_total = $jml_s_harian+$jml_s_penginapan+$s_tiket+$s_transport;
				$total_result = $this->db->order_by('id', 'desc')->limit(1)->get_where('spd_rampung',
					array(
						'id_surat' => $id_surat, 'id_pegawai' => $id_pegawai
					))->result();
				$total = $total_result['0']->total;
				$sisa = $s_total - $total;
				$pdf->Ln();
				$pdf->Cell(5,7,'',0,0);
				$pdf->Cell(10,6,$counterx,'L',0,'C',0);
				$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
				$pdf->Cell(10,6,$r_tiket_result[$a]->malam.' Malam',0,0,'L',0);
				$pdf->Cell(10,6,'x',0,0,'R',0);
				$pdf->Cell(5,6,'Rp',0,0,'L',0);
				$pdf->Cell(25,6,$this->rupiah($r_tiket_result[$a]->penginapan),'R',0,'R',0);
				$pdf->Cell(5,6,'Rp',0,0,'L',0);
				$pdf->Cell(29,6,$this->rupiah($jml_penginapan),'R',0,'R',0);
				if ($a == 0) {
					$pdf->Cell(66,6,'Ke '.$tempat,'R',0,'L',0);
				} else {
					$pdf->Cell(66,6,'','R',0,'L',0);
				}
				$counterx++;
			}

			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,$counterx,'L',0,'C',0);
			$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$tiket_ena,'R',0,'R',0);
			$pdf->Cell(66,6,'selama '.$hari.' ('. $this->terbilang($hari).') hari','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,$counterx+1,'L',0,'C',0);
			$pdf->Cell(25,6,'Transport','L',0,'L',0);
			$pdf->Cell(10,6,'',0,0,'L',0);
			$pdf->Cell(10,6,'',0,0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(25,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total_transport),'R',0,'R',0);
			$pdf->Cell(66,6,'Tanggal '.$var_tgl_mulai.' s.d ','R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'','LR',0,'L',0);
			$pdf->Cell(34,6,'','R',0,'R',0);
			$pdf->Cell(66,6,$var_tgl_akhir,'R',0,'L',0);
			$pdf->Ln();
			$pdf->Cell(5,7,'',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'','L',0,'C',0);
			$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
			$pdf->Cell(5,6,'Rp',0,0,'L',0);
			$pdf->Cell(29,6,$this->rupiah($total),'TR',0,'R',0);
			$pdf->Cell(66,6,'','R',0,'L',0);
			$pdf->Ln();
		}


		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'YANG TELAH DIBAYARKAN :','LR',0,'L',0);
		$pdf->Cell(34,6,'','R',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,'1','L',0,'C',0);
		$pdf->Cell(25,6,'Uang Harian','L',0,'L',0);
		$pdf->Cell(10,6,$hari.' Hari',0,0,'L',0);
		$pdf->Cell(10,6,'x',0,0,'R',0);
		$pdf->Cell(5,6,'Rp ',0,0,'L',0);
		$pdf->Cell(25,6,$this->rupiah($s_harian),'R',0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$pdf->Cell(29,6,$this->rupiah($jml_s_harian),'R',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'2','L',0,'C',0);
		$pdf->Cell(25,6,'Penginapan','L',0,'L',0);
		$pdf->Cell(10,6,$malam.' Malam',0,0,'L',0);
		$pdf->Cell(10,6,'x',0,0,'R',0);
		$pdf->Cell(5,6,'Rp ',0,0,'L',0);
		$pdf->Cell(25,6,$this->rupiah($s_penginapan),'R',0,'R',0);
		$pdf->Cell(5,6,'Rp ',0,0,'L',0);
		$pdf->Cell(29,6,$this->rupiah($jml_s_penginapan),'R',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'3','L',0,'C',0);
		$pdf->Cell(25,6,'Tiket Pesawat','L',0,'L',0);
		$pdf->Cell(10,6,'',0,0,'L',0);
		$pdf->Cell(10,6,'',0,0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$s_tiket_ena = $s_tiket == 0 ? '-' : $this->rupiah($s_tiket);
		$pdf->Cell(25,6,$this->rupiah($s_tiket),'R',0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$pdf->Cell(29,6,$this->rupiah($s_tiket),'R',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'4','L',0,'C',0);
		$pdf->Cell(25,6,'Transport','L',0,'L',0);
		$pdf->Cell(10,6,'',0,0,'L',0);
		$pdf->Cell(10,6,'',0,0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$pdf->Cell(25,6,$this->rupiah($s_transport),'R',0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$pdf->Cell(29,6,$this->rupiah($s_transport),'R',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(75,6,'Jumlah :','LR',0,'R',0);
		$pdf->Cell(5,6,'Rp',0,0,'L',0);
		$pdf->Cell(29,6,$this->rupiah($s_total),'TR',0,'R',0);
		$pdf->Cell(66,6,'','R',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->Cell(10,6,'','L',0,'C',0);
		$pdf->Cell(55,6,'SISA '.$keterangan,'BL',0,'L',0);
		$pdf->Cell(20,6,'Jumlah :','BR',0,'R',0);
		$pdf->Cell(5,6,'Rp','B',0,'L',0);
		$sisa = abs($sisa);
		$pdf->Cell(29,6,$this->rupiah($sisa),'BR',0,'R',0);
		$pdf->Cell(66,6,'','BR',0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,7,'',0,0);
		$pdf->SetWidths(array(10, 75, 100));
		for($i=0;$i<1;$i++)
			$pdf->Row(array("",
				"Terbilang",$this->Terbilang(abs($sisa))." rupiah"));
//		$pdf->Cell(10,6,'','1',0,'C',0);
//		$pdf->Cell(75,6,'Terbilang :','LB',0,'R',0);
//		$pdf->MultiCell(95,6,$this->Terbilang(abs($sisa))." rupiah",'LBR','L',0);
//		$pdf->Ln();
		//end of table
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(10,6,"",0,0,'L');
		$pdf->Cell(25,6,'',0,0,'L');
		$pdf->Cell(15,6,'',0,0,'L');
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(25,6,'',0,0,'R');
		$pdf->Cell(40,6,'',0,0,'C');
		$pdf->MultiCell(50,6,'Jakarta, '.$var_tgl_skrg,0,'R');

		$pdf->Ln();
		$pdf->MultiCell(60,6,'Mengetahui',0,'R');
		$pdf->Cell(100,6,"\nPejabat Pembuat Komitmen",0, 0,'C');
		$pdf->MultiCell(100,6,'Yang melakukan perjalanan dinas',0,'C');

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','BU',10);
		$pdf->Ln();
		$pdf->Cell(100,6,$nama_ppk,0, 0,'C');
		$pdf->MultiCell(100,6,$nama_dinas,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,6,'NIP.'.$nip_ppk  ,0, 0,'C');
		$pdf->MultiCell(100,6,'NIP. '.$nip_dinas,0,'C');

		//Cetak gans
		$filename = "SPD Rampung - ".$arr_slug[0]." - ".$arr_slug[1].$this->extension;
		$pdf->setTitle($filename);
		$pdf->Output("I", $filename);
	}

}

/* MC_Tables Class: Script from fpdf supaya otomatis multicell semua baris */

include_once APPPATH . '/third_party/fpdf/fpdf.php';

class PDF_MC_Table extends FPDF
{
	var $widths;
	var $aligns;
	private $ena=0;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=6*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();

			//Berder semua
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,6,$data[$i],0,$a);
			//Put the position to the right of the cell enaena
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function Row2($data)
	{
		//Calculate the height of the row
		$nb=0;
		$this->ena = 0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=6*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();

			//Berder semua
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,6,$data[$i],0,$a);
			//Put the position to the right of the cell enaena
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}
