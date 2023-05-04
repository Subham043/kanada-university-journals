<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_department extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('department',$data);
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
		$query = $this->db->get('department');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function get_all()
	{
		$query = $this->db->get('department');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('department');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('department',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('department');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('department');
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('department');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('department');

        return $query->result();
    }

	public function get_list_main($limit, $start, $search = null) {
        $this->db->limit($limit, $start);
		if(!empty($search)){
			$this->db->like('name', $search, 'both');
			$this->db->or_like('code', $search, 'both');
		}
		$query = $this->db->get('department');
        return $query->result();
    }

	public function get_conference_main_count($department_id) {
        return $this->db->where('department_id', $department_id)->get('conference')->num_rows();
    }

    public function get_list_conference_main($limit, $start, $department_id) {
		
		$this->db->select('conference.*, teacher.first_name as first_name, teacher.last_name as last_name, teacher.prefix as prefix');
		$this->db->from('conference');
		$this->db->join('teacher','teacher.id = conference.teacher_id');
		$this->db->where('conference.department_id', $department_id);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
		// print_r($query->result());exit;
        return $query->result();
		
    }
	
	public function get_journal_articles_main_count($department_id) {
		$this->db->select('journal_article.id');
		$this->db->from('journal_article');
		$this->db->join('department','journal_article.department_id = department.id');
        $this->db->where('journal_article.department_id', $department_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_journal_articles_main($limit, $start, $department_id) {
		
		$this->db->select('journal_article.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal_article_teacher');
		$this->db->join('journal_article','journal_article_teacher.journal_article_id = journal_article.id');
		$this->db->join('teacher','journal_article_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = journal_article.publisher_id');
		$this->db->where('journal_article.department_id', $department_id);
		$this->db->group_by('journal_article_teacher.journal_article_id'); 
        $query = $this->db->get();

        return $query->result();
    }
	
	public function get_book_articles_main_count($department_id) {
		$this->db->select('book_article.id');
		$this->db->from('book_article');
		$this->db->join('department','book_article.department_id = department.id');
        $this->db->where('book_article.department_id', $department_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_book_articles_main($limit, $start, $department_id) {

		$this->db->select('book_article.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('book_article_teacher');
		$this->db->join('book_article','book_article_teacher.book_article_id = book_article.id');
		$this->db->join('teacher','book_article_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = book_article.publisher_id');
		$this->db->where('book_article.department_id', $department_id);
		$this->db->group_by('book_article_teacher.book_article_id'); 
        $query = $this->db->get();

        return $query->result();
    }

	public function get_book_main_count($department_id) {
		$this->db->select('book.id');
		$this->db->from('book');
		$this->db->join('department','book.department_id = department.id');
        $this->db->where('book.department_id', $department_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_book_main($limit, $start, $department_id) {
		
		$this->db->select('book.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('book_teacher');
		$this->db->join('book','book_teacher.book_id = book.id');
		$this->db->join('teacher','book_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = book.publisher_id');
		$this->db->where('book.department_id', $department_id);
		$this->db->group_by('book_teacher.book_id'); 
        $query = $this->db->get();

        return $query->result();
    }
	
	public function get_journal_main_count($department_id) {
		$this->db->select('journal.id');
		$this->db->from('journal');
		$this->db->join('department','journal.department_id = department.id');
        $this->db->where('journal.department_id', $department_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_journal_main($limit, $start, $department_id) {
		$this->db->select('journal.*, publisher.name as publisher_name,GROUP_CONCAT(CONCAT(teacher.prefix, ". ", teacher.first_name, " ",teacher.last_name) SEPARATOR ", ") as first_last_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal_teacher');
		$this->db->join('journal','journal_teacher.journal_id = journal.id');
		$this->db->join('teacher','journal_teacher.teacher_id = teacher.id');
		$this->db->join('publisher','publisher.id = journal.publisher_id');
		$this->db->where('journal.department_id', $department_id);
		$this->db->group_by('journal_teacher.journal_id'); 
        $query = $this->db->get();

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */