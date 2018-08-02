<?php
class Home_model extends CI_Model {
	function get_pegawai() {
		$this->db->from('pegawai');
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

	function get_nomor() {
		$this->db->select('nomor');
		$this->db->from('surat_dinas');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}

	function delete_pegawai($where) {
		$this->db->where($where);
		$this->db->delete('pegawai');
	}


}
?>
