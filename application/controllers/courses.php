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
				{
					$data['status'] = TRUE;
					$data['html'] = 	
						"<div class='accordion-group'>			
							<div class='accordion-heading'>
								<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#course".$data['create_course']."'>".$post_data['title']."</a>
							</div>
							<div id='course".$data['create_course']."' class='accordion-body collapse in'>
								<div class='accordion-inner'>
									<p>".$post_data['description']."</p>
									<p><a href='' class='pull-right'>delete</a> <a href='' class='pull-right' style='margin-right: 5px;''>edit</a></p>
								</div>
							</div>
						</div>";

					echo json_encode($data);
				}
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