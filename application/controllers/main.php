<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();

	public function index()
	{
		$this->load->view('home_page');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */