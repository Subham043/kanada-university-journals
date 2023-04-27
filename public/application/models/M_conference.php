<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_conference extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('conference',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('conference');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('conference');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('conference');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('conference',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('conference');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('conference');
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('conference');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('conference');

        return $query->result();
    }
	
	public function get_main_count($search = null) {
		$this->db->select('conference.id');
		$this->db->from('conference');
		$this->db->join('teacher','teacher.id = conference.teacher_id');
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('conference.title', $search, 'both');
			$this->db->or_like('conference.conference', $search, 'both');
			$this->db->or_like('conference.isbn', $search, 'both');
			$this->db->or_like('conference.place', $search, 'both');
		}
		$query = $this->db->get();

        return $query->num_rows();
    }

    public function get_main_list($limit, $start, $search = null) {

		$this->db->select('conference.*, teacher.first_name, teacher.last_name, teacher.prefix');
		$this->db->from('conference');
		$this->db->join('teacher','teacher.id = conference.teacher_id');
        $this->db->limit($limit, $start);
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('conference.title', $search, 'both');
			$this->db->or_like('conference.conference', $search, 'both');
			$this->db->or_like('conference.isbn', $search, 'both');
			$this->db->or_like('conference.place', $search, 'both');
		}
		$query = $this->db->get();

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */