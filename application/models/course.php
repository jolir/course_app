<?php

class Course extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_course()
	{
		return $this->db->get('courses')->result_array();
	}

	public function create_course($course_info)
	{
		$this->load->helper('date');
		$data = array(
					"title" => $course_info['title'],
					"description" => $course_info['description'],
					"created_at" => date("Y-m-d H:i:s"),
					"updated_at" => date("Y-m-d H:i:s")
				);
		return $this->db->insert('courses', $data);
	}

}