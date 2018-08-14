<?php
class Home_model extends CI_Model {
	function get_pegawai() {
		$this->db->from('pegawai');
		$query = $this->db->get();
		return $query->result();
	}

	function get_surat() {
		$this->db->from('surat_dinas');
		$query = $this->db->get();
		return $query->result();
	}

	function get_biaya_transport() {
		$this->db->from('biaya_transport');
		$query = $this->db->get();
		return $query->result();
	}

	function get_biaya_penginapan() {
		$this->db->from('biaya_penginapan');
		$query = $this->db->get();
		return $query->result();
	}

	function get_tiket_pesawat() {
		$this->db->from('tiket_pesawat');
		$query = $this->db->get();
		return $query->result();
	}

	function get_uang_harian() {
		$this->db->from('uang_harian');
		$query = $this->db->get();
		return $query->result();
	}

	function get_uang_representasi() {
		$this->db->from('uang_representasi');
		$query = $this->db->get();
		return $query->result();
	}

	function get_nomor() {
		$this->db->select('nomor');
		$this->db->from('surat_dinas');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

   function get_yang_dinas ($id){
	   //get form db
	   $this->db->select('*');
	   $this->db->from('pegawai');
	   $this->db->join('yang_dinas', 'yang_dinas.id_pegawai = pegawai.id_pegawai', 'inner')->where( array(
		   'id_surat' => $id
	   ));
	   $query = $this->db->get();
	   return $query->result();
   }

   function get_data_rinci_pegawai($id) {
	   //get form db
	   $this->db->select('*');
	   $this->db->from('pegawai');
	   $this->db->join('data_rinci', 'data_rinci.id_pegawai = pegawai.id_pegawai', 'inner')->where( array(
		   'id_surat' => $id
	   ));
	   $query = $this->db->get();
	   return $query->result();
   }

   function get_ppk() {
	   $this->db->from('pejabat_administratif');
	   $query = $this->db->get();
	   return $query->result();
   }

  /* function get_harian($slug) {
	   $arr_slug = explode('_', $slug);
	   $id_surat = $arr_slug[0];
	   $id_pegawai = $arr_slug[1];
	   $this->db->select('*');
	   $this->db->from('rincian_biaya');
	   $this->db->join('uang_harian', 'uang_harian.id = rincian_biaya.harian', 'inner')->where('uang_harian.id', 'rincian_biaya.harian' );
	   $query = $this->db->get();
	   return $query->result();
   }*/

	function get_harian($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$this->db->select('*');
		$this->db->from('rincian_biaya');
		$this->db->join('uang_harian', 'uang_harian.id = rincian_biaya.harian', 'inner')->where('id_pegawai', $id_pegawai);
		$query = $this->db->get();
		return $query->result();
	}

	function get_penginapan($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$this->db->select('*');
		$this->db->from('rincian_biaya');
		$this->db->join('biaya_penginapan', 'biaya_penginapan.id = rincian_biaya.penginapan', 'inner')
			->where('id_pegawai', $id_pegawai);
		$query = $this->db->get();
		return $query->result();
	}

	function get_tiket($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$this->db->select('*');
		$this->db->from('rincian_biaya');
		$this->db->join('tiket_pesawat', 'tiket_pesawat.id = rincian_biaya.tiket', 'inner')
			->where('id_pegawai', $id_pegawai);
		$query = $this->db->get();
		return $query->result();
	}

	function get_transport($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$this->db->select('*');
		$this->db->from('rincian_biaya');
		$this->db->join('biaya_transport', 'biaya_transport.id = rincian_biaya.transport', 'inner')
			->where('id_pegawai', $id_pegawai);
		$query = $this->db->get();
		return $query->result();
	}

	function get_pembayaran_awal($slug) {
		$arr_slug = explode('_', $slug);
		$id_surat = $arr_slug[0];
		$id_pegawai = $arr_slug[1];
		$data = array (
			'id_surat' => $id_surat, 'id_pegawai' => $id_pegawai
		);
		$query = $this->db->get_where('pembayaran_awal', $data);
		return $query->result();
	}



}
?>
