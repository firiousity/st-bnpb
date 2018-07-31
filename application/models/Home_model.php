<?php
class Home_model extends CI_Model {
	function get_pegawai() {
		$this->db->from('pegawai');
		$query = $this->db->get();
		return $query->result();
	}

	function get_nomor() {
		$this->db->from('surat_dinas');
		$query = $this->db->get();
	}


}
?>
