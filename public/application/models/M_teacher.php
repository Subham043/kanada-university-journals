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
	
	public function get_data_with_department($id = null)
	{
		$this->db->select('teacher.*, department.name, department.code');
		$this->db->from('teacher');
		$this->db->join('department','department.id = teacher.department_id','left');
		$this->db->where('teacher.id', $id);
		$query = $this->db->get();
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
		$this->db->select('teacher.*, department.name, department.code');
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

	public function get_conference_main_count($teacher_id) {
        return $this->db->where('teacher_id', $teacher_id)->get('conference')->num_rows();
    }

    public function get_list_conference_main($limit, $start, $teacher_id) {
        $this->db->limit($limit, $start);
		$this->db->where('teacher_id', $teacher_id);
        $query = $this->db->get('conference');

        return $query->result();
    }
	
	public function get_journal_articles_main_count($teacher_id) {
		$this->db->select('journal_article_teacher.id');
		$this->db->from('journal_article');
		$this->db->join('journal_article_teacher','journal_article_teacher.journal_article_id = journal_article.id');
        $this->db->where('journal_article_teacher.teacher_id', $teacher_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_journal_articles_main($limit, $start, $teacher_id) {
		$this->db->select('journal_article.*, publisher.name as publisher_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal_article');
		$this->db->join('journal_article_teacher','journal_article_teacher.journal_article_id = journal_article.id');
		$this->db->join('publisher','publisher.id = journal_article.publisher_id');
		$this->db->where('journal_article_teacher.teacher_id', $teacher_id);
        $query = $this->db->get();

        return $query->result();
    }
	
	public function get_book_articles_main_count($teacher_id) {
		$this->db->select('book_article_teacher.id');
		$this->db->from('book_article');
		$this->db->join('book_article_teacher','book_article_teacher.book_article_id = book_article.id');
        $this->db->where('book_article_teacher.teacher_id', $teacher_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_book_articles_main($limit, $start, $teacher_id) {
		$this->db->select('book_article.*, publisher.name as publisher_name');
        $this->db->limit($limit, $start);
		$this->db->from('book_article');
		$this->db->join('book_article_teacher','book_article_teacher.book_article_id = book_article.id');
		$this->db->join('publisher','publisher.id = book_article.publisher_id');
		$this->db->where('book_article_teacher.teacher_id', $teacher_id);
        $query = $this->db->get();

        return $query->result();
    }

	public function get_book_main_count($teacher_id) {
		$this->db->select('book_teacher.id');
		$this->db->from('book');
		$this->db->join('book_teacher','book_teacher.book_id = book.id');
        $this->db->where('book_teacher.teacher_id', $teacher_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_book_main($limit, $start, $teacher_id) {
		$this->db->select('book.*, publisher.name as publisher_name');
        $this->db->limit($limit, $start);
		$this->db->from('book');
		$this->db->join('book_teacher','book_teacher.book_id = book.id');
		$this->db->join('publisher','publisher.id = book.publisher_id');
		$this->db->where('book_teacher.teacher_id', $teacher_id);
        $query = $this->db->get();

        return $query->result();
    }
	
	public function get_journal_main_count($teacher_id) {
		$this->db->select('journal_teacher.id');
		$this->db->from('journal');
		$this->db->join('journal_teacher','journal_teacher.journal_id = journal.id');
        $this->db->where('journal_teacher.teacher_id', $teacher_id);
		return $this->db->get()->num_rows();
    }

    public function get_list_journal_main($limit, $start, $teacher_id) {
		$this->db->select('journal.*, publisher.name as publisher_name');
        $this->db->limit($limit, $start);
		$this->db->from('journal');
		$this->db->join('journal_teacher','journal_teacher.journal_id = journal.id');
		$this->db->join('publisher','publisher.id = journal.publisher_id');
		$this->db->where('journal_teacher.teacher_id', $teacher_id);
        $query = $this->db->get();

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */