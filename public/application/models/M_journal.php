<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_journal extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('journal',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_teacher($data = null)
	{
		$this->db->insert('journal_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_teacher_all($journal_id)
	{
		$query = $this->db->where('journal_id', $journal_id)->get('journal_teacher');
		return $query->result();
	}

	public function delete_teacher($journal_id){
		$this->db->where('journal_id', $journal_id)->delete('journal_teacher');
	}
	
	public function create_add_teacher($data = null)
	{
		$this->db->insert('journal_add_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_teacher_all($journal_id)
	{
		$query = $this->db->where('journal_id', $journal_id)->get('journal_add_teacher');
		return $query->result();
	}

	public function delete_add_teacher($journal_id){
		$this->db->where('journal_id', $journal_id)->delete('journal_add_teacher');
	}
	
	public function create_co_editor($data = null)
	{
		$this->db->insert('journal_co_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function get_co_editor_all($journal_id)
	{
		$query = $this->db->where('journal_id', $journal_id)->get('journal_co_editor');
		return $query->result();
	}
	
	public function delete_co_editor($journal_id){
		$this->db->where('journal_id', $journal_id)->delete('journal_co_editor');
	}
	
	public function create_add_co_editor($data = null)
	{
		$this->db->insert('journal_add_co_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function get_add_co_editor_all($journal_id)
	{
		$query = $this->db->where('journal_id', $journal_id)->get('journal_add_co_editor');
		return $query->result();
	}
	
	public function delete_add_co_editor($journal_id){
		$this->db->where('journal_id', $journal_id)->delete('journal_add_co_editor');
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('journal');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('journal',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('journal');
			$this->delete_teacher($id);
			$this->delete_add_teacher($id);
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('journal');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('journal');

        return $query->result();
    }

	public function get_main_count($search = null) {
		$this->db->select('journal.id');
		$this->db->from('journal_teacher');
		$this->db->join('journal','journal_teacher.journal_id = journal.id');
		$this->db->join('teacher','journal_teacher.teacher_id = teacher.id');
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('journal.title', $search, 'both');
			$this->db->or_like('journal.edition', $search, 'both');
			$this->db->or_like('journal.isbn', $search, 'both');
			$this->db->or_like('journal.name', $search, 'both');
		}
		return $this->db->get()->num_rows();
    }

    public function get_main_list($limit, $start, $search = null) {
        $this->db->select('journal.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal_teacher');
		$this->db->join('journal','journal_teacher.journal_id = journal.id');
		$this->db->join('teacher','journal_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = journal.publisher_id');
		$this->db->group_by('journal_teacher.journal_id'); 
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('journal.title', $search, 'both');
			$this->db->or_like('journal.edition', $search, 'both');
			$this->db->or_like('journal.isbn', $search, 'both');
			$this->db->or_like('journal.name', $search, 'both');
		}
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */