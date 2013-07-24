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
							<div class='accordion-heading' id='course_group".$data['create_course']."'>
								<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#course".$data['create_course']."'>".$post_data['title']."</a>
							</div>
							<div id='course".$data['create_course']."' class='accordion-body collapse'>
								<div class='accordion-inner'>
									<p>".$post_data['description']."</p>
									<form action='courses/delete_course' method='post' class='delete_course pull-right'>
										<input type='hidden' name='form_action' value='delete_course'>
										<input type='hidden' name='course_id' value='".$data['create_course']."'>
										<button type='submit' class='delete'>delete</button> 
									</form>
									<form action='courses/delete_course' method='post' class='pull-right'>
										<input type='hidden' name='form_action' value='delete_course'>
										<input type='hidden' name='course_id' value='".$data['create_course']."'>
										<input type='hidden' name='course_title' value='".$post_data['title']."'>
										<input type='hidden' name='course_description' value='".$post_data['description']."'>
										<button class='edit' style='margin-right: 5px;''>edit</button>
									</form>
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

	public function delete_course()
	{
		$post_data = $this->input->post();
		if(isset($post_data['form_action']) && $post_data['form_action'] == "delete_course")
		{
			$this->load->model('Course');
			$data['delete_course'] = $this->Course->delete_course($post_data);

			if($data['delete_course'])
				$data['status'] = TRUE;
			else
				$data['status'] = FALSE;

			echo json_encode($data);
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */