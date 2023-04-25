<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_book extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('book',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_teacher($data = null)
	{
		$this->db->insert('book_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_co_teacher($data = null)
	{
		$this->db->insert('book_co_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_teacher_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_teacher');
		return $query->result();
	}
	
	public function get_co_teacher_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_co_teacher');
		return $query->result();
	}

	public function delete_teacher($book_id){
		$this->db->where('book_id', $book_id)->delete('book_teacher');
	}
	
	public function delete_co_teacher($book_id){
		$this->db->where('book_id', $book_id)->delete('book_co_teacher');
	}
	
	public function create_add_teacher($data = null)
	{
		$this->db->insert('book_add_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_add_co_teacher($data = null)
	{
		$this->db->insert('book_add_co_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_teacher_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_add_teacher');
		return $query->result();
	}
	
	public function get_add_co_teacher_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_add_co_teacher');
		return $query->result();
	}

	public function delete_add_teacher($book_id){
		$this->db->where('book_id', $book_id)->delete('book_add_teacher');
	}
	
	public function delete_add_co_teacher($book_id){
		$this->db->where('book_id', $book_id)->delete('book_add_co_teacher');
	}
	
	public function create_editor($data = null)
	{
		$this->db->insert('book_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_co_editor($data = null)
	{
		$this->db->insert('book_co_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_editor_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_editor');
		return $query->result();
	}
	
	public function get_co_editor_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_co_editor');
		return $query->result();
	}

	public function delete_editor($book_id){
		$this->db->where('book_id', $book_id)->delete('book_editor');
	}
	
	public function delete_co_editor($book_id){
		$this->db->where('book_id', $book_id)->delete('book_co_editor');
	}
	
	public function create_add_editor($data = null)
	{
		$this->db->insert('book_add_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_add_co_editor($data = null)
	{
		$this->db->insert('book_add_co_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_editor_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_add_editor');
		return $query->result();
	}
	
	public function get_add_co_editor_all($book_id)
	{
		$query = $this->db->where('book_id', $book_id)->get('book_add_co_editor');
		return $query->result();
	}

	public function delete_add_editor($book_id){
		$this->db->where('book_id', $book_id)->delete('book_add_editor');
	}
	
	public function delete_add_co_editor($book_id){
		$this->db->where('book_id', $book_id)->delete('book_add_co_editor');
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('book');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('book');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('book');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('book',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('book');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('book');
			$this->delete_teacher($id);
			$this->delete_add_teacher($id);
			$this->delete_editor($id);
			$this->delete_add_editor($id);
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('book');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('book');

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */