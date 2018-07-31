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
        $this->load->model('home_model');
        $this->load->library("pagination");
    }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function login() {
		 $sql = "select * from admin where nama = ? and password = ?";
		 $query = $this->db->query($sql, array($this->input->post('name'), $this->input->post('password')));
         if($query->num_rows()> 0) {
         	$this->load->view('header');
         	$this->load->view('beranda');
         	$this->load->view('footer');
         } else {
         	echo "<script>         	
         	alert('password atau username salah!');
         	window.location.href='index';</script>";
         }
	}
}
