<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 8/6/2018
 * Time: 9:10 AM
 */

class Surat extends CI_Controller
{

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

	function buat_surat_dinas() {
		$data['pegawai'] = $this->home_model->get_pegawai();
		$data['nomor'] = $this->home_model->get_nomor();
		$data['harian'] = $this->home_model->get_uang_harian();
		$data['penginapan'] = $this->home_model->get_biaya_penginapan();
		$data['tiket'] = $this->home_model->get_tiket_pesawat();
		$data['transport'] = $this->home_model->get_biaya_transport();
		$this->load->view('layouts/nav');
		$this->load->view('layouts/header');
		$this->load->view('dynamic_form', $data);
		// $this->load->view('layouts/footer');
	}

	function exec_surat() {
		if (isset($_POST['submit'])) {
			$nomor = $this->input->post('nomor');
			$kegiatan = $this->input->post('kegiatan');
			$jenis = isset($_POST['jenisPembayaran']) ? "1" : "0";
			$opsi = isset($_POST['check'])	 ? "1" : "0";
			$pos = $this->input->post('pos');

			$data_surat = array(
				'nomor' => $nomor,
				'kegiatan' => $kegiatan,
				'jenis' => $jenis,
				'opsi' => $opsi,
				'pos' => $pos
			);
			$this->db->insert('surat_dinas', $data_surat);
			$surat_result = $this->db->from('surat_dinas')->order_by('id', 'desc')->limit(1)->get()->result();
			$id_surat = $surat_result['0']->id;
			$tgl_surat = date('d')."/".date('m')."/".date('Y');

			if(!isset($_POST['check'])) {
				//Proses banyak nama untuk satu tempat
				$mulai = $this->input->post('mulai');
				$akhir = $this->input->post('akhir');
				$my_select = $this->input->post('my-select[]');
				$tempat = $this->input->post('tempat');
				$harian = $this->input->post('harian');
				$penginapan = $this->input->post('penginapan');
				$tiket = $this->input->post('tiket');
				$transport = $this->input->post('transport');
				$transport2 = $this->input->post('transport2');

				$num_data = count($this->input->post('my-select[]'));
				for($i=0;$i<$num_data;$i++) {
					$data_rinci = array(
						'id_surat' => $id_surat, 'tgl_surat' => $tgl_surat,
						'nomor' => $nomor, 'kegiatan' => $kegiatan, 'jenis' => $jenis, 'pos' => $pos,
						'opsi' => $opsi, 'id_pegawai' => $my_select[$i], 'tgl_mulai' => $mulai,
						'tgl_akhir' => $akhir, 'tempat' => $tempat, 'id_harian' => $harian,
						'id_penginapan' => $penginapan, 'id_tiket' => $tiket, 'id_transport' => $transport,
						'id_transport2' => $transport2
					);
					$data_with_nip = array(
						'id_surat'      => $id_surat,
						'id_pegawai' =>$my_select[$i]
					);
					$this->db->insert('yang_dinas', $data_with_nip);
					$this->db->insert('data_rinci', $data_rinci);

					//if opsi = 1 maka pembayaran awalny
				}

			} else {
				//Proses banyak nama untuk banyak tempat

				$mulai = $this->input->post('mulai_input');
				$akhir = $this->input->post('akhir_input');
				$tempat = $this->input->post('tempat_input');

				$d_pegawai = $this->input->post('my-select-pegawai');
				$d_harian = $this->input->post('my-select-harian');
				$d_penginapan = $this->input->post('my-select-penginapan');
				$d_tiket = $this->input->post('my-select-tiket');
				$d_transport = $this->input->post('my-select-transport');
				$d_transport2 = $this->input->post('my-select-transport2');

				$num_data = count($this->input->post('my-select-pegawai'));

				for($key=0;$key<$num_data;$key++) {

					$data_rinci = array(
						'id_surat' => $id_surat, 'tgl_surat' => $tgl_surat,
						'nomor' => $nomor, 'kegiatan' => $kegiatan, 'jenis' => $jenis,
						'opsi' => $opsi, 'id_pegawai' => $d_pegawai[$key], 'tgl_mulai' => $mulai[$key],
						'tgl_akhir' => $akhir[$key], 'tempat' => $tempat[$key], 'id_harian' => $d_harian[$key],
						'id_penginapan' => $d_penginapan[$key], 'id_tiket' => $d_tiket[$key],
						'id_transport' => $d_transport[$key],'id_transport2' => $d_transport2[$key]
					);
					$data_with_nip = array(
						'id_surat'      => $id_surat,
						'id_pegawai' => $d_pegawai[$key]
					);
					$this->db->insert('yang_dinas', $data_with_nip);
					$this->db->insert('data_rinci', $data_rinci);
				}
			}
			$this->href("home/lihat_surat");
		}
	}

	function hapus_surat($id) {
		$where = array('id' => $id );
		$where2 = array('id_surat' => $id );
		$this->db->delete('surat_dinas', $where);
		$this->db->delete('yang_dinas', $where2);
		$this->db->delete('spd_rampung', $where2);
		$this->db->delete('pembayaran_awal', $where2);
		$this->db->delete('data_rinci', $where2);
		$_SESSION['berhasil'] = "Berhasil menghapus";
		$this->href('home/lihat_surat');
	}
}
