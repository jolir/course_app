<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');
class Courses extends Main {

	protected $view_data = array();

	public function index()
	{
		$this->load->model('Course');
		$this->view_data['courses'] = $this->Course->get_course();
		$this->load->view('course_new', $this->view_data);
	}

	public function course_new()
	{
		$post_data = $this->input->post();
		if(isset($post_data['form_action']) && $post_data['form_action'] == "create_course")
		{
			$this->load->model('Course');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			if($this->form_validation->run() === FALSE)
			{
				$this->view_data['status'] = FALSE;
				$this->view_data['errors'] = validation_errors();
			}
			else
			{
				$data['create_course'] = $this->Course->create_course($post_data);	

				if($data['create_course'])
					redirect(base_url('main'));
				else
					$this->load->view('course_new');
			}

		}
		else
			$this->load->view('course_new');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */