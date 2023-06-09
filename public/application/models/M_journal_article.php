<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_journal_article extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('journal_article',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}
	
	public function create_teacher($data = null)
	{
		$this->db->insert('journal_article_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_teacher_all($article_id)
	{
		$query = $this->db->where('journal_article_id', $article_id)->get('journal_article_teacher');
		return $query->result();
	}

	public function delete_teacher($article_id){
		$this->db->where('journal_article_id', $article_id)->delete('journal_article_teacher');
	}
	
	public function create_add_teacher($data = null)
	{
		$this->db->insert('journal_article_add_teacher',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_teacher_all($article_id)
	{
		$query = $this->db->where('journal_article_id', $article_id)->get('journal_article_add_teacher');
		return $query->result();
	}

	public function delete_add_teacher($article_id){
		$this->db->where('journal_article_id', $article_id)->delete('journal_article_add_teacher');
	}
	
	public function create_editor($data = null)
	{
		$this->db->insert('journal_article_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_editor_all($article_id)
	{
		$query = $this->db->where('journal_article_id', $article_id)->get('journal_article_editor');
		return $query->result();
	}

	public function delete_editor($article_id){
		$this->db->where('journal_article_id', $article_id)->delete('journal_article_editor');
	}
	
	public function create_add_editor($data = null)
	{
		$this->db->insert('journal_article_add_editor',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_add_editor_all($article_id)
	{
		$query = $this->db->where('journal_article_id', $article_id)->get('journal_article_add_editor');
		return $query->result();
	}

	public function delete_add_editor($article_id){
		$this->db->where('journal_article_id', $article_id)->delete('journal_article_add_editor');
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal_article');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('journal_article');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal_article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('journal_article',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('journal_article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('journal_article');
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
        return $this->db->count_all('journal_article');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('journal_article');

        return $query->result();
    }

	public function get_main_count($search = null) {
		$this->db->select('journal_article.id');
		$this->db->from('journal_article_teacher');
		$this->db->join('journal_article','journal_article_teacher.journal_article_id = journal_article.id');
		$this->db->join('teacher','journal_article_teacher.teacher_id = teacher.id');
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('journal_article.title', $search, 'both');
			$this->db->or_like('journal_article.edition', $search, 'both');
			$this->db->or_like('journal_article.isbn', $search, 'both');
			$this->db->or_like('journal_article.name', $search, 'both');
		}
		return $this->db->get()->num_rows();
    }

    public function get_main_list($limit, $start, $search = null) {
        $this->db->select('journal_article.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal_article_teacher');
		$this->db->join('journal_article','journal_article_teacher.journal_article_id = journal_article.id');
		$this->db->join('teacher','journal_article_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = journal_article.publisher_id');
		$this->db->group_by('journal_article_teacher.journal_article_id'); 
		if(!empty($search)){
			$this->db->like('teacher.first_name', $search, 'both');
			$this->db->or_like('teacher.last_name', $search, 'both');
			$this->db->or_like('journal_article.title', $search, 'both');
			$this->db->or_like('journal_article.edition', $search, 'both');
			$this->db->or_like('journal_article.isbn', $search, 'both');
			$this->db->or_like('journal_article.name', $search, 'both');
		}
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */