<?php

class Course extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_course()
	{
		return $this->db->order_by('created_at DESC')->get('courses')->result_array();
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
		$this->db->insert('courses', $data);

		return $this->db->insert_id();
	}

	public function delete_course($course_info)
	{
		return $this->db->where('id', $course_info['course_id'])
						->delete('courses');
	}

}