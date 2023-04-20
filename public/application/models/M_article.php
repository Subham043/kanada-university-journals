<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_article extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('article',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_teacher($data = null)
	{
		$this->db->insert('article_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_teacher_all($article_id)
	{
		$query = $this->db->where('article_id', $article_id)->get('article_teacher');
		return $query->result();
	}

	public function delete_teacher($article_id){
		$this->db->where('article_id', $article_id)->delete('article_teacher');
	}
	
	public function create_add_teacher($data = null)
	{
		$this->db->insert('article_add_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_teacher_all($article_id)
	{
		$query = $this->db->where('article_id', $article_id)->get('article_add_teacher');
		return $query->result();
	}

	public function delete_add_teacher($article_id){
		$this->db->where('article_id', $article_id)->delete('article_add_teacher');
	}
	
	public function create_editor($data = null)
	{
		$this->db->insert('article_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_editor_all($article_id)
	{
		$query = $this->db->where('article_id', $article_id)->get('article_editor');
		return $query->result();
	}

	public function delete_editor($article_id){
		$this->db->where('article_id', $article_id)->delete('article_editor');
	}
	
	public function create_add_editor($data = null)
	{
		$this->db->insert('article_add_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_editor_all($article_id)
	{
		$query = $this->db->where('article_id', $article_id)->get('article_add_editor');
		return $query->result();
	}

	public function delete_add_editor($article_id){
		$this->db->where('article_id', $article_id)->delete('article_add_editor');
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('article');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('article');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('article',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('article');
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
        return $this->db->count_all('article');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('article');

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */