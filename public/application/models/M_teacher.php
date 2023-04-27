<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_teacher extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('teacher',$data);
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
		$query = $this->db->get('teacher');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('teacher');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('teacher');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('teacher',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('teacher');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('teacher');
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('teacher');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('teacher');

        return $query->result();
    }
    
	public function get_list_main($limit, $start, $search = null, $department = null) {
		$this->db->select('teacher.*, department.*');
		$this->db->from('teacher');
		$this->db->join('department','department.id = teacher.department_id','left');
        $this->db->limit($limit, $start);
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('department.name', $search, 'both');
		}
		if(!empty($department)){
			$this->db->where('department.code', $department);
		}
		$query = $this->db->get();
        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */