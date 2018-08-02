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

	public function __construct() {
        parent::__construct();
    }

    public function record_count() {
        return $this->db->count_all("Country");
    }

    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("Country");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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


}
?>
